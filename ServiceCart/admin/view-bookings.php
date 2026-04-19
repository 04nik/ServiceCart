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

// Get total bookings for pagination count
$total_result = $conn->query("SELECT count(id) AS id FROM bookings");
$booking_count = $total_result->fetch_assoc();
$total_pages = ceil($booking_count['id'] / $limit);

// Fetch bookings for current page
$sql = "SELECT b.*, u.name as customer_name FROM bookings b 
        LEFT JOIN users u ON b.customer_id = u.id 
        ORDER BY b.id DESC LIMIT $start, $limit";
$result = $conn->query($sql);

$message = "";
if (isset($_GET['msg']) && $_GET['msg'] == 'updated') {
    $message = "<div class='alert alert-success'>Booking status updated successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings | Admin Dashboard</title>
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
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">ServiceCart Admin</span>
        <div class="collapse navbar-collapse justify-content-end">
            <span class="navbar-text text-white me-3">Welcome, Admin</span>
            <a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
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
            <a href="view-bookings.php" class="bg-primary text-white">Bookings</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">
            <h3 class="mb-4">All Service Bookings</h3>
            <?php echo $message; ?>

            <div class="table-container">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Provider</th>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Address & Ph</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $status = $row['status'];
                                $badge_class = "bg-secondary";
                                if($status == "Pending") $badge_class = "bg-warning text-dark";
                                elseif($status == "Confirmed") $badge_class = "bg-primary";
                                elseif($status == "Completed") $badge_class = "bg-success";
                                elseif($status == "Rejected") $badge_class = "bg-danger";

                                echo "<tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['customer_name']."</td>
                                    <td>".$row['provider']."</td>
                                    <td><span class='badge bg-info text-dark'>".$row['service']."</span></td>
                                    <td>
                                        <small>".date('d M Y', strtotime($row['date']))."</small><br>
                                        <small class='text-muted'>".$row['time']."</small>
                                    </td>
                                    <td>
                                        <small>".$row['address']."</small><br>
                                        <small class='fw-bold'>".$row['phone']."</small>
                                    </td>
                                    <td><span class='badge $badge_class'>$status</span></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No Bookings Found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="view-bookings.php?page=<?php echo $page-1; ?>">Previous</a></li>
                        <?php endif; ?>

                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                                <a class="page-link" href="view-bookings.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if($page < $total_pages): ?>
                            <li class="page-item"><a class="page-link" href="view-bookings.php?page=<?php echo $page+1; ?>">Next</a></li>
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
