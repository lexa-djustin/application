<?php

namespace Components\Controllers;

use Components\Auth;
use Components\Calculator;
use Components\EXCELBuilder;

class Form extends ControllerAbstract
{
    /**
     * @var array
     */
    protected $roles = ['user', 'admin'];

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        \Components\Registry::getInstance()->onlyRead = false;
        $calculatorDao = new \Components\CalculatorDao();
        $user = Auth::getAuth();
        $form = null;
        $data = [];

        if (!empty($_GET['id'])) {
            $userId = null;

            if ($user['role'] !== 'admin') {
                $userId = $user['id'];
            }

            $form = $calculatorDao->findByUserIdAndFormId($userId, $_GET['id']);
            \Components\Registry::getInstance()->onlyRead = $form && $form['submitted'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $calculator = new Calculator($_POST);
            $result = $calculator->calculate();

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($result);
                exit();
            }

            $data = array_merge($_POST, $result);

            if (isset($_POST['saveToXML'])) {
                unset($data['saveToXML']);
                $xmlBuilder = new EXCELBuilder($data);
                $xmlBuilder->toStream();
            }
            if (isset($_POST['saveToDb']) || isset($_POST['submit'])) {
                unset($data['saveToDb'], $data['submit']);
                $id = $form ? intval($form['id']) : null;
                $calculatorDao->save([
                    'data' => json_encode($data),
                    'user_id' => $user['id'],
                    'submitted' => !empty($_POST['submit']) ? 1 : 0,
                ], $id);

                header('Location: /calculator');
                exit();
            }
        } else if (!empty($_GET['id'])) {
            if ($form) {
                $data = json_decode($form['data'], true);
                $data = array_merge($data, $form);
            } else {
                header('Location: /calculator');
                exit();
            }
        }

        $labels = json_decode(file_get_contents(BASE_PATH . 'labels.json'), true);

        if (!is_array($labels)) {
            throw new \Exception('Error in the file "labels.json" structure');
        }

        $render = new \Renderer('templates/form', null, ['data' => $data, 'labels' => $labels]);
        return $this->layout($render->render());
    }
}