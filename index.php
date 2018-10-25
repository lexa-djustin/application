<?php

use Components\Controllers;

session_start();

define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'Autoloader.php';

$uri = $_SERVER['REQUEST_URI'];

if (($pos = stripos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}

$page = 'index';
$parts = array_filter(explode('/', $uri), function ($part) {
    return !empty($part);
});

if (!empty($parts)) {
    $page = array_shift($parts);
}

switch ($page) {
    case 'login':
        $controller = new Controllers\Login();
        break;
    case 'logout':
        $controller = new Controllers\Logout();
        break;
    case 'register':
        $controller = new Controllers\Register();
        break;
    case 'form':
        $controller = new Controllers\Form();
        break;
    case 'admin-profile':
        $controller = new Controllers\AdminProfile();
        break;
    case 'admin-user':
        $controller = new Controllers\AdminUser();
        break;
    case 'excel':
        $controller = new Controllers\Excel();
        break;
    case 'index':
    default:
        $controller = new Controllers\Index();
}

if (!$controller->hasPermission()) {
    header('Location: login');
    exit();
}

echo $controller->execute();