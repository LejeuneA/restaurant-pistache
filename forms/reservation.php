<?php

require_once __DIR__ . '/../admin/conf/conf-db.php';

$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$book_date = isset($_POST['book_date']) ? $_POST['book_date'] : null;
$book_time = isset($_POST['book_time']) ? $_POST['book_time'] : null;
$person = isset($_POST['person']) ? $_POST['person'] : null;

// Check for missing required fields
if (!$name || !$email || !$book_date || !$book_time || !$person) {
    die('Please fill in all required fields.');
}

// Database connection
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli(SERVER_NAME, USER_NAME, USER_PWD, DB_NAME);
if ($conn->connect_error) {
    die('The reservation form is temporarily unavailable. Please try again later.');
} else {
    // Insert form data into the database
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, book_date, book_time, person) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $email, $phone, $book_date, $book_time, $person);
    $stmt->execute();

    // Close the statement and connection before redirecting
    $stmt->close();
    $conn->close();

    // Redirect back to the index page with a success message
    header('Location: ../public/reservation.php?success=1');
    exit();
}
