<?php

namespace Components\Controllers;

class Index extends ControllerAbstract
{
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

        $data = [];

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
                $calculatorDao->save([
                    'data' => json_encode($data),
                    'user_id' => $_SESSION['id'],
                    'submitted' => !empty($_POST['submit']) ? 1 : 0,
                ]);

                header('Location: index.php');
                exit();
            }
        } else if (!empty($_SESSION['id'])) {
            $row = $calculatorDao->findByUserId($_SESSION['id']);

            if ($row) {
                $data = json_decode($row['data'], true);
            }
        }

        $render = new \Renderer('templates/main', null, ['data' => $data]);
        return $this->layout($render->render());
    }
}