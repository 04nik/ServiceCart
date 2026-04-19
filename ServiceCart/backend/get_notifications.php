<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$notifications = [];

if ($role === 'Customer') {
    // Get bookings that are NOT pending AND not yet read by customer
    $sql = "SELECT b.* FROM bookings b WHERE b.customer_id = '$user_id' AND b.status != 'Pending' AND b.is_read_customer = 0 ORDER BY b.id DESC LIMIT 5";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $message = ""; $icon = "";
            if ($row['status'] == 'Confirmed') { $message = "Your request for " . $row['service'] . " has been approved by " . $row['provider'] . "."; $icon = "✅"; }
            elseif ($row['status'] == 'Completed') { $message = "Service for " . $row['service'] . " is marked as completed. Thank you!"; $icon = "🎉"; }
            elseif ($row['status'] == 'Rejected') { $message = "Sorry, your request for " . $row['service'] . " was declined by " . $row['provider'] . "."; $icon = "❌"; }
            $notifications[] = ["id" => $row['id'], "type" => "booking", "message" => $message, "icon" => $icon, "date" => $row['date']];
        }
    }
} elseif ($role === 'Provider') {
    $provider_name = $_SESSION['user_name'];
    // 1. New Pending Bookings (matching by provider name but also can use ID if we had it. For now, name is still used in bookings table)
    $sql_bookings = "SELECT * FROM bookings WHERE provider = ? AND status = 'Pending' AND is_read_provider = 0 ORDER BY id DESC LIMIT 3";
    $stmt_book = $conn->prepare($sql_bookings);
    $stmt_book->bind_param("s", $provider_name);
    $stmt_book->execute();
    $res_bookings = $stmt_book->get_result();
    while($row = $res_bookings->fetch_assoc()) {
        $notifications[] = [
            "id" => $row['id'],
            "type" => "booking",
            "message" => "New request for " . $row['service'] . " received.",
            "icon" => "🔔",
            "date" => $row['date']
        ];
    }
    
    // 2. New Feedback (RELIABLY USING provider_id now)
    $sql_reviews = "SELECT r.*, u.name as customer_name FROM reviews r JOIN users u ON r.customer_id = u.id WHERE r.provider_id = ? AND r.is_read_provider = 0 ORDER BY r.id DESC LIMIT 3";
    $stmt_rev = $conn->prepare($sql_reviews);
    $stmt_rev->bind_param("i", $user_id);
    $stmt_rev->execute();
    $res_reviews = $stmt_rev->get_result();
    while($row = $res_reviews->fetch_assoc()) {
        $notifications[] = [
            "id" => $row['id'],
            "type" => "review",
            "message" => "You received a " . $row['rating'] . "⭐ review from " . $row['customer_name'] . ".",
            "icon" => "⭐",
            "date" => date('Y-m-d', strtotime($row['created_at']))
        ];
    }
}

echo json_encode($notifications);
?>
