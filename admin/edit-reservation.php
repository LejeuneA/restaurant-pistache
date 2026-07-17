<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

requireLogin();

if (isGuest()) {
    rpAdminSetFlash(
        'Demo account: reservation details are hidden to protect customer privacy.',
        'info'
    );

    header(
        'Location: '
        . appUrl(
            'admin/manager-reservation.php'
        )
    );
    exit();
}

$message = rpAdminPullFlash();

$reservationId = filter_input(
    INPUT_GET,
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

    header(
        'Location: '
        . appUrl(
            'admin/manager-reservation.php'
        )
    );
    exit();
}

if (!$conn instanceof PDO) {
    rpAdminSetFlash(
        'The database connection is unavailable.',
        'error'
    );

    header(
        'Location: '
        . appUrl(
            'admin/manager-reservation.php'
        )
    );
    exit();
}

$reservation = rpAdminFetchReservation(
    $conn,
    (int) $reservationId
);

if ($reservation === null) {
    rpAdminSetFlash(
        'The requested reservation was not found.',
        'error'
    );

    header(
        'Location: '
        . appUrl(
            'admin/manager-reservation.php'
        )
    );
    exit();
}

$formData = [
    'name' => rpAdminDecodeText(
        $reservation['name'] ?? ''
    ),
    'email' => (string) (
        $reservation['email'] ?? ''
    ),
    'phone' => (string) (
        $reservation['phone'] ?? ''
    ),
    'book_date' => (string) (
        $reservation['book_date'] ?? ''
    ),
    'book_time' => (string) (
        $reservation['book_time'] ?? ''
    ),
    'person' => (int) (
        $reservation['person'] ?? 1
    ),
    'active' => (int) (
        $reservation['active'] ?? 0
    ),
    'created_at' => (string) (
        $reservation['created_at'] ?? ''
    ),
];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['update_form'] ?? '') === '1'
) {
    [$submittedData, $validationError] =
        rpAdminValidateReservationInput(
            $_POST,
            true
        );

    $formData = array_merge(
        $formData,
        $submittedData
    );

    if (!rpAdminCsrfIsValid()) {
        $message = getMessage(
            'Your session has expired. Please try again.',
            'error'
        );
    } elseif ($validationError !== null) {
        $message = getMessage(
            $validationError,
            'error'
        );
    } elseif (
        rpAdminUpdateReservation(
            $conn,
            (int) $reservationId,
            $formData
        )
    ) {
        rpAdminSetFlash(
            'The reservation has been updated.',
            'success'
        );

        $_SESSION['csrf_token'] =
            bin2hex(random_bytes(32));

        header(
            'Location: '
            . appUrl(
                'admin/edit-reservation.php'
            )
            . '?idReservation='
            . (int) $reservationId
        );
        exit();
    } else {
        $message = getMessage(
            'The reservation could not be updated.',
            'error'
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    displayHeadSection('Editing a reservation');
    ?>
</head>

<body>

    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <main class="edit-content">

        <div class="edit-title">
            <h1>Editing a reservation</h1>

            <div class="message">
                <?= $message ?? '' ?>
            </div>
        </div>

        <div class="edit-form container">

            <form
                class="edit-reservation"
                action="<?= escapeHtml(
                    appUrl(
                        'admin/edit-reservation.php'
                    )
                    . '?idReservation='
                    . (int) $reservationId
                ) ?>"
                method="post"
            >
                <input
                    type="hidden"
                    name="update_form"
                    value="1"
                >

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= escapeHtml(
                        $_SESSION['csrf_token']
                    ) ?>"
                >

                <div class="form-top">

                    <div class="form-left">

                        <div class="checkbox-ctrl">
                            <label
                                for="published_article"
                                class="published_article"
                            >
                                Reservation status
                            </label>

                            <?php
                            displayFormRadioBtnArticlePublished(
                                $formData['active'],
                                'EDIT'
                            );
                            ?>
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="created_at"
                                class="form-ctrl"
                            >
                                Created At
                            </label>

                            <input
                                type="text"
                                class="form-ctrl"
                                id="created_at"
                                value="<?= escapeHtml(
                                    $formData['created_at']
                                ) ?>"
                                readonly
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="name"
                                class="form-ctrl"
                            >
                                Name
                            </label>

                            <input
                                type="text"
                                class="form-ctrl"
                                id="name"
                                name="name"
                                value="<?= escapeHtml(
                                    $formData['name']
                                ) ?>"
                                maxlength="100"
                                required
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="email"
                                class="form-ctrl"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-ctrl"
                                id="email"
                                name="email"
                                value="<?= escapeHtml(
                                    $formData['email']
                                ) ?>"
                                maxlength="150"
                                required
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="phone"
                                class="form-ctrl"
                            >
                                Phone
                            </label>

                            <input
                                type="tel"
                                class="form-ctrl"
                                id="phone"
                                name="phone"
                                value="<?= escapeHtml(
                                    $formData['phone']
                                ) ?>"
                                maxlength="30"
                                required
                            >
                        </div>

                    </div>

                    <div class="form-right --reservation">

                        <div class="form-ctrl">
                            <label
                                for="book_date"
                                class="form-ctrl"
                            >
                                Booking Date
                            </label>

                            <input
                                type="date"
                                class="form-ctrl"
                                id="book_date"
                                name="book_date"
                                value="<?= escapeHtml(
                                    $formData['book_date']
                                ) ?>"
                                required
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="book_time"
                                class="form-ctrl"
                            >
                                Booking Time
                            </label>

                            <input
                                type="time"
                                class="form-ctrl"
                                id="book_time"
                                name="book_time"
                                value="<?= escapeHtml(
                                    substr(
                                        (string) $formData[
                                            'book_time'
                                        ],
                                        0,
                                        5
                                    )
                                ) ?>"
                                required
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="person"
                                class="form-ctrl"
                            >
                                Number of Persons
                            </label>

                            <input
                                type="number"
                                class="form-ctrl"
                                id="person"
                                name="person"
                                value="<?= escapeHtml(
                                    $formData['person']
                                ) ?>"
                                min="1"
                                max="20"
                                required
                            >
                        </div>

                        <button
                            type="submit"
                            class="btn-primary"
                        >
                            Save
                        </button>

                    </div>

                </div>

            </form>

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
