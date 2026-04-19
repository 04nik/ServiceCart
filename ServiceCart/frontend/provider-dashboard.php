<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Provider Dashboard | ServiceCart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { padding-top: 56px; background-color: #f4f6f9; }
    .sidebar {
      height: calc(100vh - 56px);
      position: fixed;
      left: 0;
      width: 250px;
      background: white;
      box-shadow: 2px 0 5px rgba(0,0,0,0.05);
      padding: 20px;
      z-index: 1000;
    }
    .main-content { margin-left: 250px; padding: 30px; }
    .nav-link {
      color: #333;
      padding: 12px 15px;
      border-radius: 8px;
      margin-bottom: 5px;
      display: block;
      text-decoration: none;
      transition: all 0.3s;
    }
    .sidebar .nav-link {
      color: #333 !important;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .sidebar .nav-link .nav-text {
      display: none;
    }
    .sidebar .nav-link.active {
      background: #e7f1ff;
      color: black !important;
      border-left: 4px solid #0d6efd;
    }
    .sidebar .nav-link.active .nav-text {
      display: inline;
    }
    .sidebar .nav-link i, .sidebar .nav-link span:first-child {
       font-size: 1.2rem;
    }
    .badge-status { font-size: 0.8rem; padding: 5px 10px; border-radius: 20px; }
    @media (max-width: 768px) {
      .sidebar { width: 100%; height: auto; position: relative; }
      .main-content { margin-left: 0; }
    }
  </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">ServiceCart Provider</a>

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
      <div class="ms-auto d-flex align-items-center">
        <span class="navbar-text text-white me-3" id="providerNameDisplay">Welcome, Provider</span>
        <a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </div>
</nav>

<div class="sidebar">
  <h5 class="mb-4 text-muted px-3">Provider Panel</h5>
  <a href="#" class="nav-link active" onclick="showSection('bookings')"><span>📋</span> <span class="nav-text">Service Requests</span></a>
  <a href="#" class="nav-link" onclick="showSection('earnings')"><span>💰</span> <span class="nav-text">My Earnings</span></a>
  <a href="#" class="nav-link" onclick="showSection('settings')"><span>⚙️</span> <span class="nav-text">Service Settings</span></a>
  <hr>
  <a href="index.php" class="nav-link"><span>🏠</span> <span class="nav-text">Home Page</span></a>
</div>

<div class="main-content">
  <div id="bookingsSection">
    <div class="mb-4">
      <h3>Incoming Service Requests</h3>
      <p class="text-muted">Manage and track your assigned tasks.</p>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Service</th>
                <th>Date & Time</th>
                <th>Address</th>
                <th>Customer Phone</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="bookingTableBody">
              <!-- Content loaded via JS -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="earningsSection" style="display:none;">
    <h3>My Earnings</h3>
    <p>Financial summaries will be displayed here.</p>
  </div>

  <div id="settingsSection" style="display:none;">
    <h3>Service Settings</h3>
    <p>Configure your availability and service regions.</p>
  </div>
</div>

<!-- 🔻 FOOTER -->
<div class="dashboard-footer">
  <?php include "../includes/footer.php"; ?>
</div>

<script>
  function showSection(sectionId) {
    ['bookings', 'earnings', 'settings'].forEach(id => {
      document.getElementById(id + 'Section').style.display = 'none';
      document.querySelector(`[onclick="showSection('${id}')"]`).classList.remove('active');
    });
    document.getElementById(sectionId + 'Section').style.display = 'block';
    document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active');
  }

  function loadBookings() {
    fetch('../backend/get_user.php')
      .then(res => res.json())
      .then(user => {
        if (!user.loggedIn || user.role !== 'Provider') {
          window.location.href = 'login.php';
        } else {
          document.getElementById('providerNameDisplay').innerText = "Hi, " + user.userName;
        }
      });

    // Fetch Stats & Earnings
    fetch('../backend/get_provider_stats.php')
      .then(res => res.json())
      .then(data => {
        const earningsDiv = document.getElementById('earningsSection');
        earningsDiv.innerHTML = `
          <h3 class="mb-4">Earning Summary</h3>
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card border-0 shadow-sm p-4 text-center rounded-4">
                <div class="text-primary fs-1 mb-2">₹${data.total_earned}</div>
                <div class="fw-bold text-muted">Total Earned</div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card border-0 shadow-sm p-4 text-center rounded-4">
                <div class="text-success fs-1 mb-2">${data.completed_count}</div>
                <div class="fw-bold text-muted">Tasks Completed</div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card border-0 shadow-sm p-4 text-center rounded-4">
                <div class="text-warning fs-1 mb-2">⭐ ${data.rating}</div>
                <div class="fw-bold text-muted">Average Rating</div>
              </div>
            </div>
          </div>
        `;
      });

    // Fetch Profile Detail
    fetch('../backend/get_profile_details.php')
      .then(res => res.json())
      .then(data => {
        const settingsDiv = document.getElementById('settingsSection');
        settingsDiv.innerHTML = `
          <h3 class="mb-4">Service Profile</h3>
          <div class="card border-0 shadow-sm p-4 rounded-4 col-md-8">
            <form id="profileForm">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label small text-muted fw-bold">Provider Name</label>
                  <input type="text" name="name" class="form-control" value="${data.name}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small text-muted fw-bold">Service Category</label>
                  <div class="form-control bg-light">${data.service}</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label small text-muted fw-bold">Base Price (₹)</label>
                  <input type="number" name="price" class="form-control" value="${data.price}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small text-muted fw-bold">Location</label>
                  <input type="text" name="location" class="form-control" value="${data.location}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small text-muted fw-bold">Experience (Years)</label>
                  <input type="number" name="experience" class="form-control" value="${data.experience}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small text-muted fw-bold">Contact Phone</label>
                  <input type="text" name="phone" class="form-control" value="${data.phone}" required>
                </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
            <div id="profileMsg" class="mt-3"></div>
          </div>
        `;

        document.getElementById('profileForm').addEventListener('submit', function(e) {
          e.preventDefault();
          const formData = new FormData(this);
          fetch('../backend/update_profile.php', {
            method: 'POST',
            body: formData
          })
          .then(res => res.text())
          .then(result => {
            const msgDiv = document.getElementById('profileMsg');
            if (result.trim() === 'success') {
              msgDiv.innerHTML = '<div class="alert alert-success">Profile updated successfully!</div>';
              document.getElementById('providerNameDisplay').innerText = "Hi, " + formData.get('name');
              setTimeout(() => { msgDiv.innerHTML = ''; }, 3000);
            } else {
              msgDiv.innerHTML = '<div class="alert alert-danger">Error: ' + result + '</div>';
            }
          });
        });
      });

    fetch('../backend/get_provider_bookings.php')
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById('bookingTableBody');
        tbody.innerHTML = '';
        
        if (data.length === 0) {
          tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">No assignments found yet.</td></tr>';
          return;
        }

        data.forEach(booking => {
          let badgeClass = 'bg-warning';
          if(booking.status === 'Confirmed') badgeClass = 'bg-primary';
          if(booking.status === 'Completed') badgeClass = 'bg-success';
          if(booking.status === 'Rejected') badgeClass = 'bg-danger';

          let actionBtn = '<span class="text-muted">No Action</span>';
          if (booking.status === 'Pending') {
            actionBtn = `
              <button onclick="updateStatus(${booking.id}, 'Confirmed')" class="btn btn-primary btn-sm me-1">Approve</button>
              <button onclick="updateStatus(${booking.id}, 'Rejected')" class="btn btn-outline-danger btn-sm">Reject</button>
            `;
          } else if (booking.status === 'Confirmed') {
            actionBtn = `<button onclick="updateStatus(${booking.id}, 'Completed')" class="btn btn-success btn-sm">Complete</button>`;
          }

          tbody.innerHTML += `
            <tr>
              <td>#${booking.id}</td>
              <td class="fw-bold">${booking.service}</td>
              <td>${booking.date}<br><small class="text-muted">${booking.time}</small></td>
              <td>${booking.address}</td>
              <td>${booking.phone}</td>
              <td><span class="badge ${badgeClass} badge-status">${booking.status}</span></td>
              <td>${actionBtn}</td>
            </tr>
          `;
        });
      });
  }

  function updateStatus(id, status) {
    let msg = 'Are you sure you want to update the status?';
    if(status === 'Confirmed') msg = 'Approve this service request?';
    else if(status === 'Rejected') msg = 'Reject this service request?';
    else if(status === 'Completed') msg = 'Mark this service as completed?';
    
    if(confirm(msg)) {
        location.href = `../admin/update_status.php?id=${id}&status=${status}&from=provider`;
    }
  }

  loadBookings();
</script>

</body>
</html>
