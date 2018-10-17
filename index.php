<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'PHPExcel/classes/PHPExcel.php';
require_once 'Autoloader.php';

$result = [];
$render = new Renderer('templates/main', null, ['data' => $result]);
echo $render->render();