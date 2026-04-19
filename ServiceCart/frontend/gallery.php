<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Gallery | ServiceCart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    .gallery-hero {
      position: relative;
      background: #000;
      color: white;
      padding: 120px 0;
      text-align: center;
      overflow: hidden;
    }
    .gallery-hero-bg {
      position: absolute;
      top: 0; left: 0; width: 100%; height: 100%;
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                  url('https://images.unsplash.com/photo-1517646287270-a5a9ca602e5c?q=80&w=2070&auto=format&fit=crop');
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
    .gallery-item {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 30px;
      cursor: pointer;
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
    }
    .gallery-item:hover {
      transform: scale(1.03);
      box-shadow: var(--shadow-md);
    }
    .gallery-item img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      transition: var(--transition);
    }
    .gallery-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(13, 110, 253, 0.7);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: var(--transition);
      color: white;
      text-align: center;
      padding: 20px;
    }
    .gallery-item:hover .gallery-overlay {
      opacity: 1;
    }
    .filter-btn {
      border-radius: 30px;
      padding: 8px 25px;
      margin: 5px;
      font-weight: 600;
      border: 2px solid #0d6efd;
      color: #0d6efd;
      background: transparent;
      transition: var(--transition);
    }
    .filter-btn.active, .filter-btn:hover {
      background: #0d6efd;
      color: white;
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
          <li class="nav-item"><a class="nav-link active" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <div id="authLinks" class="d-flex align-items-center ms-auto">
          <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
          <a href="register.php" class="btn btn-light btn-sm">Register</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Gallery Hero -->
  <section class="gallery-hero">
    <div class="gallery-hero-bg"></div>
    <div class="floating-orb" style="top: -50px; right: -50px;"></div>
    <div class="floating-orb" style="bottom: -50px; left: -20px; background: rgba(0, 210, 255, 0.15); animation-delay: -4s;"></div>
    
    <div class="container hero-content">
      <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Work <span class="text-primary">Showcase</span></h1>
      <p class="lead opacity-75 animate__animated animate__fadeInUp animate__delay-1s">See the quality of services delivered by our verified professionals.</p>
    </div>
  </section>

  <!-- Gallery Content -->
  <section class="container my-5 py-4">
    <div class="text-center mb-5">
      <button class="filter-btn active" data-filter="all">All Work</button>
      <button class="filter-btn" data-filter="plumbing">Plumbing</button>
      <button class="filter-btn" data-filter="electrical">Electrical</button>
      <button class="filter-btn" data-filter="cleaning">Cleaning</button>
      <button class="filter-btn" data-filter="carpentry">Carpentry</button>
      <button class="filter-btn" data-filter="painting">Painting</button>
      <button class="filter-btn" data-filter="pestcontrol">Pest Control</button>
    </div>

    <div class="row g-4" id="galleryGrid">
      <!-- Plumbing 1 -->
      <div class="col-md-4 gallery-item plumbing">
        <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?q=80&w=2070&auto=format&fit=crop" alt="Bathroom Repair">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Modern Bathroom Fitting</h5>
            <p class="small mb-0">Complete renovation and pipe assembly</p>
          </div>
        </div>
      </div>

      <!-- Electrical 1 -->
      <div class="col-md-4 gallery-item electrical">
        <img src="../images/wire.png" alt="Electrical Panel">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Panel Upgrade</h5>
            <p class="small mb-0">Safe and efficient industrial wiring</p>
          </div>
        </div>
      </div>

      <!-- Cleaning 1 -->
      <div class="col-md-4 gallery-item cleaning">
        <img src="../images/deep.png" alt="Deep Cleaning">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Deep Home Cleaning</h5>
            <p class="small mb-0">Post-renovation sparkle and sanitization</p>
          </div>
        </div>
      </div>

      <!-- Carpentry 1 -->
      <div class="col-md-4 gallery-item carpentry">
        <img src="https://images.unsplash.com/photo-1533090161767-e6ffed986c88?q=80&w=2069&auto=format&fit=crop" alt="Custom Cabinets">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Kitchen Cabinetry</h5>
            <p class="small mb-0">Custom wood finish and soft-close hinges</p>
          </div>
        </div>
      </div>

      <!-- Plumbing 2 -->
      <div class="col-md-4 gallery-item plumbing">
        <img src="../images/sink.png" alt="Sink Fix">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Kitchen Leak Fix</h5>
            <p class="small mb-0">Emergency repair and new faucet install</p>
          </div>
        </div>
      </div>

      <!-- Cleaning 2 -->
      <div class="col-md-4 gallery-item cleaning">
        <img src="https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?q=80&w=1974&auto=format&fit=crop" alt="Sofa Cleaning">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Sofa Shampooing</h5>
            <p class="small mb-0">Deep stain removal and fabric care</p>
          </div>
        </div>
      </div>

      <!-- Painting 1 -->
      <div class="col-md-4 gallery-item painting">
        <img src="../images/painting_gallery.png" alt="Painting Service">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Interior Wall Painting</h5>
            <p class="small mb-0">Premium finish with vibrant color themes</p>
          </div>
        </div>
      </div>

      <!-- Pest Control 1 -->
      <div class="col-md-4 gallery-item pestcontrol">
        <img src="../images/pestcontrol_gallery.png" alt="Pest Control Service">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Residential Pest Control</h5>
            <p class="small mb-0">Safe and effective sanitation solutions</p>
          </div>
        </div>
      </div>

      <!-- Painting 2 -->
      <div class="col-md-4 gallery-item painting">
        <img src="../images/painting_gallery_2.png" alt="Painting Preparation">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Detail Oriented Prep</h5>
            <p class="small mb-0">Careful masking and surface preparation</p>
          </div>
        </div>
      </div>

      <!-- Pest Control 2 -->
      <div class="col-md-4 gallery-item pestcontrol">
        <img src="../images/pestcontrol_gallery_2.png" alt="Termite Inspection">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Expert Bug Inspection</h5>
            <p class="small mb-0">Thorough check for termite and pest activity</p>
          </div>
        </div>
      </div>

      <!-- Carpentry 2 -->
      <div class="col-md-4 gallery-item carpentry">
        <img src="../images/carpentry.png" alt="Woodworking">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Custom Furniture</h5>
            <p class="small mb-0">Handcrafted wooden tables and chairs</p>
          </div>
        </div>
      </div>

      <!-- Electrical 2 -->
      <div class="col-md-4 gallery-item electrical">
        <img src="../images/electrical.png" alt="Electrical Work">
        <div class="gallery-overlay">
          <div>
            <h5 class="fw-bold">Circuit Maintenance</h5>
            <p class="small mb-0">Comprehensive diagnostic and repair</p>
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

    // Gallery Filter Logic
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.getAttribute('data-filter');
        const items = document.querySelectorAll('.gallery-item');
        
        items.forEach(item => {
          if (filter === 'all' || item.classList.contains(filter)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });

    checkSession();
  </script>

</body>

</html>
