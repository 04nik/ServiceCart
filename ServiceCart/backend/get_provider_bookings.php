<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Provider') {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$provider_name = $_SESSION['user_name'];

$sql = "SELECT * FROM bookings WHERE provider = '$provider_name' ORDER BY id DESC";
$result = $conn->query($sql);

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

echo json_encode($bookings);
?>
