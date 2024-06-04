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
                        <!-- Menu items -->
                        <div class="menu-items" data-aos="fade-up" data-aos-delay="150">
                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/starter-1.jpg" alt="Scottish red label salmon">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Scottish smoked label salmon</h3>
                                    <span class="menu-item-price">€15.00</span>
                                    <p>Salmon filet, Kosher salt, Brown sugar, Olive oil</p>
                                </div>
                            </div>

                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/starter-2.jpg" alt="Ravioli with tomato sauce and dill">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Ravioli with tomato sauce and dill</h3>
                                    <span class="menu-item-price">€13.00</span>
                                    <p>Ravolli, Tomato sauce, Dill, Olive oil</p>
                                </div>
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items reverse" data-aos="fade-up" data-aos-delay="300">
                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Tuna salad with tomatoes</h3>
                                    <span class="menu-item-price">€15.00</span>
                                    <p>Tuna fish, Boiled egg, Tomatoes, Lemon</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/starter-3.jpg" alt="Tuna salad with tomatoes">
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Shrimps in batter with sauce</h3>
                                    <span class="menu-item-price">€17.00</span>
                                    <p>Shrimps, Fresh vegetable salad, Lemon, Sauce</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/starter-4.jpg" alt="Shrimps in batter with sauce">
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items" data-aos="fade-up" data-aos-delay="450">
                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/starter-5.jpg" alt="Fried squid">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Fried squid</h3>
                                    <span class="menu-item-price">€17.00</span>
                                    <p>Calamari, Fresh vegetable salad, Lemon, Sauce</p>
                                </div>
                            </div>

                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/starter-6.jpg" alt="Steak tartare">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Steak tartare</h3>
                                    <span class="menu-item-price">€18.00</span>
                                    <p>Beef fillet, Shallots, Cornichons, Yolk egg</p>
                                </div>
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items reverse" data-aos="fade-up" data-aos-delay="600">
                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Chicken liver pâté</h3>
                                    <span class="menu-item-price">€13.00</span>
                                    <p>Chicken livers, Onion, Double cream, Toast</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/starter-7.jpg" alt="Chicken liver pâté">
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">French onion soup</h3>
                                    <span class="menu-item-price">€14.00</span>
                                    <p>Onions, Beef stock, Butter, Parsley</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/starter-8.jpg" alt="French onion soup">
                            </div>
                        </div>
                        <!-- Menu items end -->
                    </div>
                    <!-- Starter content end -->

                    <!-- Main Course -->
                    <div class="menu-content" id="main-course-content">
                        <!-- Menu items -->
                        <div class="menu-items" data-aos="fade-up" data-aos-delay="150">
                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/main-1.jpg" alt="Chicken confit with sauce vierge">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Chicken confit with sauce vierge</h3>
                                    <span class="menu-item-price">€24.00</span>
                                    <p>Chicken marylandst, Pommes puree, Garlic cloves, Sauce</p>
                                </div>
                            </div>

                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/main-2.jpg" alt="Salmon steamed in paper parcels">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Salmon steamed in paper parcels</h3>
                                    <span class="menu-item-price">€24.00</span>
                                    <p>Ravolli, Tomato sauce, Dill, Olive oil</p>
                                </div>
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items reverse" data-aos="fade-up" data-aos-delay="300">
                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Slow-cooked boeuf bourguignon</h3>
                                    <span class="menu-item-price">€25.00</span>
                                    <p>Chuck steak, Carrot, Garlic cloves, Potato</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/main-3.jpg" alt="Slow-cooked boeuf bourguignon">
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Marseille-Style Shrimp Stew</h3>
                                    <span class="menu-item-price">€21.00</span>
                                    <p>Jumbo shrimp, Garlic cloves, Cayenne pepper, Basilic leaves</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/main-4.jpg" alt="Marseille-Style Shrimp Stew">
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items" data-aos="fade-up" data-aos-delay="450">
                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/main-5.jpg" alt="Duck à l'Orange">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Duck à l'Orange</h3>
                                    <span class="menu-item-price">€32.00</span>
                                    <p>Pekin ducks, Oranges, Potatoes, White wine</p>
                                </div>
                            </div>

                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/main-6.jpg" alt="Stuffed Pork Tenderloins with Bacon">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Stuffed Pork Tenderloins with Bacon</h3>
                                    <span class="menu-item-price">€25.00</span>
                                    <p>Pork tenderloins, Breakfast sausage, Garlic cloves, Chopped thyme</p>
                                </div>
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items reverse" data-aos="fade-up" data-aos-delay="600">
                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Strip Steak Frites with Béarnaise Butter</h3>
                                    <span class="menu-item-price">€24.00</span>
                                    <p>Steaks, Potatoes, Béarnaise butter, White vinegar</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/main-7.jpg" alt="Strip Steak Frites with Béarnaise Butter">
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Ratatouille</h3>
                                    <span class="menu-item-price">€21.00</span>
                                    <p>Eggplants, Zucchini, Yellow onions, Red bell peppers</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/main-8.jpg" alt="Ratatouille">
                            </div>
                        </div>
                        <!-- Menu items end -->
                    </div>

                    <!-- Dessert -->
                    <div class="menu-content" id="dessert-content">
                        <!-- Menu items -->
                        <div class="menu-items" data-aos="fade-up" data-aos-delay="150">
                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/dessert-1.jpg" alt="Crêpes Suzette">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Crêpes suzette</h3>
                                    <span class="menu-item-price">€12.00</span>
                                    <p>Flour, Milk, Granulated sugar, Orange Butter Sauce</p>
                                </div>
                            </div>

                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/dessert-2.jpg" alt="Tarte Tatin">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Tarte tatin</h3>
                                    <span class="menu-item-price">€13.00</span>
                                    <p>Flour, Apples, Sugar, Whipped cream</p>
                                </div>
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items reverse" data-aos="fade-up" data-aos-delay="300">
                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Floating islands</h3>
                                    <span class="menu-item-price">€12.00</span>
                                    <p>Egg whites, Granulated sugar, Heavy cream, Dark chocolate</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/dessert-3.jpg" alt="Floating Islands">
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Hazelnut and crème fraîche meringues</h3>
                                    <span class="menu-item-price">€15.00</span>
                                    <p>Raw hazelnuts, Egg whites, Crème fraiche, Granulated sugar</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/dessert-4.jpg" alt="Hazelnut and Crème Fraîche Meringues">
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items" data-aos="fade-up" data-aos-delay="450">
                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/dessert-5.jpg" alt="Fresh Raspberry Tart">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Fresh raspberry tart</h3>
                                    <span class="menu-item-price">€13.00</span>
                                    <p>Fresh raspberries, Raspberry jam, Fresh lemon juice, Vanilla ice cream</p>
                                </div>
                            </div>

                            <div class="menu-item">
                                <img class="menu-item-image" src="../uploads/dessert-6.jpg" alt="Raspberry Macarons">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Raspberry macarons</h3>
                                    <span class="menu-item-price">€12.00</span>
                                    <p>Raspberry jam, Almond flour, Confectioners' sugar, Egg whites</p>
                                </div>
                            </div>
                        </div>
                        <!-- Menu items end -->

                        <!-- Menu items -->
                        <div class="menu-items reverse" data-aos="fade-up" data-aos-delay="600">
                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Cream puffs with chocolate sauce</h3>
                                    <span class="menu-item-price">€15.00</span>
                                    <p>Bittersweet chocolate, Flour, Heavy cream, Vanilla extract</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/dessert-7.jpg" alt="Cream Puffs with Chocolate Sauce">
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <h3 class="menu-item-title">Crème caramel</h3>
                                    <span class="menu-item-price">€12.00</span>
                                    <p>Heavy cream, Yolks, Milk, Vanilla bean</p>
                                </div>
                                <img class="menu-item-image" src="../uploads/dessert-8.jpg" alt="Crème Caramel">
                            </div>
                        </div>
                        <!-- Menu items end -->
                    </div>
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