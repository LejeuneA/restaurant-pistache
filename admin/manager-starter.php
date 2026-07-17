<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

requireLogin();

$config = rpAdminDishConfig('starter');
$message = rpAdminPullFlash();
$dishes = [];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['action'] ?? '') === 'delete-dish'
) {
    if (!rpAdminCsrfIsValid()) {
        rpAdminSetFlash(
            'Your session has expired. Please try again.',
            'error'
        );
    } else {
        $dishId = filter_input(
            INPUT_POST,
            $config['id_key'],
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'min_range' => 1,
                ],
            ]
        );

        if ($dishId === false || $dishId === null) {
            rpAdminSetFlash(
                'The selected starter is invalid.',
                'error'
            );
        } elseif (!isAdmin()) {
            rpAdminSetFlash(
                'Demo account: deleting starters is disabled.',
                'error'
            );
        } elseif (!$conn instanceof PDO) {
            rpAdminSetFlash(
                'The database connection is unavailable.',
                'error'
            );
        } elseif (
            rpAdminDeleteDish(
                $conn,
                $config,
                (int) $dishId
            )
        ) {
            rpAdminSetFlash(
                'Starter successfully deleted.',
                'success'
            );
        } else {
            rpAdminSetFlash(
                'The starter could not be deleted.',
                'error'
            );
        }
    }

    header(
        'Location: '
        . appUrl('admin/' . $config['manager_page'])
    );
    exit();
}

if (!$conn instanceof PDO) {
    if ($message === null) {
        $message = getMessage(
            'The database connection is unavailable.',
            'error'
        );
    }
} else {
    $dishes = rpAdminFetchDishes($conn, $config);

    if (empty($dishes) && $message === null) {
        $message = getMessage(
            'There are no starters to display at the moment.',
            'info'
        );
    }
}

$tableFunction = (string) $config['display_table_function'];
$idKey = (string) $config['id_key'];
$jsName = (string) $config['js_name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    displayHeadSection('Managing starters');
    ?>
</head>

<body>

    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <main class="table-starters container">

        <h1 class="title">Managing starters</h1>

        <?php if (isGuest()): ?>
            <div class="message">
                <?= getMessage(
                    'Demo account: you can browse the full interface, but adding, editing and deleting are disabled.',
                    'info'
                ) ?>
            </div>
        <?php endif; ?>

        <div id="message">
            <?= $message ?? '' ?>
        </div>

        <div id="content" class="container">
            <?php if (!empty($dishes)): ?>
                <?php $tableFunction($dishes); ?>
            <?php endif; ?>
        </div>

        <form
            id="delete-dish-form"
            action="<?= escapeHtml(
                appUrl(
                    'admin/'
                    . $config['manager_page']
                )
            ) ?>"
            method="post"
            hidden
        >
            <input
                type="hidden"
                name="action"
                value="delete-dish"
            >

            <input
                type="hidden"
                name="<?= escapeHtml($idKey) ?>"
                id="delete-dish-id"
                value=""
            >

            <input
                type="hidden"
                name="csrf_token"
                value="<?= escapeHtml(
                    $_SESSION['csrf_token']
                ) ?>"
            >
        </form>

    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>

    <script>
        function modifyStarter(dishId) {
            window.location.href =
                '<?= escapeHtml($config['edit_page']) ?>?'
                + '<?= escapeHtml($idKey) ?>='
                + encodeURIComponent(dishId);
        }

        function displayStarter(dishId) {
            window.location.href =
                '<?= escapeHtml($config['single_page']) ?>?'
                + '<?= escapeHtml($idKey) ?>='
                + encodeURIComponent(dishId);
        }

        function deleteStarter(dishId) {
            const confirmed = window.confirm(
                'Are you sure you want to delete this starter?'
            );

            if (!confirmed) {
                return;
            }

            document.getElementById(
                'delete-dish-id'
            ).value = dishId;

            document.getElementById(
                'delete-dish-form'
            ).submit();
        }
    </script>

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
