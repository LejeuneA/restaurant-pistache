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
    <title>Book a table</title>
</head>

<body>
    <header>
        <?php displayNavigation(); ?>
    </header>
    <main>
        <section class="reservation-section">
            <div class="reservation-section-container container">
                <div class="reservation-container container" data-aos="fade-in" data-aos-delay="200">
                    <div class="reservation-content">
                        <div class="reservation-content-title">
                            <div class="reservation-title">
                                <span class="subheading">Book a table</span>
                                <h2 class="title">Make Reservation</h2>
                            </div>
                        </div>
                        
                        <!-- Check for the success message -->
                        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                            <div class="success-message">
                                Your reservation has been made successfully!
                            </div>
                        <?php endif; ?>
                        
                        <form action="../forms/reservation.php" method="post">
                            <div class="reservation-form-container">
                                <div class="reservation-form-items">
                                    <div class="reservation-form-item">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                        </div>
                                    </div>
                                    <div class="reservation-form-item">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                                        </div>
                                    </div>
                                    <div class="reservation-form-item">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="reservation-form-items">
                                    <div class="reservation-form-item">
                                        <div class="form-group">
                                            <label for="book_date">Book date</label>
                                            <input type="date" name="book_date" class="form-control" id="book_date" placeholder="Date" required>
                                        </div>
                                    </div>
                                    <div class="reservation-form-item">
                                        <div class="form-group">
                                            <label for="book_time">Time</label>
                                            <select name="book_time" class="form-control" id="book_time" required>
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
                                            <select name="person" id="person" class="form-control" required>
                                                <option value="">Select Person</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4+</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="reservation-button">
                                <div class="form-group">
                                    <input type="submit" value="Make a Reservation" class="btn-secondary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="map-container container" data-aos="fade-in" data-aos-delay="400">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2518.798010128868!2d5.569091276394098!3d50.63038067949861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c0f0897b7a8bb7%3A0x401ed56b8e997e0!2sRue%20Saint-Gilles%20343%2C%204000%20Li%C3%A8ge%2C%20Belgium!5e0!3m2!1sen!2s!4v1688150655951!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="upper-footer-container">
            <div class="upper-footer container">
                <div class="footer-left">
                    <a class="footer-brand" href="../index.php">
                        Pistache
                    </a>
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
                </div>
                <div class="footer-right">
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
                    <div class="footer-follow-us">
                        <h3>Follow Us</h3>
                        <div class="footer-social-icons">
                            <p>
                                Stay connected and follow us on social media for the latest updates, special offers, and a glimpse behind the scenes at Restaurant Pistache.
                            </p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </div>
                            <p>343 Rue Saint-Gilles, 4000 Liége - Belgique</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer-container">
            <div class="bottom-footer container">
                <div>© 2024 Copyright tous droits réservés</div>
                <div>
                    Conception et développement par
                    <a href="https://github.com/lejeunea" class="github text-decoration-none">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://github.com/lejeunea" class="text-decoration-none">Açelya Lejeune</a>.
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></a>

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
