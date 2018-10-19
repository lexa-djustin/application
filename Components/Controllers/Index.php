<?php

namespace Components\Controllers;

use Components\CalculatorDao;
use Components\Auth;

class Index extends ControllerAbstract
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
        $dao = new CalculatorDao();
        $forms = $dao->fetchAllUserForms(Auth::getAuth()['id']);

        $render = new \Renderer('templates/index', null, ['forms' => $forms]);
        return $this->layout($render->render());
    }
}