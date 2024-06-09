<?php
require_once('settings.php');

$msg = null;
$result = null;
$execute = false;

// Check if the ID of the dessert is passed in the URL
if (isset($_GET['idDessert']) && !empty($_GET['idDessert'])) {
    $idDessert = $_GET['idDessert'];
    // Ensure that the database connection object is valid
    if (!is_object($conn)) {
        $msg = getMessage($conn, 'error');
    } else {
        // Fetch the dessert from the database based on the ID
        $result = getDessertByIDDB($conn, $idDessert);
        // Check if the result is a valid array and not empty
        if (isset($result) && is_array($result) && !empty($result)) {
            $execute = true;
        } else {
            $msg = getMessage('There is no product to display.', 'error');
        }
    }
} else {
    $msg = getMessage('There is no product to display.', 'error');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php displayHeadSection('Desserts'); ?>
</head>

<body>
    <!-----------------------------------------------------------------
                                Header
    ------------------------------------------------------------------>
    <header class="header-article">

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
                                <a class="nav-link" href="../public/menu.php">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../public/contact.php">Contact</a>
                            </li>
                        </ul>

                        <!-- Login button -->
                        <a href="../public/reservation.php" class="btn-primary">Book a table</a>
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
            <a class="nav-link" href="../public/menu.php">Menu</a>
            <a class="nav-link" href="../public/contact.php">Contact</a>
            <!-- Menu end -->

            <!-- Login button -->
            <a href="../public/reservation.php" class="btn-primary">Book a table</a>
            <!-- Login button end -->
        </div>

        <!-- Hamburger icon for smaller screens -->
        <div class="navbar-hamburger">
            <div id="hamburger" onclick="openNav()"><i class="fas fa-bars"></i></div>
        </div>
        <!-- Offcanvas menu end -->
        <!-- Navigation end-->
    </header>
    <!-----------------------------------------------------------------
                            Header end
    ------------------------------------------------------------------>
    <!-- Main -->
    <main>
        <div class="container">
            <div id="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
            <div id="content">
                <?php
                // Peut-on exécuter l'affichage de l'article
                if ($execute) {
                    displayDessertByID($result);
                }
                ?>
            </div>
        </div>
    </main>
    
    
    <!-----------------------------------------------------------------
                               Footer
    ------------------------------------------------------------------>
    <footer>
        <?php displayFooter(); ?>
    </footer>
    <!-----------------------------------------------------------------
                            Footer end
    ------------------------------------------------------------------>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Main JS -->
    <script src="../js/main.js"></script>
    
</body>

</html>