<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo "login_required";
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role === 'Customer') {
    // Mark all currently displayed notifications as read for this customer
    $sql = "UPDATE bookings SET is_read_customer = 1 WHERE customer_id = ? AND status != 'Pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    echo "success";
} elseif ($role === 'Provider') {
    $provider_name = $_SESSION['user_name'];
    // Mark pending bookings as read for provider
    $sql1 = "UPDATE bookings SET is_read_provider = 1 WHERE provider = ? AND status = 'Pending'";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("s", $provider_name);
    $stmt1->execute();
    
    // Mark reviews as read for provider (RELIABLE with id)
    $sql2 = "UPDATE reviews SET is_read_provider = 1 WHERE provider_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    
    echo "success";
} else {
    echo "invalid_role";
}
?>
