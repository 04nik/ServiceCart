<?php
include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$service = $_POST['service'];
$location = $_POST['location'];

$sql = "INSERT INTO services(name,email,phone,service,location)
VALUES('$name','$email','$phone','$service','$location')";

if($conn->query($sql)){
    echo "Service submitted successfully";
}else{
    echo "Error: " . $conn->error;
}
?>
