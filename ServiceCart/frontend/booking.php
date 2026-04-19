<?php
session_start();
include "../backend/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Service | ServiceCart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="style.css">

<style>
body{
padding-top:70px;
background:#f8f9fa;
}
.booking-card{
box-shadow: 0 10px 30px rgba(0,0,0,0.08);
border-radius:20px;
border: none;
}
</style>
</head>

<body>

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
        <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
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


<!-- BOOKING FORM -->
<div class="container mt-4">
<div class="row justify-content-center">
<div class="col-md-6">

<div class="card booking-card p-4">

<h3 class="text-center mb-4">Book Service</h3>

<form id="bookingForm">

<!-- Hidden values from previous page -->

<input type="hidden" name="provider" id="provider">
<input type="hidden" name="price" id="priceValue">

<!-- Service -->
<div class="mb-3">
<label class="form-label">Select Service</label>

<select class="form-select" id="service" name="service">

<option value="">-- Select Service --</option>
<option>Plumbing</option>
<option>Electrical</option>
<option>Cleaning</option>
<option>Carpentry</option>
<option>Painting</option>
<option>Pest Control</option>

</select>
</div>


<!-- Date -->
<div class="mb-3">
<label class="form-label">Preferred Date</label>

<input type="date" class="form-control" name="date" required min="<?php echo date('Y-m-d'); ?>">

</div>


<!-- Time -->
<div class="mb-3">
<label class="form-label">Preferred Time</label>

<input type="time" class="form-control" name="time" required>

</div>


<!-- Address -->
<div class="mb-3">
<label class="form-label">Service Address</label>

<textarea class="form-control" rows="3" name="address" required></textarea>

</div>


<!-- Phone -->
<div class="mb-3">
<label class="form-label">Contact Number</label>

<input type="tel" class="form-control" name="phone" required pattern="[0-9]{10}" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="10-digit number">

</div>


<!-- Price Display -->
<div class="mb-3">

<label class="form-label">Estimated Price</label>

<input type="text" id="priceDisplay" class="form-control" disabled>

</div>


<button type="submit" class="btn btn-primary w-100">

Confirm Booking

</button>

</form>

</div>

</div>
</div>

<div style="height:300px;"></div>

</div>


<!-- 🔻 FOOTER -->
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
      <a href="services.php" class="btn btn-outline-light btn-sm me-2">Services</a>
      <a href="${dashboardLink}" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
      <a href="../backend/logout.php" class="btn btn-light btn-sm">Logout</a>
    `;
  }
}

/* GET VALUES FROM URL */
const params = new URLSearchParams(window.location.search);
const provider = params.get("provider");
const service = params.get("service");
const price = params.get("price");

/* FILL FORM VALUES */
if(service) {
  const serviceSelect = document.getElementById("service");
  serviceSelect.value = service;
  
  // If service is from URL, we lock it
  serviceSelect.disabled = true;
  
  // Add hidden input to maintain post data
  let hiddenSvc = document.createElement("input");
  hiddenSvc.type = "hidden";
  hiddenSvc.name = "service";
  hiddenSvc.value = service;
  document.getElementById("bookingForm").appendChild(hiddenSvc);
}

if(price){
  document.getElementById("priceDisplay").value = "₹" + price;
  document.getElementById("priceValue").value = price;
}
if(provider) document.getElementById("provider").value = provider;

/* BOOKING SUBMIT */
document.getElementById("bookingForm").addEventListener("submit",function(e){
  e.preventDefault();
  if(!currentUser) {
    alert("Please login to book a service.");
    window.location.href = "login.php";
    return;
  }

  let formData = new FormData(this);
  fetch("../backend/book_service.php",{
    method:"POST",
    body:formData
  })
  .then(response => response.text())
  .then(data => {
    if(data.trim()=="success"){
      alert("🎉 Booking Successful!\n\nOur service provider will contact you soon.");
      window.location.href="index.php";
    } else if(data.trim()=="login_required"){
      alert("Session expired. Please login again.");
      window.location.href="login.php";
    } else {
      alert("❌ Booking Failed: " + data);
    }
  });
});

checkSession();
</script>


</body>
</html>
