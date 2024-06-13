<?php
require_once('settings.php');

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if user is not identified
if (!isset($_SESSION['IDENTIFY']) || !$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit;
}

$msg = null;
$tinyMCE = true;
$reservation = null;

// Check database connection
if (!is_object($conn)) {
    $_SESSION['message'] = getMessage($conn, 'error');
    header('Location: manager-reservation.php');
    exit;
} else {
    // Check if reservation ID is provided in the URL
    if (isset($_GET['idReservation'])) {
        $idReservation = $_GET['idReservation'];

        // Retrieve reservation details from the database
        $reservation = getReservationByIDDB($conn, $idReservation);


        // Check if form is submitted and handle update
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check user permission
            if ($_SESSION['user_permission'] == 2) {
                $msg = getMessage('You are not allowed to modify a reservation.', 'error');
            } else {
                // Validate and process form data
                if (isset($_POST['update_form'])) {
                    // Handle file upload if new image is uploaded
                    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === UPLOAD_ERR_OK) {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["image_upload"]["name"]);

                        if (!file_exists($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }

                        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
                            $_POST['image_url'] = $target_file;
                        } else {
                            $_SESSION['message'] = getMessage('Error uploading image. Please try again.', 'error');
                            header('Location: edit-reservation.php?idReservation=' . $idReservation);
                            exit();
                        }
                    }

                    // Prepare update data
                    $updateData = [
                        'idReservation' => $idReservation,
                        'name' => $_POST['name'] ?? '',
                        'email' => $_POST['email'] ?? '',
                        'phone' => $_POST['phone'] ?? '',
                        'book_date' => $_POST['book_date'],
                        'book_time' => $_POST['book_time'],
                        'person' => $_POST['person'],
                        'created_at' => $_POST['created_at'],
                        'active' => isset($_POST['published_article']) ? 1 : 0,
                    ];

                    // Perform database update
                    $updateResult = updatereservationDB($conn, $updateData);

                    if ($updateResult === true) {
                        $_SESSION['message'] = getMessage('Changes saved successfully.', 'success');
                    } else {
                        $_SESSION['message'] = getMessage('Error modifying reservation. Please try again.', 'error');
                    }

                    // Redirect to prevent form resubmission
                    header('Location: edit-reservation.php?idReservation=' . $idReservation);
                    exit();
                }
            }
        }
    } else {
        // Redirect if reservation ID is not provided
        header('Location: manager.php');
        exit;
    }
}

// Retrieve message from session and unset it
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    displayHeadSection('Editing a reservation');
    displayJSSection($tinyMCE);
    ?>
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
            <form class="edit-reservation" action="edit-reservation.php?idReservation=<?php echo $reservation['idReservation']; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idReservation" value="<?php echo $reservation['idReservation']; ?>">
                <input type="hidden" name="update_form" value="1">

                <!-- Form top -->
                <div class="form-top">
                    <!-- Form left -->
                    <div class="form-left">
                        <!-- Status of the article -->
                        <div class="checkbox-ctrl">
                            <label for="published_article" class="published_article">Reservation Status</label>
                            <input type="checkbox" id="published_article" name="published_article" value="1" <?php echo ($reservation['active'] == 1) ? 'checked' : ''; ?>>
                            <label for="published_article">Active</label>
                        </div>

                        <!-- Name -->
                        <div class="form-ctrl">
                            <label for="name" class="form-ctrl">Name</label>
                            <input type="text" class="form-ctrl" id="name" name="name" value="<?php echo $reservation['name']; ?>">
                        </div>

                        <!-- Email -->
                        <div class="form-ctrl">
                            <label for="email" class="form-ctrl">Email</label>
                            <input type="email" class="form-ctrl" id="email" name="email" value="<?php echo $reservation['email']; ?>">
                        </div>

                        <!-- Phone -->
                        <div class="form-ctrl">
                            <label for="phone" class="form-ctrl">Phone</label>
                            <input type="text" class="form-ctrl" id="phone" name="phone" value="<?php echo $reservation['phone']; ?>">
                        </div>

                    </div>
                    <!-- Form left end -->

                    <!-- Form right -->
                    <div class="form-right">
                        <!-- Book Date -->
                        <div class="form-ctrl">
                            <label for="book_date" class="form-ctrl">Booking Date</label>
                            <input type="date" class="form-ctrl" id="book_date" name="book_date" value="<?php echo $reservation['book_date']; ?>">
                        </div>

                        <!-- Book Time -->
                        <div class="form-ctrl">
                            <label for="book_time" class="form-ctrl">Booking Time</label>
                            <input type="time" class="form-ctrl" id="book_time" name="book_time" value="<?php echo $reservation['book_time']; ?>">
                        </div>

                        <!-- Number of Persons -->
                        <div class="form-ctrl">
                            <label for="person" class="form-ctrl">Number of Persons</label>
                            <input type="number" class="form-ctrl" id="person" name="person" value="<?php echo $reservation['person']; ?>">
                        </div>

                        <!-- Created At -->
                        <div class="form-ctrl">
                            <label for="created_at" class="form-ctrl">Created At</label>
                            <input type="text" class="form-ctrl" id="created_at" name="created_at" value="<?php echo $reservation['created_at']; ?>" readonly>
                        </div>
                    </div>
                    <!-- Form right end -->
                </div>

                <button type="submit" class="btn-primary">Save</button>
            </form>
        </div>
    </div>

    <?php
    displayJSSection($tinyMCE);
    ?>

    <!-- Footer -->
    <footer>
        <?php displayFooter(); ?>
    </footer>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS -->
    <script src="../js/main.js"></script>

</body>

</html>