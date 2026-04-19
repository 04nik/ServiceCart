<?php
include "db.php";
$res = $conn->query("DESCRIBE bookings");
echo "BOOKINGS:\n";
while($row = $res->fetch_assoc()) {print_r($row);}
$res = $conn->query("DESCRIBE reviews");
echo "\nREVIEWS:\n";
while($row = $res->fetch_assoc()) {print_r($row);}
$res = $conn->query("DESCRIBE users");
echo "\nUSERS:\n";
while($row = $res->fetch_assoc()) {print_r($row);}
$res = $conn->query("DESCRIBE providers");
echo "\nPROVIDERS:\n";
while($row = $res->fetch_assoc()) {print_r($row);}
?>
