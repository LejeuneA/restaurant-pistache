<?php

declare(strict_types=1);

require_once __DIR__ . '/../admin/settings.php';

function publicContactRedirect(string $message, string $type = 'error'): void
{
    $_SESSION['public_form_flash']['contact'] = [
        'message' => $message,
        'type' => $type,
    ];
    $_SESSION['public_contact_csrf'] = bin2hex(random_bytes(32));

    header(
        'Location: ' . appUrl('public/contact.php'),
        true,
        303
    );
    exit();
}

function publicContactTextLength(string $value): int
{
    return function_exists('mb_strlen')
        ? mb_strlen($value, 'UTF-8')
        : strlen($value);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    publicContactRedirect('Please submit the contact form.', 'error');
}

$submittedToken = (string) ($_POST['csrf_token'] ?? '');
$sessionToken = (string) ($_SESSION['public_contact_csrf'] ?? '');

if (
    $submittedToken === ''
    || $sessionToken === ''
    || !hash_equals($sessionToken, $submittedToken)
) {
    publicContactRedirect(
        'Your session has expired. Please complete the form again.',
        'error'
    );
}

if (trim((string) ($_POST['website'] ?? '')) !== '') {
    publicContactRedirect('Your message has been sent successfully.', 'success');
}

$lastSubmission = (int) ($_SESSION['last_public_contact_submission'] ?? 0);
if ($lastSubmission > 0 && (time() - $lastSubmission) < 10) {
    publicContactRedirect(
        'Please wait a few seconds before sending another message.',
        'error'
    );
}

$firstName = trim((string) ($_POST['firstName'] ?? ''));
$lastName = trim((string) ($_POST['lastName'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if (
    $firstName === ''
    || publicContactTextLength($firstName) > 45
) {
    publicContactRedirect('Please enter a valid first name.', 'error');
}

if (
    $lastName === ''
    || publicContactTextLength($lastName) > 45
) {
    publicContactRedirect('Please enter a valid surname.', 'error');
}

if (
    !filter_var($email, FILTER_VALIDATE_EMAIL)
    || publicContactTextLength($email) > 150
) {
    publicContactRedirect('Please enter a valid email address.', 'error');
}

if (
    publicContactTextLength($phone) < 7
    || publicContactTextLength($phone) > 30
    || !preg_match('/^[0-9+().\s-]+$/', $phone)
) {
    publicContactRedirect('Please enter a valid phone number.', 'error');
}

$messageLength = publicContactTextLength($message);
if ($messageLength < 10 || $messageLength > 500) {
    publicContactRedirect(
        'Your message must contain between 10 and 500 characters.',
        'error'
    );
}

if (!($conn instanceof PDO)) {
    publicContactRedirect(
        'The contact form is temporarily unavailable. Please try again later.',
        'error'
    );
}

try {
    $statement = $conn->prepare(
        'INSERT INTO contact '
        . '(firstname, lastname, email, phone, message) '
        . 'VALUES (:firstname, :lastname, :email, :phone, :message)'
    );
    $statement->execute([
        ':firstname' => $firstName,
        ':lastname' => $lastName,
        ':email' => $email,
        ':phone' => $phone,
        ':message' => $message,
    ]);

    $_SESSION['last_public_contact_submission'] = time();
    publicContactRedirect('Your message has been sent successfully.', 'success');
} catch (Throwable $exception) {
    error_log('Public contact form error: ' . $exception->getMessage());
    publicContactRedirect(
        'The contact form is temporarily unavailable. Please try again later.',
        'error'
    );
}
