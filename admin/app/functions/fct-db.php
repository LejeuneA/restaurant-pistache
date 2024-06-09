<?php
/* ********************************************************************** */
/* *                           DB FUNCTIONS                             * */
/* *                           ------------                             * */
/* *                 FUNCTIONS FOR DATABASE INTERACTION                 * */
/* ********************************************************************** */


/**-----------------------------------------------------------------
                        Database connection
*------------------------------------------------------------------**/
/**
 * Database connection
 * 
 * @param string $serverName
 * @param string $userName
 * @param string $userPwd
 * @param string $dbName
 * 
 * @return object $conn
 */
function connectDB($serverName, $userName, $userPwd, $dbName)
{
    try {
        // Creating a database connection
        $conn = new PDO("mysql:host=$serverName;dbname=$dbName;charset=utf8", $userName, $userPwd);

        // Set PDO error mode to Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        (DEBUG) ? $st = 'Error : ' . $e->getMessage() : $st = "Error : Database connexion";
        return $e;
    }
}


/**-----------------------------------------------------------------
                         User identification
 *------------------------------------------------------------------**/

/**
 * User identification
 * 
 * @param mixed $conn 
 * @param mixed $datas 
 * @return mixed 
 */
function userIdentificationDB($conn, $datas)
{
    try {
        $user = null;

        // Preparing data for insertion into the database
        $login = filterInputs($datas['login']);
        $pwd = filterInputs($datas['pwd']);

        // Selecting data in the users table
        $req = $conn->prepare("SELECT * FROM users WHERE email = :login AND passwd = :pwd");
        $req->bindParam(':login', $login);
        $req->bindParam(':pwd', $pwd);
        $req->execute();

        // Generates a result if a match is found
        $user = $req->fetch(PDO::FETCH_ASSOC);

        // Closing the connection
        $req = null;
        $conn = null;

        if ((isset($user['email']) && $user['email'] === $login) && (isset($user['passwd']) && $user['passwd'] === $pwd)) {
            // Delete password from $user object
            $user['passwd'] = null;
            return $user;
        } else
            return false;
    } catch (PDOException $e) {
        (DEBUG) ? $st = 'Error : ' . $e->getMessage() : $st = "Error in : userIdentificationDB() function";
        return $st;
    }
}


/**-----------------------------------------------------------------
            Retrieve all starters from the starters table
*------------------------------------------------------------------**/
/**
 * Retrieve all starters from the starters table
 * 
 * @param object $conn 
 * @param int $limit (Number of items to retrieve)
 * @param string $active (0, 1 or %)
 * @return array|false 
 */
function getAllStartersDB($conn, $limit = null, $active = '%')
{
    try {
        // Preparing SQL queries
        $sql = "SELECT * FROM starters WHERE active LIKE :active ORDER BY idStarter DESC";

        // If a limit number is specified, add a LIMIT clause to the request
        if ($limit !== null) {
            $sql .= " LIMIT :limit";
        }

        // Preparing the request
        $req = $conn->prepare($sql);
        $req->bindParam(':active', $active);

        // If a limit is specified, bind the parameter to the request
        if ($limit !== null) {
            $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        // Executing the request
        $req->execute();

        // Retrieving results
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        // Closing the connection
        $req = null;
        $conn = null;

        // Returns results
        return $resultat;
    } catch (PDOException $e) {

        (DEBUG) ? $st['error'] = 'Error : ' . $e->getMessage() : $st['error'] = "Error in : getAllStartersDB() function";
        return $st;
    }
}

/**-----------------------------------------------------------------
        Retrieve all main courses from the mainCourses table
*------------------------------------------------------------------**/

/**
 * Retrieve all main courses from the mainCourses table
 * 
 * @param object $conn 
 * @param int $limit (Number of items to be recovered)
 * @param string $active (0, 1 or %)
 * @return array|false $result or false in the event of an error
 */
function getAllMainCoursesDB($conn, $limit = null, $active = '%')
{
    try {
        // Preparing the SQL query
        $sql = "SELECT * FROM mainCourses WHERE active LIKE :active ORDER BY idMainCourse DESC";

        // If a limit is specified, add a LIMIT clause to the query
        if ($limit !== null) {
            $sql .= " LIMIT :limit";
        }

        // Preparing the request
        $req = $conn->prepare($sql);
        $req->bindParam(':active', $active);

        // If a limit is specified, bind the parameter to the request
        if ($limit !== null) {
            $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        // Executing the request
        $req->execute();

        // Retrieving results
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion
        $req = null;
        $conn = null;

        // Returns results
        return $resultat;
    } catch (PDOException $e) {
        (DEBUG) ? $st['error'] = 'Error : ' . $e->getMessage() : $st['error'] = "Error in : getAllMainCoursesDB() function";
        return $st;
    }
}


/**-----------------------------------------------------------------
            Retrieve all desserts from the desserts table
*------------------------------------------------------------------**/

/**
 * Retrieve all desserts from the desserts table
 * 
 * @param object $conn 
 * @param int $limit (Number of items to be recovered)
 * @param string $active (0, 1 or %)
 * @return array|false $result or false in the event of an error
 */
function getAllDessertsDB($conn, $limit = null, $active = '%')
{
    try {
        // Preparing the SQL query
        $sql = "SELECT * FROM desserts WHERE active LIKE :active ORDER BY idDessert DESC";

        // If a limit is specified, add a LIMIT clause to the query
        if ($limit !== null) {
            $sql .= " LIMIT :limit";
        }

        // Preparing the request
        $req = $conn->prepare($sql);
        $req->bindParam(':active', $active);

        // If a limit is specified, bind the parameter to the request
        if ($limit !== null) {
            $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        // Executing the request
        $req->execute();

        // Retrieving results
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        // Closing the connection
        $req = null;
        $conn = null;

        // Returns results
        return $resultat;
    } catch (PDOException $e) {
        (DEBUG) ? $st['error'] = 'Error : ' . $e->getMessage() : $st['error'] = "Error in : getAllDessertsDB() function";
        return $st;
    }
}


/**-----------------------------------------------------------------
                    Retrieve a starter by ID
*------------------------------------------------------------------**/
/**
 * Retrieve a starter by ID
 * 
 * @param object $conn 
 * @return array $result
 */
function getStarterByIDDB($conn, $idStarter)
{
    try {
        // Retrieving data from our items table
        $req = $conn->prepare("SELECT * FROM starters WHERE idStarter = :idStarter");
        $req->bindParam(':idStarter', $idStarter);
        $req->execute();

        // Returns an associative array for each entry in the items table with the column name as the key
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        // Closing the connection
        $req = null;
        $conn = null;

        return $resultat;
    } catch (PDOException $e) {
        (DEBUG) ? $st['error'] = 'Error : ' . $e->getMessage() : $st['error'] = "Error in : getStarterByIDDB() function";
        return $st;
    }
}


/**-----------------------------------------------------------------
                    Retrieve a main course by ID
*------------------------------------------------------------------**/
/**
 * Retrieve a main course by ID
 * 
 * @param object $conn 
 * @return array $result
 */
function getMainCourseByIDDB($conn, $idMainCourse)
{
    try {
        // Retrieving data from our items table
        $req = $conn->prepare("SELECT * FROM mainCourses WHERE idMainCourse = :idMainCourse");
        $req->bindParam(':idMainCourse', $idMainCourse);
        $req->execute();

        // Returns an associative array for each entry in the items table with the column name as the key
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        // Closing the connection
        $req = null;
        $conn = null;

        return $resultat;
    } catch (PDOException $e) {
        (DEBUG) ? $st['error'] = 'Error : ' . $e->getMessage() : $st['error'] = "Error in : getMainCourseByIDDB() function";
        return $st;
    }
}

/**-----------------------------------------------------------------
                Retrieve a dessert course by ID
*------------------------------------------------------------------**/
/**
 * Retrieve a dessert course by ID
 * 
 * @param object $conn 
 * @return array $result
 */
function getDessertByIDDB($conn, $idDessert)
{
    try {
        // Retrieving data from our items table
        $req = $conn->prepare("SELECT * FROM desserts WHERE idDessert = :idDessert");
        $req->bindParam(':idDessert', $idDessert);
        $req->execute();

        // Returns an associative array for each entry in the items table with the column name as the key
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        // Closing the connection
        $req = null;
        $conn = null;

        return $resultat;
    } catch (PDOException $e) {
        (DEBUG) ? $st['error'] = 'Error : ' . $e->getMessage() : $st['error'] = "Error in : getDessertByIDDB() function";
        return $st;
    }
}

/**-----------------------------------------------------------------
                 Adding an item to the database
*------------------------------------------------------------------**/

/**
 * Adding an item to the database
 * 
 * @param mixed $conn 
 * @return true 
 */
function addArticleDB($conn, $datas)
{
    try {
        // Preparing data for insertion into the database
        $title = filterInputs($datas['title']);
        $content = nl2br(filterInputs($datas['content']));

        // If we receive a value for the publication status of the article
        if (isset($datas['published_article']) && !empty($datas['published_article']))
            $active = $datas['published_article'];
        else
            $active = 0;

        // Inserting data in the items table
        $req = $conn->prepare("INSERT INTO articles (title, content, active) VALUES (:title, :content, :active)");
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->bindParam(':active', $active);
        $req->execute();

        // Connection closure
        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: addArticleDB() function");
        }
        return false;
    }
}


/**-----------------------------------------------------------------
                Adding a starter to the database
*------------------------------------------------------------------**/
/**
 * Adding a starter to the database
 * 
 * @param mixed $conn 
 * @return true 
 */
function addStarterDB($conn, $datas)
{
    try {
        // Preparing data for insertion into the database
        $image_url = filterInputs($datas['image_url']);
        $title = filterInputs($datas['title']);
        $price = filterInputs($datas['price']);
        $description = filterInputs($datas['description']);
        $idCategory = filterInputs($datas['idCategory']);

        $content = nl2br($datas['content']);
        $content = preg_replace("/(<[a-zA-Z0-9=\"\/\ ]+>)<br \/>/", "$1", $content);
        $content = htmlentities($content);

        // If we receive a value for the publication status of the article
        if (isset($datas['published_article']) && !empty($datas['published_article'])) {
            $active = $datas['published_article'];
        } else {
            $active = 0;
        }

        // Insertion des données dans la table articles
        $req = $conn->prepare("INSERT INTO starters (image_url, title, price, description, content, active, idCategory) VALUES (:image_url, :title, :price, :description, :content, :active, :idCategory)");
        $req->bindParam(':image_url', $image_url);
        $req->bindParam(':title', $title);
        $req->bindParam(':price', $price);
        $req->bindParam(':description', $description);
        $req->bindParam(':content', $content);
        $req->bindParam(':active', $active);
        $req->bindParam(':idCategory', $idCategory);
        $req->execute();

        // Connection closure
        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: addStarterDB() function");
        }
        return false;
    }
}

/**-----------------------------------------------------------------
                Adding a main course to the database
*------------------------------------------------------------------**/

/**
 * Adding a main course to the database
 * 
 * @param mixed $conn 
 * @return boolean 
 */
function addMainCourseDB($conn, $datas)
{
    try {
        // Preparing data for insertion into the database
        $image_url = filterInputs($datas['image_url']);
        $title = filterInputs($datas['title']);
        $price = filterInputs($datas['price']);
        $description = filterInputs($datas['description']);
        $idCategory = filterInputs($datas['idCategory']);

        $content = nl2br($datas['content']);
        $content = preg_replace("/(<[a-zA-Z0-9=\"\/\ ]+>)<br \/>/", "$1", $content);
        $content = htmlentities($content);

        // If we receive a value for the publication status of the article
        if (isset($datas['published_article']) && !empty($datas['published_article'])) {
            $active = $datas['published_article'];
        } else {
            $active = 0;
        }

        // Inserting data in the main courses table
        $req = $conn->prepare("INSERT INTO mainCourses (image_url, title, description, price, content, active, idCategory) VALUES (:image_url, :title, :description, :price, :content, :active, :idCategory)");
        $req->bindParam(':image_url', $image_url);
        $req->bindParam(':title', $title);
        $req->bindParam(':price', $price);
        $req->bindParam(':description', $description);
        $req->bindParam(':content', $content);
        $req->bindParam(':active', $active);
        $req->bindParam(':idCategory', $idCategory);
        $req->execute();

        // Connection closure
        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: addMainCourseDB() function");
        }
        return false;
    }
}

/**-----------------------------------------------------------------
                Adding a dessert to the database
*------------------------------------------------------------------**/

/**
 *  Adding a dessert to the database
 * 
 * @param mixed $conn 
 * @return boolean 
 */
function addDessertDB($conn, $datas)
{
    try {
        // Preparing data for insertion into the database
        $image_url = filterInputs($datas['image_url']);
        $title = filterInputs($datas['title']);
        $price = filterInputs($datas['price']);
        $description = filterInputs($datas['description']);
        $idCategory = filterInputs($datas['idCategory']);

        $content = nl2br($datas['content']);
        $content = preg_replace("/(<[a-zA-Z0-9=\"\/\ ]+>)<br \/>/", "$1", $content);
        $content = htmlentities($content);

        // If we receive a value for the publication status of the article
        if (isset($datas['published_article']) && !empty($datas['published_article'])) {
            $active = $datas['published_article'];
        } else {
            $active = 0;
        }

        // Inserting data in the desserts table
        $req = $conn->prepare("INSERT INTO desserts (image_url, title, description, price, content, active, idCategory) VALUES (:image_url, :title, :description, :price, :content, :active, :idCategory)");
        $req->bindParam(':image_url', $image_url);
        $req->bindParam(':title', $title);
        $req->bindParam(':description', $description);
        $req->bindParam(':price', $price);
        $req->bindParam(':content', $content);
        $req->bindParam(':active', $active);
        $req->bindParam(':idCategory', $idCategory);
        $req->execute();

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: addDessertDB() function");
        }
        return false;
    }
}


/**-----------------------------------------------------------------
                Modifying a starter in the database
 *------------------------------------------------------------------**/
/**
 * Modifying a starter in the database
 * 
 * @param mixed $conn 
 * @param array $datas 
 * @return true 
 */
function updateStarterDB($conn, $datas)
{
    try {
        $image_url = filterInputs($datas['image_url']);
        $title = filterInputs($datas['title']);
        $price = filterInputs($datas['price']);
        $description = filterInputs($datas['description']);
        $idCategory = filterInputs($datas['idCategory']);

        $content = nl2br($datas['content']);
        $content = preg_replace("/(<[a-zA-Z0-9=\"\/\ ]+>)<br \/>/", "$1", $content);
        $content = htmlentities($content);


        $idStarter = filterInputs($datas['idStarter']);

        // If we receive a value for the publication status of the article
        if (isset($datas['published_article']) && !empty($datas['published_article']))
            $active = $datas['published_article'];
        else
            $active = 0;

        // Inserting data in the items table
        $req = $conn->prepare("UPDATE starters SET image_url = :image_url, title = :title, price = :price, description = :description, content = :content, active = :active, idCategory = :idCategory WHERE idStarter = :idStarter");
        $req->bindParam(':image_url', $image_url);
        $req->bindParam(':title', $title);
        $req->bindParam(':price', $price);
        $req->bindParam(':description', $description);
        $req->bindParam(':content', $content);
        $req->bindParam(':active', $active);
        $req->bindParam(':idCategory', $idCategory);
        $req->bindParam(':idStarter', $idStarter);
        $req->execute();

        // Closing the connection
        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: updateStarterDB() function");
        }
        return false;
    }
}


/**-----------------------------------------------------------------
                Modifying a main course in the database
*------------------------------------------------------------------**/
/**
 * Modifying a main course in the database
 * 
 * @param PDO $conn The database connection
 * @param array $datas The data to update
 * @return bool|string Returns true on success, or an error message on failure
 */
function updateMainCourseDB($conn, $datas)
{
    try {
        // Sanitize input data
        $image_url = filterInputs($datas['image_url']);
        $title = filterInputs($datas['title']);
        $price = filterInputs($datas['price']);
        $description = filterInputs($datas['description']);
        $idCategory = filterInputs($datas['idCategory']);
        $idMainCourse = filterInputs($datas['idMainCourse']);

        // Sanitize and format content
        $content = nl2br($datas['content']);
        $content = preg_replace("/(<[a-zA-Z0-9=\"\/\ ]+>)<br \/>/", "$1", $content);
        $content = htmlentities($content);

        // Determine the active status
        $active = isset($datas['published_article']) ? $datas['published_article'] : 0;

        // Prepare and execute the update query
        $stmt = $conn->prepare("UPDATE mainCourses SET image_url = :image_url, title = :title, description = :description, price = :price, content = :content, active = :active, idCategory = :idCategory WHERE idMainCourse = :idMainCourse");
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':active', $active);
        $stmt->bindParam(':idCategory', $idCategory);
        $stmt->bindParam(':idMainCourse', $idMainCourse);
        $stmt->execute();

        // Close the statement
        $stmt = null;

        return true; // Return true on success
    } catch (PDOException $e) {
        // Log or handle the error
        return 'Error: ' . $e->getMessage(); // Return the error message
    }
}


/**-----------------------------------------------------------------
                Modifying a dessert in the database
*------------------------------------------------------------------**/
/**
 *  Modifying a dessert in the database
 * 
 * @param mixed $conn 
 * @param array $datas 
 * @return true 
 */
function updateDessertDB($conn, $datas)
{
    try {
        
        // Preparing data for insertion into the database
        $image_url = filterInputs($datas['image_url']);
        $title = filterInputs($datas['title']);
        $price = filterInputs($datas['price']);
        $description = filterInputs($datas['description']);
        $idCategory = filterInputs($datas['idCategory']);

        $content = nl2br($datas['content']);
        $content = preg_replace("/(<[a-zA-Z0-9=\"\/\ ]+>)<br \/>/", "$1", $content);
        $content = htmlentities($content);


        $idDessert = filterInputs($datas['idDessert']);

        // If we receive a value for the publication status of the article
        if (isset($datas['published_article']) && !empty($datas['published_article']))
            $active = $datas['published_article'];
        else
            $active = 0;

        // Insertion des données dans la table articles
        $req = $conn->prepare("UPDATE desserts SET image_url = :image_url, title = :title, description = :description, price = :price, content = :content, active = :active, idCategory = :idCategory WHERE idDessert = :idDessert");
        $req->bindParam(':image_url', $image_url);
        $req->bindParam(':title', $title);
        $req->bindParam(':price', $price);
        $req->bindParam(':description', $description);
        $req->bindParam(':content', $content);
        $req->bindParam(':active', $active);
        $req->bindParam(':idCategory', $idCategory);
        $req->bindParam(':idDessert', $idDessert);
        $req->execute();

        // Fermeture connexion
        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: updateDessertDB() function");
        }
        return false;
    }
}



/**-----------------------------------------------------------------
                    Deleting a starter from the database
*------------------------------------------------------------------**/
/**
 * Deleting a starter from the database
 * 
 * @param mixed $conn 
 * @return true 
 */
function deleteStarterDB($conn, $idStarter)
{
    try {

        $idStarter = filterInputs($idStarter);

        $req = $conn->prepare("DELETE FROM starters WHERE idStarter = :idStarter");
        $req->bindParam(':idStarter', $idStarter);
        $req->execute();

        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: deleteStarterDB() function");
        }
        return false;
    }
}

/**-----------------------------------------------------------------
                Deleting a main course from the database
*------------------------------------------------------------------**/
/**
 * Deleting a main course from the database
 * 
 * @param mixed $conn 
 * @param int $idMainCourse
 * @return bool 
 */
function deleteMainCourseDB($conn, $idMainCourse)
{
    try {
        
        $idMainCourse = filterInputs($idMainCourse);

       
        $req = $conn->prepare("DELETE FROM mainCourses WHERE idMainCourse = :idMainCourse");
        $req->bindParam(':idMainCourse', $idMainCourse, PDO::PARAM_INT);
        $req->execute();

        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: deleteMainCourseDB() function");
        }
        return false;
    }
}


/**-----------------------------------------------------------------
                Deleting a dessert from the database
*------------------------------------------------------------------**/

/**
 * Deleting a dessert from the database
 * 
 * @param mixed $conn 
 * @return true 
 */
function deleteDessertDB($conn, $idDessert)
{
    try {
        
        $idDessert = filterInputs($idDessert);

        $req = $conn->prepare("DELETE FROM desserts WHERE idDessert = :idDessert");
        $req->bindParam(':idDessert', $idDessert);
        $req->execute();

        $req = null;
        $conn = null;

        return true;
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            error_log('Error: ' . $e->getMessage());
        } else {
            error_log("Error in: deleteDessertDB() function");
        }
        return false;
    }
}


/**-----------------------------------------------------------------
    Function to fetch all categories from the database using PDO
 *------------------------------------------------------------------**/

function getAllCategoriesDB($pdo)
{
    // Initialize an array to store the categories
    $categories = [];

    try {
        // Prepare the SQL query to select all categories
        $query = "SELECT * FROM category";

        // Prepare the statement
        $statement = $pdo->prepare($query);

        // Execute the statement
        $statement->execute();

        // Fetch all categories as an associative array
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle any errors
        echo "Error: " . $e->getMessage();
    }

    // Return the categories
    return $categories;
}


/**-----------------------------------------------------------------
        Function to retrieve category names from the database
 *------------------------------------------------------------------**/


function getCategoryNamesFromDB($conn)
{
    $categories = array();

    try {
        // Assuming your SQL query to fetch category names
        $query = "SELECT idCategory, nameOfCategory FROM category";
        $stmt = $conn->query($query);

        // Check if the query executed successfully
        if ($stmt) {
            // Fetch associative array of category names
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }
        } else {
            // Handle query failure
            throw new Exception("Query failed: " . implode(", ", $conn->errorInfo()));
        }
    } catch (Exception $e) {
        // Handle exception
        error_log($e->getMessage());
    }

    return $categories;
}


