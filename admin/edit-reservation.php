<?php
require_once('settings.php');

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is authenticated
if (!isset($_SESSION['IDENTIFY']) || !$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit;
}

$msg = null;
$tinyMCE = true;
$reservation = null;

// Check the database connection
if (!is_object($conn)) {
    $_SESSION['message'] = getMessage($conn, 'error');
    header('Location: manager-reservation.php');
    exit;
}

// Check if reservation ID is provided in the URL
if (isset($_GET['idReservation'])) {
    $idReservation = $_GET['idReservation'];

    // Retrieve reservation details from the database
    $reservation = getReservationByIDDB($conn, $idReservation);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_form'])) {
        // Check if user has permission to edit
        if ($_SESSION['user_permission'] == 2) {
            $msg = getMessage('You are not allowed to modify a reservation.', 'error');
        } else {
            $updateData = [
                'idReservation' => $idReservation,
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'book_date' => $_POST['book_date'] ?? '',
                'book_time' => $_POST['book_time'] ?? '',
                'person' => $_POST['person'] ?? '',
                'active' => isset($_POST['active']) ? 1 : 0,
            ];

            // Perform the update operation
            $updateResult = updateReservationDB($conn, $updateData);

            // Check the result of the update operation
            if ($updateResult === true) {
                $_SESSION['message'] = getMessage('The changes have been saved on the page.', 'success');
            } else {
                $_SESSION['message'] = getMessage('Error modifying the product. Please try again.', 'error');
            }

            // Redirect to prevent form resubmission
            header('Location: edit-reservation.php?idReservation=' . $idReservation);
            exit();
        }
    }
} else {
    // If reservation ID is not provided, redirect to manager.php
    header('Location: manager.php');
    exit;
}

// Retrieve the message from the session
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('Editing a reservation'); ?>
</head>
<body>
    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <div class="edit-content">
        <div class="edit-title">
            <h1>Editing a reservation</h1>
            <div class="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
        </div>

        <div class="edit-form container">
            <form action="edit-reservation.php?idReservation=<?php echo $reservation['idReservation']; ?>" method="post">
                <input type="hidden" name="idReservation" value="<?php echo $reservation['idReservation']; ?>">
                <input type="hidden" name="update_form" value="1">

                <!-- Form top -->
                <div class="form-top">
                    <!-- Name -->
                    <div class="form-ctrl">
                        <label for="name" class="form-ctrl">Name</label>
                        <input type="text" class="form-ctrl" id="name" name="name" value="<?php echo isset($reservation['name']) ? $reservation['name'] : ''; ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="form-ctrl">
                        <label for="email" class="form-ctrl">Email</label>
                        <input type="email" class="form-ctrl" id="email" name="email" value="<?php echo isset($reservation['email']) ? $reservation['email'] : ''; ?>" required>
                    </div>

                    <!-- Phone -->
                    <div class="form-ctrl">
                        <label for="phone" class="form-ctrl">Phone</label>
                        <input type="tel" class="form-ctrl" id="phone" name="phone" value="<?php echo isset($reservation['phone']) ? $reservation['phone'] : ''; ?>" required>
                    </div>

                    <!-- Book Date -->
                    <div class="form-ctrl">
                        <label for="book_date" class="form-ctrl">Book Date</label>
                        <input type="date" class="form-ctrl" id="book_date" name="book_date" value="<?php echo isset($reservation['book_date']) ? $reservation['book_date'] : ''; ?>" required>
                    </div>

                    <!-- Book Time -->
                    <div class="form-ctrl">
                        <label for="book_time" class="form-ctrl">Book Time</label>
                        <input type="time" class="form-ctrl" id="book_time" name="book_time" value="<?php echo isset($reservation['book_time']) ? $reservation['book_time'] : ''; ?>" required>
                    </div>

                    <!-- Person -->
                    <div class="form-ctrl">
                        <label for="person" class="form-ctrl">Person</label>
                        <input type="number" class="form-ctrl" id="person" name="person" value="<?php echo isset($reservation['person']) ? $reservation['person'] : ''; ?>" required>
                    </div>

                    <!-- Active -->
                    <div class="checkbox-ctrl">
                        <label for="active" class="active">Active</label>
                        <input type="checkbox" id="active" name="active" value="1" <?php echo isset($reservation['active']) && $reservation['active'] ? 'checked' : ''; ?>>
                    </div>
                </div>

                <!-- Form bottom -->
                <div class="form-bottom">
                    <button type="submit" class="btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <?php displayJSSection($tinyMCE); ?>

    <footer>
        <?php displayFooter(); ?>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/main.js"></script>
</body>
</html>
