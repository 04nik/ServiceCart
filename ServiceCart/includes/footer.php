<?php
// Determine the base path based on where this is included from
$current_dir = basename(getcwd());
$path_prefix = ($current_dir == 'admin' || $current_dir == 'provider' || $current_dir == 'frontend') ? '../' : './';
if ($current_dir == 'ServiceCart') $path_prefix = './'; // Root level
?>

<footer class="main-footer">
    <div class="container">
        <div class="row g-4">
            <!-- Brand & About -->
            <div class="col-lg-4 col-md-6">
                <a href="<?php echo $path_prefix; ?>frontend/index.php" class="footer-brand">ServiceCart</a>
                <p class="mb-4">Providing top-notch professional home services at your doorstep. From repairs to renovations, we've got you covered with certified experts.</p>
                <div class="social-icons d-flex">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="<?php echo $path_prefix; ?>frontend/index.php">Home</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/services.php">Services</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/about.php">About Us</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/gallery.php">Our Gallery</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/contact.php">Contact</a></li>
                </ul>
            </div>

            <!-- Our Services -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Our Services</h5>
                <ul class="footer-links">
                    <li><a href="<?php echo $path_prefix; ?>frontend/services.php?service=Plumbing">Expert Plumbing</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/services.php?service=Electrical">Electrical Solutions</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/services.php?service=Cleaning">Home Cleaning</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/services.php?service=Carpentry">Master Carpentry</a></li>
                    <li><a href="<?php echo $path_prefix; ?>frontend/services.php?service=Painting">Professional Painting</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Contact Us</h5>
                <ul class="contact-info list-unstyled">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Service Hub, Powai,<br>Mumbai, Maharashtra 400076</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>+91 98765 43210</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>support@servicecart.com</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Mon - Sat: 9:00 AM - 7:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> ServiceCart. All rights reserved. Designed for Excellence.</p>
        </div>
    </div>
</footer>
