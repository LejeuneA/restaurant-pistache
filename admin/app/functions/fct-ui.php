<?php
/* ********************************************************************** */
/* *                          TOOLS FUNCTIONS                           * */
/* *                          ---------------                           * */
/* *                 USER INTERFACE DISPLAY FUNCTIONS                   * */
/* ********************************************************************** */


/**-----------------------------------------------------------------
    Returns the html code of the radio buttons indicating the 
                publication status of the article
*------------------------------------------------------------------**/
/**
 * Returns the html code of the radio buttons 
 * indicating the publication status of the article
 * 
 * @param boolean     $published
 * @param string      $typeForm  (ADD ou EDIT)
 * @return void
 */
function displayFormRadioBtnArticlePublished($published, $typeForm = 'ADD')
{
    $html = '';

    if ($typeForm == 'ADD') {
        $html .= '
        <div class="checkbox-wrapper-22">
            <label class="switch" for="checkbox">
            <input type="checkbox" id="checkbox" value="1" name="published_article" />
            <div class="slider round"></div>
            </label>
        </div>
        ';
    } elseif ($typeForm == 'EDIT') {
        if ($published) {
            $html .= '
                <div class="checkbox-wrapper-22">
                    <label class="switch" for="checkbox"> 
                    <input type="checkbox" id="checkbox" value="1" name="published_article" checked>    
                    <span class="slider round"></span> 
                    </label>
                </div>
            ';
        } else {
            $html .= '
                <div class="checkbox-wrapper-22">
                    <label class="switch" for="checkbox">
                    <input type="checkbox" id="checkbox" value="1" name="published_article">  
                    <span class="slider round"></span> 
                    </label>   
                </div>
            ';
        }
    }

    echo $html;
}


/**-----------------------------------------------------------------
                    Displaying the JS section
 *------------------------------------------------------------------**/
/**
 * Displaying the JS section
 * 
 * @param bool $tinyMCE 
 * @return void 
 */
function displayJSSection($tinyMCE = false)
{
    $js = '';

    // TinyMCE loaded if necessary (parameter $tinyMCE = true)
    $js .= ($tinyMCE) ? '
    <script src="vendors/tinymce/tinymce.min.js" referrerpolicy="origin"></script>  
    <script src="assets/js/conf-tinymce.js"> </script>
    ' : null;

    // Displaying the JS script chain
    echo $js;
}


/**-----------------------------------------------------------------
                Displaying the head section of a page
*------------------------------------------------------------------**/
/**
 * Displaying the head section of a page
 * 
 * @param string $title 
 * @return void 
 */
function displayHeadSection($title = APP_NAME)
{
    $head = '
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Restaurant Pistache - Liége">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="'.DOMAIN.'/css/styles.css">

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
        
    <title>' . $title . '</title>
    ';

    echo $head;
}


/**-----------------------------------------------------------------
                  Displaying the admin navigation
*------------------------------------------------------------------**/

/**
 * Displaying the admin navigation
 * 
 * @return void 
 */
function displayNavigationAdmin()
{

    $navigation = '';

    if ($_SESSION['IDENTIFY']) {
        $navigation .= '
        <nav class="navbar-admin">
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
                                <a class="nav-link" href="../index.php"><i class="fas fa-home"></i><span> Home</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager.php">Catégories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager-starter.php">Starters</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../admin/manager-maincourse.php">Main courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager-dessert.php">Desserts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager.php"><i class="fa-solid fa-square-plus"></i>
                                <span> Add</span></a>
                            </li>
                        </ul>

                        <!-- Login button -->
                        <a href="logoff.php" class="btn-primary">Log off</a>
                        <!-- Login button end -->
                    </div>
                    <!-- Navbar menu end -->
                </div>
                <!-- Right-side content end -->
            </div>
        </nav>


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

        
        <!------------------------------------------------------------- 
                            Offcanvas menu end
        --------------------------------------------------------------->


        ';
    } else {
        $navigation .= '
        <nav class="navbar-admin">
            <div class="navbar-container container">
                <!-- Logo -->
                <a class="navbar-brand" href="login.php">
                    Pistache
                </a>
                <!-- Logo end -->

                <!-- Right-side content -->
                <div class="navbar-right">
                    <!-- Navbar menu -->
                    <div class="navbar-menu">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fas fa-home"></i><span> Home</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager.php">Catégories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager-starter.php">Starters</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../admin/manager-maincourse.php">Main courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager-dessert.php">Desserts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager.php"><i class="fa-solid fa-square-plus"></i>
                            <span> Add</span></a>
                        </li>
                        </ul>

                        <!-- Login button -->
                        <a href="logoff.php" class="btn-primary">Log off</a>
                        <!-- Login button end -->
                    </div>
                    <!-- Navbar menu end -->
                </div>
                <!-- Right-side content end -->
            </div>
        </nav>
        ';
    }

    echo $navigation;
}

/**-----------------------------------------------------------------
                     Displaying the navigation
*------------------------------------------------------------------**/

/**
 * Displaying the navigation
 * 
 * @return void 
 */
function displayNavigation()
{

    $navigation = '';

    if ($_SESSION['IDENTIFY']) {
        $navigation .= '
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

        <!-- Navigation-->
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
            <a class="nav-link" href="../index.php">Home</a>
            <a class="nav-link" href="../index.php#about">About</a>
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

        ';
    } else {
        $navigation .= '

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

        <!-- Navigation-->
        <nav class="navbar">
            <div class="navbar-container container">
                <!-- Logo -->
                <a class="navbar-brand" href="login.php">
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
        ';
    }

    echo $navigation;
}


/**-----------------------------------------------------------------
                     Displaying the footer
*------------------------------------------------------------------**/
/**
 * Displaying the footer
 * 
 * @return void 
 */
function displayFooter()
{
    $footer = '';

    if ($_SESSION['IDENTIFY']) {
        $footer .= '
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
                        <h3>Instagram</h3>
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
        ';
    }

    echo $footer;
}



/**-----------------------------------------------------------------
                  Returning a message in HTML format
*------------------------------------------------------------------**/

/**
 * Returning a message in HTML format
 * 
 * @param string $message 
 * @param string $type 
 * @return string 
 */
function getMessage($message, $type = 'success')
{
    $html = '<div class="msg-' . $type . '">' . $message . '</div>';
    return $html;
}

/**-----------------------------------------------------------------
        Generate HTML markup for displaying starters information
*------------------------------------------------------------------**/
/**
 * Generate HTML markup for displaying starters information
 * 
 * @param array $starter 
 * @return string 
 */
function generateStarterHTML($starter)
{
    $html = ""; 

    $image_url = htmlspecialchars($starter['image_url'], ENT_QUOTES);
    $title = htmlspecialchars($starter['title'], ENT_QUOTES);
    $price = htmlspecialchars($starter['price'], ENT_QUOTES);
    $description = htmlspecialchars($starter['description'], ENT_QUOTES);

    // Construct the HTML markup
    $html .= "
        <div class=\"menu-items\" data-aos=\"fade-up\" data-aos-delay=\"150\">
            <div class=\"menu-item\">
                <img class=\"menu-item-image\" src=\"$image_url\" alt=\"$title\">
                <div class=\"menu-item-info\">
                    <h3 class=\"menu-item-title\">$title</h3>
                    <span class=\"menu-item-price\">€$price</span>
                    <p>$description</p>
                </div>
            </div>
        </div>
    ";

    return $html;
}

/**-----------------------------------------------------------------
    Generate HTML markup for displaying main courses information
*------------------------------------------------------------------**/
/**
 * Generate HTML markup for displaying main course information
 * 
 * @param array $mainCourse
 * @return string 
 */
function generateMainCourseHTML($mainCourse)
{
    $html = ""; 

    $image_url = htmlspecialchars($mainCourse['image_url'], ENT_QUOTES);
    $title = htmlspecialchars($mainCourse['title'], ENT_QUOTES);
    $price = htmlspecialchars($mainCourse['price'], ENT_QUOTES);
    $description = htmlspecialchars($mainCourse['description'], ENT_QUOTES);

    // Construct the HTML markup
    $html .= "
        <div class=\"menu-items\" data-aos=\"fade-up\" data-aos-delay=\"150\">
            <div class=\"menu-item\">
                <img class=\"menu-item-image\" src=\"$image_url\" alt=\"$title\">
                <div class=\"menu-item-info\">
                    <h3 class=\"menu-item-title\">$title</h3>
                    <span class=\"menu-item-price\">€$price</span>
                    <p>$description</p>
                </div>
            </div>
        </div>
    ";

    return $html;
}

/**-----------------------------------------------------------------
    Generate HTML markup for displaying desserts information
*------------------------------------------------------------------**/
/**
 * Generate HTML markup for displaying desserts information
 * 
 * @param array $dessert
 * @return string 
 */
function generateDessertHTML($dessert)
{
    $html = ""; 

    $image_url = htmlspecialchars($dessert['image_url'], ENT_QUOTES);
    $title = htmlspecialchars($dessert['title'], ENT_QUOTES);
    $price = htmlspecialchars($dessert['price'], ENT_QUOTES);
    $description = htmlspecialchars($dessert['description'], ENT_QUOTES);

    // Construct the HTML markup
    $html .= "
        <div class=\"menu-items\" data-aos=\"fade-up\" data-aos-delay=\"150\">
            <div class=\"menu-item\">
                <img class=\"menu-item-image\" src=\"$image_url\" alt=\"$title\">
                <div class=\"menu-item-info\">
                    <h3 class=\"menu-item-title\">$title</h3>
                    <span class=\"menu-item-price\">€$price</span>
                    <p>$description</p>
                </div>
            </div>
        </div>
    ";

    return $html;
}


/**-----------------------------------------------------------------
             Displays the starter received as a parameter
*------------------------------------------------------------------**/

/**
 * Displays the starter received as a parameter
 * 
 * @param mixed $starter
 * @return void 
 */
function displayStarterByID($starter)
{
    echo '<section class="product-container container">';
    echo '<div class="product-info-container">';
    echo '<div class="product-img">';
    echo '<img src="' . DOMAIN . '/admin/' . $starter['image_url'] . '" alt="' . $starter['title'] . '">';
    echo '</div>';
    echo '<div class="product-info">';
    echo '<div>';
    echo '<h2>' . $starter['title'] . '</h2>';
    echo '<p>' . $starter['description'] . '</p>';
    echo '</div>';
    echo '<div class="product-price">';
    echo '<p>' . $starter['price'] . ' €</p>';
    echo '</div>';
    echo '<div class="product-description">';
    echo '<h2>Description</h2>';
    echo '<p>' . htmlspecialchars_decode($starter['content']) . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</section>';

}

/**-----------------------------------------------------------------
           Displays the main course received as a parameter
*------------------------------------------------------------------**/

/**
 * Displays the stationery received as a parameter
 * 
 * @param mixed $mainCourse
 * @return void 
 */
function displayMainCourseByID($mainCourse)
{
    echo '<section class="product-container container">';
    echo '<div class="product-info-container">';
    echo '<div class="product-img">';
    echo '<img src="' . DOMAIN . '/admin/' . $mainCourse['image_url'] . '" alt="' . $mainCourse['title'] . '">';
    echo '</div>';
    echo '<div class="product-info">';
    echo '<div>';
    echo '<h2>' . $mainCourse['title'] . '</h2>';
    echo '<p>' . $mainCourse['description'] . '</p>';
    echo '</div>';
    echo '<div class="product-price">';
    echo '<p>' . $mainCourse['price'] . ' €</p>';
    echo '</div>';
    echo '<div class="product-description">';
    echo '<h2>Description</h2>';
    echo '<p>' . htmlspecialchars_decode($mainCourse['content']) . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
}


/**-----------------------------------------------------------------
           Displays the dessert received as a parameter
*------------------------------------------------------------------**/
/**
 * Displays the dessert received as a parameter
 * 
 * @param mixed $dessert
 * @return void 
 */
function displayDessertByID($dessert)
{
    echo '<section class="product-container container">';
    echo '<div class="product-info-container">';
    echo '<div class="product-img">';
    echo '<img src="' . DOMAIN . '/admin/' . $dessert['image_url'] . '" alt="' . $dessert['title'] . '">';
    echo '</div>';
    echo '<div class="product-info">';
    echo '<div>';
    echo '<h2>' . $dessert['title'] . '</h2>';
    echo '<p>' . $dessert['description'] . '</p>';
    echo '</div>';
    echo '<div class="product-price">';
    echo '<p>' . $dessert['price'] . ' €</p>';
    echo '</div>';
    echo '<div class="product-description">';
    echo '<h2>Description</h2>';
    echo '<p>' . htmlspecialchars_decode($dessert['content']) . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
}


/**-----------------------------------------------------------------
            Display starters for the manager page
*------------------------------------------------------------------**/
/**
 * Display starters for the manager page
 * 
 * @param array $starters
 * @return void
 */

function displayStartersWithButtons($starters)
{
    foreach ($starters as $starter) {
        // Display Article Content
        echo '<div class="article">';

        // Display circle based on article status
        $circleClass = ($starter['active']) ? 'circle-published' : 'circle-not-published';
        echo '<div class="circle ' . $circleClass . '"></div>';

        echo '<h3>' . htmlspecialchars_decode($starter['title']) . '</h3>';
        echo '</div>';

        // Display buttons
        echo '<div class="buttons">';
        echo '<button class="btn-primary" onclick="modifyStarter(' . $starter['idStarter'] . ')">Modify</button>';
        echo '<button class="btn-primary" onclick="displayStarter(' . $starter['idStarter'] . ')">Display</button>';
        echo '<button class="btn-secondary" onclick="deleteStarter(' . $starter['idStarter'] . ')">Delete</button>';
        echo '</div>';

        echo '<hr>';
    }
}

/**-----------------------------------------------------------------
                Display main courses for the manager page
*------------------------------------------------------------------**/

/**
 * Display main courses for the manager page
 * 
 * @param array $mainCourses
 * @return void
 */

function displayMainCoursesWithButtons($mainCourses)
{
    foreach ($mainCourses as $mainCourse) {
        // Display Article Content
        echo '<div class="article">';

        // Display circle based on article status
        $circleClass = ($mainCourse['active']) ? 'circle-published' : 'circle-not-published';
        echo '<div class="circle ' . $circleClass . '"></div>';

        echo '<h3>' . htmlspecialchars_decode($mainCourse['title']) . '</h3>';
        echo '</div>';

        // Display buttons
        echo '<div class="buttons">';
        echo '<button class="btn-primary" onclick="modifyMainCourse(' . $mainCourse['idMainCourse'] . ')">Modify</button>';
        echo '<button class="btn-primary" onclick="displayMainCourse(' . $mainCourse['idMainCourse'] . ')">Display</button>';
        echo '<button class="btn-secondary" onclick="deleteMainCourse(' . $mainCourse['idMainCourse'] . ')">Delete</button>';
        echo '</div>';

        echo '<hr>';
    }
}


/**-----------------------------------------------------------------
                Display desserts for the manager page
*------------------------------------------------------------------**/
/**
 * Display desserts for the manager page
 * 
 * @param array $desserts
 * @return void
 */

function displayDessertsWithButtons($desserts)
{
    foreach ($desserts as $dessert) {
        // Display Article Content
        echo '<div class="article">';

        // Display circle based on article status
        $circleClass = ($dessert['active']) ? 'circle-published' : 'circle-not-published';
        echo '<div class="circle ' . $circleClass . '"></div>';

        echo '<h3>' . htmlspecialchars_decode($dessert['title']) . '</h3>';
        echo '</div>';

        // Display buttons
        echo '<div class="buttons">';
        echo '<button class="btn-primary" onclick="modifyDessert(' . $dessert['isDessert'] . ')">Modify</button>';
        echo '<button class="btn-primary" onclick="displayDessert(' . $dessert['isDessert'] . ')">Display</button>';
        echo '<button class="btn-secondary" onclick="deleteDessert(' . $dessert['isDessert'] . ')">Delete</button>';
        echo '</div>';

        echo '<hr>';
    }
}

/**-----------------------------------------------------------------
    Displays the starters for the manager's page in table form
*------------------------------------------------------------------**/
/**
 * Displays the starters for the manager's page in table form
 * 
 * @param array $starters
 * @return void
 */
function displayStartersAsTable($starters)
{
    // Start the table
    echo '<table>';

    // Table headers
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Title</th>';
    echo '<th>Price</th>';
    echo '<th>Description</th>';
    echo '<th>Statut</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    // Table data
    foreach ($starters as $starter) {
        echo '<tr>';
        echo '<td data-cell="id">' . $starter['idStarter'] . '</td>';
        echo '<td data-cell="title">' . html_entity_decode($starter['title']) . '</td>';
        echo '<td data-cell="price">' . html_entity_decode($starter['price']) . '</td>';
        echo '<td data-cell="description">' . html_entity_decode($starter['description']) . '</td>';
        echo '<td data-cell="statut">' . ($starter['active'] ? 'Actif' : 'Inactif') . '</td>';
        echo '<td>';
        echo '<button class="btn-secondary" onclick="modifyStarter(' . $starter['idStarter'] . ')">Modify</button>';
        echo '<button class="btn-secondary" onclick="displayStarter(' . $starter['idStarter'] . ')">Display</button>';
        echo '<button class="btn-primary" onclick="deleteStarter(' . $starter['idStarter'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';
}


/**-----------------------------------------------------------------
    Displays the main courses for the manager's page in table form
*------------------------------------------------------------------**/

/**
 *  Displays the main courses for the manager's page in table form
 * 
 * @param array $mainCourses
 * @return void
 */
function displayMainCoursesAsTable($mainCourses)
{
    // Start the table
    echo '<table>';

    // Table headers
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Title</th>';
    echo '<th>Price</th>';
    echo '<th>Description</th>';
    echo '<th>Statut</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    // Table data
    foreach ($mainCourses as $mainCourse) {
        echo '<tr>';
        echo '<td data-cell="id">' . $mainCourse['idMainCourse'] . '</td>';
        echo '<td data-cell="title">' . html_entity_decode($mainCourse['title']) . '</td>';
        echo '<td data-cell="price">' . html_entity_decode($mainCourse['price']) . '</td>';
        echo '<td data-cell="description">' . html_entity_decode($mainCourse['description']) . '</td>';
        echo '<td data-cell="statut">' . ($mainCourse['active'] ? 'Actif' : 'Inactif') . '</td>';
        echo '<td>';
        echo '<button class="btn-secondary" onclick="modifyMainCourse(' . $mainCourse['idMainCourse'] . ')">Modify</button>';
        echo '<button class="btn-secondary" onclick="displayMainCourse(' . $mainCourse['idMainCourse'] . ')">Display</button>';
        echo '<button class="btn-primary" onclick="deleteMainCourse(' . $mainCourse['idMainCourse'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';
}


/**-----------------------------------------------------------------
     Displays the desserts for the manager's page in table form
*------------------------------------------------------------------**/

/**
 * Displays the desserts for the manager's page in table form
 * 
 * @param array $desserts
 * @return void
 */
function displayDessertsAsTable($desserts)
{
    // Start the table
    echo '<table>';

    // Table headers
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Title</th>';
    echo '<th>Price</th>';
    echo '<th>Description</th>';
    echo '<th>Statut</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    // Table data
    foreach ($desserts as $dessert) {
        echo '<tr>';
        echo '<td data-cell="id">' . $dessert['idDessert'] . '</td>';
        echo '<td data-cell="title">' . html_entity_decode($dessert['title']) . '</td>';
        echo '<td data-cell="price">' . html_entity_decode($dessert['price']) . '</td>';
        echo '<td data-cell="description">' . html_entity_decode($dessert['description']) . '</td>';
        echo '<td data-cell="statut">' . ($dessert['active'] ? 'Actif' : 'Inactif') . '</td>';
        echo '<td>';
        echo '<button class="btn-secondary" onclick="modifyDessert(' . $dessert['idDessert'] . ')">Modify</button>';
        echo '<button class="btn-secondary" onclick="displayDessert(' . $dessert['idDessert'] . ')">Display</button>';
        echo '<button class="btn-primary" onclick="deleteDessert(' . $dessert['idDessert'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';
}
