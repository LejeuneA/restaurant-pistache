<?php
require_once('settings.php');

// Start the session at the beginning of your script if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is not identified, redirect to login page
if (!isset($_SESSION['IDENTIFY']) || !$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit;
}

$msg = null;
$tinyMCE = true;
$mainCourse = null;

// Check the database connection
if (!is_object($conn)) {
    $_SESSION['message'] = getMessage($conn, 'error');
    header('Location: manager-maincourse.php');
    exit;
} else {
    // Check if mainCourse ID is provided in the URL
    if (isset($_GET['idMainCourse'])) {
        // Get the mainCourse ID from the URL
        $idMainCourse = $_GET['idMainCourse'];

        // Retrieve mainCourse details from the database
        $mainCourse = getMainCourseByIDDB($conn, $idMainCourse);

        // Fetch category names from the database
        $categories = getCategoryNamesFromDB($conn);

        // Check if the form is submitted and the form type
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the user has permission to edit the main course
            if ($_SESSION['user_permission'] == 2) {
                $msg = getMessage('You do not have the right to modify a main course.', 'error');
            } else {
                // Check if the form was submitted for update
                if (isset($_POST['update_form'])) {
                    // Check if file is uploaded
                    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === UPLOAD_ERR_OK) {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["image_upload"]["name"]);

                        // Check if the directory exists, if not, create it
                        if (!file_exists($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }

                        // Move the uploaded file to the target directory
                        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file)) {
                            // File upload successful, set the image URL
                            $_POST['image_url'] = $target_file;
                        } else {
                            $_SESSION['message'] = getMessage('Error recording the image. Please try again.', 'error');
                            header('Location: edit-mainCourse.php?idMainCourse=' . $idMainCourse);
                            exit();
                        }
                    }

                    // Update the mainCourse in the database
                    $updateData = [
                        'idMainCourse' => $idMainCourse,
                        'image_url' => $_POST['image_url'] ?? '',
                        'title' => $_POST['title'] ?? '',
                        'price' => $_POST['price'] ?? '',
                        'description' => $_POST['description'] ?? '',
                        'content' => $_POST['content'],
                        'published_article' => isset($_POST['published_article']) ? 1 : 0,
                        'idCategory' => $_POST['idCategory']
                    ];

                    // Perform the update operation in the database
                    $updateResult = updateMainCourseDB($conn, $updateData);

                    // Check the result of the update operation
                    if ($updateResult === true) {
                        $_SESSION['message'] = getMessage('The changes have been saved on the page.', 'success');
                    } else {
                        $_SESSION['message'] = getMessage('Error modifying the product. Please try again.', 'error');
                    }

                    // Redirect to the same page to prevent form resubmission
                    header('Location: edit-maincourse.php?idMainCourse=' . $idMainCourse);
                    exit();
                }
            }
        }
    } else {
        // If mainCourse ID is not provided, redirect to manager.php
        header('Location: manager.php');
        exit;
    }
}

// Retrieve the message from the session and unset it
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    // Include the head section
    displayHeadSection('Editing a main course');
    displayJSSection($tinyMCE);
    ?>
</head>

<body>
    <header>
        <?php displayNavigation(); ?>
    </header>

    <div class="edit-content">
        <div class="edit-title">
            <h1>Editing a main course</h1>
            <div class="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
        </div>

        <div class="edit-form container">
            <form action="edit-mainCourse.php?idMainCourse=<?php echo $mainCourse['idMainCourse']; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idMainCourse" value="<?php echo $mainCourse['idMainCourse']; ?>">
                <input type="hidden" name="update_form" value="1">

                <!-- Form top -->
                <div class="form-top">

                    <!-- Form left -->
                    <div class="form-left">

                        <!-- Statue of the article -->
                        <div class="checkbox-ctrl">
                            <label for="published_article" class="published_article">Status of the product <span>(publication)</span></label>
                            <?php displayFormRadioBtnArticlePublished(isset($mainCourse['active']) ? $mainCourse['active'] : 0, 'EDIT'); ?>
                        </div>

                        <!-- Category -->
                        <div class="form-ctrl">
                            <label for="idCategory" class="form-ctrl">Category</label>
                            <select id="idCategory" name="idCategory" class="form-ctrl" required>
                                <option value="">Select a category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category['idCategory']; ?>" <?php echo ($category['idCategory'] == $mainCourse['idCategory']) ? 'selected' : ''; ?>><?php echo $category['nameOfCategory']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="form-ctrl">
                            <label for="title" class="form-ctrl">Title</label>
                            <input type="text" class="form-ctrl" id="title" name="title" value="<?php echo isset($mainCourse['title']) ? $mainCourse['title'] : ''; ?>" required>
                        </div>

                        <!-- Price -->
                        <div class="form-ctrl">
                            <label for="price" class="form-ctrl">Price</label>
                            <input type="text" class="form-ctrl" id="price" name="price" value="<?php echo isset($mainCourse['price']) ? $mainCourse['price'] : ''; ?>">
                        </div>

                        <!-- Description -->
                        <div class="form-ctrl">
                            <label for="description" class="form-ctrl">Description</label>
                            <input type="text" class="form-ctrl" id="description" name="description" value="<?php echo isset($mainCourse['description']) ? $mainCourse['description'] : ''; ?>">
                        </div>

                    </div>

                    <!-- Form right -->
                    <div class="form-right">

                        <!-- File upload field -->
                        <div class="form-ctrl">
                            <label for="image_upload" class="form-ctrl">Upload image</label>
                            <input type="file" class="form-ctrl" id="image_upload" name="image_upload" onchange="previewImage(this)">
                        </div>

                        <!-- Preview of the image -->
                        <div class="form-ctrl">
                            <label for="image_preview" class="form-ctrl">Image preview</label>
                            <div>
                                <input type="text" class="form-ctrl image_url" id="image_url" name="image_url" value="<?php echo isset($mainCourse['image_url']) ? $mainCourse['image_url'] : ''; ?>" readonly>
                                <img id="image_preview" class="image_preview" src="<?php echo isset($mainCourse['image_url']) ? $mainCourse['image_url'] : ''; ?>" alt="Image preview">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form bottom -->
                <div class="form-bottom">
                    <div class="form-ctrl">
                        <label for="content" class="form-ctrl">Content</label>
                        <textarea class="content" id="content" name="content" rows="5"><?php echo isset($mainCourse['content']) ? $mainCourse['content'] : ''; ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Save</button>
                <button type="submit" class="btn-primary" formaction="article-mainCourse.php?idMainCourse=<?php echo $mainCourse['idMainCourse']; ?>">Display</button>
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