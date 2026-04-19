<?php
session_start();
include "../backend/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $rating = 0.0; // Default initial rating
    $experience = $_POST['experience'];
    $service = $_POST['service'];
    $price = $_POST['price'];
    $city = $_POST['city'];
    $district = $_POST['district'];

    // Basic validation
    if ($password !== $confirm_password) {
        $message = "<div class='alert alert-danger'>Passwords do not match!</div>";
    } else {
        // Check if email already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $message = "<div class='alert alert-danger'>Email already registered!</div>";
        } else {
            // Start transaction
            $conn->begin_transaction();

            try {
                // 1. Insert into users table
                $role = 'Provider';
                $insert_user = $conn->prepare("INSERT INTO users (name, email, mobile, role, password) VALUES (?, ?, ?, ?, ?)");
                $insert_user->bind_param("sssss", $name, $email, $mobile, $role, $password);
                $insert_user->execute();
                
                // 2. Insert into providers table
                $location = $city . ", " . $district;
                $insert_provider = $conn->prepare("INSERT INTO providers (name, service, rating, experience, price, location, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_provider->bind_param("ssdidsss", $name, $service, $rating, $experience, $price, $location, $mobile, $email);
                $insert_provider->execute();

                $conn->commit();
                $message = "<div class='alert alert-success'>Registration successful! You can now <a href='login.php'>Login</a>.</div>";
            } catch (Exception $e) {
                $conn->rollback();
                $message = "<div class='alert alert-danger'>Error during registration: " . $e->getMessage() . "</div>";
            }
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Provider Registration | ServiceCart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .register-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .form-label { font-weight: 600; font-size: 0.9rem; color: #444; }
        .input-group-text { background: #f8f9fa; color: #0d6efd; border-right: none; }
        .form-control { border-left: none; }
        .form-control:focus { box-shadow: none; border-color: #dee2e6; }
        .input-group:focus-within { box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1); border-radius: 0.375rem; }
    </style>
</head>
<body class="bg-light" style="padding-top: 80px;">

  <!-- 🔷 FIXED NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">
        <div class="brand-logo"><i class="fas fa-screwdriver-wrench"></i></div>
        <span>ServiceCart</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center ms-auto">
          <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
          <a href="register.php" class="btn btn-light btn-sm">Register</a>
        </div>
      </div>
    </div>
  </nav>

<div class="container">
    <div class="register-container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Join as a Partner</h2>
            <p class="text-muted">Register your service and start earning today</p>
        </div>

        <?php echo $message; ?>

        <form action="provider-register.php" method="POST">
            <div class="row g-4">
                <!-- Personal Info -->
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="tel" name="mobile" class="form-control" placeholder="10-digit number" required pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Service Category</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tools"></i></span>
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

                <!-- Professional Details -->
                <div class="col-md-6">
                    <label class="form-label">Experience (Years)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                        <input type="number" name="experience" class="form-control" placeholder="e.g. 5" min="0" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Service Price (₹)</label>
                    <div class="input-group">
                        <span class="input-group-text fw-bold">₹</span>
                        <input type="number" name="price" class="form-control" placeholder="Min. charge" min="0" required>
                    </div>
                </div>

                <!-- Location -->
                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                        <input type="text" name="city" class="form-control" placeholder="Your City" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">District</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="district" class="form-control" placeholder="Your District" required>
                    </div>
                </div>

                <!-- Passwords -->
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Create Password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Re-type Password" required>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-3 fw-bold">Create Account</button>
                    </div>
                    <div class="text-center mt-3">
                        Already have an account? <a href="login.php" class="text-decoration-none fw-bold">Login Here</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
