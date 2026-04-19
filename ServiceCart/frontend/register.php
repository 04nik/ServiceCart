<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Service Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      background-color: #f4f6f9;
      padding-top: 70px;
      overflow-x: hidden;
    }

    /* 🧬 Animated Background Orbs */
    .register-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }

    .orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.1;
      animation: float 20s infinite alternate ease-in-out;
    }

    .orb-1 { width: 450px; height: 450px; background: #00d2ff; top: -150px; right: -100px; }
    .orb-2 { width: 350px; height: 350px; background: #0d6efd; bottom: -100px; left: -100px; animation-delay: -10s; }

    @keyframes float {
      from { transform: translate(0, 0) rotate(0deg) scale(1); }
      to { transform: translate(60px, 40px) rotate(10deg) scale(1.05); }
    }

    /* ✨ Register Card Animation */
    .register-container {
      min-height: calc(100vh - 70px);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 50px 15px;
      animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUpFade {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .register-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(12px);
      border: none;
      border-radius: 24px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
      padding: 45px;
      position: relative;
      overflow: hidden;
    }

    .register-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 6px;
      background: linear-gradient(90deg, #00d2ff, #0d6efd);
    }

    .form-label { font-weight: 600; color: #444; font-size: 0.9rem; margin-bottom: 6px; }
    .form-control, .form-select {
      border-radius: 12px;
      padding: 12px 18px;
      border: 1px solid #edf2f7;
      background: #fdfdfd;
      transition: all 0.25s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
      background: #fff;
    }

    .btn-register {
      background: linear-gradient(90deg, #00d2ff, #0d6efd);
      border: none;
      border-radius: 12px;
      padding: 14px;
      font-weight: 700;
      letter-spacing: 0.5px;
      color: white;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      margin-top: 15px;
    }

    .btn-register:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
      color: white;
    }

    .login-link { color: #0d6efd; text-decoration: none; font-weight: 600; }
    .login-link:hover { text-decoration: underline; }
  </style>
</head>

<body>

  <!-- 🧬 Background -->
  <div class="register-bg">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
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
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center ms-auto">
          <a href="login.php" class="btn btn-light btn-sm">Login</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- 📝 REGISTRATION FORM -->
  <div class="register-container">
    <div class="register-card">
      <div class="text-center mb-4">
        <div class="mb-2">
          <span style="font-size: 2.5rem;">🚀</span>
        </div>
        <h3 class="fw-bold">Join ServiceCart</h3>
        <p class="text-muted small">Create an account to start booking services</p>
      </div>

      <form action="../backend/register.php" method="POST">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required placeholder="John Doe">
          </div>
          
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required placeholder="name@example.com">
          </div>
          
          <div class="col-md-6">
            <label class="form-label">Mobile Number</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input type="tel" name="mobile" class="form-control" placeholder="10-digit number" required pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            </div>
          </div>


          <div class="col-12">
            <label class="form-label">Create Password</label>
            <input type="password" name="password" class="form-control" required placeholder="••••••••">
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-register w-100">Create My Account</button>
          </div>
        </div>
      </form>

      <div class="text-center mt-4 pt-2">
        <p class="mb-0 text-muted small">Already have an account? <a href="login.php" class="login-link">Login here</a></p>
      </div>
    </div>
  </div>

  <!-- 🔻 FOOTER -->
  <?php include "../includes/footer.php"; ?>

</body>

</html>

