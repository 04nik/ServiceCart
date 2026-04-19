<?php
session_start();
include "../backend/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Provider') {
    header("Location: ../frontend/login.php");
    exit();
}

$provider_name = $_SESSION['user_name'];
$provider_id = $_SESSION['user_id'];

// Fetch Bookings for this provider with Customer Names
$sql = "SELECT b.*, u.name as customer_name FROM bookings b 
        LEFT JOIN users u ON b.customer_id = u.id 
        WHERE b.provider = ? ORDER BY b.id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $provider_name);
$stmt->execute();
$result = $stmt->get_result();

// Stats for this provider
$stats_sql = "SELECT 
    COUNT(*) as total,
    SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) as pending,
    SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) as completed
    FROM bookings WHERE provider = ?";
$stmt_stats = $conn->prepare($stats_sql);
$stmt_stats->bind_param("s", $provider_name);
$stmt_stats->execute();
$stats = $stmt_stats->get_result()->fetch_assoc();

// Fetch Average Rating and Total Reviews
$rating_sql = "SELECT AVG(rating) as avg_rating, COUNT(*) as review_count FROM reviews WHERE provider_id = ?";
$stmt_rating = $conn->prepare($rating_sql);
$stmt_rating->bind_param("i", $provider_id);
$stmt_rating->execute();
$rating_data = $stmt_rating->get_result()->fetch_assoc();
$avg_rating = number_format($rating_data['avg_rating'] ?? 0, 1);
$review_count = $rating_data['review_count'];

// Fetch Reviews
$reviews_sql = "SELECT r.*, u.name as customer_name FROM reviews r 
                LEFT JOIN users u ON r.customer_id = u.id 
                WHERE r.provider_id = ? 
                ORDER BY r.id DESC LIMIT 5";
$stmt_reviews = $conn->prepare($reviews_sql);
$stmt_reviews->bind_param("i", $provider_id);
$stmt_reviews->execute();
$reviews_result = $stmt_reviews->get_result();

// Fetch ALL Reviews for Modal
$all_reviews_sql = "SELECT r.*, u.name as customer_name FROM reviews r 
                    LEFT JOIN users u ON r.customer_id = u.id 
                    WHERE r.provider_id = ? 
                    ORDER BY r.id DESC";
$stmt_all = $conn->prepare($all_reviews_sql);
$stmt_all->bind_param("i", $provider_id);
$stmt_all->execute();
$all_reviews_result = $stmt_all->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Provider Dashboard | Service Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../frontend/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { padding-top: 70px; background: #f8f9fa; }
        .sidebar { height: 100vh; background: #fff; border-right: 1px solid #eee; padding: 20px; position: fixed; width: 240px; }
        .main-content { margin-left: 240px; padding: 30px; }
        .sidebar a { display: block; padding: 12px 15px; color: #444; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #0d6efd; color: #fff; }
        .stat-card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .table-container { background: #fff; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .main-footer { margin-left: 240px; }
        @media (max-width: 992px) {
            .main-footer { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold"><i class="fas fa-tools me-2"></i>ServiceCart Provider</span>
        <div class="ms-auto d-flex align-items-center">
            <!-- Notifications Dropdown -->
            <div class="dropdown me-3">
                <button class="btn btn-outline-light dropdown-toggle position-relative" type="button" data-bs-toggle="dropdown" id="notifBtn">
                    <i class="fas fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notifCount" style="display:none;">0</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3" style="width: 300px; max-height: 400px; overflow-y: auto;" id="notifMenu">
                    <div class="p-3 border-bottom fw-bold text-dark">Notifications</div>
                    <div id="notifList">
                        <div class="p-3 text-center text-muted small">Loading...</div>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> <?php echo $provider_name; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="provider-profile.php"><i class="fas fa-user-edit me-2"></i> Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="../backend/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="provider-dashboard.php" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="my-bookings.php"><i class="fas fa-calendar-alt me-2"></i> My Bookings</a>
    <a href="provider-profile.php"><i class="fas fa-id-card me-2"></i> My Profile</a>
    <a href="../backend/logout.php" class="text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <h3 class="fw-bold mb-4">Welcome back, <?php echo explode(' ', $provider_name)[0]; ?>!</h3>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card stat-card p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-pill p-3 me-3">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Requests</p>
                        <h2 class="fw-bold mb-0"><?php echo $stats['total']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-pill p-3 me-3">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Pending</p>
                        <h2 class="fw-bold mb-0"><?php echo $stats['pending']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-pill p-3 me-3">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Completed</p>
                        <h2 class="fw-bold mb-0"><?php echo $stats['completed']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card p-3 bg-white" onclick="showAllFeedback()" style="cursor: pointer;">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-pill p-3 me-3">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Rating</p>
                        <h2 class="fw-bold mb-0"><?php echo $avg_rating; ?> <small class="fs-6 text-muted">(<?php echo $review_count; ?>)</small></h2>
                        <small class="text-primary" style="font-size: 0.7rem;">Click to view all</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h5 class="fw-bold mb-4"><i class="fas fa-history me-2"></i>Recent Service Requests</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Schedule</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td><i class="fas fa-user-circle me-1"></i> <?php echo $row['customer_name'] ?? 'Guest'; ?></td>
                            <td><span class="badge bg-info text-dark"><?php echo $row['service']; ?></span></td>
                            <td>
                                <div class="small fw-bold"><?php echo date('d M Y', strtotime($row['date'])); ?></div>
                                <div class="small text-muted"><?php echo $row['time']; ?></div>
                            </td>
                            <td><div class="small text-truncate" style="max-width: 150px;"><?php echo $row['address']; ?></div></td>
                            <td>
                                <?php 
                                    $s = $row['status'];
                                    $display_status = ($s == 'Confirmed') ? 'Approved' : $s;
                                    $cl = ($s == 'Pending') ? 'warning' : (($s == 'Confirmed') ? 'primary' : 'success');
                                    if($s == 'Rejected') $cl = 'danger';
                                    echo "<span class='badge bg-$cl'>$display_status</span>";
                                ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-boundary="viewport">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu shadow-sm">
                                        <?php if($row['status'] == 'Pending'): ?>
                                            <li><a class="dropdown-item text-primary" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Confirmed&from=provider"><i class="fas fa-check me-2"></i> Approve</a></li>
                                            <li><a class="dropdown-item text-danger" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Rejected&from=provider"><i class="fas fa-times me-2"></i> Reject</a></li>
                                        <?php elseif($row['status'] == 'Confirmed'): ?>
                                            <li><a class="dropdown-item text-success" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Completed&from=provider"><i class="fas fa-check-double me-2"></i> Complete</a></li>
                                            <li><a class="dropdown-item text-danger" href="../admin/update_status.php?id=<?php echo $row['id']; ?>&status=Rejected&from=provider"><i class="fas fa-ban me-2"></i> Reject</a></li>
                                        <?php else: ?>
                                            <li><span class="dropdown-item disabled">No Actions available</span></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center py-4">No requests found for you.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="table-container">
                <h5 class="fw-bold mb-4"><i class="fas fa-comments me-2 text-primary"></i>Recent Customer Feedback</h5>
                <?php if ($reviews_result->num_rows > 0): ?>
                    <div class="row g-3">
                        <?php while($rev = $reviews_result->fetch_assoc()): ?>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm bg-light p-3 rounded-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="fw-bold text-dark"><i class="fas fa-user-circle me-1"></i> <?php echo $rev['customer_name']; ?></div>
                                    <div class="text-warning small fw-bold">
                                        <?php echo $rev['rating']; ?> ⭐
                                    </div>
                                </div>
                                <p class="text-muted small mb-0 italic">"<?php echo htmlspecialchars($rev['comment']); ?>"</p>
                                <div class="text-end"><small class="text-muted" style="font-size: 0.7rem;"><?php echo date('d M Y', strtotime($rev['created_at'])); ?></small></div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-light text-center py-4 border">
                        <i class="fas fa-comment-slash fa-2x mb-3 text-muted"></i>
                        <p class="text-muted mb-0">No feedback received yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- All Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fas fa-star text-warning me-2"></i>All Customer Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <?php if ($all_reviews_result->num_rows > 0): ?>
                        <?php 
                        // Seek back to start if needed, but since we didn't use it yet it's fine
                        while($rev = $all_reviews_result->fetch_assoc()): 
                        ?>
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-4 border-0 shadow-sm mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="fw-bold"><i class="fas fa-user-circle me-1"></i> <?php echo $rev['customer_name'] ?? 'Anonymous'; ?></div>
                                    <div class="text-warning fw-bold"><?php echo $rev['rating']; ?> ⭐</div>
                                </div>
                                <p class="text-muted mb-1 italic">"<?php echo htmlspecialchars($rev['comment']); ?>"</p>
                                <div class="text-end small text-muted"><?php echo date('d M Y', strtotime($rev['created_at'])); ?></div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-comment-slash fa-3x text-muted mb-3 opacity-25"></i>
                            <p class="text-muted">No reviews found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fetch Notifications
    function showAllFeedback() {
        const modal = new bootstrap.Modal(document.getElementById('feedbackModal'));
        modal.show();
        // Hide notification badge when feedback is viewed
        document.getElementById('notifCount').style.display = 'none';
    }

    function loadNotifications() {
        fetch('../backend/get_notifications.php')
            .then(res => res.json())
            .then(data => {
                const list = document.getElementById('notifList');
                const count = document.getElementById('notifCount');
                
                if (data.length > 0) {
                    count.innerText = data.length;
                    count.style.display = 'inline';
                    let html = '';
                    data.forEach(n => {
                        html += `
                            <div class="p-3 border-bottom bg-light bg-opacity-10 d-flex align-items-start gap-3">
                                <div class="fs-4">${n.icon}</div>
                                <div>
                                    <div class="small fw-normal text-dark">${n.message}</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">${n.date}</div>
                                </div>
                            </div>`;
                    });
                    list.innerHTML = html;
                } else {
                    count.style.display = 'none';
                    list.innerHTML = '<div class="p-4 text-center text-muted small"><i class="fas fa-check-circle fa-2x mb-2 text-success opacity-25"></i><br>Up to date!</div>';
                }
            });
    }

    // Call on load
    loadNotifications();
    
    // Hide notification badge when clicked and mark as read in DB
    document.getElementById('notifBtn').addEventListener('click', function() {
        document.getElementById('notifCount').style.display = 'none';
        
        fetch('../backend/mark_notifications_read.php')
            .then(res => res.text())
            .then(data => {
                console.log("Notifications marked as seen:", data);
            });
    });

    // Refresh every minute
    setInterval(loadNotifications, 60000);
</script>
</body>
</html>
