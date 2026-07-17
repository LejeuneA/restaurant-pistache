<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

requireLogin();

$message = rpAdminPullFlash();
$reservations = [];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['action'] ?? '') === 'delete-reservation'
) {
    if (!rpAdminCsrfIsValid()) {
        rpAdminSetFlash(
            'Your session has expired. Please try again.',
            'error'
        );
    } else {
        $reservationId = filter_input(
            INPUT_POST,
            'idReservation',
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'min_range' => 1,
                ],
            ]
        );

        if (
            $reservationId === false
            || $reservationId === null
        ) {
            rpAdminSetFlash(
                'The selected reservation is invalid.',
                'error'
            );
        } elseif (!isAdmin()) {
            rpAdminSetFlash(
                'Demo account: deleting reservations is disabled.',
                'error'
            );
        } elseif (!$conn instanceof PDO) {
            rpAdminSetFlash(
                'The database connection is unavailable.',
                'error'
            );
        } elseif (
            rpAdminDeleteReservation(
                $conn,
                (int) $reservationId
            )
        ) {
            rpAdminSetFlash(
                'Reservation successfully deleted.',
                'success'
            );
        } else {
            rpAdminSetFlash(
                'The reservation could not be deleted.',
                'error'
            );
        }
    }

    header(
        'Location: '
        . appUrl(
            'admin/manager-reservation.php'
        )
    );
    exit();
}

if (isGuest()) {
    if ($message === null) {
        $message = getMessage(
            'Demo account: reservation details are hidden to protect customer privacy.',
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
    $reservations =
        rpAdminFetchReservations($conn);

    if (
        empty($reservations)
        && $message === null
    ) {
        $message = getMessage(
            'There are no reservations to display at the moment.',
            'info'
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    displayHeadSection('Managing reservations');
    ?>
</head>

<body>

    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <main class="table-reservations container">

        <h1 class="title">Managing reservations</h1>

        <a
            class="btn-primary"
            href="<?= escapeHtml(
                appUrl(
                    'admin/add-reservation.php'
                )
            ) ?>"
        >
            <i class="fa-solid fa-square-plus"></i>
            Add Reservation
        </a>

        <div id="message">
            <?= $message ?? '' ?>
        </div>

        <div id="content" class="container">
            <?php if (!empty($reservations)): ?>
                <?php
                displayReservationsAsTable(
                    $reservations
                );
                ?>
            <?php endif; ?>
        </div>

        <form
            id="delete-reservation-form"
            action="<?= escapeHtml(
                appUrl(
                    'admin/manager-reservation.php'
                )
            ) ?>"
            method="post"
            hidden
        >
            <input
                type="hidden"
                name="action"
                value="delete-reservation"
            >

            <input
                type="hidden"
                name="idReservation"
                id="delete-reservation-id"
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
        function modifyReservation(reservationId) {
            window.location.href =
                'edit-reservation.php?idReservation='
                + encodeURIComponent(reservationId);
        }

        function deleteReservation(reservationId) {
            const confirmed = window.confirm(
                'Are you sure you want to delete this reservation?'
            );

            if (!confirmed) {
                return;
            }

            document.getElementById(
                'delete-reservation-id'
            ).value = reservationId;

            document.getElementById(
                'delete-reservation-form'
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
