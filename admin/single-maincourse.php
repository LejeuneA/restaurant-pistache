<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

$config = rpAdminDishConfig('maincourse');
$message = null;
$dish = null;
$pageTitle = 'Main course';

$dishId = filter_input(
    INPUT_GET,
    $config['id_key'],
    FILTER_VALIDATE_INT,
    [
        'options' => [
            'min_range' => 1,
        ],
    ]
);

if ($dishId === false || $dishId === null) {
    http_response_code(404);

    $message = getMessage(
        'The requested main course was not found.',
        'error'
    );
} elseif (!$conn instanceof PDO) {
    http_response_code(500);

    $message = getMessage(
        'The database connection is unavailable.',
        'error'
    );
} else {
    $dish = rpAdminFetchDish(
        $conn,
        $config,
        (int) $dishId,
        !isAuthenticated()
    );

    if ($dish === null) {
        http_response_code(404);

        $message = getMessage(
            'The requested main course was not found.',
            'error'
        );
    } else {
        $storedTitle = trim(
            rpAdminDecodeText(
                $dish['title'] ?? ''
            )
        );

        if ($storedTitle !== '') {
            $pageTitle = mb_substr(
                strip_tags($storedTitle),
                0,
                120
            );
        }
    }
}

$displayFunction =
    (string) $config['display_single_function'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php displayHeadSection($pageTitle); ?>
</head>

<body>

    <header class="header-article">
        <?php displayNavigationArticle(); ?>
    </header>

    <main>
        <div class="container">

            <div id="message">
                <?= $message ?? '' ?>
            </div>

            <div id="content">
                <?php if ($dish !== null): ?>
                    <?php $displayFunction($dish); ?>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>

    <script src="<?= escapeHtml(
        appUrl('js/main.js')
    ) ?>"></script>

</body>

</html>
