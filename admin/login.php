<?php
require_once('settings.php');

// Redirection vers la page de gestion si l'utilisateur est connecté
if (isset($_SESSION['IDENTIFY']) && $_SESSION['IDENTIFY']) {
    header('Location: manager.php');
    exit();
}

$user = null;
$connexionSuccessfull = null;
$msg = null;

// Check the $conn connection object
if (!is_object($conn)) {
    $msg = getMessage($conn, 'error');
} else {

    // Checks if the identification form has been received
    if (isset($_POST['form']) && $_POST['form'] == 'login') {

        // Checks if fields are empty
        if (empty($_POST['login']) || empty($_POST['pwd'])) {
            $msg = getMessage('Please fill in all fields', 'error');
        } else {

            // Recover the form data
            $datas = $_POST;

            // Use this function if the passwords are in clear text in the DB
            $user = userIdentificationDB($conn, $datas);          

            // We check if we have an email address in the $user array, if so we're connected
            $connexionSuccessfull = !empty($user['email']);
        }
    }

    // If you are logged in, we initialize the session variables and redirect you to the appropriate page.
    if ($connexionSuccessfull === true) {
        $_SESSION['IDENTIFY'] = true;
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_permission'] = $user['permission'];

        if ($user['permission'] == 1) {
            header('Location: manager.php');
        } elseif ($user['permission'] == 2) {
            header('Location: customer.php');
        } else {
            $msg = getMessage('Unknown permission', 'error');
        }
        exit();
    } elseif ($connexionSuccessfull === false) {
        $msg = getMessage('Your email and/or password are incorrect', 'error');
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php displayHeadSection('S\'identifier'); ?>
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
    <div class="login-container">
        <div class="login-title">
            <h1>Login</h1>
            <p>Login and manage your page</p>
            <div class="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
        </div>
        <div class="login-content container">
            <form class="login-form" action="login.php" method="post">
                <div class="form-ctrl">
                    <label for="login" class="form-ctrl">E-mail</label>
                    <input type="email" class="form-ctrl" id="login" name="login" value="<?php echo (!empty($_POST['login'])) ? $_POST['login'] : null; ?>" required>
                </div>
                <div class="form-ctrl">
                    <label for="pwd" class="form-ctrl">Password</label>
                    <input type="password" class="form-ctrl" id="pwd" name="pwd" value="" required>
                </div>
                <p>Forgot your password?</p>
                <input type="hidden" id="form" name="form" value="login">
                <button type="submit" class="btn-primary">Login</button>
            </form>
            <div class="background-vector">
                <img src="../assets/images/background-vector.png" alt="background-vector">
            </div>
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

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Main Js -->
   <script src="../js/main.js"></script>
   
</body>

</html>
