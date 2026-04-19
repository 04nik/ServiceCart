<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | ServiceCart</title>
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
    .login-bg {
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
      animation: float 15s infinite alternate ease-in-out;
    }

    .orb-1 { width: 400px; height: 400px; background: #0d6efd; top: -100px; left: -100px; }
    .orb-2 { width: 300px; height: 300px; background: #00d2ff; bottom: -50px; right: -50px; animation-delay: -5s; }

    @keyframes float {
      from { transform: translate(0, 0) scale(1); }
      to { transform: translate(50px, 50px) scale(1.1); }
    }

    /* 🔐 Login Card Animation */
    .login-container {
      min-height: calc(100vh - 70px);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 15px;
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: none;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 450px;
      padding: 40px;
      position: relative;
      overflow: hidden;
    }

    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, #0d6efd, #00d2ff);
    }

    .form-label { font-weight: 600; color: #444; }
    .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      border: 1px solid #eee;
      background: #fdfdfd;
      transition: all 0.3s;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
      background: #fff;
    }

    .btn-login {
      background: linear-gradient(90deg, #0d6efd, #004aad);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 700;
      letter-spacing: 0.5px;
      transition: all 0.3s;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    .register-link { color: #0d6efd; text-decoration: none; font-weight: 600; }
    .register-link:hover { text-decoration: underline; }
  </style>
</head>

<body>

  <!-- 🧬 Background -->
  <div class="login-bg">
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
          <a href="register.php" class="btn btn-light btn-sm">Register</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- 🔐 LOGIN FORM -->
  <div class="login-container">
    <div class="login-card">
      <div class="text-center mb-4">
        <div class="mb-3">
          <span style="font-size: 3rem;">👋</span>
        </div>
        <h3 class="fw-bold">Welcome Back</h3>
        <p class="text-muted">Login to manage your service bookings</p>
      </div>

      <form action="../backend/login.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input type="email" name="email" class="form-control" required placeholder="name@example.com">
        </div>
        <div class="mb-4">
          <div class="d-flex justify-content-between">
            <label class="form-label">Password</label>
            <a href="#" class="small text-decoration-none">Forgot?</a>
          </div>
          <input type="password" name="password" class="form-control" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn btn-primary btn-login w-100 mb-3">Login to Account</button>
      </form>

      <div class="text-center">
        <p class="mb-0 text-muted">Don't have an account? <a href="register.php" class="register-link">Create one</a></p>
      </div>
    </div>
  </div>

  <!-- 🔻 FOOTER -->
  <?php include "../includes/footer.php"; ?>

</body>

</html>
