<?php

include "db.php";
   // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$mobile = $conn->real_escape_string($_POST['mobile']);
$role = 'Customer';
$password = $conn->real_escape_string($_POST['password']);

$sql = "INSERT INTO users (name,email,mobile,role,password)
VALUES ('$name','$email','$mobile','$role','$password')";

if ($conn->query($sql) === TRUE) {

echo "<script>
alert('Registration Successful');
window.location.href='../frontend/login.php';
</script>";

} else {

echo "Error: " . $conn->error;

}

$conn->close();

}

?>
