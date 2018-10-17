<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'PHPExcel/classes/PHPExcel.php';
require_once 'Autoloader.php';

$result = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calculator = new Calculator($_POST);
    $result = $calculator->calculate();
}

$render = new Renderer('templates/main', null, ['data' => $result]);
echo $render->render();