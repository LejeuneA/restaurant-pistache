<?php
    // Constantes de l'application
    const APP_NAME = "Restaurant Pistache";
    const APP_VERSION = 'v1.0.0';
    const APP_UPDATED = '15-05-2024 08:30';
    const APP_AUTHOR = 'Açelya Lejeune';
       
    // Constante d'activation/désactivation du mode DEBUG
    const DEBUG = false;

    // Constante de l'URL du site
    const DOMAIN = 'http://localhost/restaurant-pistache';

    // Charge les credentials de connexion à la DB
    require_once('conf/conf-db.php');

    // Configuration de la session / du cookie de session
    $name = session_name(str_replace(' ', '', APP_NAME).'_session');
    $domain = $_SERVER['HTTP_HOST'];
    $time = time() + 3600; 

    setcookie($name, APP_NAME, [
        'expires' => $time,
        'path' => '/',
        'domain' => $domain,
        'secure' => false,
        'httponly' => true,
        'samesite' => 'strict',
    ]);

    // Lancement de la session
    session_start();
    
    // Initialisation de la variable $_SESSION['IDENTIFY'] à false (pas d'utilisateur connecté)
    if (!isset($_SESSION['IDENTIFY'])) {
        $_SESSION['IDENTIFY'] = false;
    }
   
    // Chargement des fichiers de fonctions
    require_once('app/functions/fct-db.php');
    require_once('app/functions/fct-ui.php');
    require_once('app/functions/fct-tools.php');

    // Instancier un objet de connexion
    $conn = connectDB(SERVER_NAME, USER_NAME, USER_PWD, DB_NAME);



    
    