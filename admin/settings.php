<?php

// Application constants
const APP_NAME = 'Restaurant Pistache';
const APP_VERSION = 'v1.0.0';
const APP_UPDATED = '15-05-2024 08:30';
const APP_AUTHOR = 'Açelya Lejeune';
const DEBUG = false;

// Build a root-relative site URL so the project works both in a subfolder
// on XAMPP and at the document root on production hosting.
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$basePath = preg_replace('#/(?:admin|public|forms)/[^/]+$#', '', $scriptName);

if (!is_string($basePath) || $basePath === $scriptName || $basePath === '/') {
    $basePath = '';
}

define('DOMAIN', rtrim($basePath, '/'));

require_once __DIR__ . '/conf/conf-db.php';
require_once __DIR__ . '/app/functions/fct-db.php';
require_once __DIR__ . '/app/functions/fct-ui.php';
require_once __DIR__ . '/app/functions/fct-tools.php';

// Start one secure, portable session for all admin pages.
if (session_status() === PHP_SESSION_NONE) {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

    session_name(str_replace(' ', '', APP_NAME) . '_session');
    session_set_cookie_params([
        'lifetime' => 3600,
        'path' => DOMAIN !== '' ? DOMAIN . '/' : '/',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

if (!isset($_SESSION['IDENTIFY'])) {
    $_SESSION['IDENTIFY'] = false;
}

$conn = connectDB(SERVER_NAME, USER_NAME, USER_PWD, DB_NAME);
