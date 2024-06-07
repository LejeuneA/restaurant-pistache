<?php
    // Application constants
    const APP_NAME = "Restaurant Pistache";
    const APP_VERSION = 'v1.0.0';
    const APP_UPDATED = '15-05-2024 08:30';
    const APP_AUTHOR = 'Açelya Lejeune';
       
    // DEBUG mode activation/deactivation constant
    const DEBUG = false;

    // Site URL constant
    const DOMAIN = 'http://localhost/restaurant-pistache';

    // Loads DB connection credentials
    require_once('conf/conf-db.php');

    // Session / session cookie configuration
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

    // Session launch
    session_start();
    
    // Set variable $_SESSION['IDENTIFY'] to false (no user logged in)
    if (!isset($_SESSION['IDENTIFY'])) {
        $_SESSION['IDENTIFY'] = false;
    }
   
    // Loading function files
    require_once('app/functions/fct-db.php');
    require_once('app/functions/fct-ui.php');
    require_once('app/functions/fct-tools.php');

    // Instantiate a connection object
    $conn = connectDB(SERVER_NAME, USER_NAME, USER_PWD, DB_NAME);



    
    