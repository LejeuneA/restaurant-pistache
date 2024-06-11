<?php
require_once('C:\xampp\htdocs\restaurant-pistache\admin\settings.php');


$msg = null;
$resultStarters = null;
$resultMainCourses = null;
$resultDesserts = null;
$execute = false;

// Check the database connection
if (!is_object($conn)) {
    $msg = getMessage($conn, 'error');
} else {
    // Fetch all menu from the database
    $resultStarters = getAllStartersDB($conn);
    $resultMainCourses = getAllMainCoursesDB($conn);
    $resultDesserts = getAllDessertsDB($conn);

    // Check if starters exist
    if (is_array($resultStarters) && !empty($resultStarters)) {
        $execute = true;
    } else {
        $msg = getMessage('There is currently no menu to display.', 'error');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php displayHeadSection('Menu'); ?>
</head>

<body>
    <!-----------------------------------------------------------------
                                Header
    ------------------------------------------------------------------>
    <header>
        <?php displayNavigation(); ?>
    </header>
    <!-----------------------------------------------------------------
                            Header end
    ------------------------------------------------------------------>

    <!-- Main -->
    <main>
        <!-- Hero section -->
        <section class="hero-section hero-starter">
            <h2>Discover Flavorful Starters</h2>
            <div class="hero-container container">
            </div>
        </section>
        <!-- Hero section end -->

        <!-- Menu section -->
        <section class="menu-section">
            <!-- Menu container -->
            <div class="menu-container container">
                <!-- Menu navbar -->
                <div class="menu-navbar">
                    <ul class="menu-navbar-items">
                        <li class="menu-navbar-item" id="menu-starter">
                            <a class="nav-link" href="./menu.php">Starter</a>
                        </li>
                        <li class="menu-navbar-item" id="menu-main-course">
                            <a class="nav-link" href="./menu-maincourse.php">Main Course</a>
                        </li>
                        <li class="menu-navbar-item" id="menu-dessert">
                            <a class="nav-link" href="./menu-dessert.php">Dessert</a>
                        </li>
                    </ul>
                </div>
                <!-- Menu navbar end -->

                <!-- Menu items -->
                <div class="menu-items">

                    <!-- Starter content-->
                    <div class="menu-content" id="starter-content">
                        <?= displayStarters($execute, $resultStarters) ?>
                    </div>
                    <!-- Starter content end -->


                    <!-- Main Course content -->
                    <div class="menu-content" id="main-course-content">
                        <?= displayMainCourses($execute, $resultMainCourses) ?>
                    </div>
                    <!-- Main Course content end -->

                    <!-- Dessert content -->
                    <div class="menu-content" id="dessert-content">
                        <?= displayDesserts($execute, $resultDesserts) ?>
                    </div>
                    <!-- Dessert content end -->

                </div>
                <!-- Menu items end -->

            </div>
            <!-- Menu container end -->
        </section>
        <!-- Menu section end -->
    </main>

    <footer>
        <!-----------------------------------------------------------------
                               Footer
    ------------------------------------------------------------------>
        <footer>
            <!-- Footer upper section -->
            <div class="upper-footer-container">
                <!-- Upper footer -->
                <div class="upper-footer container">
                    <div class="footer-left">
                        <!-- Logo column -->
                        <a class="footer-brand" href="../index.php">
                            Pistache
                        </a>
                        <!-- Logo column end-->

                        <!-- Open hours column -->
                        <div class="footer-open-hours">
                            <h3>Open Hours</h3>
                            <ul>
                                <li>Monday<span>9:00 - 24:00</span></li>
                                <li>Tuesday<span>9:00 - 24:00</span></li>
                                <li>Wednesday<span>9:00 - 24:00</span></li>
                                <li>Thursday<span>9:00 - 24:00</span></li>
                                <li>Friday<span>9:00 - 02:00</span></li>
                                <li>Saturday<span>9:00 - 02:00</span></li>
                                <li>Sunday<span>9:00 - 02:00</span></li>
                            </ul>
                        </div>
                        <!-- Open hours column end -->
                    </div>

                    <div class="footer-right">
                        <!-- Instagram column -->
                        <div class="footer-instagram">
                            <h3>Instagram<h3>
                                    <div class="footer-instagram-container">
                                        <div class="footer-instagram-items">
                                            <img src="../assets/images/insta-1.jpg" alt="pistache instagram">
                                            <img src="../assets/images/insta-2.jpg" alt="pistache instagram">
                                            <img src="../assets/images/insta-3.jpg" alt="pistache instagram">
                                        </div>
                                        <div class="footer-instagram-items">
                                            <img src="../assets/images/insta-4.jpg" alt="pistache instagram">
                                            <img src="../assets/images/insta-5.jpg" alt="pistache instagram">
                                            <img src="../assets/images/insta-6.jpg" alt="pistache instagram">
                                        </div>
                                    </div>
                        </div>
                        <!-- Instagram column end -->

                        <!-- Follow us column -->
                        <div class="footer-follow-us">
                            <h3>Follow Us</h3>
                            <div class="footer-social-icons">
                                <p>
                                    Stay connected and follow us on social media for the latest updates, special offers, and
                                    a glimpse behind the scenes at Restaurant Pistache.
                                </p>
                                <div class="social-icons">
                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                    <!-- Twitter -->
                                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                    <!-- Instagram -->
                                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </div>

                                <p>343 Rue Saint-Gilles, 4000 Liége - Belgique</p>
                            </div>
                        </div>
                        <!-- Follow us column end -->
                    </div>
                </div>
            </div>
            <!-- Footer upper section end -->
            <!-----------------------------------------------------------------
                            Footer bottom section
        ------------------------------------------------------------------>
            <div class="bottom-footer-container">
                <!-- Section: Copyright -->
                <div class="bottom-footer container">
                    <!-- Copyright column -->
                    <div>
                        © 2024 Copyright tous droits réservés
                    </div>
                    <!-- Copyright column end -->

                    <!-- Conception and development column -->
                    <div>
                        Conception et développement par
                        <a href="https://github.com/lejeunea" class="github text-decoration-none">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a href="https://github.com/lejeunea" class="text-decoration-none">Açelya Lejeune</a>.
                    </div>
                    <!-- Conception and development column end -->
                </div>
                <!-- Section: Copyright -->
            </div>
            <!-- Footer bottom section end -->
        </footer>
        <!-----------------------------------------------------------------
                                   Footer end
        ------------------------------------------------------------------>
    </footer>

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></a>
    <!-----------------------------------------------------------------
                        JS Libraries
    ------------------------------------------------------------------>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="../assets/vendor/aos/aos.js"></script>

    <!-- Custom JS -->
    <script src="../js/main.js"></script>

</body>

</html>