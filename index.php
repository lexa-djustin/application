<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'PHPExcel/classes/PHPExcel.php';
require_once 'Autoloader.php';

$data = [];

\Components\Registry::getInstance()->onlyRead = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calculator = new Calculator($_POST);
    $result = $calculator->calculate();
    $data = array_merge($_POST, $result);

    if (isset($_POST['saveToXML'])) {
        unset($data['saveToXML']);
        $xmlBuilder = new EXCELBuilder($data);
        $xmlBuilder->createFile();
    }
    if (isset($_POST['saveToDb']) || isset($_POST['submit'])) {
        $calculatorDao = new \Components\CalculatorDao();
        $calculatorDao->save([
            'data' => json_encode($_POST),
            'user_id' => 1,
            'submitted' => !empty($_POST['submit']) ? 1 : 0,
        ]);
    }
}

$render = new Renderer('templates/main', null, ['data' => $data]);
echo $render->render();