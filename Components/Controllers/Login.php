<?php

namespace Components\Controllers;

class Login extends ControllerAbstract
{
    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        $redirectTo = '/calculator/';

        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("location: {$redirectTo}");
            exit;
        }

        $errors = [];
        $email = $password = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty(trim($_POST["email"]))) {
                $errors['email'] = "Please enter email.";
            } else {
                $email = trim($_POST["email"]);
            }

            // Check if password is empty
            if (empty(trim($_POST["password"]))) {
                $errors['password'] = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);
            }

            if (empty($errors)) {
                $loginObject = new \Components\Auth();
                $result = $loginObject->login($email, $password);

                if ($result->getStatus() == 1) {
                    if (\Components\Auth::getAuth()['role'] === 'admin') {
                        $redirectTo = 'admin-profile';
                    }

                    header("location: {$redirectTo}");
                    exit();
                } else {
                    $errors = $result->getMessages();
                }
            }
        }

        $render = new \Renderer('templates/login', null, ['errors' => $errors, 'email' => $email]);
        return $this->layout($render->render());
    }
}