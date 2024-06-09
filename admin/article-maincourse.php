<?php
require_once('settings.php');

$msg = null;
$result = null;
$execute = false;

// Check if the ID of the main course is passed in the URL
if (isset($_GET['idMainCourse']) && !empty($_GET['idMainCourse'])) {
    $idMainCourse = $_GET['idMainCourse'];
    // Ensure that the database connection object is valid
    if (!is_object($conn)) {
        $msg = getMessage($conn, 'error');
    } else {
        // Fetch the main course from the database based on the ID
        $result = getMainCourseByIDDB($conn, $idMainCourse);
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
    <?php displayHeadSection('Main Courses'); ?>
</head>

<body>
    <header>
        <?php displayNavigation(); ?>
    </header>
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
                    displayMainCourseByID($result);
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
    <!-- Include functions.js -->
    <script src="../js/functions.js"></script>
</body>

</html>