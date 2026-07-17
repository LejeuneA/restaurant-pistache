<?php

require_once __DIR__ . '/settings.php';

requireLogin();

$msg = null;
if (isset($_GET['readonly']) && isGuest()) {
    $msg = getMessage(
        'Demo account: you can explore every management screen, but adding, editing and deleting data is disabled.',
        'info'
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('Products management'); ?>
    <?php displayJSSection(); ?>
</head>
<body>
<header class="manager-header"><?php displayNavigationAdmin(); ?></header>
<main class="manager-container">
    <div class="welcome"><div class="welcome-text">Welcome <span><?= escapeHtml($_SESSION['user_email']) ?></span></div></div>
    <div class="manager-content container">
        <h1 class="title">Manage your products</h1>
        <?php if (isGuest()): ?>
            <div class="message"><?= getMessage('Demo account: the interface is fully visible, but all database changes are disabled.', 'info') ?></div>
        <?php endif; ?>
        <?php if ($msg !== null): ?><div class="message"><?= $msg ?></div><?php endif; ?>
        <div class="category-container">
            <div class="category-card-container">
                <img src="<?= escapeHtml(appUrl('assets/images/starter-vector.png')) ?>" alt="Starters">
                <div class="category-card">
                    <a class="btn-primary" href="<?= escapeHtml(appUrl('admin/manager-starter.php')) ?>">Manage starters</a>
                    <a class="btn-primary" href="<?= escapeHtml(appUrl('admin/add-starter.php')) ?>">Add a starter</a>
                </div>
            </div>
            <div class="category-card-container">
                <img src="<?= escapeHtml(appUrl('assets/images/maincourse-vector.png')) ?>" alt="Main courses">
                <div class="category-card">
                    <a class="btn-primary" href="<?= escapeHtml(appUrl('admin/manager-maincourse.php')) ?>">Manage main courses</a>
                    <a class="btn-primary" href="<?= escapeHtml(appUrl('admin/add-maincourse.php')) ?>">Add a main course</a>
                </div>
            </div>
            <div class="category-card-container">
                <img src="<?= escapeHtml(appUrl('assets/images/dessert-vector.png')) ?>" alt="Desserts">
                <div class="category-card">
                    <a class="btn-primary" href="<?= escapeHtml(appUrl('admin/manager-dessert.php')) ?>">Manage desserts</a>
                    <a class="btn-primary" href="<?= escapeHtml(appUrl('admin/add-dessert.php')) ?>">Add a dessert</a>
                </div>
            </div>
            <div class="background-vector"><img src="<?= escapeHtml(appUrl('assets/images/background-vector.png')) ?>" alt=""></div>
        </div>
    </div>
</main>
<footer><?php displayFooter(); ?></footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= escapeHtml(appUrl('js/main.js')) ?>"></script>
</body>
</html>
