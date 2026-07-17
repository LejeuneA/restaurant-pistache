<?php

require_once __DIR__ . '/settings.php';

$msg = null;
$emailValue = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailValue = trim((string) ($_POST['email'] ?? ''));
    $submittedToken = (string) ($_POST['csrf_token'] ?? '');
    $sessionToken = (string) ($_SESSION['csrf_token'] ?? '');

    if (
        $submittedToken === ''
        || $sessionToken === ''
        || !hash_equals($sessionToken, $submittedToken)
    ) {
        $msg = getMessage('Your session has expired. Please try again.', 'error');
    } elseif (!filter_var($emailValue, FILTER_VALIDATE_EMAIL)) {
        $msg = getMessage('Please enter a valid email address.', 'error');
    } else {
        $msg = getMessage(
            'Automatic password recovery is disabled in this portfolio demo. Please use the supplied demo credentials or contact the site administrator.',
            'success'
        );
        $emailValue = '';
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php displayHeadSection('Forgot Password'); ?></head>
<body>
<header><?php displayNavigationAdmin(); ?></header>
<main class="login-container">
    <div class="login-title"><h1>Forgot Password</h1><div class="message"><?= $msg ?? '' ?></div></div>
    <div class="login-content container">
        <form class="login-form" method="post" action="<?= escapeHtml(appUrl('admin/forgot-pass.php')) ?>">
            <label for="email" class="form-ctrl">Enter your email address</label>
            <input type="email" class="form-ctrl" name="email" id="email" value="<?= escapeHtml($emailValue) ?>" maxlength="150" autocomplete="email" required>
            <input type="hidden" name="csrf_token" value="<?= escapeHtml($_SESSION['csrf_token']) ?>">
            <button type="submit" class="btn-primary">Submit</button>
            <a href="<?= escapeHtml(appUrl('admin/login.php')) ?>">Back to login</a>
        </form>
        <div class="background-vector"><img src="<?= escapeHtml(appUrl('assets/images/background-vector.png')) ?>" alt=""></div>
    </div>
</main>
<footer><?php displayFooter(); ?></footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= escapeHtml(appUrl('js/main.js')) ?>"></script>
</body>
</html>
