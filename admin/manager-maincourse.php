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
    // Fetch all main courses from the database
    $result = getAllMainCoursesDB($conn);

    // Check if main courses exist
    if (is_array($result) && !empty($result)) {
        $execute = true;

        // Check if main course ID is provided in the URL for deletion
        if (isset($_GET['idMainCourse']) && is_numeric($_GET['idMainCourse'])) {

            $mainCourseIdToDelete = $_GET['idMainCourse'];

            if ($_SESSION['user_permission'] == 1) {

                // Delete the main course from the database
                $deleteResult = deleteMainCourseDB($conn, $mainCourseIdToDelete);

                // Check deletion result and display appropriate message
                if ($deleteResult === true) {
                    $_SESSION['message'] = getMessage('Main course successfully deleted.', 'success');

                    // Refresh the page to reflect the changes after deletion
                    header('Location: manager-maincourse.php');
                    exit();
                } else {
                    $_SESSION['message'] = getMessage('Error when deleting starter.' . $deleteResult, 'error');
                }
            } else {
                $_SESSION['message'] = getMessage('You are not allowed to delete the main course.', 'error');
            }
        }
    } else {
        $_SESSION['message'] = getMessage('There is no main course to display at the moment.', 'error');
    }
}

// Refresh the redirected page (manager-maincourse.php), add this code to display the message
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
    displayHeadSection('Managing main courses');
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
    <div class="table-mainCourses container">
        <h1 class="title">Managing main courses</h1>
        <div id="message">
            <?= isset($msg) ? $msg : ''; ?>
        </div>

        <div id="content">
            <?php
            // If mainCourses exist, display them in a table
            if ($execute) {
                displayMainCoursesAsTable($result);
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
        // JavaScript functions for handling mainCourse actions
        function modifyMainCourse(mainCourseId) {
            // Redirect to the edit page with the specified mainCourse ID
            window.location.href = 'edit-mainCourse.php?idMainCourse=' + mainCourseId;
        }

        function displayMainCourse(mainCourseId) {
            // Redirect to the mainCourse page with the specified mainCourse ID
            window.location.href = 'article-mainCourse.php?idMainCourse=' + mainCourseId;
        }

        function deleteMainCourse(mainCourseId) {
            // Confirm mainCourse deletion
            if (confirm('Are you sure you want to delete the main course below?')) {
                // Redirect to manager-mainCourse.php with the mainCourse ID for deletion
                window.location.href = 'manager-mainCourse.php?idMainCourse=' + mainCourseId;
            }
        }
    </script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Main Js -->
   <script src="../js/main.js"></script>
   
</body>

</html>
