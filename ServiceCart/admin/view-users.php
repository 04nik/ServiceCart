<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../frontend/login.php");
    exit();
}

// Pagination Logic
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Get total customers for pagination links
$total_result = $conn->query("SELECT count(id) AS id FROM users WHERE role = 'Customer'");
$user_count = $total_result->fetch_assoc();
$total_pages = ceil($user_count['id'] / $limit);

// Fetch only customers for current page
$sql = "SELECT * FROM users WHERE role = 'Customer' ORDER BY id DESC LIMIT $start, $limit";
$result = $conn->query($sql);

$message = "";
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Prevent admin from deleting themselves
    if ($delete_id == $_SESSION['user_id']) {
        $message = "<div class='alert alert-warning'>You cannot delete your own admin account!</div>";
    } else {
        $delete_sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            header("Location: view-users.php?msg=deleted&page=$page");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Error deleting user.</div>";
        }
    }
}

if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $message = "<div class='alert alert-success'>User deleted successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../frontend/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { padding-top: 70px; background: #f4f6f9; }
        .sidebar { height: 100vh; background: #ffffff; border-right: 1px solid #ddd; padding: 20px; }
        .sidebar a { display: block; padding: 10px; margin-bottom: 5px; color: #333; text-decoration: none; border-radius: 5px; }
        .sidebar a:hover { background: #0d6efd; color: white; }
        .table-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .pagination { margin-top: 20px; }
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
            <a href="view-users.php" class="bg-primary text-white">Users</a>
            <a href="view-providers.php">Service Providers</a>
            <a href="view-bookings.php">Bookings</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">
            <h3 class="mb-4">Registered Customers</h3>
            <?php echo $message; ?>

            <div class="table-container">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $role_badge = $row['role'] == 'Admin' ? 'bg-danger' : ($row['role'] == 'Provider' ? 'bg-success' : 'bg-primary');
                                echo "<tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['name']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['mobile']."</td>
                                    <td><span class='badge $role_badge'>".$row['role']."</span></td>
                                    <td>".$row['created_at']."</td>
                                    <td>
                                        <a href='view-users.php?delete_id=".$row['id']."&page=$page' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No Users Found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="view-users.php?page=<?php echo $page-1; ?>">Previous</a></li>
                        <?php endif; ?>

                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                                <a class="page-link" href="view-users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if($page < $total_pages): ?>
                            <li class="page-item"><a class="page-link" href="view-users.php?page=<?php echo $page+1; ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php include "../includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
