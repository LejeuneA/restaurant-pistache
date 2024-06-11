<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email']; // Assuming 'email' corresponds to 'email' in your HTML form
$subject = $_POST['subject'];
$message = $_POST['message'];

// Database connection
$conn = new mysqli('mysql.acelyalejeune.be', 'acelyalejeune', '@NtLYa130580', 'portfolio_contact_form');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Insert form data into the database
    $stmt = $conn->prepare("INSERT INTO contact_info (firstName, lastName, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $subject, $message);
    $stmt->execute();

    // Send email notification
    $to = "acelyalejeune@gmail.com"; 
    $subject = "New Form Submission";
    $body = "You have received a new form submission:\n\n";
    $body .= "Name: $firstName $lastName\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n";
    $body .= "Message: $message\n";

    // Send email using mail() function
    mail($to, $subject, $body);

    echo "Message sent...";

    // Redirect back to index.html after 3 seconds
    header("refresh:1;url=https://acelyalejeune.be/");

    $stmt->close();
    $conn->close();
}
?>
