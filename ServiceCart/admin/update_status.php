<?php

include "../backend/db.php";

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE bookings SET status='$status' WHERE id=$id";

$conn->query($sql);

if(isset($_GET['from']) && $_GET['from'] == 'provider'){
    header("Location: ../provider/provider-dashboard.php");
} elseif(isset($_GET['from']) && $_GET['from'] == 'bookings'){
    header("Location: view-bookings.php?msg=updated");
} else {
    header("Location: admin-dashboard.php");
}
?>
