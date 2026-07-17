<?php

require_once __DIR__ . '/../admin/settings.php';

$message = null;
$results = [];
$execute = false;

if (!($conn instanceof PDO)) {
    $message = getMessage(
        'The menu is temporarily unavailable. Please try again later.',
        'error'
    );
} else {
    $results = getAllMainCoursesDB($conn, null, '1');

    if (is_array($results) && !isset($results['error'])) {
        $execute = true;
    } else {
        $message = getMessage(
            'The menu is temporarily unavailable. Please try again later.',
            'error'
        );
        $results = [];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('Menu - Main Courses'); ?>
</head>
<body>
<header>
    <?php displayNavigation(); ?>
</header>
<main>
    <section class="hero-section hero-maincourse">
        <h2>Savor Our Signature Dishes</h2>
        <div class="hero-container container"></div>
    </section>

    <section class="menu-section">
        <div class="menu-container container">
            <div class="menu-navbar">
                <ul class="menu-navbar-items">
                    <li class="menu-navbar-item" id="menu-starter">
                        <a class="nav-link" href="<?= escapeHtml(appUrl('public/menu.php')) ?>">Starter</a>
                    </li>
                    <li class="menu-navbar-item" id="menu-main-course">
                        <a class="nav-link" href="<?= escapeHtml(appUrl('public/menu-maincourse.php')) ?>">Main Course</a>
                    </li>
                    <li class="menu-navbar-item" id="menu-dessert">
                        <a class="nav-link" href="<?= escapeHtml(appUrl('public/menu-dessert.php')) ?>">Dessert</a>
                    </li>
                </ul>
            </div>

            <?php if ($message !== null): ?>
                <div class="message"><?= $message ?></div>
            <?php endif; ?>

            <div class="menu-items">
                <div class="menu-content" id="main-course-content">
                    <?= displayMainCourses($execute, $results) ?>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <?php displayFooter(); ?>
</footer>

<a href="#" class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="<?= escapeHtml(appUrl('assets/vendor/aos/aos.js')) ?>"></script>
<script src="<?= escapeHtml(appUrl('js/main.js')) ?>"></script>
</body>
</html>
