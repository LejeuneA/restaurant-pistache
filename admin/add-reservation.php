<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

requireLogin();

$message = rpAdminPullFlash();

$formData = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'book_date' => '',
    'book_time' => '',
    'person' => '',
    'active' => 0,
];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['form'] ?? '') === 'add'
) {
    [$formData, $validationError] =
        rpAdminValidateReservationInput(
            $_POST,
            false
        );

    if (!rpAdminCsrfIsValid()) {
        $message = getMessage(
            'Your session has expired. Please try again.',
            'error'
        );
    } elseif (!isAdmin()) {
        $message = getMessage(
            'Demo account: adding reservations is disabled.',
            'error'
        );
    } elseif (!$conn instanceof PDO) {
        $message = getMessage(
            'The database connection is unavailable.',
            'error'
        );
    } elseif ($validationError !== null) {
        $message = getMessage(
            $validationError,
            'error'
        );
    } elseif (
        rpAdminInsertReservation(
            $conn,
            $formData
        )
    ) {
        rpAdminSetFlash(
            'Reservation successfully added.',
            'success'
        );

        $_SESSION['csrf_token'] =
            bin2hex(random_bytes(32));

        header(
            'Location: '
            . appUrl(
                'admin/add-reservation.php'
            )
        );
        exit();
    } else {
        $message = getMessage(
            'The reservation could not be added.',
            'error'
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    displayHeadSection('Add a reservation');
    ?>
</head>

<body>

    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <main class="edit-content">

        <div class="edit-title">
            <h1>Add a reservation</h1>

            <?php if (isGuest()): ?>
                <div class="message">
                    <?= getMessage(
                        'Demo account: you can fill in this form, but the reservation will not be added.',
                        'info'
                    ) ?>
                </div>
            <?php endif; ?>

            <div class="message">
                <?= $message ?? '' ?>
            </div>
        </div>

        <div class="edit-form container">

            <form
                class="edit-reservation"
                id="add-reservation-form"
                action="<?= escapeHtml(
                    appUrl(
                        'admin/add-reservation.php'
                    )
                ) ?>"
                method="post"
            >
                <input
                    type="hidden"
                    name="form"
                    value="add"
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

                        <div class="checkbox-ctrl checkbox-wrapper-22 add-checkbox">
                            <label for="active">
                                Reservation Status
                            </label>

                            <label
                                class="switch"
                                for="active"
                            >
                                <input
                                    type="checkbox"
                                    id="active"
                                    name="active"
                                    value="1"
                                    <?= (
                                        (int) $formData[
                                            'active'
                                        ] === 1
                                    )
                                        ? 'checked'
                                        : '' ?>
                                >
                                <span class="slider round"></span>
                            </label>
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
                                Book Date
                            </label>

                            <input
                                type="date"
                                class="form-ctrl"
                                id="book_date"
                                name="book_date"
                                value="<?= escapeHtml(
                                    $formData['book_date']
                                ) ?>"
                                min="<?= date('Y-m-d') ?>"
                                required
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="book_time"
                                class="form-ctrl"
                            >
                                Book Time
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

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    <i class="fa-solid fa-square-plus"></i>
                    Add
                </button>

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
