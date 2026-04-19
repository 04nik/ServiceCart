<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>About Us | ServiceCart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    .about-hero {
      position: relative;
      background: #000;
      color: white;
      padding: 140px 0;
      text-align: center;
      overflow: hidden;
    }
    .about-hero-bg {
      position: absolute;
      top: 0; left: 0; width: 100%; height: 100%;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                  url('https://images.unsplash.com/photo-1521737711867-e3b90473bd58?q=80&w=2068&auto=format&fit=crop');
      background-size: cover;
      background-position: center;
      z-index: 1;
      animation: kenBurns 20s infinite alternate linear;
    }
    @keyframes kenBurns {
      from { transform: scale(1); }
      to { transform: scale(1.15); }
    }
    .hero-content {
      position: relative;
      z-index: 5;
    }
    .floating-orb {
      position: absolute;
      width: 250px;
      height: 250px;
      background: rgba(13, 110, 253, 0.2);
      filter: blur(80px);
      border-radius: 50%;
      z-index: 2;
      animation: float 8s infinite alternate ease-in-out;
    }
    @keyframes float {
      from { transform: translate(0, 0); }
      to { transform: translate(50px, 50px); }
    }
    .value-card {
      border: none;
      border-radius: 16px;
      padding: 30px;
      transition: var(--transition);
      background: white;
      box-shadow: var(--shadow-sm);
    }
    .value-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
    }
    .icon-box {
      width: 60px;
      height: 60px;
      background: rgba(13, 110, 253, 0.1);
      color: #0d6efd;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin-bottom: 20px;
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
          <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <div id="authLinks" class="d-flex align-items-center ms-auto">
          <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
          <a href="register.php" class="btn btn-light btn-sm">Register</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- About Hero -->
  <section class="about-hero">
    <div class="about-hero-bg"></div>
    <div class="floating-orb" style="top: -50px; left: -50px;"></div>
    <div class="floating-orb" style="bottom: -50px; right: -20px; background: rgba(0, 210, 255, 0.15); animation-delay: -4s;"></div>
    
    <div class="container hero-content">
      <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Your Trusted Partner in <span class="text-primary">Home Services</span></h1>
      <p class="lead opacity-75 animate__animated animate__fadeInUp animate__delay-1s">Simplifying the way you care for your home with elite professionals.</p>
    </div>
  </section>

  <!-- Who We Are -->
  <section class="container my-5 py-5">
    <div class="bg-white p-5 rounded-4 shadow-lg border">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <h2 class="fw-bold mb-4">Who We Are</h2>
          <p class="text-muted lead">ServiceCart is more than just a booking platform – we are your dedicated partner in maintaining and improving your living space.</p>
          <p class="text-muted">Founded in 2026, ServiceCart was born out of a simple realization: finding reliable, skilled professionals for home maintenance should be easy, transparent, and secure. We bridge the gap between homeowners and local experts, ensuring that every service is handled with care and professionalism.</p>
          <p class="text-muted">Whether it's a leaky pipe, an electrical update, or a master carpentry project, our mission remains the same: to provide On-Demand Services, Simplified.</p>
        </div>
        <div class="col-lg-6 text-center">
          <img src="../images/homere.png" alt="Home Repair" class="img-fluid rounded-4 shadow-sm" style="max-height: 400px; width: 100%; object-fit: cover;">
        </div>
      </div>
    </div>
  </section>

  <!-- Our Values -->
  <section class="bg-light py-5">
    <div class="container my-5">
      <div class="bg-white p-5 rounded-4 shadow border">
        <div class="text-center mb-5">
          <h2 class="fw-bold">Our Core Values</h2>
          <p class="text-muted">The principles that guide everything we do.</p>
        </div>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="value-card h-100 shadow-sm border">
              <div class="icon-box">⭐</div>
              <h4 class="fw-bold">Quality First</h4>
              <p class="text-muted mb-0">We vet every professional on our platform to ensure they meet our high standards of craftsmanship and reliability.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="value-card h-100 shadow-sm border">
              <div class="icon-box">🛡️</div>
              <h4 class="fw-bold">Trust & Safety</h4>
              <p class="text-muted mb-0">Your peace of mind is our priority. We provide secure transactions and verified reviews for every service.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="value-card h-100 shadow-sm border">
              <div class="icon-box">⚡</div>
              <h4 class="fw-bold">Convenience</h4>
              <p class="text-muted mb-0">From instant browsing to easy booking, we've designed our platform to save you time and effort.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="container my-5 py-5 text-center">
    <div class="bg-white p-5 rounded-4 shadow-lg border">
      <h2 class="fw-bold mb-5">How It Works</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="p-4 bg-white rounded-4 shadow h-100 border border-2 border-dark border-opacity-10">
            <h1 class="display-1 fw-bold text-primary opacity-25">01</h1>
            <h4 class="fw-bold">Search</h4>
            <p class="text-muted">Identify your problem and find the right service category for your needs.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white rounded-4 shadow h-100 border border-2 border-dark border-opacity-10">
            <h1 class="display-1 fw-bold text-primary opacity-25">02</h1>
            <h4 class="fw-bold">Select</h4>
            <p class="text-muted">Browse through our verified professionals and choose the one that fits your budget.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 bg-white rounded-4 shadow h-100 border border-2 border-dark border-opacity-10">
            <h1 class="display-1 fw-bold text-primary opacity-25">03</h1>
            <h4 class="fw-bold">Book</h4>
            <p class="text-muted">Confirm your appointment and relax while our experts get the job done.</p>
          </div>
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

    checkSession();
  </script>

</body>

</html>
