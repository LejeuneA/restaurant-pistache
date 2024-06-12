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
    // Fetch all reservations from the database
    $result = getAllReservationsDB($conn);

    // Check if reservations exist
    if (is_array($result) && !empty($result)) {
        $execute = true;

        // Check if reservation ID is provided in the URL for deletion
        if (isset($_GET['idReservation']) && is_numeric($_GET['idReservation'])) {

            $reservationIdToDelete = $_GET['idReservation'];

            if ($_SESSION['user_permission'] == 1) {

                // Delete the reservation from the database
                $deleteResult = deleteReservationDB($conn, $reservationIdToDelete);

                // Check deletion result and display appropriate message
                if ($deleteResult === true) {
                    $_SESSION['message'] = getMessage('reservation successfully deleted.', 'success');

                    // Refresh the page to reflect the changes after deletion
                    header('Location: manager-reservation.php');
                    exit();
                } else {
                    $_SESSION['message'] = getMessage('Error when deleting reservation.' . $deleteResult, 'error');
                }
            } else {
                $_SESSION['message'] = getMessage('You are not allowed to delete the reservation.', 'error');
            }
        }
    } else {
        $_SESSION['message'] = getMessage('There is no reservation to display at the moment.', 'error');
    }
}

// Refresh the redirected page (manager-reservation.php), add this code to display the message
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']); 
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include the head section
    displayHeadSection('Managing reservations');
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
        <?php displayNavigationAdmin(); ?>
        <!-----------------------------------------------------------------
							Navigation end
	    ------------------------------------------------------------------>
    </header>
    <!-----------------------------------------------------------------
							   Header end
	------------------------------------------------------------------>
    <div class="table-reservations container">
        <h1 class="title">Managing reservations</h1>
        <div id="message">
            <?= isset($msg) ? $msg : ''; ?>
        </div>

        <div id="content" class="container">
            <?php
            // If reservations exist, display them in a table
            if ($execute) {
                displayReservationsAsTable($result);
            }
            ?>
        </div>
    </div>

    <!-----------------------------------------------------------------
                               Footer
    ------------------------------------------------------------------>
    <footer>
        <?php displayFooter(); ?>
    </footer>
    <!-----------------------------------------------------------------
                                   Footer end
    ------------------------------------------------------------------>

    <script>
        // JavaScript functions for handling reservation actions
        function modifyReservation(reservationId) {
            // Redirect to the edit page with the specified reservation ID
            window.location.href = 'edit-reservation.php?idReservation=' + reservationId;
        }

        function deleteReservation(reservationId) {
            // Confirm reservation deletion
            if (confirm('Are you sure you want to delete the reservation below?')) {
                // Redirect to manager-reservation.php with the reservation ID for deletion
                window.location.href = 'manager-reservation.php?idReservation=' + reservationId;
            }
        }
    </script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main Js -->
    <script src="../js/main.js"></script>
</body>

</html>