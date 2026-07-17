<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

requireLogin();

$message = rpAdminPullFlash();
$messages = [];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['action'] ?? '') === 'delete-message'
) {
    if (!rpAdminCsrfIsValid()) {
        rpAdminSetFlash(
            'Your session has expired. Please try again.',
            'error'
        );
    } else {
        $messageId = filter_input(
            INPUT_POST,
            'idContact',
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'min_range' => 1,
                ],
            ]
        );

        if (
            $messageId === false
            || $messageId === null
        ) {
            rpAdminSetFlash(
                'The selected message is invalid.',
                'error'
            );
        } elseif (!isAdmin()) {
            rpAdminSetFlash(
                'Demo account: deleting messages is disabled.',
                'error'
            );
        } elseif (!$conn instanceof PDO) {
            rpAdminSetFlash(
                'The database connection is unavailable.',
                'error'
            );
        } elseif (
            rpAdminDeleteMessage(
                $conn,
                (int) $messageId
            )
        ) {
            rpAdminSetFlash(
                'Message successfully deleted.',
                'success'
            );
        } else {
            rpAdminSetFlash(
                'The message could not be deleted.',
                'error'
            );
        }
    }

    header(
        'Location: '
        . appUrl(
            'admin/manager-messages.php'
        )
    );
    exit();
}

if (isGuest()) {
    if ($message === null) {
        $message = getMessage(
            'Demo account: visitor messages are hidden to protect personal data.',
            'info'
        );
    }
} elseif (!$conn instanceof PDO) {
    if ($message === null) {
        $message = getMessage(
            'The database connection is unavailable.',
            'error'
        );
    }
} else {
    $messages = rpAdminFetchMessages($conn);

    if (
        empty($messages)
        && $message === null
    ) {
        $message = getMessage(
            'There are no messages to display at the moment.',
            'info'
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php displayHeadSection('My messages'); ?>
</head>

<body>

    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <main class="table-messages container">

        <h1 class="title">My messages</h1>

        <div id="message">
            <?= $message ?? '' ?>
        </div>

        <div id="content" class="container">
            <?php if (!empty($messages)): ?>
                <?php
                displayMessagesAsTable($messages);
                ?>
            <?php endif; ?>
        </div>

        <form
            id="delete-message-form"
            action="<?= escapeHtml(
                appUrl(
                    'admin/manager-messages.php'
                )
            ) ?>"
            method="post"
            hidden
        >
            <input
                type="hidden"
                name="action"
                value="delete-message"
            >

            <input
                type="hidden"
                name="idContact"
                id="delete-message-id"
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
        function deleteMessage(messageId) {
            const confirmed = window.confirm(
                'Are you sure you want to delete this message?'
            );

            if (!confirmed) {
                return;
            }

            document.getElementById(
                'delete-message-id'
            ).value = messageId;

            document.getElementById(
                'delete-message-form'
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
