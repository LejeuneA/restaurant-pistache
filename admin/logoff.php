<?php
    require_once('settings.php');
    
    // Logout script
    unset($_SESSION);
    setcookie(session_name(), '', time()-3600);
    session_destroy();

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

    // Launching the session
    session_start();

    // Set variable $_SESSION['IDENTIFY'] to false (no user logged in)
    $_SESSION['IDENTIFY'] = false;

    // Redirect to home page
    header('Location: admin-logoff.php');