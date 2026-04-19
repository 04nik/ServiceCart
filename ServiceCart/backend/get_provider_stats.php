<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Provider') {
    echo json_encode([]);
    exit();
}

$provider_name = $_SESSION['user_name'];

// Get earnings from completed bookings
$sql = "SELECT SUM(price) as total_earned, COUNT(*) as total_bookings, 
        (SELECT COUNT(*) FROM bookings WHERE provider='$provider_name' AND status='Completed') as completed_count
        FROM bookings WHERE provider = '$provider_name'";

$result = $conn->query($sql);
$stats = $result->fetch_assoc();

// Also get rating from providers table
$sql_info = "SELECT rating, experience FROM providers WHERE name='$provider_name'";
$result_info = $conn->query($sql_info);
$info = $result_info->fetch_assoc();

$response = [
    "total_earned" => $stats['total_earned'] ?? 0,
    "total_bookings" => $stats['total_bookings'] ?? 0,
    "completed_count" => $stats['completed_count'] ?? 0,
    "rating" => $info['rating'] ?? 0.0,
    "experience" => $info['experience'] ?? 0
];

echo json_encode($response);
?>
