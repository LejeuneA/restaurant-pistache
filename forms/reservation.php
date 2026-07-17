<?php

declare(strict_types=1);

require_once __DIR__ . '/../admin/settings.php';

function publicReservationRedirect(
    string $message,
    string $type = 'error',
    string $returnTo = 'reservation'
): void {
    $_SESSION['public_form_flash']['reservation'] = [
        'message' => $message,
        'type' => $type,
    ];
    $_SESSION['public_reservation_csrf'] = bin2hex(random_bytes(32));

    $location = $returnTo === 'home'
        ? appUrl('index.php') . '#reservation'
        : appUrl('public/reservation.php');

    header('Location: ' . $location, true, 303);
    exit();
}

function publicReservationTextLength(string $value): int
{
    return function_exists('mb_strlen')
        ? mb_strlen($value, 'UTF-8')
        : strlen($value);
}

$returnTo = (string) ($_POST['return_to'] ?? 'reservation');
if (!in_array($returnTo, ['home', 'reservation'], true)) {
    $returnTo = 'reservation';
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    publicReservationRedirect(
        'Please submit the reservation form.',
        'error',
        $returnTo
    );
}

$submittedToken = (string) ($_POST['csrf_token'] ?? '');
$sessionToken = (string) ($_SESSION['public_reservation_csrf'] ?? '');

if (
    $submittedToken === ''
    || $sessionToken === ''
    || !hash_equals($sessionToken, $submittedToken)
) {
    publicReservationRedirect(
        'Your session has expired. Please complete the form again.',
        'error',
        $returnTo
    );
}

$lastSubmission = (int) ($_SESSION['last_public_reservation_submission'] ?? 0);
if ($lastSubmission > 0 && (time() - $lastSubmission) < 10) {
    publicReservationRedirect(
        'Please wait a few seconds before sending another reservation.',
        'error',
        $returnTo
    );
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$bookDate = trim((string) ($_POST['book_date'] ?? ''));
$bookTime = trim((string) ($_POST['book_time'] ?? ''));
$person = filter_var(
    $_POST['person'] ?? null,
    FILTER_VALIDATE_INT,
    [
        'options' => [
            'min_range' => 1,
            'max_range' => 10,
        ],
    ]
);

if (
    publicReservationTextLength($name) < 2
    || publicReservationTextLength($name) > 255
) {
    publicReservationRedirect(
        'Please enter a valid name.',
        'error',
        $returnTo
    );
}

if (
    !filter_var($email, FILTER_VALIDATE_EMAIL)
    || publicReservationTextLength($email) > 255
) {
    publicReservationRedirect(
        'Please enter a valid email address.',
        'error',
        $returnTo
    );
}

if (
    publicReservationTextLength($phone) < 7
    || publicReservationTextLength($phone) > 20
    || !preg_match('/^[0-9+().\s-]+$/', $phone)
) {
    publicReservationRedirect(
        'Please enter a valid phone number.',
        'error',
        $returnTo
    );
}

$timezone = new DateTimeZone('Europe/Brussels');
$reservationDate = DateTimeImmutable::createFromFormat(
    '!Y-m-d',
    $bookDate,
    $timezone
);
$today = new DateTimeImmutable('today', $timezone);
$latestAllowedDate = $today->modify('+1 year');

if (
    !($reservationDate instanceof DateTimeImmutable)
    || $reservationDate->format('Y-m-d') !== $bookDate
    || $reservationDate < $today
    || $reservationDate > $latestAllowedDate
) {
    publicReservationRedirect(
        'Please choose a valid reservation date.',
        'error',
        $returnTo
    );
}

$allowedTimes = [
    '09:00', '10:00', '11:00', '12:00', '13:00',
    '14:00', '15:00', '16:00', '17:00', '18:00',
    '19:00', '20:00', '21:00',
];

if (!in_array($bookTime, $allowedTimes, true)) {
    publicReservationRedirect(
        'Please choose a valid reservation time.',
        'error',
        $returnTo
    );
}

if ($person === false) {
    publicReservationRedirect(
        'Please select a valid number of guests.',
        'error',
        $returnTo
    );
}

if (!($conn instanceof PDO)) {
    publicReservationRedirect(
        'The reservation form is temporarily unavailable. Please try again later.',
        'error',
        $returnTo
    );
}

try {
    $statement = $conn->prepare(
        'INSERT INTO reservations '
        . '(name, email, phone, book_date, book_time, person, active) '
        . 'VALUES (:name, :email, :phone, :book_date, :book_time, :person, 1)'
    );
    $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':book_date' => $bookDate,
        ':book_time' => $bookTime,
        ':person' => (int) $person,
    ]);

    $_SESSION['last_public_reservation_submission'] = time();
    publicReservationRedirect(
        'Your reservation has been made successfully.',
        'success',
        $returnTo
    );
} catch (Throwable $exception) {
    error_log('Public reservation form error: ' . $exception->getMessage());
    publicReservationRedirect(
        'The reservation form is temporarily unavailable. Please try again later.',
        'error',
        $returnTo
    );
}
