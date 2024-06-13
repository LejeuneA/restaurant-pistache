<?php

require_once('settings.php');

// Check if user is not identified, redirect to login page
if (!$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit();
}

$msg = null;
$execute = false;

// Check the database connection
if (!is_object($conn)) {
    $msg = getMessage($conn, 'error');
} else {
    // Check if the form is submitted and it's an add operation
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form']) && $_POST['form'] === 'add') {
        // Initialize empty array for storing form data
        $addData = [];

        // Gather data from the form
        $addData['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $addData['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $addData['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
        $addData['book_date'] = isset($_POST['book_date']) ? $_POST['book_date'] : '';
        $addData['book_time'] = isset($_POST['book_time']) ? $_POST['book_time'] : '';
        $addData['person'] = isset($_POST['person']) ? $_POST['person'] : '';
        $addData['active'] = isset($_POST['active']) ? 1 : 0;

        if ($_SESSION['user_permission'] == 1) {
            // Add the reservation to the database
            $addResult = addReservationDB($conn, $addData);

            // Check the result and display appropriate message
            if ($addResult === true) {
                $msg = getMessage('Reservation successfully added.', 'success');
                // Set session variable to indicate success
                $_SESSION['reservation_added'] = true;
                // Redirect to the same page to refresh and clear the form
                header('Location: add-reservation.php');
                exit();
            } else {
                $msg = getMessage('Error adding reservation. Please try again.', 'error');
            }
        } else {
            $msg = getMessage('You are not allowed to add a reservation.', 'error');
        }
    }
}

// At the beginning of the file, before any output
// Check if a reservation has been successfully added
if (isset($_SESSION['reservation_added']) && $_SESSION['reservation_added'] === true) {
    // Display success message
    $msg = getMessage('The reservation has been added successfully.', 'success');
    // Clear the session variable
    unset($_SESSION['reservation_added']);
}

// Initialize the $addData array with empty values
$addData = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'book_date' => '',
    'book_time' => '',
    'person' => '',
    'active' => 0
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include the head section
    displayHeadSection('Add a reservation');
    ?>
</head>

<body>
    <!-----------------------------------------------------------------
                               Header
    ------------------------------------------------------------------>
    <header>
        <!-----------------------------------------------------------------
                               Navigation
        ------------------------------------------------------------------>
        <?php displayNavigationAdmin(); ?>
        <!-----------------------------------------------------------------
                            Navigation end
        ------------------------------------------------------------------>
    </header>
    <!-----------------------------------------------------------------
                               Header end
    ------------------------------------------------------------------>
    <div class="edit-content">
        <div class="edit-title">
            <h1>Add a reservation</h1>
            <div class="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
        </div>

        <div class="edit-form container">
            <form class="edit-reservation" id="add-reservation-form" action="add-reservation.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="form" value="add">

                <!-- Form top -->
                <div class="form-top">
                    <!-- Form left -->
                    <div class="form-left">

                        <!-- Active -->
                        <div class="checkbox-ctrl">
                            <label for="active" class="active">Reservation Status</label>
                            <input type="checkbox" id="active" name="active" <?php echo (isset($addData['active']) && $addData['active'] == 1) ? 'checked' : ''; ?>>
                        </div>
                        
                        <!-- Name -->
                        <div class="form-ctrl">
                            <label for="name" class="form-ctrl">Name</label>
                            <input type="text" class="form-ctrl" id="name" name="name" value="<?php echo isset($addData['name']) ? $addData['name'] : ''; ?>" required>
                        </div>

                        <!-- Email -->
                        <div class="form-ctrl">
                            <label for="email" class="form-ctrl">Email</label>
                            <input type="email" class="form-ctrl" id="email" name="email" value="<?php echo isset($addData['email']) ? $addData['email'] : ''; ?>" required>
                        </div>

                        <!-- Phone -->
                        <div class="form-ctrl">
                            <label for="phone" class="form-ctrl">Phone</label>
                            <input type="text" class="form-ctrl" id="phone" name="phone" value="<?php echo isset($addData['phone']) ? $addData['phone'] : ''; ?>" required>
                        </div>
                    </div>
                    <!-- Form left end -->

                    <!-- Form right -->
                    <div class="form-right">

                        <!-- Book Date -->
                        <div class="form-ctrl">
                            <label for="book_date" class="form-ctrl">Book Date</label>
                            <input type="date" class="form-ctrl" id="book_date" name="book_date" value="<?php echo isset($addData['book_date']) ? $addData['book_date'] : ''; ?>" required>
                        </div>

                        <!-- Book Time -->
                        <div class="form-ctrl">
                            <label for="book_time" class="form-ctrl">Book Time</label>
                            <input type="time" class="form-ctrl" id="book_time" name="book_time" value="<?php echo isset($addData['book_time']) ? $addData['book_time'] : ''; ?>" required>
                        </div>

                        <!-- Person -->
                        <div class="form-ctrl">
                            <label for="person" class="form-ctrl">Number of Persons</label>
                            <input type="number" class="form-ctrl" id="person" name="person" value="<?php echo isset($addData['person']) ? $addData['person'] : ''; ?>" required>
                        </div>

                    </div>
                    <!-- Form right end -->
                </div>
                <!-- Form top end -->
                <button type="submit" class="btn-primary"><i class="fa-solid fa-square-plus"></i> Add</button>
            </form>
        </div>
    </div>

    <!-----------------------------------------------------------------
                               Footer
    ------------------------------------------------------------------>
    <footer>
        <?php displayFooter(); ?>
    </footer>
    <!-----------------------------------------------------------------
                            Footer end
    ------------------------------------------------------------------>

    <?php
    displayJSSection(false);
    ?>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main Js -->
    <script src="../js/main.js"></script>

</body>

</html>