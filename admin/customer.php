<?php

require_once('settings.php');

// Check if user is not identified, redirect to login page
if (!isset($_SESSION['IDENTIFY']) || !$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include the head section
    displayHeadSection('Products management');
    displayJSSection();
    ?>
</head>

<body>

    <!-----------------------------------------------------------------
							   Header
	------------------------------------------------------------------>
    <header class="manager-header">
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
    <div class="manager-container">
        <?php echo '<div class="welcome"><div class="welcome-text"> Welcome <span>' . $_SESSION['user_email'] . '</span></div></div>'; ?>
        <div class="manager-content container">
            <h1 class="title">Manage your products</h1>
            <div class="category-container">
                <!-- Starters -->
                <div class="category-card">
                    <a class="btn-primary" href="./manager-starter.php">Manage starters</a>
                    <a class="btn-primary" href="./add-starter.php">Add a starter</a>
                </div>

                <!-- MAin courses -->
                <div class="category-card">
                    <a class="btn-primary" href="./manager-maincourse.php">Manage main courses</a>
                    <a class="btn-primary" href="./add-maincourse.php">Add a main course</a>
                </div>

                <!-- Desserts -->
                <div class="category-card"> 
                    <a class="btn-primary" href="./manager-dessert.php">Manage desserts</a>
                    <a class="btn-primary" href="./add-dessert.php">Add a dessert</a>
                </div>

                <!-- Vector -->
                <div class="background-vector">
                    <img src="../assets/images/background-vector.png" alt="background-vector">
                </div>
            </div>

        </div>
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
        // JavaScript functions for handling article actions
        function modifierArticle(articleId) {
            // Redirect to the edit page with the specified article ID
            window.location.href = 'edit.php?id=' + articleId;
        }

        function afficherArticle(articleId) {
            // Redirect to the article page with the specified article ID
            window.location.href = 'article.php?id=' + articleId;
        }

        function supprimerArticle(articleId) {
            // Confirm article deletion and redirect to manager.php with the article ID
            if (confirm('Êtes-vous certain de vouloir supprimer l\'article ci-dessous ?')) {
                window.location.href = 'manager.php?id=' + articleId;
            }
        }
    </script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Include functions.js -->
    <script src="../js/functions.js"></script>
</body>

</html>