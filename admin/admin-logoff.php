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

// On vérifie l'objet de connexion $conn
if (!is_object($conn)) {
    $msg = getMessage($conn, 'error');
} else {

    // Vérifie si on reçoit le formulaire d'identification
    if (isset($_POST['form']) && $_POST['form'] == 'login') {

        // Vérifie si les champs sont vides
        if (empty($_POST['login']) || empty($_POST['pwd'])) {
            $msg = getMessage('Veuillez remplir tous les champs', 'error');
        } else {

            // On récupère les données du formulaire
            $datas = $_POST;

            // Appel de la fonction d'identification
            // Utiliser cette fonction si les mots de passe sont en clair dans la DB
            $user = userIdentificationDB($conn, $datas);

            // On vérifie si on a une adresse email dans le tableau $user, si c'est le cas on est connecté
            $connexionSuccessfull = !empty($user['email']);
        }
    }

    // Si on est connecté, on initialise les variables de session et on redirige vers la page appropriée
    if ($connexionSuccessfull === true) {
        $_SESSION['IDENTIFY'] = true;
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_permission'] = $user['permission'];

        if ($user['permission'] == 1) {
            header('Location: manager.php');
        } elseif ($user['permission'] == 2) {
            header('Location: customer.php');
        } else {
            $msg = getMessage('Permission inconnue', 'error');
        }
        exit();
    } elseif ($connexionSuccessfull === false) {
        $msg = getMessage('Votre email et/ou votre mot de passe sont erronés', 'error');
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
        <?php displayNavigationAdmin(); ?>
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
        <?php displayFooter(); ?>
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