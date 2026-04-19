<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Customer') {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$customer_id = $_SESSION['user_id'];

$sql = "SELECT b.*, (SELECT id FROM reviews r WHERE r.booking_id = b.id LIMIT 1) as review_id 
        FROM bookings b 
        WHERE b.customer_id = '$customer_id' 
        ORDER BY b.id DESC";
$result = $conn->query($sql);

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $row['is_reviewed'] = !empty($row['review_id']);
    $bookings[] = $row;
}

echo json_encode($bookings);
?>
