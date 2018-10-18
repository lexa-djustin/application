<?php

namespace Components;

class Auth
{
    public function login($email, $password)
    {
        $result = new AuthResult();
        // Prepare a select statement
        $sql = "SELECT id, name, email, password FROM users WHERE email = :email";

        if ($stmt = Db::getConnection()->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $email, \PDO::PARAM_STR);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {

                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];

                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;

                            // Redirect user to welcome page
                            $result->setStatus(1);

                            return $result;
                        } else {
                            // Display an error message if password is not valid
                            $result->addMessage('password', 'The password you entered was not valid.');
                        }
                    }
                } else {
                    // Display an error message if email doesn't exist
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
     * Logout user
     */
    public function logout()
    {
        // Initialize the session
        session_start();

// Unset all of the session variables
        $_SESSION = [];

// Destroy the session.
        session_destroy();

// Redirect to login page
        header("location: login.php");
        exit;
    }

}