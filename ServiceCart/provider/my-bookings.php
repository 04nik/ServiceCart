<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Provider') {
    header("Location: ../frontend/login.php");
    exit();
}

$provider_name = $_SESSION['user_name'];

// Fetch all bookings for this provider with Customer Names and Reviews
$sql = "SELECT b.*, u.name as customer_name, r.rating as review_rating, r.comment as review_comment 
        FROM bookings b 
        LEFT JOIN users u ON b.customer_id = u.id 
        LEFT JOIN reviews r ON b.id = r.booking_id
        WHERE b.provider = ? ORDER BY b.date DESC, b.time DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $provider_name);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings | Provider Dashboard</title>
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
        .booking-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.03); margin-bottom: 20px; transition: 0.3s; }
        .booking-card:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
        .main-footer { margin-left: 240px; }
        @media (max-width: 992px) {
            .main-footer { margin-left: 0; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold"><i class="fas fa-tools me-2"></i>ServiceCart Provider</span>
        <div class="ms-auto">
            <span class="text-white small me-3"><?php echo $provider_name; ?></span>
        </div>
    </div>
</nav>

<div class="sidebar">
    <a href="provider-dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="my-bookings.php" class="active"><i class="fas fa-calendar-alt me-2"></i> My Bookings</a>
    <a href="provider-profile.php"><i class="fas fa-id-card me-2"></i> My Profile</a>
    <a href="../backend/logout.php" class="text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="main-content">
    <h4 class="fw-bold mb-4">All Assigned Bookings</h4>

    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-6 mb-4">
                <div class="card booking-card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-secondary p-2">#<?php echo $row['id']; ?></span>
                        <?php 
                            $status = $row['status'];
                            $display_status = ($status == 'Confirmed') ? 'Approved' : $status;
                            $color = ($status == 'Pending') ? 'warning' : (($status == 'Confirmed') ? 'primary' : 'success');
                            if($status == 'Rejected') $color = 'danger';
                            echo "<span class='badge bg-$color'>$display_status</span>";
                        ?>
                    </div>
                    <div class="mb-2"><i class="fas fa-user-circle text-muted me-2"></i><b>Customer:</b> <?php echo $row['customer_name'] ?? 'Guest'; ?></div>
                    <div class="mb-2"><i class="fas fa-hammer text-muted me-2"></i><b>Service:</b> <?php echo $row['service']; ?></div>
                    <div class="mb-2"><i class="fas fa-calendar-check text-muted me-2"></i><b>Date:</b> <?php echo date('d M Y', strtotime($row['date'])); ?> at <?php echo $row['time']; ?></div>
                    <div class="mb-3"><i class="fas fa-map-marker-alt text-muted me-2"></i><b>Address:</b> <?php echo $row['address']; ?></div>
                    
                    <?php if ($row['review_rating']): ?>
                    <div class="mt-2 p-2 bg-light rounded shadow-sm border-start border-4 border-warning">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-bold text-muted">Customer Review</span>
                            <span class="text-warning small fw-bold"><?php echo $row['review_rating']; ?> ⭐</span>
                        </div>
                        <p class="mb-0 small italic">"<?php echo htmlspecialchars($row['review_comment'] ?? 'No comment provided'); ?>"</p>
                    </div>
                    <?php endif; ?>
                    
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fw-bold text-primary">₹<?php echo $row['price']; ?></div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Action
                            </button>
                            <ul class="dropdown-menu shadow">
                                <?php if($row['status'] == 'Pending'): ?>
                                    <li><a class="dropdown-item text-primary" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Confirmed&from=provider"><i class="fas fa-check me-2"></i> Approve</a></li>
                                    <li><a class="dropdown-item text-danger" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Rejected&from=provider"><i class="fas fa-times me-2"></i> Reject</a></li>
                                <?php elseif($row['status'] == 'Confirmed'): ?>
                                    <li><a class="dropdown-item text-success" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Completed&from=provider"><i class="fas fa-check-double me-2"></i> Complete</a></li>
                                    <li><a class="dropdown-item text-danger" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Rejected&from=provider"><i class="fas fa-ban me-2"></i> Reject</a></li>
                                <?php else: ?>
                                    <li><span class="dropdown-item disabled small">Finished</span></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="tel:<?php echo $row['phone']; ?>"><i class="fas fa-phone me-2"></i> Call Customer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/no-data-found-8867280-7223910.png" style="width: 200px;" alt="">
            <p class="text-muted mt-3">No bookings found in your history.</p>
        </div>
    <?php endif; ?>
</div>
<?php include "../includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
