<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo "login_required";
    exit();
}

$customer_id = $_SESSION['user_id'];
$booking_id = $_POST['booking_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'] ?? '';

// Check if booking exists, belongs to the customer, and is completed
$check_stmt = $conn->prepare("SELECT provider, status FROM bookings WHERE id = ? AND customer_id = ?");
$check_stmt->bind_param("ii", $booking_id, $customer_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows === 0) {
    echo "Booking not found or not authorized.";
    exit();
}

$booking = $check_result->fetch_assoc();
if ($booking['status'] !== 'Completed') {
    echo "Feedback can only be given for completed services.";
    exit();
}

$provider_name = $booking['provider'];

// Check if review already exists
$review_check = $conn->prepare("SELECT id FROM reviews WHERE booking_id = ?");
$review_check->bind_param("i", $booking_id);
$review_check->execute();
if ($review_check->get_result()->num_rows > 0) {
    echo "Feedback already submitted for this booking.";
    exit();
}

// Get the provider's user ID from their name (using TRIM and case-insensitive check)
$prov_sql = "SELECT id, email FROM users WHERE TRIM(name) = TRIM(?) AND role = 'Provider' LIMIT 1";
$prov_stmt = $conn->prepare($prov_sql);
$prov_stmt->bind_param("s", $provider_name);
$prov_stmt->execute();
$prov_res = $prov_stmt->get_result();
$prov_data = $prov_res->fetch_assoc();
$provider_id = $prov_data['id'] ?? null;
$provider_email_from_user = $prov_data['email'] ?? '';

// Fallback: If not found in users by name, try to find in providers table by name to get email, then link back to users
if (!$provider_id) {
    $fallback_sql = "SELECT email FROM providers WHERE TRIM(name) = TRIM(?) LIMIT 1";
    $fallback_stmt = $conn->prepare($fallback_sql);
    $fallback_stmt->bind_param("s", $provider_name);
    $fallback_stmt->execute();
    $fallback_res = $fallback_stmt->get_result();
    if ($fallback_row = $fallback_res->fetch_assoc()) {
        $p_email = $fallback_row['email'];
        $user_sql = "SELECT id FROM users WHERE email = ? AND role = 'Provider' LIMIT 1";
        $user_stmt = $conn->prepare($user_sql);
        $user_stmt->bind_param("s", $p_email);
        $user_stmt->execute();
        $provider_id = $user_stmt->get_result()->fetch_assoc()['id'] ?? null;
    }
}

// Insert into reviews table
$insert_stmt = $conn->prepare("INSERT INTO reviews (booking_id, customer_id, provider_id, provider_name, rating, comment) VALUES (?, ?, ?, ?, ?, ?)");
$insert_stmt->bind_param("iiisds", $booking_id, $customer_id, $provider_id, $provider_name, $rating, $comment);

if ($insert_stmt->execute()) {
    // Also update provider's average rating in providers table based on their latest reviews
    // We match by email since that's a common link between users and providers
    $email_fetch = $conn->prepare("SELECT email FROM users WHERE id = ?");
    $email_fetch->bind_param("i", $provider_id);
    $email_fetch->execute();
    $provider_email = $email_fetch->get_result()->fetch_assoc()['email'];
    
    $update_rating_stmt = $conn->prepare("UPDATE providers SET rating = (SELECT ROUND(AVG(rating), 1) FROM reviews WHERE provider_id = ?) WHERE email = ?");
    $update_rating_stmt->bind_param("is", $provider_id, $provider_email);
    $update_rating_stmt->execute();
    
    echo "success";
} else {
    echo "error: " . $conn->error;
}
?>
