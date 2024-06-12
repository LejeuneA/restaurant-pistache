<?php

const DOMAIN = 'http://localhost/restaurant-pistache';

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
$conn = new mysqli('localhost', 'root', '@NtLYa130580', 'restaurant-pistache');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Insert form data into the database
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, book_date, book_time, person) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $email, $phone, $book_date, $book_time, $person);
    $stmt->execute();

    // Send email notification
    // $to = "acelyalejeune@gmail.com"; 
    // $subject = "New Reservation";
    // $body = "You have received a new reservation:\n\n";
    // $body .= "Name: $name\n";
    // $body .= "Email: $email\n";
    // $body .= "Phone: $phone\n";
    // $body .= "Date: $book_date\n";
    // $body .= "Time: $book_time\n";
    // $body .= "Number of People: $person\n";

    // // Send email using mail() function
    // mail($to, $subject, $body);

    echo "Reservation made successfully...";

    // Redirect back to index.html after 1 second
    header("refresh:2;url=" . DOMAIN);

    $stmt->close();
    $conn->close();
}

