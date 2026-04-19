<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Service Providers | ServiceCart</title>
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

<!-- NAVBAR -->
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
        <li class="nav-item"><a class="nav-link active" href="services.php">Services</a></li>
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

<!-- 🔍 Hero with Slider (No Search Bar) -->
<section class="search-section d-flex align-items-center position-relative overflow-hidden mb-0">
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
      <div class="carousel-item h-100">
        <div class="slide-content h-100" style="background-image: url('https://images.unsplash.com/photo-1589939705384-5185137a7f0f?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
      </div>
      <div class="carousel-item h-100">
        <div class="slide-content h-100" style="background-image: url('../images/electri_hero.png'); background-size: cover; background-position: center;"></div>
      </div>
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
    <h1 class="display-4 fw-bold mb-3 text-shadow animate__animated animate__fadeInDown">Our Professional Services</h1>
    <p class="lead mb-0 opacity-75 text-shadow animate__animated animate__fadeInUp">Choose from our wide range of expert-led home services tailored for you.</p>
  </div>
</section>

<!-- 🛠 SERVICES & PROVIDERS -->
<div class="container mt-5">
  <div id="serviceCategories" style="display: none;">
    <div class="text-center mb-5" style="display: none;">
      <h2 class="fw-bold">Our Professional Services</h2>
      <p class="text-muted">Choose from our wide range of expert-led home services</p>
    </div>
    
    <div class="row g-4">
      <!-- Plumbing -->
      <div class="col-md-4">
        <div class="card service-info-card h-100 shadow-sm border-0">
          <img src="../images/plumbing.png" class="card-img-top" alt="Plumbing">
          <div class="card-body">
            <h5 class="fw-bold">Expert Plumbing</h5>
            <p class="text-muted small">From leak repairs to new installations, our certified plumbers handle it all with precision.</p>
            <ul class="list-unstyled mb-4 small">
              <li>✅ Leak Detection & Repair</li>
              <li>✅ Pipe Replacement</li>
              <li>✅ Bathroom Fittings</li>
            </ul>
            <a href="services.php?service=Plumbing" class="btn btn-primary w-100">Browse Plumbers</a>
          </div>
        </div>
      </div>

      <!-- Electrical -->
      <div class="col-md-4">
        <div class="card service-info-card h-100 shadow-sm border-0">
          <img src="../images/electrical.png" class="card-img-top" alt="Electrical">
          <div class="card-body">
            <h5 class="fw-bold">Safe Electrical</h5>
            <p class="text-muted small">Safety-first electrical work, including wiring, panel upgrades, and appliance setup.</p>
            <ul class="list-unstyled mb-4 small">
              <li>✅ House Wiring</li>
              <li>✅ Circuit Breaker Repair</li>
              <li>✅ Light & Fan Fitting</li>
            </ul>
            <a href="services.php?service=Electrical" class="btn btn-primary w-100">Browse Electricians</a>
          </div>
        </div>
      </div>

      <!-- Cleaning -->
      <div class="col-md-4">
        <div class="card service-info-card h-100 shadow-sm border-0">
          <img src="../images/cleaning.png" class="card-img-top" alt="Cleaning">
          <div class="card-body">
            <h5 class="fw-bold">Full Home Cleaning</h5>
            <p class="text-muted small">Deep cleaning and sanitization services that leave every corner of your home sparkling.</p>
            <ul class="list-unstyled mb-4 small">
              <li>✅ Deep Kitchen Cleaning</li>
              <li>✅ Sofa & Carpet Wash</li>
              <li>✅ Window & Glass Polish</li>
            </ul>
            <a href="services.php?service=Cleaning" class="btn btn-primary w-100">Browse Cleaners</a>
          </div>
        </div>
      </div>

      <!-- Carpentry -->
      <div class="col-md-4">
        <div class="card service-info-card h-100 shadow-sm border-0">
          <img src="../images/carpentry.png" class="card-img-top" alt="Carpentry">
          <div class="card-body">
            <h5 class="fw-bold">Master Carpentry</h5>
            <p class="text-muted small">Furniture repair, custom cabinets, and wood restoration by skilled craftsmen.</p>
            <ul class="list-unstyled mb-4 small">
              <li>✅ Furniture Assembly</li>
              <li>✅ Door & Window Repair</li>
              <li>✅ Custom Wardrobes</li>
            </ul>
            <a href="services.php?service=Carpentry" class="btn btn-primary w-100">Browse Carpenters</a>
          </div>
        </div>
      </div>

      <!-- Painting -->
      <div class="col-md-4">
        <div class="card service-info-card h-100 shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?q=80&w=2070&auto=format&fit=crop" class="card-img-top" alt="Painting">
          <div class="card-body">
            <h5 class="fw-bold">Premium Painting</h5>
            <p class="text-muted small">Professional interior and exterior painting with high-quality finishes.</p>
            <ul class="list-unstyled mb-4 small">
              <li>✅ Interior & Exterior</li>
              <li>✅ Waterproofing</li>
              <li>✅ Texture & Wall Design</li>
            </ul>
            <a href="services.php?service=Painting" class="btn btn-primary w-100">Browse Painters</a>
          </div>
        </div>
      </div>

      <!-- Pest Control -->
      <div class="col-md-4">
        <div class="card service-info-card h-100 shadow-sm border-0">
          <img src="../images/pestcontrol.png" class="card-img-top" alt="Pest Control">
          <div class="card-body">
            <h5 class="fw-bold">Expert Pest Control</h5>
            <p class="text-muted small">Safe and effective pest management solutions for your home.</p>
            <ul class="list-unstyled mb-4 small">
              <li>✅ Termite Treatment</li>
              <li>✅ Cockroach Control</li>
              <li>✅ Rodent Prevention</li>
            </ul>
            <a href="services.php?service=Pest Control" class="btn btn-primary w-100">Browse Experts</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="providerSection" style="display: none;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
        <li class="breadcrumb-item active" id="breadcrumbService"></li>
      </ol>
    </nav>
    <h2 class="mb-4" id="serviceTitle"></h2>
    <div class="row" id="providerList">
      <!-- Providers will load here -->
    </div>
  </div>
</div>

<!-- FOOTER -->
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
    if(currentUser.role === 'Admin') dashboardLink = '../admin/admin-dashboard.php';
    else if(currentUser.role === 'Provider') dashboardLink = 'provider-dashboard.php';
    else if(currentUser.role === 'Customer') dashboardLink = 'user-dashboard.php';
    
    authLinks.innerHTML = `
      <span class="text-white me-3">Hi, ${currentUser.userName}</span>
      <a href="index.php" class="btn btn-outline-light btn-sm me-2">Home</a>
      <a href="${dashboardLink}" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
      <a href="../backend/logout.php" class="btn btn-light btn-sm">Logout</a>
    `;
  }
}

/* get service and location from URL */
const params = new URLSearchParams(window.location.search);
const service = params.get("service");
const locationParam = params.get("location") || "";

if (!service && !locationParam) {
  // Show all categories
  document.getElementById("serviceCategories").style.display = "block";
} else {
  // Show provider listings for selected service/location
  document.getElementById("providerSection").style.display = "block";
  
  let pageTitle = "Service Providers";
  if (service && locationParam) pageTitle = `${service} Experts in ${locationParam}`;
  else if (service) pageTitle = `${service} Providers`;
  else if (locationParam) pageTitle = `Providers in ${locationParam}`;

  document.getElementById("breadcrumbService").innerText = service || "Searched Area";
  document.getElementById("serviceTitle").innerText = pageTitle;

  /* fetch providers from backend */
  let fetchUrl = "../backend/get_providers.php?";
  if (service) fetchUrl += "service=" + encodeURIComponent(service);
  if (locationParam) fetchUrl += (service ? "&" : "") + "location=" + encodeURIComponent(locationParam);

  fetch(fetchUrl)
    .then(res => res.json())
    .then(data => {
      let html = "";
      if (data.length === 0) {
        html = `<div class='col-12 text-center py-5'>
                  <div class='alert alert-info'>No providers found for ${service} at the moment.</div>
                </div>`;
      } else {
        data.forEach(provider => {
          html += `
            <div class="col-md-4 mb-4">
              <div class="card provider-card p-3 h-100 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                  <h5 class="fw-bold mb-0">${provider.name}</h5>
                  <span class="badge bg-primary">⭐ ${provider.rating}</span>
                </div>
                <p class="text-muted small">${provider.service} Specialist</p>
                <div class="mb-3 small">
                  <p class="mb-1">🛠 <strong>Experience:</strong> ${provider.experience} Years</p>
                  <p class="mb-1">📍 <strong>Location:</strong> ${provider.location}</p>
                  <p class="mb-1">📞 <strong>Contact:</strong> ${provider.phone}</p>
                </div>
                <div class="mt-auto d-flex justify-content-between align-items-center">
                  <span class="fs-5 fw-bold text-primary">₹${provider.price}</span>
                  <a href="booking.php?provider=${provider.name}&service=${provider.service}&price=${provider.price}" 
                    class="btn btn-primary">Book Now</a>
                </div>
              </div>
            </div>
          `;
        });
      }
      document.getElementById("providerList").innerHTML = html;
    });
}

checkSession();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
