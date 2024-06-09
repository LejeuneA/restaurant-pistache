<?php

require_once('settings.php');

// Check if user is not identified, redirect to login page
if (!$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit();
}

$msg = null;
$tinyMCE = true;
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
        $addData['image_url'] = '';
        $addData['title'] = isset($_POST['title']) ? $_POST['title'] : '';
        $addData['price'] = isset($_POST['price']) ? $_POST['price'] : '';
        $addData['description'] = isset($_POST['description']) ? $_POST['description'] : '';
        $addData['content'] = isset($_POST['content']) ? $_POST['content'] : '';
        $addData['published_article'] = isset($_POST['published_article']) ? 1 : 0;
        $addData['idCategory'] = isset($_POST['idCategory']) ? $_POST['idCategory'] : 0;

        // Handle image upload
        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['image_upload']['name']);

            // Move uploaded file to designated directory
            if (move_uploaded_file($_FILES['image_upload']['tmp_name'], $uploadFile)) {
                $addData['image_url'] = $uploadFile;
            }
        }

        if ($_SESSION['user_permission'] == 1) {
            // Add the starter to the database
            $addResult = addStarterDB($conn, $addData);

            // Check the result and display appropriate message
            if ($addResult === true) {

                $msg = getMessage('Starter successfully added.', 'success');

                // Set session variable to indicate success
                $_SESSION['starter_added'] = true;
                // Redirect to the same page to refresh and clear the form
                header('Location: add-starter.php');
                exit();
            } else {
                $msg = getMessage('Error adding starter. Please try again.', 'error');
            }
        } else {
            $msg = getMessage('You are not allowed to add a starter.', 'error');
        }
    }

    // Fetch categories for the form dropdown
    $categories = getAllCategoriesDB($conn);
}

// At the beginning of the file, before any output
// Check if a starter has been successfully added
if (isset($_SESSION['starter_added']) && $_SESSION['starter_added'] === true) {
    // Display success message
    $msg = getMessage('The starter has been added successfully.', 'success');
    // Clear the session variable
    unset($_SESSION['starter_added']);
}

// Initialize the $addData array with empty values
$addData = [
    'image_url' => '',
    'title' => '',
    'price' => '',
    'description' => '',
    'content' => '',
    'published_article' => 0,
    'idCategory' => 0
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include the head section
    displayHeadSection('Add a starter');
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
        <?php displayNavigation(); ?>
        <!-----------------------------------------------------------------
                            Navigation end
        ------------------------------------------------------------------>
    </header>
    <!-----------------------------------------------------------------
                               Header end
    ------------------------------------------------------------------>
    <div class="edit-content">
        <div class="edit-title">
            <h1>Ajouter un starter</h1>
            <div class="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
        </div>

        <div class="edit-form container">
            <form id="add-starter-form" action="add-starter.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="form" value="add">

                <!-- Form top -->
                <div class="form-top">
                    <!-- Form left -->
                    <div class="form-left">
                        <!-- Statue of the article -->
                        <div class=" checkbox-ctrl">
                            <label for="published_article" class="published_article">Product status <span>(publication)</span></label>
                            <?php displayFormRadioBtnArticlePublished(isset($starter['active']) ? $starter['active'] : 0, 'ADD'); ?>
                        </div>
                        <!-- Category -->
                        <div class="form-ctrl">
                            <label for="idCategory" class="form-ctrl">Category</label>
                            <select id="idCategory" name="idCategory" class="form-ctrl" required>
                                <option value="">Select a category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category['idCategory']; ?>"><?php echo $category['nameOfCategory']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Title -->
                        <div class="form-ctrl">
                            <label for="title" class="form-ctrl">Title</label>
                            <input type="text" class="form-ctrl" id="title" name="title" value="<?php echo isset($addData['title']) ? $addData['title'] : ''; ?>" required>
                        </div>
                        
                        <!-- Description -->
                        <div class="form-ctrl">
                            <label for="description" class="form-ctrl">Description</label>
                            <input type="text" class="form-ctrl" id="description" name="description" value="<?php echo isset($addData['description']) ? $addData['description'] : ''; ?>">
                        </div>

                        <!-- Price -->
                        <div class="form-ctrl">
                            <label for="price" class="form-ctrl">Price</label>
                            <input type="text" class="form-ctrl" id="price" name="price" value="<?php echo isset($addData['price']) ? $addData['price'] : ''; ?>">
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
                                <img id="image_preview" class="image_preview" src="<?php echo isset($addData['image_url']) ? $addData['image_url'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form bottom -->
                <div class="form-bottom">
                    <div class="form-ctrl">
                        <label for="content" class="form-ctrl">Content</label>
                        <textarea class="content" id="content" name="content" rows="5"><?php echo isset($addData['content']) ? $addData['content'] : ''; ?></textarea>
                    </div>
                </div>
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
    displayJSSection($tinyMCE);
    ?>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Main Js -->
   <script src="../js/main.js"></script>

</body>

</html>