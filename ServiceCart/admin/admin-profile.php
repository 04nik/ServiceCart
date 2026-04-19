<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../frontend/login.php");
    exit();
}

$admin_id = $_SESSION['user_id'];
$message = "";

// Fetch current admin details
$stmt = $conn->prepare("SELECT name, email, mobile FROM users WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    if (!empty($password)) {
        // Update with new password (Note: In a real app, use password_hash)
        $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, mobile = ?, password = ? WHERE id = ?");
        $update_stmt->bind_param("ssssi", $name, $email, $mobile, $password, $admin_id);
    } else {
        // Update without changing password
        $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, mobile = ? WHERE id = ?");
        $update_stmt->bind_param("sssi", $name, $email, $mobile, $admin_id);
    }

    if ($update_stmt->execute()) {
        $_SESSION['user_name'] = $name; // Update session name
        $message = "<div class='alert alert-success'>Profile updated successfully!</div>";
        // Refresh local data
        $admin['name'] = $name;
        $admin['email'] = $email;
        $admin['mobile'] = $mobile;
    } else {
        $message = "<div class='alert alert-danger'>Error updating profile: " . $update_stmt->error . "</div>";
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../frontend/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { padding-top: 70px; background: #f4f6f9; }
        .sidebar { height: 100vh; background: #ffffff; border-right: 1px solid #ddd; padding: 20px; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; color: #333; text-decoration: none; border-radius: 5px; }
        .sidebar a:hover { background: #0d6efd; color: white; }
        .profile-card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
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
                    <li><a class="dropdown-item active" href="admin-profile.php"><i class="fas fa-user-edit me-2"></i> Update Profile</a></li>
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
            <a href="view-bookings.php">Bookings</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="profile-card">
                        <h3 class="mb-4 text-center"><i class="fas fa-user-cog me-2"></i>Account Settings</h3>
                        <?php echo $message; ?>
                        
                        <form action="admin-profile.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($admin['name']); ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                                </div>
                                <div class="form-text">We'll never share your email with anyone else.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" name="mobile" class="form-control" value="<?php echo htmlspecialchars($admin['mobile']); ?>" required pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                </div>
                                <div class="form-text text-warning"><i class="fas fa-info-circle me-1"></i> Only enter a value if you wish to change your password.</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-2 fw-bold">Save Changes</button>
                                <a href="admin-dashboard.php" class="btn btn-outline-secondary py-2">Cancel</a>
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
