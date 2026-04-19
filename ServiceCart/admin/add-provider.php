<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../frontend/login.php");
    exit();
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $service = $_POST['service'];
    $rating = 0.0; // Default initial rating
    $experience = $_POST['experience'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO providers (name, service, rating, experience, price, location, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdidsss", $name, $service, $rating, $experience, $price, $location, $phone, $email);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>New provider added successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Provider | Service Cart Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../frontend/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
body{ padding-top:70px; background:#f4f6f9; }
.sidebar{ height:100vh; background:#ffffff; border-right:1px solid #ddd; padding:20px; }
.sidebar a{ display:block; padding:10px; margin-bottom:5px; color:#333; text-decoration:none; border-radius:5px; }
.sidebar a:hover{ background:#0d6efd; color:white; }
.form-container{ background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
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
            <a href="view-providers.php">Service Providers</a>
            <a href="add-provider.php" class="bg-primary text-white">Add Provider</a>
            <a href="view-bookings.php">Bookings</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-container">
                        <h3 class="mb-4">Add New Service Provider</h3>
                        <?php echo $message; ?>
                        <form action="add-provider.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Service Type</label>
                                    <select name="service" class="form-select" required>
                                        <option value="">Select Service</option>
                                        <option value="Plumbing">Plumbing</option>
                                        <option value="Electrical">Electrical</option>
                                        <option value="Cleaning">Cleaning</option>
                                        <option value="Carpentry">Carpentry</option>
                                        <option value="Painting">Painting</option>
                                        <option value="Pest Control">Pest Control</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Experience (Years)</label>
                                    <input type="number" name="experience" class="form-control" required min="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price per Visit (₹)</label>
                                    <input type="number" name="price" class="form-control" required min="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control" required pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="10-digit number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="reset" class="btn btn-secondary me-2">Reset</button>
                                <button type="submit" class="btn btn-primary">Add Provider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
