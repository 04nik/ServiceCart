<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Contact Us | ServiceCart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .contact-hero {
      background: #000;
      background-image: 
        radial-gradient(circle at 15% 50%, rgba(13, 110, 253, 0.25) 0%, transparent 50%),
        radial-gradient(circle at 85% 50%, rgba(0, 210, 255, 0.15) 0%, transparent 50%);
      color: white;
      padding: 120px 0;
      text-align: center;
      position: relative;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .hero-title {
      font-size: 3.5rem;
      letter-spacing: -1px;
    }
    .text-highlight {
      color: #0d6efd;
    }
    .hero-subtitle {
      font-size: 1.25rem;
      color: rgba(255, 255, 255, 0.7);
      max-width: 800px;
      margin: 0 auto;
    }
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      .contact-hero {
        padding: 80px 0;
      }
    }
    .contact-info-card {
      border: none;
      border-radius: 16px;
      padding: 30px;
      background: white;
      box-shadow: var(--shadow-sm);
      height: 100%;
      transition: var(--transition);
    }
    .contact-info-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
    }
    .contact-icon {
      width: 50px;
      height: 50px;
      background: rgba(13, 110, 253, 0.1);
      color: #0d6efd;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #dee2e6;
    }
    .form-control:focus {
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
      border-color: #0d6efd;
    }
  </style>
</head>

<body>

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
          <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
        </ul>
        <div id="authLinks" class="d-flex align-items-center ms-auto">
          <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
          <a href="register.php" class="btn btn-light btn-sm">Register</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Contact Hero -->
  <section class="contact-hero">
    <div class="container">
      <h1 class="hero-title fw-bold mb-3">Get in <span class="text-highlight">Touch</span></h1>
      <p class="hero-subtitle">We're here to help you with any questions or concerns.</p>
    </div>
  </section>

  <section class="container my-5 py-5">
    <div class="row g-5">
      <!-- Contact Details -->
      <div class="col-lg-5">
        <h2 class="fw-bold mb-4">Contact Information</h2>
        <p class="text-muted mb-5">Have a question about our services or need assistance with a booking? Reach out to us through any of these channels.</p>
        
        <div class="row g-4">
          <div class="col-md-12">
            <div class="contact-info-card">
              <div class="contact-icon">📍</div>
              <h5 class="fw-bold">Our Office</h5>
              <p class="text-muted mb-0">123 Service Street, Tech Hub, <br>Mumbai, Maharashtra 400001</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="contact-info-card">
              <div class="contact-icon">📞</div>
              <h5 class="fw-bold">Call Us</h5>
              <p class="text-muted mb-0">+91 1800 123 4567<br>+91 98765 43210</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="contact-info-card">
              <div class="contact-icon">✉️</div>
              <h5 class="fw-bold">Email Us</h5>
              <p class="text-muted mb-0">support@servicecart.com<br>info@servicecart.com</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4">
          <h2 class="fw-bold mb-4">Send us a Message</h2>
          <form id="contactForm">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Full Name</label>
                <input type="text" class="form-control" placeholder="John Doe" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Email Address</label>
                <input type="email" class="form-control" placeholder="john@example.com" required>
              </div>
              <div class="col-12">
                <label class="form-label small fw-bold">Subject</label>
                <select class="form-select form-control">
                  <option>General Inquiry</option>
                  <option>Booking Support</option>
                  <option>Provider Partnership</option>
                  <option>Feedback</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label small fw-bold">Message</label>
                <textarea class="form-control" rows="5" placeholder="How can we help you?" required></textarea>
              </div>
              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary w-100 py-3">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- 🔻 FIXED FOOTER -->
  <?php include "../includes/footer.php"; ?>

  <script>
    let currentUser = null;

    function checkSession() {
      fetch('../backend/get_user.php')
        .then(res => res.json())
        .then(user => {
          currentUser = user.loggedIn ? user : null;
          updateNavbar();
        });
    }

    function updateNavbar() {
      const authLinks = document.getElementById("authLinks");
      if (currentUser) {
        let dashboardLink = '#';
        if (currentUser.role === 'Admin') dashboardLink = '../admin/admin-dashboard.php';
        else if (currentUser.role === 'Provider') dashboardLink = 'provider-dashboard.php';
        else if (currentUser.role === 'Customer') dashboardLink = 'user-dashboard.php';

        authLinks.innerHTML = `
          <span class="text-white me-3">Hi, ${currentUser.userName}</span>
          <a href="${dashboardLink}" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
          <a href="../backend/logout.php" class="btn btn-light btn-sm">Logout</a>
        `;
      }
    }

    document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Thank you for reaching out! Our team will get back to you shortly.');
      this.reset();
    });

    checkSession();
  </script>

</body>

</html>
