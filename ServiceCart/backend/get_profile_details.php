<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$response = [];

if ($role === 'Customer') {
    $sql = "SELECT name, email, mobile FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    $response = $result->fetch_assoc();
} else {
    $email = $_SESSION['user_email'] ?? '';
    if (!$email) {
        $sql_email = "SELECT email FROM users WHERE id = '$user_id'";
        $res_email = $conn->query($sql_email);
        $row_email = $res_email->fetch_assoc();
        $email = $row_email['email'];
    }
    $sql = "SELECT * FROM providers WHERE email = '$email'";
    $result = $conn->query($sql);
    $response = $result->fetch_assoc();
}

echo json_encode($response);
?>
