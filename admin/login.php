<?php

require_once __DIR__ . '/settings.php';

if (isAuthenticated()) {
    header('Location: ' . rtrim(DOMAIN, '/') . '/admin/manager.php');
    exit();
}

$msg = null;
$emailValue = '';

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['login_locked_until'])) {
    $_SESSION['login_locked_until'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailValue = trim((string) ($_POST['login'] ?? ''));
    $password = (string) ($_POST['pwd'] ?? '');
    $submittedToken = (string) ($_POST['csrf_token'] ?? '');
    $sessionToken = (string) ($_SESSION['csrf_token'] ?? '');
    $lockedUntil = (int) $_SESSION['login_locked_until'];

    if ($lockedUntil > time()) {
        $msg = getMessage(
            'Too many login attempts. Please wait a few minutes and try again.',
            'error'
        );
    } elseif (
        $submittedToken === ''
        || $sessionToken === ''
        || !hash_equals($sessionToken, $submittedToken)
    ) {
        $msg = getMessage('Your session has expired. Please try again.', 'error');
    } elseif (!filter_var($emailValue, FILTER_VALIDATE_EMAIL)) {
        $msg = getMessage('Please enter a valid email address.', 'error');
    } elseif ($password === '' || strlen($password) > 255) {
        $msg = getMessage('Please enter your password.', 'error');
    } elseif (!$conn instanceof PDO) {
        $msg = getMessage('Database connection is unavailable.', 'error');
    } else {
        $user = userIdentificationDB(
            $conn,
            [
                'login' => $emailValue,
                'pwd' => $password,
            ]
        );

        if (is_array($user) && !empty($user['email'])) {
            $permission = (int) ($user['permission'] ?? 0);

            if (!in_array($permission, [1, 2], true)) {
                $msg = getMessage('This account does not have a valid permission.', 'error');
            } else {
                session_regenerate_id(true);
                $_SESSION['IDENTIFY'] = true;
                $_SESSION['user_email'] = (string) $user['email'];
                $_SESSION['user_permission'] = $permission;
                $_SESSION['login_attempts'] = 0;
                $_SESSION['login_locked_until'] = 0;
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

                header('Location: ' . rtrim(DOMAIN, '/') . '/admin/manager.php');
                exit();
            }
        } else {
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts'] >= 5) {
                $_SESSION['login_locked_until'] = time() + 300;
                $_SESSION['login_attempts'] = 0;
            }
            $msg = getMessage('Your email and/or password are incorrect.', 'error');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php displayHeadSection('Login'); ?></head>
<body>
<header><?php displayNavigationAdmin(); ?></header>
<main class="login-container">
    <div class="login-title">
        <h1>Login</h1>
        <p>Login and manage your page</p>
        <div class="message"><?= $msg ?? '' ?></div>
    </div>
    <div class="login-content container">
        <form class="login-form" action="<?= escapeHtml(appUrl('admin/login.php')) ?>" method="post">
            <div class="form-ctrl">
                <label for="login" class="form-ctrl">E-mail</label>
                <input type="email" class="form-ctrl" id="login" name="login" value="<?= escapeHtml($emailValue) ?>" maxlength="150" autocomplete="email" required>
            </div>
            <div class="form-ctrl">
                <label for="pwd" class="form-ctrl">Password</label>
                <input type="password" class="form-ctrl" id="pwd" name="pwd" maxlength="255" autocomplete="current-password" required>
            </div>
            <a href="<?= escapeHtml(appUrl('admin/forgot-pass.php')) ?>"><p>Forgot your password?</p></a>
            <input type="hidden" name="csrf_token" value="<?= escapeHtml($_SESSION['csrf_token']) ?>">
            <button type="submit" class="btn-primary">Login</button>
        </form>
        <div class="background-vector"><img src="<?= escapeHtml(appUrl('assets/images/background-vector.png')) ?>" alt=""></div>
    </div>
</main>
<footer><?php displayFooter(); ?></footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= escapeHtml(appUrl('js/main.js')) ?>"></script>
</body>
</html>
