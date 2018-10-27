<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.10.2018
 * Time: 9:33
 */

namespace Components\Controllers;

use Components\User;

class AdminUser extends ControllerAbstract
{
    const ACTION_USER_CREATE = 'create';
    const ACTION_USER_SAVE = 'save';
    const ACTION_USER_DELETE = 'delete';
    const ACTION_USER_EDIT = 'edit';
    /**
     * @var array
     */
    protected $roles = ['admin'];

    /**
     * @var string
     */
    protected $layoutScript = 'templates/admin-layout';

    /**
     * @var string
     */
    protected $viewScript = 'templates/admin-user';

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        $user = new User();
        $errors = [];
        $params = [];
        $users = [];

        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == self::ACTION_USER_CREATE) {
                $this->viewScript = 'templates/admin-user-create';
                $this->layoutScript = 'templates/layout';
            } else if ($_REQUEST['action'] == self::ACTION_USER_EDIT) {
                $params = $user->findById($_GET['id']);
                $this->viewScript = 'templates/admin-user-create';
                $this->layoutScript = 'templates/layout';
            } elseif ($_REQUEST['action'] == self::ACTION_USER_DELETE) {
                $userId = $_GET['id'];
                if ($userId != 1) {
                    if ($user->delete($userId)) {
                        header('Location: /calculator/admin-user');
                    } else {
                        $errors[] = 'User can\'t be delete';
                    }
                } else {
                    $errors[] = 'Admin user can\'t be delete';
                }
            }
        }

        $users = $user->fetchAllUsers();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ? intval($_POST['id']) : null;

            $registerObject = new \Components\Register();

            $params['name'] = trim($_POST["name"]);
            if (empty($params['name'])) {
                $errors['name'] = "Please enter a username.";
            }

            $params['email'] = trim($_POST["email"]);
            if (empty($params['email'])) {
                $errors['email'] = "Please enter a email.";
            } elseif (!$id && $registerObject->isEmailExist(trim($_POST["email"]))) {
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

            // Check input errors before inserting in database
            if (empty($errors)) {
                unset($_POST['id']);

                $user->save($_POST, $id);
                header('Location: /calculator/admin-user');
                exit();
            }
        }


        $this->setLayoutScript($this->layoutScript);
        $render = new \Renderer($this->viewScript, null, ['errors' => $errors, 'params' => $params, 'users' => $users]);

        return $this->layout($render->render());
    }

}