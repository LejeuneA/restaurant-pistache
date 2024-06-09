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
    // Fetch all dessert from the database
    $result = getAllDessertsDB($conn);

    // Check if dessertx exist
    if (is_array($result) && !empty($result)) {
        $execute = true;

        // Check if dessert ID is provided in the URL for deletion
        if (isset($_GET['idDessert']) && is_numeric($_GET['idDessert'])) {

            $dessertIdToDelete = $_GET['idDessert'];

            if ($_SESSION['user_permission'] == 1) {

                // Delete the dessert from the database
                $deleteResult = deleteDessertDB($conn, $dessertIdToDelete);

                // Check deletion result and display appropriate message
                if ($deleteResult === true) {
                    $_SESSION['message'] = getMessage('Dessert successfully deleted', 'success');

                    // Refresh the page to reflect the changes after deletion
                    header('Location: manager-dessert.php');
                    exit();
                } else {
                    $_SESSION['message'] = getMessage('Error when deleting starter.' . $deleteResult, 'error');
                }
            } else {
                $_SESSION['message'] = getMessage('You are not allowed to delete the main course.', 'error');
            }
        }
    } else {
        $_SESSION['message'] = getMessage('There is no dessert to display at the moment.', 'error');
    }
}

// On the redirected page (manager-dessert.php), add this code to display the message
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
    displayHeadSection('Managing desserts');
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
    <div class="table-desserts container">
        <h1 class="title">Managing desserts</h2>
        <div id="message">
            <?= isset($msg) ? $msg : ''; ?>
        </div>

        <div id="content">
            <?php
            // If dessertx exist, display them in a table
            if ($execute) {
                displayDessertsasTable($result);
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
        // JavaScript functions for handling dessert actions
        function modifyDessert(dessertId) {
            // Redirect to the edit page with the specified dessert ID
            window.location.href = 'edit-dessert.php?idDessert=' + dessertId;
        }

        function displayDessert(dessertId) {
            // Redirect to the dessert page with the specified dessert ID
            window.location.href = 'article-dessert.php?idDessert=' + dessertId;
        }

        function deleteDessert(dessertId) {
            // Confirm dessert deletion
            if (confirm('Are you sure you want to delete the dessert below?')) {
                // Redirect to manager-dessert.php with the dessert ID for deletion
                window.location.href = 'manager-dessert.php?idDessert=' + dessertId;
            }
        }
    </script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Main Js -->
   <script src="../js/main.js"></script>
   
</body>

</html>
