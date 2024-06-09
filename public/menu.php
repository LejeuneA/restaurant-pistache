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
        <div class="header-top">
            <div class="header-top-container container">
                <div class="header-top-items">
                    <div class="header-top-item">
                        <i class="fas fa-phone"></i>
                        <span>+32 493 38 77 29</span>
                    </div>
                </div>
                <div class="header-top-items">
                    <div class="header-top-item">
                        <i class="fas fa-paper-plane"></i>
                        <span>contact@pistache.be</span>
                    </div>
                </div>
                <div class="header-top-items">
                    <div class="header-top-item">
                        <i class="fas fa-location-dot"></i>
                        <span>343 Rue Saint Gilles, 4000 Liége</span>
                    </div>
                </div>
                <!-- Header top items end -->
            </div>
            <!-- Header top container end -->
        </div>
        <!-- Header top end -->

        <!---------------------------------------------------------------
                                Navigation
        ---------------------------------------------------------------->
        <nav class="navbar">
            <div class="navbar-container container">
                <!-- Logo -->
                <a class="navbar-brand" href="../index.php">
                    Pistache
                </a>
                <!-- Logo end -->

                <!-- Right-side content -->
                <div class="navbar-right">
                    <!-- Navbar menu -->
                    <div class="navbar-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./menu.php">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./contact.php">Contact</a>
                            </li>
                        </ul>

                        <!-- Login button -->
                        <a href="./reservation.php" class="btn-primary">Book a table</a>
                        <!-- Login button end -->
                    </div>
                    <!-- Navbar menu end -->
                </div>
                <!-- Right-side content end -->
            </div>
        </nav>
        <!-- End Nav Menu -->

        <!---------------------------------------------------------------
                             Offcanvas menu
        ----------------------------------------------------------------->
        <div id="mySidenav" class="sidenav">

            <!-- Menu -->
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a class="nav-link" href="./index.php">Home</a>
            <a class="nav-link" href="./index.php#about">About</a>
            <a class="nav-link" href="./menu.php">Menu</a>
            <a class="nav-link" href="./contact.php">Contact</a>
            <!-- Menu end -->

            <!-- Login button -->
            <a href="./reservation.php" class="btn-primary">Book a table</a>
            <!-- Login button end -->
        </div>

        <!-- Hamburger icon for smaller screens -->
        <div class="navbar-hamburger">
            <div id="hamburger" onclick="openNav()"><i class="fas fa-bars"></i></div>
        </div>
        <!-- Offcanvas menu end -->
        <!-- Navigation end-->
    </header>
    <!-- Header end -->

    <!-- Main -->
    <main>
        <!-- Hero section -->
        <section class="hero-section">
            <h2>Explore Our Culinary Delights</h2>
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
                            <a class="nav-link" href="#">Starter</a>
                        </li>
                        <li class="menu-navbar-item" id="menu-main-course">
                            <a class="nav-link" href="#">Main Course</a>
                        </li>
                        <li class="menu-navbar-item" id="menu-dessert">
                            <a class="nav-link" href="#">Dessert</a>
                        </li>
                    </ul>
                </div>
                <!-- Menu navbar end -->

                <!-- Menu items -->
                <div class="menu-items">

                    <!-- Starter content-->
                    <div class="menu-content" id="starter-content">
                        <?php if ($execute) : ?>
                            <?php
                            $delay = 0;
                            foreach ($resultStarters as $index => $starter) : ?>
                                <?php if ($index % 2 == 0) : ?>
                                    <div class="menu-row" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                                        <?php $delay += 200; ?>
                                    <?php endif; ?>
                                    <div class="menu-item">
                                        <img class="menu-item-image" src="<?= DOMAIN . '/uploads/' . htmlspecialchars($starter['image_url']) ?>" alt="<?= htmlspecialchars($starter['title']) ?>">
                                        <div class="menu-item-info">
                                            <h3 class="menu-item-title"><?= htmlspecialchars($starter['title']) ?></h3>
                                            <span class="menu-item-price">€<?= number_format($starter['price'], 2) ?></span>
                                            <p><?= htmlspecialchars($starter['description']) ?></p>
                                        </div>
                                    </div>
                                    <?php if (($index + 1) % 2 == 0) : ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($index >= 160) break; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No starters available at the moment.</p>
                        <?php endif; ?>
                    </div>
                    <!-- Starter content end -->


                    <!-- Main Course content -->
                    <div class="menu-content" id="main-course-content">
                        <?php if (is_array($resultMainCourses) && !empty($resultMainCourses)) : ?>
                            <?php
                            $delay = 0;
                            foreach ($resultMainCourses as $index => $mainCourse) : ?>
                                <?php if ($index % 4 == 0) : ?>
                                    <div class="menu-row" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                                        <?php $delay += 100; ?>
                                    <?php endif; ?>
                                    <div class="menu-item">
                                        <img class="menu-item-image" src="<?= DOMAIN . '/uploads/' . htmlspecialchars($mainCourse['image_url']) ?>" alt="<?= htmlspecialchars($mainCourse['title']) ?>">
                                        <div class="menu-item-info">
                                            <h3 class="menu-item-title"><?= htmlspecialchars($mainCourse['title']) ?></h3>
                                            <span class="menu-item-price">€<?= number_format($mainCourse['price'], 2) ?></span>
                                            <p><?= htmlspecialchars($mainCourse['description']) ?></p>
                                        </div>
                                    </div>
                                    <?php if (($index + 1) % 4 == 0) : ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($index >= 160) break; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No main courses available at the moment.</p>
                        <?php endif; ?>
                    </div>
                    <!-- Main Course content end -->

                    <!-- Dessert content -->
                    <div class="menu-content" id="dessert-content">
                        <?php if (is_array($resultDesserts) && !empty($resultDesserts)) : ?>
                            <?php
                            $delay = 0;
                            foreach ($resultDesserts as $index => $dessert) : ?>
                                <?php if ($index % 4 == 0) : ?>
                                    <div class="menu-row" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                                        <?php $delay += 100; ?>
                                    <?php endif; ?>
                                    <div class="menu-item">
                                        <img class="menu-item-image" src="<?= DOMAIN . '/uploads/' . htmlspecialchars($dessert['image_url']) ?>" alt="<?= htmlspecialchars($dessert['title']) ?>">
                                        <div class="menu-item-info">
                                            <h3 class="menu-item-title"><?= htmlspecialchars($dessert['title']) ?></h3>
                                            <span class="menu-item-price">€<?= number_format($dessert['price'], 2) ?></span>
                                            <p><?= htmlspecialchars($dessert['description']) ?></p>
                                        </div>
                                    </div>
                                    <?php if (($index + 1) % 4 == 0) : ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($index >= 160) break; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No desserts available at the moment.</p>
                        <?php endif; ?>
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