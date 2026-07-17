<?php

require_once __DIR__ . '/settings.php';

destroyUserSession();

header('Location: ' . rtrim(DOMAIN, '/') . '/admin/login.php');
exit();
