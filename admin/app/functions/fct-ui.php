<?php
/* ********************************************************************** */
/* *                          TOOLS FUNCTIONS                           * */
/* *                          ---------------                           * */
/* *                 USER INTERFACE DISPLAY FUNCTIONS                   * */
/* ********************************************************************** */


/**-----------------------------------------------------------------
    Returns the html code of the radio buttons indicating the 
                publication status of the article
*------------------------------------------------------------------**/
/**
 * Returns the html code of the radio buttons 
 * indicating the publication status of the article
 * 
 * @param boolean     $published
 * @param string      $typeForm  (ADD ou EDIT)
 * @return void
 */
function displayFormRadioBtnArticlePublished($published, $typeForm = 'ADD')
{
    $html = '';

    if ($typeForm == 'ADD') {
        $html .= '
        <div class="checkbox-wrapper-22">
            <label class="switch" for="checkbox">
            <input type="checkbox" id="checkbox" value="1" name="published_article" />
            <div class="slider round"></div>
            </label>
        </div>
        ';
    } elseif ($typeForm == 'EDIT') {
        if ($published) {
            $html .= '
                <div class="checkbox-wrapper-22">
                    <label class="switch" for="checkbox"> 
                    <input type="checkbox" id="checkbox" value="1" name="published_article" checked>    
                    <span class="slider round"></span> 
                    </label>
                </div>
            ';
        } else {
            $html .= '
                <div class="checkbox-wrapper-22">
                    <label class="switch" for="checkbox">
                    <input type="checkbox" id="checkbox" value="1" name="published_article">  
                    <span class="slider round"></span> 
                    </label>   
                </div>
            ';
        }
    }

    echo $html;
}


/**-----------------------------------------------------------------
                    Displaying the JS section
 *------------------------------------------------------------------**/
/**
 * Displaying the JS section
 * 
 * @param bool $tinyMCE 
 * @return void 
 */
function displayJSSection($tinyMCE = false)
{
    $js = '';

    // TinyMCE loaded if necessary (parameter $tinyMCE = true)
    $js .= ($tinyMCE) ? '
    <script src="vendors/tinymce/tinymce.min.js" referrerpolicy="origin"></script>  
    <script src="assets/js/conf-tinymce.js"> </script>
    ' : null;

    // Displaying the JS script chain
    echo $js;
}


/**-----------------------------------------------------------------
                Displaying the head section of a page
*------------------------------------------------------------------**/
/**
 * Displaying the head section of a page
 * 
 * @param string $title 
 * @return void 
 */
function displayHeadSection($title = APP_NAME)
{
    $head = '
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Restaurant Pistache - Liége">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="'.DOMAIN.'/css/styles.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- AOS Library CSS -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/icons/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
    <title>' . $title . '</title>
    ';

    echo $head;
}


/**-----------------------------------------------------------------
                  Displaying the admin navigation
*------------------------------------------------------------------**/

/**
 * Displaying the admin navigation
 * 
 * @return void 
 */
function displayNavigation()
{

    $navigation = '';

    if ($_SESSION['IDENTIFY']) {
        $navigation .= '
        <nav class="navbar-admin">
            <div class="navbar-container container">
                <!-- Logo -->
                <a class="navbar-brand" href="../index.php">
                    Pistache
                </a>
                <!-- Logo end -->

                <!-- Right-side content -->
                <div class="navbar-right">
                    <!-- Navbar menu -->
                    <div class="navbar-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php"><i class="fas fa-home"></i><span> Home</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager.php">Catégories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager-starter.php">Starters</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../admin/manager-maincourse.php">Main courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager-dessert.php">Desserts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/manager.php"><i class="fa-solid fa-square-plus"></i>
                                <span> Add</span></a>
                            </li>
                        </ul>

                        <!-- Login button -->
                        <a href="logoff.php" class="btn-primary">Log off</a>
                        <!-- Login button end -->
                    </div>
                    <!-- Navbar menu end -->
                </div>
                <!-- Right-side content end -->
            </div>
        </nav>
        ';
    } else {
        $navigation .= '
        <nav class="navbar-admin">
            <div class="navbar-container container">
                <!-- Logo -->
                <a class="navbar-brand" href="login.php">
                    Pistache
                </a>
                <!-- Logo end -->

                <!-- Right-side content -->
                <div class="navbar-right">
                    <!-- Navbar menu -->
                    <div class="navbar-menu">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fas fa-home"></i><span> Home</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager.php">Catégories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager-starter.php">Starters</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../admin/manager-maincourse.php">Main courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager-dessert.php">Desserts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/manager.php"><i class="fa-solid fa-square-plus"></i>
                            <span> Add</span></a>
                        </li>
                        </ul>

                        <!-- Login button -->
                        <a href="logoff.php" class="btn-primary">Log off</a>
                        <!-- Login button end -->
                    </div>
                    <!-- Navbar menu end -->
                </div>
                <!-- Right-side content end -->
            </div>
        </nav>
        ';
    }

    echo $navigation;
}


/**-----------------------------------------------------------------
                  Returning a message in HTML format
*------------------------------------------------------------------**/

/**
 * Returning a message in HTML format
 * 
 * @param string $message 
 * @param string $type 
 * @return string 
 */
function getMessage($message, $type = 'success')
{
    $html = '<div class="msg-' . $type . '">' . $message . '</div>';
    return $html;
}

/**-----------------------------------------------------------------
        Generate HTML markup for displaying articles information
*------------------------------------------------------------------**/
/**
 * Generate HTML markup for displaying starters information
 * 
 * @param array $starter 
 * @return string 
 */
function generateStarterHTML($starter)
{
    $html = ""; 

    $imageUrl = htmlspecialchars($starter['imageUrl'], ENT_QUOTES);
    $title = htmlspecialchars($starter['title'], ENT_QUOTES);
    $price = htmlspecialchars($starter['price'], ENT_QUOTES);
    $description = htmlspecialchars($starter['description'], ENT_QUOTES);

    // Construct the HTML markup
    $html .= "
        <div class=\"menu-items\" data-aos=\"fade-up\" data-aos-delay=\"150\">
            <div class=\"menu-item\">
                <img class=\"menu-item-image\" src=\"$imageUrl\" alt=\"$title\">
                <div class=\"menu-item-info\">
                    <h3 class=\"menu-item-title\">$title</h3>
                    <span class=\"menu-item-price\">€$price</span>
                    <p>$description</p>
                </div>
            </div>
        </div>
    ";

    return $html;
}

/**-----------------------------------------------------------------
        Generate HTML markup for displaying articles information
*------------------------------------------------------------------**/
/**
 * Generate HTML markup for displaying starters information
 * 
 * @param array $starter 
 * @return string 
 */
function generateMenuHTML($starter)
{
    $html = ""; 

    $imageUrl = htmlspecialchars($starter['imageUrl'], ENT_QUOTES);
    $title = htmlspecialchars($starter['title'], ENT_QUOTES);
    $price = htmlspecialchars($starter['price'], ENT_QUOTES);
    $description = htmlspecialchars($starter['description'], ENT_QUOTES);

    // Construct the HTML markup
    $html .= "
        <div class=\"menu-items\" data-aos=\"fade-up\" data-aos-delay=\"150\">
            <div class=\"menu-item\">
                <img class=\"menu-item-image\" src=\"$imageUrl\" alt=\"$title\">
                <div class=\"menu-item-info\">
                    <h3 class=\"menu-item-title\">$title</h3>
                    <span class=\"menu-item-price\">€$price</span>
                    <p>$description</p>
                </div>
            </div>
        </div>
    ";

    return $html;
}




/**-----------------------------------------------------------------
             Displays the book received as a parameter
*------------------------------------------------------------------**/

/**
 * Displays the book received as a parameter
 * 
 * @param mixed $livre 
 * @return void 
 */
function displayLivreByID($livre)
{
    echo '<section class="product-container container">';
    echo '<div class="product-info-container">';
    echo '<div class="product-img">';
    echo '<img src="'.DOMAIN. '/'. $livre['image_url'] . '" alt="' . $livre['title'] . '">';
    echo '</div>';
    echo '<div class="product-info">';
    echo '<div>';
    echo '<h2>' . $livre['title'] . '</h2>';
    echo '<p>' . $livre['writer'] . ' <span>' . $livre['feature'] . '</span></p>';
    echo '</div>';
    echo '<div class="product-price">';
    echo '<p>' . $livre['price'] . ' € <span><i class="fas fa-truck"></i> Livraison 1 à 2 semaines</span><span><i class="fas fa-receipt"></i> Retrait en magasin dans 2 h.</span></p>';
    echo '<a href="#" class="btn-primary"><i class="fas fa-shopping-cart"></i> Ajouter au panier</a>';
    echo '</div>';
    echo '<div class="product-advantages">';
    echo '<ul>';
    echo '<li><i class="fa fa-shopping-cart"></i> Passer une commande en un clic</li>';
    echo '<li><i class="fa fa-lock"></i> Payer en toute sécurité</li>';
    echo '<li><i class="fa fa-home"></i> Livraison en Belgique: 3,99 €</li>';
    echo '<li><i class="fa fa-gift"></i> Livraison en magasin gratuite</li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="product-description">';
    echo '<h2>Description</h2>';
    echo '<p>' . htmlspecialchars_decode($livre['content']) . '</p>';
    echo '</div>';
}

/**-----------------------------------------------------------------
           Displays the stationery received as a parameter
*------------------------------------------------------------------**/

/**
 * Displays the stationery received as a parameter
 * 
 * @param mixed $papeterie
 * @return void 
 */
function displayPapeterieByID($papeterie)
{
    echo '<main>';
    echo '<section class="product-container container">';
    echo '<div class="product-info-container">';
    echo '<div class="product-img">';
    echo '<img src="'.DOMAIN. '/'. $papeterie['image_url'] . '" alt="' . $papeterie['title'] . '">';
    echo '</div>';
    echo '<div class="product-info">';
    echo '<div>';
    echo '<h2>' . $papeterie['title'] . '</h2>';
    echo '</div>';
    echo '<div class="product-price">';
    echo '<p>' . $papeterie['price'] . ' € <span><i class="fas fa-truck"></i> Livraison 1 à 2 semaines</span><span><i class="fas fa-receipt"></i> Retrait en magasin dans 2 h.</span></p>';
    echo '<a href="#" class="btn-primary"><i class="fas fa-shopping-cart"></i> Ajouter au panier</a>';
    echo '</div>';
    echo '<div class="product-advantages">';
    echo '<ul>';
    echo '<li><i class="fa fa-shopping-cart"></i> Passer une commande en un clic</li>';
    echo '<li><i class="fa fa-lock"></i> Payer en toute sécurité</li>';
    echo '<li><i class="fa fa-home"></i> Livraison en Belgique: 3,99 €</li>';
    echo '<li><i class="fa fa-gift"></i> Livraison en magasin gratuite</li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="product-description">';
    echo '<h2>Description</h2>';
    echo '<p>' . htmlspecialchars_decode($papeterie['content']) . '</p>';
    echo '</div>';
}


/**-----------------------------------------------------------------
           Displays the gift received as a parameter
*------------------------------------------------------------------**/
/**
 * Displays the gift received as a parameter
 * 
 * @param mixed $papeterie
 * @return void 
 */
function displayCadeauByID($cadeau)
{
    echo '<section class="product-container container">';
    echo '<div class="product-info-container">';
    echo '<div class="product-img">';
    echo '<img src="'.DOMAIN. '/'. $cadeau['image_url'] . '" alt="' . $cadeau['title'] . '">';
    echo '</div>';
    echo '<div class="product-info">';
    echo '<div>';
    echo '<h2>' . $cadeau['title'] . '</h2>';
    echo '</div>';
    echo '<div class="product-price">';
    echo '<p>' . $cadeau['price'] . ' € <span><i class="fas fa-truck"></i> Livraison 1 à 2 semaines</span><span><i class="fas fa-receipt"></i> Retrait en magasin dans 2 h.</span></p>';
    echo '<a href="#" class="btn-primary"><i class="fas fa-shopping-cart"></i> Ajouter au panier</a>';
    echo '</div>';
    echo '<div class="product-advantages">';
    echo '<ul>';
    echo '<li><i class="fa fa-shopping-cart"></i> Passer une commande en un clic</li>';
    echo '<li><i class="fa fa-lock"></i> Payer en toute sécurité</li>';
    echo '<li><i class="fa fa-home"></i> Livraison en Belgique: 3,99 €</li>';
    echo '<li><i class="fa fa-gift"></i> Livraison en magasin gratuite</li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="product-description">';
    echo '<h2>Description</h2>';
    echo '<p>' . htmlspecialchars_decode($cadeau['content']) . '</p>';
    echo '</div>';
}


/**-----------------------------------------------------------------
            Displays articles for the manager's page
*------------------------------------------------------------------**/

/**
 * Displays articles for the manager's page
 * 
 * @param array $articles 
 * @return void
 */

function displayArticlesWithButtons($articles)
{
    foreach ($articles as $article) {
        // Display Article Content
        echo '<div class="article">';

        // Display circle based on article status
        $circleClass = ($article['active']) ? 'circle-published' : 'circle-not-published';
        echo '<div class="circle ' . $circleClass . '"></div>';

        echo '<h3>' . htmlspecialchars_decode($article['title']) . '</h3>';
        echo '</div>';

        // Display buttons
        echo '<div class="buttons">';
        echo '<button class="btn-manager" onclick="modifierArticle(' . $article['id'] . ')">Modifier</button>';
        echo '<button class="btn-manager" onclick="afficherArticle(' . $article['id'] . ')">Afficher</button>';
        echo '<button class="btn-manager-delete" onclick="supprimerArticle(' . $article['id'] . ')">Supprimer</button>';
        echo '</div>';

        echo '<hr>';
    }
}

/**-----------------------------------------------------------------
                  Display starters for the manager page
*------------------------------------------------------------------**/
/**
 * Display starters for the manager page
 * 
 * @param array $livres
 * @return void
 */

function displayLivresWithButtons($livres)
{
    foreach ($livres as $livre) {
        // Display Article Content
        echo '<div class="article">';

        // Display circle based on article status
        $circleClass = ($livre['active']) ? 'circle-published' : 'circle-not-published';
        echo '<div class="circle ' . $circleClass . '"></div>';

        echo '<h3>' . htmlspecialchars_decode($livre['title']) . '</h3>';
        echo '</div>';

        // Display buttons
        echo '<div class="buttons">';
        echo '<button class="btn-primary" onclick="modifierLivre(' . $livre['idLivre'] . ')">Modifier</button>';
        echo '<button class="btn-primary" onclick="afficherLivre(' . $livre['idLivre'] . ')">Afficher</button>';
        echo '<button class="btn-secondary" onclick="supprimerLivre(' . $livre['idLivre'] . ')">Supprimer</button>';
        echo '</div>';

        echo '<hr>';
    }
}

/**-----------------------------------------------------------------
                Display main courses for the manager page
*------------------------------------------------------------------**/

/**
 * Display main courses for the manager page
 * 
 * @param array $papeteries
 * @return void
 */

function displayPapeteriesWithButtons($papeteries)
{
    foreach ($papeteries as $papeterie) {
        // Display Article Content
        echo '<div class="article">';

        // Display circle based on article status
        $circleClass = ($papeterie['active']) ? 'circle-published' : 'circle-not-published';
        echo '<div class="circle ' . $circleClass . '"></div>';

        echo '<h3>' . htmlspecialchars_decode($papeterie['title']) . '</h3>';
        echo '</div>';

        // Display buttons
        echo '<div class="buttons">';
        echo '<button class="btn-primary" onclick="modifierPapeterie(' . $papeterie['idPapeterie'] . ')">Modifier</button>';
        echo '<button class="btn-primary" onclick="afficherPapeterie(' . $papeterie['idPapeterie'] . ')">Afficher</button>';
        echo '<button class="btn-secondary" onclick="supprimerPapeterie(' . $papeterie['idPapeterie'] . ')">Supprimer</button>';
        echo '</div>';

        echo '<hr>';
    }
}


/**-----------------------------------------------------------------
                Display desserts for the manager page
*------------------------------------------------------------------**/
/**
 * Display desserts for the manager page
 * 
 * @param array $cadeaux
 * @return void
 */

function displayCadeauxWithButtons($cadeaux)
{
    foreach ($cadeaux as $cadeau) {
        // Display Article Content
        echo '<div class="article">';

        // Display circle based on article status
        $circleClass = ($cadeau['active']) ? 'circle-published' : 'circle-not-published';
        echo '<div class="circle ' . $circleClass . '"></div>';

        echo '<h3>' . htmlspecialchars_decode($cadeau['title']) . '</h3>';
        echo '</div>';

        // Display buttons
        echo '<div class="buttons">';
        echo '<button class="btn-primary" onclick="modifierCadeau(' . $cadeau['idCadeau'] . ')">Modifier</button>';
        echo '<button class="btn-primary" onclick="afficherCadeau(' . $cadeau['idCadeau'] . ')">Afficher</button>';
        echo '<button class="btn-secondary" onclick="supprimerCadeau(' . $cadeau['idCadeau'] . ')">Supprimer</button>';
        echo '</div>';

        echo '<hr>';
    }
}

/**-----------------------------------------------------------------
    Displays the starters for the manager's page in table form
*------------------------------------------------------------------**/
/**
 * Displays the starters for the manager's page in table form
 * 
 * @param array $livres
 * @return void
 */
function displayLivresAsTable($livres)
{
    // Start the table
    echo '<table>';

    // Table headers
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Titre</th>';
    echo '<th>Auteur</th>';
    echo '<th>Fonctionnalité</th>';
    echo '<th>Prix</th>';
    echo '<th>Statut</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    // Table data
    foreach ($livres as $livre) {
        echo '<tr>';
        echo '<td data-cell="id">' . $livre['idLivre'] . '</td>';
        echo '<td data-cell="titre">' . html_entity_decode($livre['title']) . '</td>';
        echo '<td data-cell="auteur">' . html_entity_decode($livre['writer']) . '</td>';
        echo '<td data-cell="fonctionnalité">' . html_entity_decode($livre['feature']) . '</td>';
        echo '<td data-cell="prix">' . html_entity_decode($livre['price']) . '</td>';
        echo '<td data-cell="statut">' . ($livre['active'] ? 'Actif' : 'Inactif') . '</td>';
        echo '<td>';
        echo '<button class="btn-secondary" onclick="modifierLivre(' . $livre['idLivre'] . ')">Modifier</button>';
        echo '<button class="btn-secondary" onclick="afficherLivre(' . $livre['idLivre'] . ')">Afficher</button>';
        echo '<button class="btn-primary" onclick="supprimerLivre(' . $livre['idLivre'] . ')">Supprimer</button>';
        echo '</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';
}


/**-----------------------------------------------------------------
    Displays the main courses for the manager's page in table form
*------------------------------------------------------------------**/

/**
 *  Displays the main courses for the manager's page in table form
 * 
 * @param array $papeteries
 * @return void
 */
function displayPapeteriesAsTable($papeteries)
{
    // Start the table
    echo '<table>';

    // Table headers
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Titre</th>';
    echo '<th>Fonctionnalité</th>';
    echo '<th>Prix</th>';
    echo '<th>Statut</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    // Table data
    foreach ($papeteries as $papeterie) {
        echo '<tr>';
        echo '<td data-cell="id">' . $papeterie['idPapeterie'] . '</td>';
        echo '<td data-cell="titre">' . html_entity_decode($papeterie['title']) . '</td>';
        echo '<td data-cell="fonctionnalité">' . html_entity_decode($papeterie['feature']) . '</td>';
        echo '<td data-cell="prix">' . html_entity_decode($papeterie['price']) . '</td>';
        echo '<td data-cell="statut">' . ($papeterie['active'] ? 'Actif' : 'Inactif') . '</td>';
        echo '<td>';
        echo '<button class="btn-secondary" onclick="modifierPapeterie(' . $papeterie['idPapeterie'] . ')">Modifier</button>';
        echo '<button class="btn-secondary" onclick="afficherPapeterie(' . $papeterie['idPapeterie'] . ')">Afficher</button>';
        echo '<button class="btn-primary" onclick="supprimerPapeterie(' . $papeterie['idPapeterie'] . ')">Supprimer</button>';
        echo '</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';
}


/**-----------------------------------------------------------------
     Displays the desserts for the manager's page in table form
*------------------------------------------------------------------**/

/**
 * Displays the desserts for the manager's page in table form
 * 
 * @param array $cadeaux
 * @return void
 */
function displayCadeauxAsTable($cadeaux)
{
    // Start the table
    echo '<table>';

    // Table headers
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Titre</th>';
    echo '<th>Fonctionnalité</th>';
    echo '<th>Prix</th>';
    echo '<th>Statut</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    // Table data
    foreach ($cadeaux as $cadeau) {
        echo '<tr>';
        echo '<td data-cell="id">' . $cadeau['idCadeau'] . '</td>';
        echo '<td data-cell="titre">' . html_entity_decode($cadeau['title']) . '</td>';
        echo '<td data-cell="fonctionnalité">' . html_entity_decode($cadeau['feature']) . '</td>';
        echo '<td data-cell="prix">' . html_entity_decode($cadeau['price']) . '</td>';
        echo '<td data-cell="statut">' . ($cadeau['active'] ? 'Actif' : 'Inactif') . '</td>';
        echo '<td>';
        echo '<button class="btn-secondary" onclick="modifierCadeau(' . $cadeau['idCadeau'] . ')">Modifier</button>';
        echo '<button class="btn-secondary" onclick="afficherCadeau(' . $cadeau['idCadeau'] . ')">Afficher</button>';
        echo '<button class="btn-primary" onclick="supprimerCadeau(' . $cadeau['idCadeau'] . ')">Supprimer</button>';
        echo '</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';
}
