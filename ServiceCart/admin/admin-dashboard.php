<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../frontend/login.php");
    exit();
}

// Fetch Stats
$user_count_result = $conn->query("SELECT COUNT(*) as total FROM users");
$user_count = $user_count_result->fetch_assoc()['total'];

$provider_count_result = $conn->query("SELECT COUNT(*) as total FROM providers");
$provider_count = $provider_count_result->fetch_assoc()['total'];

$booking_count_result = $conn->query("SELECT COUNT(*) as total FROM bookings");
$booking_count = $booking_count_result->fetch_assoc()['total'];

$sql = "SELECT * FROM bookings ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Admin Dashboard | Service Cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../frontend/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>

body{
padding-top:70px;
background:#f4f6f9;
}

.sidebar{
height:100vh;
background:#ffffff;
border-right:1px solid #ddd;
padding:20px;
}

.sidebar a{
display:block;
padding:10px;
margin-bottom:5px;
color:#333;
text-decoration:none;
border-radius:5px;
}

.sidebar a:hover{
background:#0d6efd;
color:white;
}

.stat-card{
box-shadow:0 0 10px rgba(0,0,0,0.1);
border-radius:10px;
transition: transform 0.3s ease;
}

.stat-card:hover {
transform: translateY(-5px);
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
<div class="container-fluid">
<span class="navbar-brand fw-bold">ServiceCart Admin</span>
<div class="collapse navbar-collapse justify-content-end">
  <div class="dropdown">
    <button class="btn btn-outline-light dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['user_name']; ?>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="adminDropdown">
      <li><a class="dropdown-item" href="admin-profile.php"><i class="fas fa-user-edit me-2"></i> Update Profile</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item text-danger" href="../backend/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
    </ul>
  </div>
</div>
</div>
</nav>


<div class="container-fluid">

<div class="row">

<!-- SIDEBAR -->
<div class="col-md-2 sidebar">

<a href="admin-dashboard.php" class="bg-primary text-white">Dashboard</a>
<a href="view-users.php">Users</a>
<a href="view-providers.php">Service Providers</a>
<a href="view-bookings.php">Bookings</a>

</div>


<!-- MAIN CONTENT -->
<div class="col-md-10 p-4">

<h3 class="mb-4">Admin Overview</h3>

<!-- STATS CARDS -->
<div class="row mb-4">
    <div class="col-md-4">
        <a href="view-users.php" class="text-decoration-none">
            <div class="card stat-card bg-white border-0 p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 text-muted">Total Users</h5>
                        <h2 class="mb-0 fw-bold text-dark"><?php echo $user_count; ?></h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="view-providers.php" class="text-decoration-none">
            <div class="card stat-card bg-white border-0 p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle p-3 me-3">
                        <i class="fas fa-user-tie fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 text-muted">Service Providers</h5>
                        <h2 class="mb-0 fw-bold text-dark"><?php echo $provider_count; ?></h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="view-bookings.php" class="text-decoration-none">
            <div class="card stat-card bg-white border-0 p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 text-muted">Total Bookings</h5>
                        <h2 class="mb-0 fw-bold text-dark"><?php echo $booking_count; ?></h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<h4 class="mb-3">Recent Booking Requests</h4>

<table class="table table-bordered table-striped">

<thead class="table-primary">

<tr>
<th>ID</th>
<th>Provider</th>
<th>Service</th>
<th>Date</th>
<th>Time</th>
<th>Phone</th>
<th>Address</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

$status = $row['status'];

if($status == "Pending"){
$badge = "<span class='badge bg-warning text-dark'>Pending</span>";
}
elseif($status == "Confirmed"){
$badge = "<span class='badge bg-primary'>Confirmed</span>";
}
elseif($status == "Completed"){
$badge = "<span class='badge bg-success'>Completed</span>";
}
elseif($status == "Rejected"){
$badge = "<span class='badge bg-danger'>Rejected</span>";
}
else{
$badge = $status;
}

echo "<tr>

<td>".$row['id']."</td>
<td>".$row['provider']."</td>
<td>".$row['service']."</td>
<td>".$row['date']."</td>
<td>".$row['time']."</td>
<td>".$row['phone']."</td>
<td>".$row['address']."</td>

<td>".$badge."</td>

</tr>";

}

}else{

echo "<tr><td colspan='9' class='text-center'>No Bookings Found</td></tr>";

}

?>

</tbody>

</table>

</div>

</div>

</div>
<?php include "../includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
