<?php
require_once('settings.php');

// Vérifier si l'utilisateur n'est pas identifié, rediriger vers la page de connexion
if (!$_SESSION['IDENTIFY']) {
    header('Location: login.php');
    exit;
}

$msg = null;
$tinyMCE = true;
$starter = null;

// Check the database connection
if (!is_object($conn)) {
    $msg = getMessage($conn, 'error');
} else {
    // Check if starter ID is provided in the URL
    if (isset($_GET['idStarter'])) {
        // Get the starter ID from the URL
        $idStarter = $_GET['idStarter'];

        // Retrieve starter details from the database
        $starter = getStarterByIDDB($conn, $idStarter);

        // Fetch category names from the database
        $categories = getCategoryNamesFromDB($conn);

        // Check if the form is submitted and the form type
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the form was submitted for update
            if (isset($_POST['update_form'])) {
                // Update the article in the database
                $updateData = [
                    'idStarter' => $idStarter,
                    'imageUrl' => $_POST['imageUrl'],
                    'title' => isset($_POST['title']) ? $_POST['title'] : '',
                    'price' => isset($_POST['price']) ? $_POST['price'] : '',
                    'description' => isset($_POST['description']) ? $_POST['description'] : '',
                    'content' => $_POST['content'],
                    'published_article' => isset($_POST['published_article']) ? 1 : 0,
                    'idCategory' => $_POST['idCategory']
                ];

                // Perform the update operation in the database
                $updateResult = updateStarterDB($conn, $updateData);

                // Check the result of the update operation
                if ($updateResult === true) {
                    $msg = getMessage('Changes have been saved on the page.', 'success');
                    $_SESSION['form_submitted'] = true;
                } else {
                    $msg = getMessage('Error while modifying the product. Please try again.', 'error');
                }
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
                    $updateData['imageUrl'] = $target_file;
                    updateStarterDB($conn, $updateData);
                } else {
                    $msg = getMessage('Error recording image. Please try again.', 'error');
                }
            }
        }
    } else {
        // If article ID is not provided, redirect to manager.php
        header('Location: manager.php');
        exit;
    }
}

// Check if form was submitted and unset the session variable
if (isset($_SESSION['form_submitted'])) {
    unset($_SESSION['form_submitted']);
    // Refresh the page after form submission
    header("Refresh: 1; URL=edit-starter.php?idStarter=$idStarter");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    // Include the head section
    displayHeadSection('Editer un starter');
    displayJSSection($tinyMCE);
    ?>
</head>

<body>
    <header>
        <?php displayNavigation(); ?>
    </header>

    <div class="edit-content">
        <div class="edit-title">
            <h1>Editer un starter</h1>
            <div class="message">
                <?php if (isset($msg)) echo $msg; ?>
            </div>
        </div>

        <div class="edit-form container">
            <form action="edit-starter.php?idStarter=<?php echo $starter['idStarter']; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idStarter" value="<?php echo $starter['idStarter']; ?>">

                <!-- Form top -->
                <div class="form-top">

                    <!-- Form left -->
                    <div class="form-left">

                        <!-- Statue of the article -->
                        <div class=" checkbox-ctrl">
                            <label for="published_article" class="published_article">Status du produit <span>(publication)</span></label>
                            <?php displayFormRadioBtnArticlePublished(isset($starter['active']) ? $starter['active'] : 0, 'EDIT'); ?>
                        </div>

                        <!-- Category -->
                        <div class="form-ctrl">
                            <label for="idCategory" class="form-ctrl">Catégorie</label>
                            <select id="idCategory" name="idCategory" class="form-ctrl" required>
                                <option value="">Sélectionner une catégorie</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category['idCategory']; ?>" <?php echo ($category['idCategory'] == $starter['idCategory']) ? 'selected' : ''; ?>><?php echo $category['nameOfCategory']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="form-ctrl">
                            <label for="title" class="form-ctrl">Titre</label>
                            <input type="text" class="form-ctrl" id="title" name="title" value="<?php echo isset($starter['title']) ? $starter['title'] : ''; ?>" required>
                        </div>

                        <!-- Writer -->
                        <div class="form-ctrl">
                            <label for="writer" class="form-ctrl">Auteur</label>
                            <input type="text" class="form-ctrl" id="writer" name="writer" value="<?php echo isset($starter['writer']) ? $starter['writer'] : ''; ?>">
                        </div>

                        <!-- description -->
                        <div class="form-ctrl">
                            <label for="description" class="form-ctrl">Caractèriques</label>
                            <input type="text" class="form-ctrl" id="description" name="description" value="<?php echo isset($starter['description']) ? $starter['description'] : ''; ?>">
                        </div>

                        <!-- Price -->
                        <div class="form-ctrl">
                            <label for="price" class="form-ctrl">Prix</label>
                            <input type="text" class="form-ctrl" id="price" name="price" value="<?php echo isset($starter['price']) ? $starter['price'] : ''; ?>">
                        </div>

                    </div>

                    <!-- Form right -->
                    <div class="form-right">

                        <!-- File upload field -->
                        <div class="form-ctrl">
                            <label for="image_upload" class="form-ctrl">Uploader l'image</label>
                            <input type="file" class="form-ctrl" id="image_upload" name="image_upload" onchange="previewImage(this)">
                        </div>
                        
                        <!-- Preview of the image -->
                        <div class="form-ctrl">
                            <label for="image_preview" class="form-ctrl">Aperçu de l'image</label>
                            <div>
                                <input type="text" class="form-ctrl imageUrl" id="imageUrl" name="imageUrl" value="<?php echo isset($starter['imageUrl']) ? $starter['imageUrl'] : ''; ?>" readonly>
                                <img id="image_preview" class="image_preview" src="<?php echo isset($starter['imageUrl']) ? $starter['imageUrl'] : ''; ?>" alt="Aperçu de l'image">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form bottom -->
                <div class=" form-bottom">
                    <div class="form-ctrl">
                        <label for="content" class="form-ctrl">Contenu</label>
                        <textarea class="content" id="content" name="content" rows="5"><?php echo isset($starter['content']) ? $starter['content'] : ''; ?></textarea>
                    </div>
                </div>

                <input type="hidden" name="update_form" value="1">
                <button type="submit" class="btn-primary">Sauvegarder</button>
                <button type="submit" class="btn-primary" formaction="article-starter.php?idStarter=<?php echo $starter['idStarter']; ?>">Afficher</button>
            </form>
        </div>
    </div>

    <?php
    displayJSSection($tinyMCE);
    ?>
    <!-- Footer -->
    <footer>
        <div data-include="footer"></div>
    </footer>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Functions -->
    <script src="../js/functions.js"></script>

</body>

</html>