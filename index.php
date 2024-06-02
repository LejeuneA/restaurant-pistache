<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="restaurant website">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="./css/styles.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- AOS Library CSS -->
    <link href="./assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="./assets/icons/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Title -->
    <title>Restaurant Pistache</title>
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
                <a class="navbar-brand" href="./index.php">
                    Pistache
                </a>
                <!-- Logo end -->

                <!-- Right-side content -->
                <div class="navbar-right">
                    <!-- Navbar menu -->
                    <div class="navbar-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./public/menu.php">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./public/contact.php">Contact</a>
                            </li>
                        </ul>

                        <!-- Login button -->
                        <a href="./public/reservation.php" class="btn-primary">Book a table</a>
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
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="index.php#about">About</a>
            <a class="nav-link" href="./public/menu.php">Menu</a>
            <a class="nav-link" href="./public/contact.php">Contact</a>
            <!-- Menu end -->

            <!-- Login button -->
            <a href="./public/reservation.php" class="btn-primary">Book a table</a>
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
    <!-----------------------------------------------------------------
                                Main
    ------------------------------------------------------------------>
    <main>
        <!-----------------------------------------------------------------
                                Hero slider
        ------------------------------------------------------------------>
        <section class="hero-slider">
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <!-- Swiper-wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide"><img src="./assets/images/hero_1.jpg" alt="Restaurant Pistache"></div>

                    <div class="swiper-slide"><img src="./assets/images/hero_2.jpg" alt="Restaurant Pistache"></div>

                    <div class="swiper-slide"><img src="./assets/images/hero_3.jpg" alt="Restaurant Pistache"></div>

                    <div class="swiper-slide"><img src="./assets/images/hero_4.jpg" alt="Restaurant Pistache"></div>

                    <div class="swiper-slide"><img src="./assets/images/hero_5.jpg" alt="Restaurant Pistache"></div>
                    <!-- Slides end -->
                </div>
                <!-- Swiper-wrapper end -->
            </div>
            <!-- Swiper end -->
        </section>
        <!-- Hero slider end -->

        <!-----------------------------------------------------------------
                                 About section
        ------------------------------------------------------------------>
        <section class="about-section" id="about">
            <!-- About container -->
            <div class="about-container container">
                <!-- About content -->
                <div class="about-content">
                    <!-- About content left -->
                    <div class="about-content-left" data-aos="fade-right">
                        <img src="./assets/images/about.jpg" alt="Chef Pistache">
                        <img src="./assets/images/about-1.jpg" alt="Chef Pistache">
                    </div>
                    <!-- About content left end -->
                    <!-- About content right -->
                    <div class="about-content-right" data-aos="fade-left">
                        <div class="about-content-title">
                            <div class="about-title">
                                <span class="subheading">About</span>
                                <h2 class="title">Restaurant Pistache</h2>
                            </div>
                            <p>At Pistache Restaurant, delight in the refined flavors of Franco-Mediterranean cuisine.
                                Driven by passion and commitment, we promise an unparalleled culinary journey that will
                                leave a lasting impression. Join us to discover an extraordinary dining experience.</p>
                        </div>
                        <p class="time">
                            <span>Mon - Fri <b>9AM - 12PM</b></span>
                            <span><a href="./public/reservation.php">+32 493 38 77 29</a></span>
                        </p>
                    </div>
                    <!-- About content right end -->
                </div>
                <!-- About content end -->
            </div>
            <!-- About container end -->
        </section>
        <!-- About section end -->
        <!-----------------------------------------------------------------
                                Counter section
        ------------------------------------------------------------------>
        <!-- Counter section -->
        <section class="counter-container">
            <div class="counter-content container" data-aos="fade-up">
                <div class="counter-text">
                    <div class="value" akhi="28">0</div>
                    <span>Years of Experienced</span>
                </div>
                <div class="counter-text">
                    <div class="value" akhi="85">0</div>
                    <span>Menus/Dish</span>
                </div>
                <div class="counter-text">
                    <div class="value" akhi="65">0</div>
                    <span>Staffs</span>
                </div>
                <div class="counter-text">
                    <div class="value" akhi="37">0</div>
                    <span>Branching</span>
                </div>
            </div>
        </section>
        <!-- Counter section end -->
        <!-----------------------------------------------------------------
                                 Chef section
        ------------------------------------------------------------------>
        <section class="chef-section">
            <!--Chef container-->
            <div class="chef-container container">
                <!--Chef content-->
                <div class="chef-content">
                    <div class="chef-content-title">
                        <div class="chef-title">
                            <span class="subheading">Chef</span>
                            <h2 class="title">Our Master Chef</h2>
                        </div>
                        <p>Discover the culinary artisans behind the magic at Restaurant Pistache. With a shared passion
                            for Franco-Mediterranean cuisine and a commitment to culinary excellence, our master chefs
                            craft each dish with precision and flair. </p>
                    </div>
                    <!--Chef content left-->
                    <div class="chef-content-info">
                        <div class="chef-info-items">
                            <div class="chef-info-item" data-aos="fade-up" data-aos-delay="200">
                                <img src="./assets/images/chef_1.jpg" alt="Chef">
                                <p>Pierre Dubois<span>Restaurant Owner</span></p>
                                <ul>
                                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://x.com/"><i class="fab fa-x-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="chef-info-item" data-aos="fade-up" data-aos-delay="400">
                                <img src="./assets/images/chef_2.jpg" alt="Chef">
                                <p>Sophia Rousseau<span>Head Chef</span></p>
                                <ul>
                                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://x.com/"><i class="fab fa-x-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="chef-info-item" data-aos="fade-up" data-aos-delay="600">
                                <img src="./assets/images/chef_3.jpg" alt="Chef">
                                <p>Lucas Moreau<span>Chef</span></p>
                                <ul>
                                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://x.com/"><i class="fab fa-x-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="chef-info-item" data-aos="fade-up" data-aos-delay="800">
                                <img src="./assets/images/chef_4.jpg" alt="Chef">
                                <p>Isabelle Lefèvre<span>Chef</span></p>
                                <ul>
                                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://x.com/"><i class="fab fa-x-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Chef content top end-->
                </div>
                <!--Chef content end-->
            </div>
            <!--Chef container end-->
        </section>
        <!--Chef section end -->

        <!-----------------------------------------------------------------
                            Reservation section
        ------------------------------------------------------------------>
        <section class="reservation-section">
            <!--Reservation container-->
            <div class="reservation-container container" data-aos="fade-in" data-aos-delay="800">
                <!--Reservation content-->
                <div class="reservation-content">
                    <div class="reservation-content-title">
                        <div class="reservation-title">
                            <span class="subheading">Book a table</span>
                            <h2 class="title">Make Reservation</h2>
                        </div>
                    </div>
                    <!--Reservation-content-title-->
                    <!--Reservation form-->
                    <form action="#">
                        <div class="reservation-form-container">
                            <div class="reservation-form-items">
                                <div class="reservation-form-item">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="reservation-form-item">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" placeholder="Your Email">
                                    </div>
                                </div>
                                <div class="reservation-form-item">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <!--Reservation form item end-->
                            </div>
                            <!--Reservation form items end-->
                            <div class="reservation-form-items">
                                <div class="reservation-form-item">
                                    <div class="form-group">
                                        <label for="book_date">Phone</label>
                                        <input type="text" class="form-control" id="book_date" placeholder="Date">
                                    </div>
                                </div>
                                <div class="reservation-form-item">
                                    <div class="form-group">
                                        <label for="book_time">Time</label>
                                        <select class="form-control" id="book_time">
                                            <option value="09:00">09:00 AM</option>
                                            <option value="10:00">10:00 AM</option>
                                            <option value="11:00">11:00 AM</option>
                                            <option value="12:00">12:00 PM</option>
                                            <option value="13:00">01:00 PM</option>
                                            <option value="14:00">02:00 PM</option>
                                            <option value="15:00">03:00 PM</option>
                                            <option value="16:00">04:00 PM</option>
                                            <option value="17:00">05:00 PM</option>
                                            <option value="18:00">06:00 PM</option>
                                            <option value="19:00">07:00 PM</option>
                                            <option value="20:00">08:00 PM</option>
                                            <option value="21:00">09:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="reservation-form-item">
                                    <div class="form-group">
                                        <label for="person">Person</label>
                                        <select name="person" id="person" class="form-control">
                                            <option value="">Person</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4+</option>
                                        </select>
                                    </div>
                                </div>
                                <!--Reservation form item end-->
                            </div>
                            <!--Reservation form items end-->
                        </div>
                        <!--Reservation form container end-->
                        <!--Button-->
                        <div class="reservation-button">
                            <div class="form-group">
                                <input type="submit" value="Make a Reservation" class="btn-secondary">
                            </div>
                        </div>
                        <!--Button end-->
                    </form>
                    <!--Reservation form end-->
                </div>
                <!--Reservation content end-->
            </div>
            <!--Reservation container end-->
        </section>
        <!--Reservation section end-->

    </main>
    <!-- End Main -->
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
                    <a class="footer-brand" href="./index.php">
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
                                        <img src="./assets/images/insta-1.jpg" alt="pistache instagram">
                                        <img src="./assets/images/insta-2.jpg" alt="pistache instagram">
                                        <img src="./assets/images/insta-3.jpg" alt="pistache instagram">
                                    </div>
                                    <div class="footer-instagram-items">
                                        <img src="./assets/images/insta-4.jpg" alt="pistache instagram">
                                        <img src="./assets/images/insta-5.jpg" alt="pistache instagram">
                                        <img src="./assets/images/insta-6.jpg" alt="pistache instagram">
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

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></a>
    <!-----------------------------------------------------------------
                        JS Libraries
    ------------------------------------------------------------------>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="./assets/vendor/aos/aos.js"></script>

    <!-- Custom JS -->
    <script src="./js/main.js"></script>

</body>

</html>