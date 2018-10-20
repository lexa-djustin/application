<?php

namespace Components;

class Auth
{
    /**
     * @param string $email
     *
     * @param string $password
     * @return AuthResult
     */
    public function login($email, $password)
    {
        $result = new AuthResult();
        $sql = "SELECT id, name, email, password, role FROM users WHERE email = :email";

        if ($stmt = Db::getConnection()->prepare($sql)) {
            $stmt->bindParam(":email", $email, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {

                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["name"];
                        $email = $row["email"];
                        $role = $row["role"];
                        $hashed_password = $row["password"];

                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            $_SESSION["role"] = $role;

                            $result->setStatus(1);

                            return $result;
                        } else {
                            $result->addMessage('password', 'The password you entered was not valid.');
                        }
                    }
                } else {
                    $result->addMessage('email', 'No account found with that email.');
                }
            } else {
                throw Exception("Oops! Something went wrong. Please try again later.");
            }
        }

        unset($stmt);

        $result->setStatus(0);
        return $result;
    }

    /**
     * @return bool
     */
    public static function isAuth()
    {
        return !empty($_SESSION['id']);
    }

    /**
     * @return bool
     */
    public static function isAdmin()
    {
        return $_SESSION['role'] == 'admin';
    }

    /**
     * @return array
     */
    public static function getAuth()
    {
        if (!is_array($_SESSION)) {
            return [];
        }

        return $_SESSION;
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        header("location: login");
        exit;
    }

}