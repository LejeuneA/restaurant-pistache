<?php
require_once('C:\xampp\htdocs\restaurant-pistache\admin\settings.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="restaurant website">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- AOS Library CSS -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/icons/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Title -->
    <title>Contact us</title>
</head>

<body>
    <!-----------------------------------------------------------------
                                Header
    ------------------------------------------------------------------>
    <header>
        <?php displayNavigation(); ?>
    </header>
    <!-- Header end -->
    <!-----------------------------------------------------------------
                                Main
    ------------------------------------------------------------------>
    <main>
        <!-----------------------------------------------------------------
                            Contact section
        ------------------------------------------------------------------>
        <section class="contact-section">

            <!-- Contact upper section -->
            <div class="contact-upper-container container">
                <!-- Contact form container -->
                <div class="contact-container" data-aos="fade-right" data-aos-delay="200">
                    <!-- Contact content -->
                    <div class="contact-content">
                        <div class="contact-content-title">
                            <div class="contact-title">
                                <span class="subheading">Contact</span>
                                <h2 class="title">Contact us</h2>
                            </div>
                        </div>
                        <!-- Contact-content-title -->
                        <!-- Contact form -->
                        <form action="../forms/contact.php" method="post">
                            <div class="contact-form-container">
                                <div class="contact-form-items">
                                    <div class="contact-form-item">
                                        <div class="form-group">
                                            <label for="firstName">Name</label>
                                            <input type="text" class="form-control" name="firstName" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="contact-form-item">
                                        <div class="form-group">
                                            <label for="lastName">Surname</label>
                                            <input type="text" class="form-control" name="lastName" placeholder="Your Surname">
                                        </div>
                                    </div>
                                    <div class="contact-form-item">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Your Email">
                                        </div>
                                    </div>
                                    <!-- Contact form item end -->
                                </div>
                                <!-- Contact form items end -->
                                <div class="contact-form-items">
                                    <div class="contact-form-item">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="contact-form-item">
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea type="text" id="form-message" name="message" placeholder="Your message"></textarea>
                                        </div>
                                    </div>
                                    <!-- Contact form item end -->
                                </div>
                                <!--Contact form items end-->
                            </div>
                            <!-- Contact form container end -->
                            <!-- Button -->
                            <div class="contact-button">
                                <div class="form-group">
                                    <input type="submit" value="Make a contact" class="btn-secondary">
                                </div>
                            </div>
                            <!-- Button end -->
                        </form>
                        <!-- Contact form end -->
                    </div>
                    <!-- Contact content end -->
                </div>
                <!-- Contact container end -->
                <!-- Google map -->
                <div class="map-container" data-aos="fade-left" data-aos-delay="400">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2518.798010128868!2d5.569091276394098!3d50.63038067949861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c0f0897b7a8bb7%3A0x401ed56b8e997e0!2sRue%20Saint-Gilles%20343%2C%204000%20Li%C3%A8ge%2C%20Belgium!5e0!3m2!1sen!2s!4v1688150655951!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- Google map end -->
            </div>
            <!-- Contact upper section end -->

            <!-- Contact bottom container -->
            <div class="contact-bottom-container">
                <!-- Contact info -->
                <div class="contact-info container" data-aos="fade-up" data-aos-delay="400">
                    <div class="contact-info-items">
                        <div class="contact-info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>343 Rue Saint Gilles, 4000 Liége</span>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-envelope"></i>
                            <span>contact@pistache.be</span>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-phone"></i>
                            <span>+32 493 38 77 29</span>
                        </div>
                    </div>
                    <!-- Contact info items end -->
                </div>
                <!-- Contact info end -->
            </div>
            <!-- Contact bottom container end -->
        </section>
        <!-- Contact section end -->
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