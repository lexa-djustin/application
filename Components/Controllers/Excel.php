<?php

namespace Components\Controllers;

use Components\EXCELBuilder;
use Components\CalculatorDao;

class Excel extends ControllerAbstract
{
    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        $calculatorDao = new \Components\CalculatorDao();
        $form = $calculatorDao->findByUserIdAndFormId(null, $_GET['id']);

        if (!$form) {
            header('Location: /admin-profile');
            exit();
        }

        $data = json_decode($form['data'], true);

        if (!is_array($data)) {
            header('Location: /admin-profile');
            exit();
        }

        $xmlBuilder = new EXCELBuilder($data);
        $xmlBuilder->toStream();
    }
}