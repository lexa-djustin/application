<?php

use Components\Controllers;

session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'PHPExcel/classes/PHPExcel.php';
require_once 'Autoloader.php';

$uri = $_SERVER['REQUEST_URI'];

if (($pos = stripos($uri, '?') )!== false) {
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
    case 'index':
    default:
        $controller = new Controllers\Index();
}

if (!$controller->hasPermission()) {
    header('Location: login');
    exit();
}

echo $controller->execute();