<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    echo "login_required";
    exit();
}

$customer_id = $_SESSION['user_id'];
$provider = $_POST['provider'];
$service = $_POST['service'];
$price = $_POST['price'];
$date = $_POST['date'];
$current_date = date('Y-m-d');
if($date < $current_date){
    echo "Invalid: Booking date cannot be in the past.";
    exit();
}
$time = $_POST['time'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$sql = "INSERT INTO bookings(customer_id,provider,service,price,date,time,address,phone,status)
VALUES('$customer_id','$provider','$service','$price','$date','$time','$address','$phone','Pending')";

if($conn->query($sql)){
    echo "success";
}else{
    echo "error: " . $conn->error;
}
?>
