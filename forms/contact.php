<?php

const DOMAIN = 'http://localhost/restaurant-pistache';

$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : null;
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$message = isset($_POST['message']) ? $_POST['message'] : null;

// Check for missing required fields
if (!$firstName || !$lastName || !$email || !$phone || !$message) {
    die('Please fill in all required fields.');
}

// Database connection
$conn = new mysqli('localhost', 'root', '@NtLYa130580', 'restaurant-pistache');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Insert form data into the database
    $stmt = $conn->prepare("INSERT INTO contact (firstName, lastName, email, phone, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $message);
    $stmt->execute();

    // Send email notification
    // $to = "acelyalejeune@gmail.com"; 
    // $subject = "New Form Submission";
    // $body = "You have received a new form submission:\n\n";
    // $body .= "Name: $firstName $lastName\n";
    // $body .= "Email: $email\n";
    // $body .= "Phone: $phone\n";
    // $body .= "Message: $message\n";

    // // Send email using mail() function
    // mail($to, $subject, $body);

    echo "Message sent...";

    // Redirect back to index.html after 1 second
    header("refresh:1;url=" . DOMAIN);

    $stmt->close();
    $conn->close();
}