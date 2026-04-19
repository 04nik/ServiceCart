<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Provider') {
    header("Location: ../frontend/login.php");
    exit();
}

$provider_id = $_SESSION['user_id'];
$provider_name = $_SESSION['user_name'];
$message = "";

// Fetch current details from users table
$stmt = $conn->prepare("SELECT name, email, mobile FROM users WHERE id = ?");
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();

// Also fetch from providers table if exists to sync
$stmt_p = $conn->prepare("SELECT service, location, experience, price FROM providers WHERE name = ?");
$stmt_p->bind_param("s", $provider_name);
$stmt_p->execute();
$provider_info = $stmt_p->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Update Users Table
    if (!empty($password)) {
        $up = $conn->prepare("UPDATE users SET name=?, email=?, mobile=?, password=? WHERE id=?");
        $up->bind_param("ssssi", $name, $email, $mobile, $password, $provider_id);
    } else {
        $up = $conn->prepare("UPDATE users SET name=?, email=?, mobile=? WHERE id=?");
        $up->bind_param("sssi", $name, $email, $mobile, $provider_id);
    }

    if ($up->execute()) {
        // Sync name in providers table if it was changed
        $sync = $conn->prepare("UPDATE providers SET name=?, email=?, phone=? WHERE name=?");
        $sync->bind_param("ssss", $name, $email, $mobile, $provider_name);
        $sync->execute();

        $_SESSION['user_name'] = $name;
        $provider_name = $name;
        $message = "<div class='alert alert-success'>Profile updated successfully!</div>";
        // Refresh local data
        $user_data['name'] = $name;
        $user_data['email'] = $email;
        $user_data['mobile'] = $mobile;
    } else {
        $message = "<div class='alert alert-danger'>Update failed: " . $up->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile | Provider Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../frontend/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { padding-top: 70px; background: #f8f9fa; }
        .sidebar { height: 100vh; background: #fff; border-right: 1px solid #eee; padding: 20px; position: fixed; width: 240px; }
        .main-content { margin-left: 240px; padding: 30px; }
        .sidebar a { display: block; padding: 12px 15px; color: #444; text-decoration: none; border-radius: 8px; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background: #0d6efd; color: #fff; }
        .profile-card { background: #fff; border-radius: 15px; padding: 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .main-footer { margin-left: 240px; }
        @media (max-width: 992px) {
            .main-footer { margin-left: 0; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold"><i class="fas fa-tools me-2"></i>ServiceCart Provider</span>
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> <?php echo $provider_name; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="provider-profile.php">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="../backend/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="sidebar">
    <a href="provider-dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="#"><i class="fas fa-calendar-alt me-2"></i> My Bookings</a>
    <a href="provider-profile.php" class="active"><i class="fas fa-id-card me-2"></i> My Profile</a>
    <a href="../backend/logout.php" class="text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card">
                <h4 class="fw-bold mb-4"><i class="fas fa-user-edit me-2 text-primary"></i>Provider Profile Settings</h4>
                <?php echo $message; ?>

                <form action="provider-profile.php" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-uppercase">Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-uppercase">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-uppercase">Mobile No</label>
                            <input type="tel" name="mobile" class="form-control" value="<?php echo htmlspecialchars($user_data['mobile']); ?>" required pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-uppercase">New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Blank to keep current">
                        </div>
                    </div>

                    <?php if($provider_info): ?>
                    <hr class="my-4">
                    <div class="bg-light p-3 rounded mb-4">
                        <h6 class="fw-bold"><i class="fas fa-info-circle me-1"></i> Public Listing Info</h6>
                        <div class="row small mt-2">
                            <div class="col-6"><b>Service:</b> <?php echo $provider_info['service']; ?></div>
                            <div class="col-6"><b>Price:</b> ₹<?php echo $provider_info['price']; ?></div>
                            <div class="col-6"><b>Location:</b> <?php echo $provider_info['location']; ?></div>
                            <div class="col-6"><b>Exp:</b> <?php echo $provider_info['experience']; ?> Yrs</div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="provider-dashboard.php" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5 fw-bold">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "../includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
