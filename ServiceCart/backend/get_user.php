<?php
session_start();
if (isset($_SESSION['user_id'])) {
    echo json_encode([
        "loggedIn" => true,
        "userName" => $_SESSION['user_name'],
        "role" => $_SESSION['role']
    ]);
} else {
    echo json_encode(["loggedIn" => false]);
}
?>
