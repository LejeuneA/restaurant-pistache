<?php
require_once('settings.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        // Get the password for the provided email
        $password = getUserPasswordByEmail($conn, $email);

        if ($password) {
            // Display the password
            $message = "Your password is: " . htmlspecialchars($password);
        } else {
            // Email not found in the database
            $message = "Error: Email address not found.";
        }
    } else {
        // Invalid email format
        $message = "Error: Invalid email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    <form method="post" action="">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Submit</button>
    </form>
    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
</body>
</html>
