<?php

namespace Components\Controllers;

use Components\CalculatorDao;

class AdminProfile extends ControllerAbstract
{
    /**
     * @var array
     */
    protected $roles = ['admin'];

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        $dao = new CalculatorDao();
        $forms = $dao->fetchAllSubmittedForms();

        $render = new \Renderer('templates/admin-profile', null, ['forms' => $forms]);
        return $this->layout($render->render());
    }
}