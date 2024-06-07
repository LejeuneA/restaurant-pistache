<?php
require_once('settings.php');

// Start the session at the beginning of your script if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is not identified, redirect to login page
if (!isset($_SESSION['IDENTIFY']) || !$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit();
}

$msg = null;
$result = null;
$execute = false;

// Check the database connection
if (!is_object($conn)) {
    $msg = getMessage($conn, 'error');
} else {
    // Fetch all starters from the database
    $result = getAllStartersDB($conn);

    // Check if starters exist
    if (is_array($result) && !empty($result)) {
        $execute = true;

        // Check if starter ID is provided in the URL for deletion
        if (isset($_GET['idStarter']) && is_numeric($_GET['idStarter'])) {

            $starterIdToDelete = $_GET['idStarter'];

            if ($_SESSION['user_permission'] == 1) {

                // Delete the starter from the database
                $deleteResult = deleteStarterDB($conn, $starterIdToDelete);

                // Check deletion result and display appropriate message
                if ($deleteResult === true) {
                    $_SESSION['message'] = getMessage('starter supprimé avec succès.', 'success');

                    // Refresh the page to reflect the changes after deletion
                    header('Location: manager-starter.php');
                    exit();
                } else {
                    $_SESSION['message'] = getMessage('Erreur lors de la suppression du starter. ' . $deleteResult, 'error');
                }
            } else {
                $_SESSION['message'] = getMessage('Vous n\'avez pas le droit de supprimer le starter.', 'error');
            }
        }
    } else {
        $_SESSION['message'] = getMessage('Il n\'y a pas de starter à afficher actuellement', 'error');
    }
}

// On the redirected page (manager-starter.php), add this code to display the message
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']); // Clear the message after displaying it
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    // Include the head section
    displayHeadSection('Gestion des starters');
    displayJSSection();
    ?>
</head>

<body>

    <!-----------------------------------------------------------------
							   Header
	------------------------------------------------------------------>
    <header>
        <!-----------------------------------------------------------------
							   Navigation
	    ------------------------------------------------------------------>
        <?php displayNavigation(); ?>
        <!-----------------------------------------------------------------
							Navigation end
	    ------------------------------------------------------------------>
    </header>
    <!-----------------------------------------------------------------
							   Header end
	------------------------------------------------------------------>
    <div class="table-starters container">
        <h1 class="title">Managing starters</h1>
        <div id="message">
            <?= isset($msg) ? $msg : ''; ?>
        </div>

        <div id="content" class="container">
            <?php
            // If starters exist, display them in a table
            if ($execute) {
                displayStartersAsTable($result);
            }
            ?>
        </div>
    </div>
    <!-----------------------------------------------------------------
								Footer
	------------------------------------------------------------------>
    <footer>
        <div data-include="footer"></div>
    </footer>
    <!-----------------------------------------------------------------
							  Footer end
	------------------------------------------------------------------>

    <script>
        // JavaScript functions for handling starter actions
        function modifierstarter(starterId) {
            // Redirect to the edit page with the specified starter ID
            window.location.href = 'edit-starter.php?idStarter=' + starterId;
        }

        function afficherstarter(starterId) {
            // Redirect to the starter page with the specified starter ID
            window.location.href = 'article-starter.php?idStarter=' + starterId;
        }

        function supprimerstarter(starterId) {
            // Confirm starter deletion
            if (confirm('Êtes-vous certain de vouloir supprimer le starter ci-dessous ?')) {
                // Redirect to manager-starter.php with the starter ID for deletion
                window.location.href = 'manager-starter.php?idStarter=' + starterId;
            }
        }
    </script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Include functions.js -->
    <script src="../js/functions.js"></script>
</body>

</html>