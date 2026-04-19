<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../frontend/login.php");
    exit();
}

$sql = "SELECT * FROM providers ORDER BY id DESC";
$result = $conn->query($sql);

$message = "";
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM providers WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: view-providers.php?msg=deleted");
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Error deleting provider.</div>";
    }
}

if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $message = "<div class='alert alert-success'>Provider deleted successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Service Providers | Admin Dashboard</title>
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

.table-container{
background: #fff;
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0,0,0,0.1);
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

<a href="admin-dashboard.php">Dashboard</a>
<a href="view-users.php">Users</a>
<a href="view-providers.php" class="bg-primary text-white">Service Providers</a>
<a href="view-bookings.php">Bookings</a>

</div>


<!-- MAIN CONTENT -->
<div class="col-md-10 p-4">

<!-- <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Registered Service Providers</h3>
    <a href="add-provider.php" class="btn btn-primary">Add New Provider</a>
</div> -->

<?php echo $message; ?>

<div class="table-container">
    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Service</th>
                <th>Experience</th>
                <th>Price</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td><span class='badge bg-info text-dark'>".$row['service']."</span></td>
                        <td>".$row['experience']." Yrs</td>
                        <td>₹".$row['price']."</td>
                        <td>".$row['location']."</td>
                        <td>
                            <small><b>Ph:</b> ".$row['phone']."</small><br>
                            <small><b>Email:</b> ".$row['email']."</small>
                        </td>
                        <td><span class='text-warning fw-bold'>★ ".$row['rating']."</span></td>
                        <td>
                            <a href='view-providers.php?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this provider?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No Providers Found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</div>

</div>

</div>
<?php include "../includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
