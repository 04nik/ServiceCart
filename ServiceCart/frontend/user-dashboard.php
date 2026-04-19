<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Dashboard | ServiceCart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { padding-top: 56px; background-color: #f8f9fa; }
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
    @media (max-width: 768px) {
      .sidebar { width: 100%; height: auto; position: relative; }
      .main-content { margin-left: 0; }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">ServiceCart</a>

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
        <span class="text-white me-3" id="userNameNav">Welcome</span>
        <a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </div>
</nav>

<div class="sidebar">
  <h5 class="mb-4 text-muted px-3">Main Menu</h5>
  <a href="#" class="nav-link active" onclick="showSection('bookings')"><span>📦</span> <span class="nav-text">My Bookings</span></a>
  <a href="#" class="nav-link" onclick="showSection('profile')"><span>👤</span> <span class="nav-text">My Profile</span></a>
  <a href="#" class="nav-link" onclick="showSection('notifications')"><span>🔔</span> <span class="nav-text">Notifications</span></a>
  <a href="#" class="nav-link" onclick="showSection('support')"><span>🎧</span> <span class="nav-text">Customer Support</span></a>
  <hr>
  <a href="index.php" class="nav-link"><span>🏠</span> <span class="nav-text">Back to Home</span></a>
</div>

<div class="main-content">
  <div id="bookingsSection">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>My Booking Details</h3>
      <a href="index.php" class="btn btn-primary">Book New Service</a>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Service</th>
                <th>Provider</th>
                <th>Price</th>
                <th>Date & Time</th>
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

  <div id="profileSection" style="display:none;">
    <h3>My Profile</h3>
    <p>Profile update functionality coming soon.</p>
  </div>

  <div id="notificationsSection" style="display:none;">
    <h3>Notifications</h3>
    <p>You have no new notifications.</p>
  </div>

  <div id="supportSection" style="display:none;">
    <h3>Customer Support</h3>
    <div class="card border-0 shadow-sm p-4">
        <h5>Need Help?</h5>
        <p>Email us at: support@servicecart.com</p>
        <p>Call us: +1 800 123 4567</p>
    </div>
  </div>
  </div>
</div>

<!-- Rating Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Rate Provider: <span id="ratingProviderName" class="text-primary"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="ratingForm">
        <div class="modal-body">
          <input type="hidden" name="booking_id" id="ratingBookingId">
          <div class="mb-3">
            <label class="form-label fw-bold">Select Rating (0-5)</label>
            <div class="input-group input-group-lg shadow-sm rounded-3">
              <span class="input-group-text bg-white text-warning border-end-0"><i class="fas fa-star"></i></span>
              <input type="number" name="rating" id="ratingInput" class="form-control border-start-0 ps-0" step="0.1" min="0" max="5" placeholder="e.g. 4.5" required>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="document.getElementById('ratingInput').value=1">1 ⭐</button>
              <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="document.getElementById('ratingInput').value=2">2 ⭐</button>
              <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="document.getElementById('ratingInput').value=3">3 ⭐</button>
              <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="document.getElementById('ratingInput').value=4">4 ⭐</button>
              <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="document.getElementById('ratingInput').value=4.5">4.5 ⭐</button>
              <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="document.getElementById('ratingInput').value=5">5 ⭐</button>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Comment</label>
            <textarea name="comment" class="form-control rounded-3" rows="3" placeholder="Share your experience..."></textarea>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary px-4 fw-bold">Submit Review</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- 🔻 FOOTER -->
<div class="dashboard-footer">
  <?php include "../includes/footer.php"; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function showSection(sectionId) {
    // Hide all sections
    ['bookings', 'profile', 'notifications', 'support'].forEach(id => {
      document.getElementById(id + 'Section').style.display = 'none';
      document.querySelector(`[onclick="showSection('${id}')"]`).classList.remove('active');
    });

    // Show selected section
    document.getElementById(sectionId + 'Section').style.display = 'block';
    document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active');

    // Mark notifications as read in DB if viewing notifications section
    if (sectionId === 'notifications') {
        fetch('../backend/mark_notifications_read.php')
            .then(res => res.text())
            .then(data => console.log("Customer notifications marked as read:", data));
    }
  }

  function loadCustomerData() {
    fetch('../backend/get_user.php')
      .then(res => res.json())
      .then(user => {
        if (!user.loggedIn || user.role !== 'Customer') {
          window.location.href = 'login.php';
        } else {
          document.getElementById('userNameNav').innerText = "Hi, " + user.userName;
        }
      });

    // Fetch Notifications
    fetch('../backend/get_notifications.php')
      .then(res => res.json())
      .then(data => {
        const notifDiv = document.getElementById('notificationsSection');
        if (data.length > 0) {
          let html = '<h3>Notifications</h3><div class="list-group shadow-sm">';
          data.forEach(n => {
            html += `
              <div class="list-group-item list-group-item-action d-flex align-items-center border-0 mb-2 rounded shadow-sm">
                <div class="fs-4 me-3">${n.icon}</div>
                <div>
                  <div class="fw-bold">${n.message}</div>
                  <small class="text-muted">${n.date}</small>
                </div>
              </div>`;
          });
          html += '</div>';
          notifDiv.innerHTML = html;
        } else {
          notifDiv.innerHTML = '<h3>Notifications</h3><div class="alert alert-light text-center">You have no new notifications.</div>';
        }
      });

    // Fetch Profile Detail
    fetch('../backend/get_profile_details.php')
      .then(res => res.json())
      .then(data => {
        const profileDiv = document.getElementById('profileSection');
        profileDiv.innerHTML = `
          <h3 class="mb-4">My Profile</h3>
          <div class="card border-0 shadow-sm p-4 rounded-4 col-md-8">
            <form id="profileForm">
              <div class="mb-3">
                <label class="form-label small text-muted fw-bold">Full Name</label>
                <input type="text" name="name" class="form-control" value="${data.name}" required>
              </div>
              <div class="mb-3">
                <label class="form-label small text-muted fw-bold">Email Address</label>
                <input type="email" name="email" class="form-control" value="${data.email}" required>
              </div>
              <div class="mb-3">
                <label class="form-label small text-muted fw-bold">Mobile Number</label>
                <input type="tel" name="mobile" class="form-control" value="${data.mobile}" required pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
              </div>
              <hr>
              <button type="submit" class="btn btn-primary">Save Changes</button>
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
              document.getElementById('userNameNav').innerText = "Hi, " + formData.get('name');
              setTimeout(() => { msgDiv.innerHTML = ''; }, 3000);
            } else {
              msgDiv.innerHTML = '<div class="alert alert-danger">Error: ' + result + '</div>';
            }
          });
        });
      });

    fetch('../backend/get_customer_bookings.php')
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById('bookingTableBody');
        tbody.innerHTML = '';
        
        if (data.length === 0) {
          tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">No bookings found. <a href="index.php">Book your first service!</a></td></tr>';
          return;
        }

        data.forEach(booking => {
          let badgeClass = 'bg-warning';
          if(booking.status === 'Confirmed') badgeClass = 'bg-primary';
          if(booking.status === 'Completed') badgeClass = 'bg-success';
          if(booking.status === 'Rejected') badgeClass = 'bg-danger';

          let actionBtn = '';
          if(booking.status === 'Completed' && !booking.is_reviewed) {
            actionBtn = `<button class="btn btn-sm btn-outline-primary" onclick="openRatingModal(${booking.id}, '${booking.provider}')">Rate</button>`;
          } else if(booking.is_reviewed) {
            actionBtn = `<span class="badge bg-light text-dark border"><i class="fas fa-check text-success"></i> Reviewed</span>`;
          }

          tbody.innerHTML += `
            <tr>
              <td class="fw-bold">${booking.service}</td>
              <td>${booking.provider}</td>
              <td class="text-primary fw-bold">₹${booking.price}</td>
              <td>${booking.date} <br><small class="text-muted">${booking.time}</small></td>
              <td><span class="badge ${badgeClass}">${booking.status}</span></td>
              <td>${actionBtn}</td>
            </tr>
          `;
        });
      });
  }

  function openRatingModal(bookingId, providerName) {
    document.getElementById('ratingBookingId').value = bookingId;
    document.getElementById('ratingProviderName').innerText = providerName;
    const modal = new bootstrap.Modal(document.getElementById('ratingModal'));
    modal.show();
  }

  document.getElementById('ratingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('../backend/submit_feedback.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(result => {
      if (result.trim() === 'success') {
        alert('Feedback submitted successfully!');
        bootstrap.Modal.getInstance(document.getElementById('ratingModal')).hide();
        loadCustomerData(); // Refresh table
      } else {
        alert('Error: ' + result);
      }
    });
  });

  loadCustomerData();
</script>

</body>
</html>
