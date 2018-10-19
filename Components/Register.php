<?php

namespace Components;

class Register
{
    const DEFAULT_ROLE = 'user';

    /**
     * Check if user with email already exist
     *
     * @param $email
     * @return bool
     */
    public function isEmailExist($email)
    {
        $sql = "SELECT id FROM users WHERE email = :email";

        if ($stmt = Db::getConnection()->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $email, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    return true;
                }
            } else {
                throw Exception("Oops! Something went wrong. Please try again later.");
            }
        }

        unset($stmt);
        return false;
    }

    /**
     * Register new user
     * @param $params
     * @return RegisterResult
     */
    public function register($params)
    {
        $result = new RegisterResult();

        $sql = "INSERT INTO users (name, department, email, password, role)
                VALUES (:username, :department, :email, :password, :role)";

        if ($stmt = DB::getConnection()->prepare($sql)) {
            $passwordHash = password_hash($params['password'], PASSWORD_DEFAULT);

            $stmt->bindParam(":username", $params['username'], \PDO::PARAM_STR);
            $stmt->bindParam(":department", $params['department'], \PDO::PARAM_STR);
            $stmt->bindParam(":email", $params['email'], \PDO::PARAM_STR);
            $stmt->bindParam(":password", $passwordHash, \PDO::PARAM_STR);

            if (empty($params['role'])) {
                $params['role'] = self::DEFAULT_ROLE;
            }

            $stmt->bindParam(":role", $params['role'], \PDO::PARAM_STR);

            if ($stmt->execute()) {
                $result->setStatus(1);

                return $result;
            } else {
                $result->addMessage('other', "Something went wrong. Please try again later.");
            }
        }

        unset($stmt);
        $result->setStatus(0);

        return $result;
    }
}