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
            $form = $calculatorDao->findByUserIdAndFormId($user['id'], $_GET['id']);
            \Components\Registry::getInstance()->onlyRead = $form && $form['submitted'];
        }

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
                $id = $form ? intval($form['id']) : null;
                $calculatorDao->save([
                    'data' => json_encode($data),
                    'user_id' => $user['id'],
                    'submitted' => !empty($_POST['submit']) ? 1 : 0,
                ], $id);

                header('Location: /');
                exit();
            }
        } else if (!empty($_GET['id'])) {
            if ($form) {
                $data = json_decode($form['data'], true);
                $data = array_merge($data, $form);
            } else {
                header('Location: /');
                exit();
            }
        }

        $render = new \Renderer('templates/form', null, ['data' => $data]);
        return $this->layout($render->render());
    }
}