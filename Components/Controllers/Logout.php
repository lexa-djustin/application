<?php

namespace Components\Controllers;

class Logout extends ControllerAbstract
{
    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        $loginObject = new \Components\Auth();
        $loginObject->logout();
    }
}