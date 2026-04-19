<?php
include "db.php";
echo "--- BOOKINGS for Painting ---\n";
$res = $conn->query("SELECT * FROM bookings WHERE service LIKE '%Painting%'");
while($row = $res->fetch_assoc()) {print_r($row);}

echo "\n--- USERS with Role Provider ---\n";
$res = $conn->query("SELECT id, name, email, role FROM users");
while($row = $res->fetch_assoc()) {print_r($row);}

echo "\n--- PROVIDERS Table ---\n";
$res = $conn->query("SELECT id, name, email, service FROM providers");
while($row = $res->fetch_assoc()) {print_r($row);}

echo "\n--- REVIEWS Table ---\n";
$res = $conn->query("SELECT id, booking_id, customer_id, provider_id, provider_name, rating, comment FROM reviews");
while($row = $res->fetch_assoc()) {print_r($row);}
?>
