<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Service Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="home-body">
  <!-- 🧬 Interactive Background Elements -->
  <div class="interactive-bg">
    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>
  </div>

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
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <div id="authLinks" class="d-flex align-items-center ms-auto">
          <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
          <div class="dropdown">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="registerDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              Register
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="registerDropdown">
              <li><a class="dropdown-item" href="register.php"><i class="fas fa-user me-2"></i> As Customer</a></li>
              <li><a class="dropdown-item" href="provider-register.php"><i class="fas fa-tools me-2"></i> As Provider</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- 🔍 Search / Hero with Slider -->
  <section class="search-section d-flex align-items-center position-relative overflow-hidden">
    <!-- 📽 Bootstrap Carousel Image Slider -->
    <div id="heroCarousel" class="carousel slide carousel-fade hero-slideshow" data-bs-ride="carousel">
      <!-- ⏺ Indicators -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="5"></button>
      </div>
      <div class="carousel-inner h-100">
        <div class="carousel-item active h-100">
          <div class="slide-content h-100" style="background-image: url('../images/hero1.png'); background-size: cover; background-position: center;"></div>
        </div>
        <div class="carousel-item h-100">
          <div class="slide-content h-100" style="background-image: url('../images/hero2.png'); background-size: cover; background-position: center;"></div>
        </div>
        <div class="carousel-item h-100">
          <div class="slide-content h-100" style="background-image: url('../images/paint_hero.png'); background-size: cover; background-position: center;"></div>
        </div>
        <!-- 💡 New Slide 4: Painting Service -->
        <div class="carousel-item h-100">
          <div class="slide-content h-100" style="background-image: url('https://images.unsplash.com/photo-1589939705384-5185137a7f0f?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
        </div>
        <!-- 💡 New Slide 5: Electrical/Technical -->
        <div class="carousel-item h-100">
          <div class="slide-content h-100" style="background-image: url('../images/electri_hero.png'); background-size: cover; background-position: center;"></div>
        </div>
        <!-- 💡 New Slide 6: Home Renovation -->
        <div class="carousel-item h-100">
          <div class="slide-content h-100" style="background-image: url('https://images.unsplash.com/photo-1504148455328-c376907d081c?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
        </div>
      </div>
      <!-- 🔄 Navigation -->
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index: 6;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index: 6;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="container text-center py-5 position-relative" style="z-index: 5;">
      <h1 class="display-4 fw-bold mb-3 text-shadow animate__animated animate__fadeInDown">On-Demand Services, Simplified.</h1>
      <p class="lead mb-4 opacity-75 text-shadow animate__animated animate__fadeInUp">Connect with the best pros for your home – from leaky pipes to custom cabinets.</p>
      <div class="row justify-content-center animate__animated animate__zoomIn">
        <div class="col-lg-10">
          <div class="input-group input-group-lg shadow-lg search-bar-wrapper">
            <!-- Service Input -->
            <span class="input-group-text bg-white border-0 ps-4"><i class="fas fa-search text-primary"></i></span>
            <input type="text" id="serviceSearch" class="form-control border-0 ps-2" style="font-size: 1.1rem; height: 65px;" placeholder="Service (e.g. Plumbing)">
            
            <!-- Divider -->
            <div class="vr my-auto" style="height: 30px; width: 2px; background: #eee;"></div>

            <!-- Location Input -->
            <span class="input-group-text bg-white border-0 ps-3"><i class="fas fa-map-marker-alt text-danger"></i></span>
            <input type="text" id="locationSearch" class="form-control border-0 ps-2" style="font-size: 1.1rem; height: 65px;" placeholder="City or District">
            
            <button onclick="handleSearch()" class="btn btn-primary px-5 fw-bold" type="button">Find Pro</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 🧰 Categories -->
  <section class="container mt-5">
    <h4 class="mb-3">Service Categories</h4>
    <div class="row text-center">

      <div class="col-md-3">
        <div class="card category-card" onclick="openService('Plumbing')">
          <h6>Plumbing</h6>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card category-card" onclick="openService('Electrical')">
          <h6>Electrical</h6>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card category-card" onclick="openService('Cleaning')">
          <h6>Cleaning</h6>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card category-card" onclick="openService('Carpentry')">
          <h6>Carpentry</h6>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card category-card" onclick="openService('Painting')">
          <h6>Painting</h6>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card category-card" onclick="openService('Pest Control')">
          <h6>Pest Control</h6>
        </div>
      </div>

    </div>
  </section>

  <!-- ⭐ Services -->
  <section class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4>Popular Services</h4>
      <a href="services.php" class="text-decoration-none text-primary fw-bold">View All Services →</a>
    </div>

    <div class="row g-4">
      <!-- Plumbing Card -->
      <div class="col-md-3">
        <div class="card service-card">
          <img src="../images/plumbing.png" alt="Plumbing">
          <div class="card-body">
            <h5 class="card-title">Expert Plumbing</h5>
            <p class="card-text text-muted small">Leak repairs, pipe installations, and bathroom fittings by certified
              experts.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="price-tag">₹499 Early</span>
              <button onclick="openService('Plumbing')" class="btn btn-primary btn-sm">Book</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Electrical Card -->
      <div class="col-md-3">
        <div class="card service-card">
          <img src="../images/electrical.png" alt="Electrical">
          <div class="card-body">
            <h5 class="card-title">Safe Electrical</h5>
            <p class="card-text text-muted small">Wiring, switchboard repairs, and appliance installations with safety
              focus.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="price-tag">₹599 Start</span>
              <button onclick="openService('Electrical')" class="btn btn-primary btn-sm">Book</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Cleaning Card -->
      <div class="col-md-3">
        <div class="card service-card">
          <img src="../images/cleaning.png" alt="Cleaning">
          <div class="card-body">
            <h5 class="card-title">Full Home Cleaning</h5>
            <p class="card-text text-muted small">Deep cleaning, sanitation, and dusting for every corner of your home.
            </p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="price-tag">₹899 Flat</span>
              <button onclick="checkLogin()" class="btn btn-primary btn-sm">Book</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Carpentry Card -->
      <div class="col-md-3">
        <div class="card service-card">
          <img src="../images/carpentry.png" alt="Carpentry">
          <div class="card-body">
            <h5 class="card-title">Master Carpentry</h5>
            <p class="card-text text-muted small">Furniture assembly, wood repair, and custom cabinet making services.
            </p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="price-tag">₹699 Base</span>
              <button onclick="openService('Carpentry')" class="btn btn-primary btn-sm">Book</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 🔻 FIXED FOOTER -->
  <?php include "../includes/footer.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

    document.getElementById('serviceSearch').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') handleSearch();
    });
    document.getElementById('locationSearch').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') handleSearch();
    });

    function handleSearch() {
      const service = document.getElementById('serviceSearch').value;
      const location = document.getElementById('locationSearch').value;
      openService(service, location);
    }

    function openService(service, location = '') {
      let url = "services.php?service=" + encodeURIComponent(service);
      if (location) {
        url += "&location=" + encodeURIComponent(location);
      }
      window.location.href = url;
    }

    function checkLogin() {
      if (!currentUser) {
        alert("Please login to book a service.");
        window.location.href = "login.php";
      } else {
        // For "Home Cleaning" popular service
        window.location.href = "booking.php?service=Cleaning&price=499";
      }
    }

    checkSession();
  </script>

</body>

</html>
