<?php

require_once('settings.php');

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

                    $msg = getMessage('Starter successfully deleted.', 'success');

                } else {
                    $msg = getMessage('Error when removing the starter. ' . $deleteResult, 'error');
                }
            } else {
                $msg = getMessage('You are not allowed to remove the starter.', 'error');
            }
        }
    } else {
        $msg = getMessage('There is currently no starter to display.', 'error');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    // Include the head section
    displayHeadSection('Starters management');
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
    </div><!-----------------------------------------------------------------
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
        function modifyStarter(starterId) {
            // Redirect to the edit page with the specified starter ID
            window.location.href = 'edit-starter.php?idStarter=' + starterId;
        }

        function displayStarter(starterId) {
            // Redirect to the starter page with the specified starter ID
            window.location.href = 'article-starter.php?idStarter=' + starterId;
        }

        function deleteStarter(starterId) {
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