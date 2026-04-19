<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo "Login required";
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role === 'Customer') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $sql = "UPDATE users SET name = ?, email = ?, mobile = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $mobile, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['userName'] = $name; // Update session name
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
} else if ($role === 'Provider') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $experience = $_POST['experience'];
    $price = $_POST['price'];
    
    // For providers, we identify by email or id if we have to. 
    // Usually providers table uses email from users table or has its own link.
    // get_profile_details.php uses session email or session id to find in providers.
    
    $email = $_SESSION['user_email'] ?? '';
    if (!$email) {
        $sql_email = "SELECT email FROM users WHERE id = '$user_id'";
        $res_email = $conn->query($sql_email);
        $row_email = $res_email->fetch_assoc();
        $email = $row_email['email'];
    }

    $sql = "UPDATE providers SET name = ?, phone = ?, location = ?, experience = ?, price = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $name, $phone, $location, $experience, $price, $email);

    if ($stmt->execute()) {
        // Also update name in users table for consistency
        $sql_user = "UPDATE users SET name = ? WHERE id = ?";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("si", $name, $user_id);
        $stmt_user->execute();
        
        $_SESSION['userName'] = $name;
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
