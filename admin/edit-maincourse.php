<?php
require_once('settings.php');

// Start the session at the beginning of your script if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is not identified, redirect to login page
if (!$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit;
}

$msg = null;
$tinyMCE = true;
$papeterie = null;

// Check the database connection
if (!is_object($conn)) {
    $_SESSION['message'] = getMessage($conn, 'error');
    header('Location: manager-papeterie.php');
    exit;
} else {
    // Check if papeterie ID is provided in the URL
    if (isset($_GET['idPapeterie'])) {
        // Get the papeterie ID from the URL
        $idPapeterie = $_GET['idPapeterie'];

        // Retrieve papeterie details from the database
        $papeterie = getPapeterieByIDDB($conn, $idPapeterie);

        // Fetch category names from the database
        $categories = getCategoryNamesFromDB($conn);

        // Check if the form is submitted and the form type
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the user has permission to edit the book
            if ($_SESSION['user_permission'] == 2) {
                $msg = getMessage('Vous n\'avez pas le droit de modifier une papeterie.', 'error');
            } else {
                // Check if the form was submitted for update
                if (isset($_POST['update_form'])) {
                    // Update the papeterie in the database
                    $updateData = [
                        'idPapeterie' => $idPapeterie,
                        'image_url' => $_POST['image_url'],
                        'title' => $_POST['title'] ?? '',
                        'writer' => $_POST['writer'] ?? '',
                        'feature' => $_POST['feature'] ?? '',
                        'price' => $_POST['price'] ?? '',
                        'content' => $_POST['content'],
                        'published_article' => isset($_POST['published_article']) ? 1 : 0,
                        'idCategory' => $_POST['idCategory']
                    ];

                    // Perform the update operation in the database
                    $updateResult = updatePapeterieDB($conn, $updateData);

                    // Check the result of the update operation
                    if ($updateResult === true) {
                        $_SESSION['message'] = getMessage('Les modifications ont été enregistrées sur la page.', 'success');
                        $_SESSION['form_submitted'] = true;
                    } else {
                        $_SESSION['message'] = getMessage('Erreur lors de la modification du produit. Veuillez réessayer.', 'error');
                    }

                    // Redirect to the same page to prevent form resubmission
                    header('Location: edit-papeterie.php?idPapeterie=' . $idPapeterie);
                    exit();
                }

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
                        // File upload successful, update the image URL in the database
                        $updateData['image_url'] = $target_file;
                        updatePapeterieDB($conn, $updateData);
                    } else {
                        $_SESSION['message'] = getMessage('Erreur lors de l\'enregistrement de l\'image. Veuillez réessayer.', 'error');
                    }

                    // Redirect to the same page to prevent form resubmission
                    header('Location: edit-papeterie.php?idPapeterie=' . $idPapeterie);
                    exit();
                }
            }
        }
    } else {
        // If papeterie ID is not provided, redirect to manager.php
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
    displayHeadSection('Editer une papeterie');
    displayJSSection($tinyMCE);
    ?>
</head>

<body>
    <header>
        <?php displayNavigation(); ?>
    </header>

    <div class="edit-content">
        <div class="edit-title">
            <h1>Editer une papeterie</h1>
            <div class="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
        </div>

        <div class="edit-form container">
            <form action="edit-papeterie.php?idPapeterie=<?php echo $papeterie['idPapeterie']; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idPapeterie" value="<?php echo $papeterie['idPapeterie']; ?>">

                <!-- Form top -->
                <div class="form-top">

                    <!-- Form left -->
                    <div class="form-left">

                        <!-- Statue of the article -->
                        <div class=" form-ctrl">
                            <label for="published_article" class="published_article">Status du produit <span>(publication)</span></label>
                            <?php displayFormRadioBtnArticlePublished(isset($papeterie['active']) ? $papeterie['active'] : 0, 'EDIT'); ?>
                        </div>

                        <!-- Category -->
                        <div class="form-ctrl">
                            <label for="idCategory" class="form-ctrl">Catégorie</label>
                            <select id="idCategory" name="idCategory" class="form-ctrl" required>
                                <option value="">Sélectionner une catégorie</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category['idCategory']; ?>" <?php echo ($category['idCategory'] == $papeterie['idCategory']) ? 'selected' : ''; ?>><?php echo $category['nameOfCategory']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="form-ctrl">
                            <label for="title" class="form-ctrl">Titre</label>
                            <input type="text" class="form-ctrl" id="title" name="title" value="<?php echo isset($papeterie['title']) ? $papeterie['title'] : ''; ?>" required>
                        </div>

                        <!-- Writer -->
                        <div class="form-ctrl">
                            <label for="writer" class="form-ctrl">Auteur</label>
                            <input type="text" class="form-ctrl" id="writer" name="writer" value="<?php echo isset($papeterie['writer']) ? $papeterie['writer'] : ''; ?>">
                        </div>

                        <!-- Feature -->
                        <div class="form-ctrl">
                            <label for="feature" class="form-ctrl">Caractèriques</label>
                            <input type="text" class="form-ctrl" id="feature" name="feature" value="<?php echo isset($papeterie['feature']) ? $papeterie['feature'] : ''; ?>">
                        </div>

                        <!-- Price -->
                        <div class="form-ctrl">
                            <label for="price" class="form-ctrl">Prix</label>
                            <input type="text" class="form-ctrl" id="price" name="price" value="<?php echo isset($papeterie['price']) ? $papeterie['price'] : ''; ?>">
                        </div>

                    </div>

                    <!-- Form right -->
                    <div class="form-right">

                        <!-- URL of the image
                        <div class="form-ctrl">
                            <label for="image_url" class="form-ctrl">URL de l'image</label>
                            <input type="text" class="form-ctrl" id="image_url" name="image_url" value="<?php echo isset($papeterie['image_url']) ? $papeterie['image_url'] : ''; ?>" readonly>
                        </div> -->

                        <!-- File upload field -->
                        <div class="form-ctrl">
                            <label for="image_upload" class="form-ctrl">Uploader l'image</label>
                            <input type="file" class="form-ctrl" id="image_upload" name="image_upload" onchange="previewImage(this)">
                        </div>
                        <!-- Preview of the image -->
                        <div class="form-ctrl">
                            <label for="image_preview" class="form-ctrl">Aperçu de l'image</label>
                            <div>
                                <input type="text" class="form-ctrl image_url" id="image_url" name="image_url" value="<?php echo isset($papeterie['image_url']) ? $papeterie['image_url'] : ''; ?>" readonly>
                                <img id="image_preview" class="image_preview" src="<?php echo isset($papeterie['image_url']) ? $papeterie['image_url'] : ''; ?>" alt="Aperçu de l'image">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form bottom -->
                <div class=" form-bottom">
                    <div class="form-ctrl">
                        <label for="content" class="form-ctrl">Contenu</label>
                        <textarea class="content" id="content" name="content" rows="5"><?php echo isset($papeterie['content']) ? $papeterie['content'] : ''; ?></textarea>
                    </div>
                </div>

                <input type="hidden" name="update_form" value="1">
                <button type="submit" class="btn-primary">Sauvegarder</button>
                <button type="submit" class="btn-primary" formaction="article-papeterie.php?idPapeterie=<?php echo $papeterie['idPapeterie']; ?>">Afficher</button>
            </form>
        </div>
    </div>

    <?php
    displayJSSection($tinyMCE);
    ?>

     <!-----------------------------------------------------------------
                               Footer
    ------------------------------------------------------------------>
    <footer>
        <?php displayFooter(); ?>
    </footer>
    <!-----------------------------------------------------------------
                            Footer end
    ------------------------------------------------------------------>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Main Js -->
   <script src="../js/main.js"></script>

</body>

</html>