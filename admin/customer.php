<?php

require_once __DIR__ . '/settings.php';

requireLogin();

header('Location: ' . rtrim(DOMAIN, '/') . '/admin/manager.php');
exit();
