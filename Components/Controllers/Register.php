<?php

namespace Components\Controllers;

class Register extends ControllerAbstract
{
    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        $errors = $params = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $registerObject = new \Components\Register();
            $errors = [];
            $params = [];

            $params['username'] = trim($_POST["username"]);
            if (empty($params['username'])) {
                $errors['username'] = "Please enter a username.";
            }

            $params['email'] = trim($_POST["email"]);
            if (empty($params['email'])) {
                $errors['email'] = "Please enter a email.";
            } elseif ($registerObject->isEmailExist(trim($_POST["email"]))) {
                $errors['email'] = "This email is already taken.";
            }

            $params['department'] = trim($_POST["department"]);
            if (empty($params['department'])) {
                $errors['department'] = "Please enter a department.";
            }

            $params['password'] = trim($_POST["password"]);
            if (empty($params['password'])) {
                $errors['password'] = "Please enter a password.";
            } elseif (strlen($params['password']) < 6) {
                $errors['password'] = "Password must have atleast 6 characters.";
            }

            $params['confirm_password'] = trim($_POST["confirm_password"]);
            if (empty($params['confirm_password'])) {
                $errors['confirm_password'] = "Please confirm password.";
            } else {
                if (empty($errors['confirm_password']) && ($params['password'] != $params['confirm_password'])) {
                    $errors['confirm_password'] = "Password did not match.";
                }
            }

            // Check input errors before inserting in database
            if (empty($errors)) {
                $result = $registerObject->register($params);
                if ($result->getStatus() == 1) {
                    header("location: calculator/login");
                    exit();
                } else {
                    $errors = $result->getMessages();
                }
            }
        }

        $render = new \Renderer('templates/register', null, ['errors' => $errors, 'params' => $params]);
        return $this->layout($render->render());
    }
}