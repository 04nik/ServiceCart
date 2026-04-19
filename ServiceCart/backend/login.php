<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'Admin') {
            header("Location: ../admin/admin-dashboard.php");
        } elseif ($row['role'] == 'Provider') {
            header("Location: ../provider/provider-dashboard.php");
        } else {
            header("Location: ../frontend/user-dashboard.php");
        }
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location.href='../frontend/login.php';</script>";
    }
}
?>
