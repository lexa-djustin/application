<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 20.10.2018
 * Time: 9:37
 */

namespace Components;

use Components\Db;

class User
{

    /**
     * @param array $data
     * @param int $id
     */
    public function save(array $data, $id = null)
    {
        if ($id) {
            $row = $this->findById($id);
        } else {
            $row = null;
        }


        if ($row) {
            $query = 'UPDATE `users` SET ';

            foreach ($data as $name => $value) {
                $query .= "`{$name}` = :{$name},";
            }

            $query = rtrim($query, ',');
            $query .= ' WHERE id = :id';

            $stmt = Db::getConnection()->prepare($query);
            $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        } else {
            $columns = array_keys($data);
            $query = 'INSERT INTO `users` ';
            $query .= "(`" . implode("`, `", $columns) . "`) ";
            $query .= 'VALUES ';
            $query .= "(:" . implode(", :", $columns) . ")";

            $stmt = Db::getConnection()->prepare($query);
        }

        $stmt->bindParam('name', $data['name'], \PDO::PARAM_INT);
        $stmt->bindParam('email', $data['email'], \PDO::PARAM_INT);
        $stmt->bindParam('department', $data['department'], \PDO::PARAM_INT);
        $stmt->bindParam('role', $data['role']);
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt->bindParam('password', $passwordHash);

        $stmt->execute();
    }

    /**
     * @param int $id
     *
     * @return array|null
     */
    public function findById($id)
    {
        $query = 'SELECT * FROM users WHERE id = ?';
        $stmt = Db::getConnection()->prepare($query);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result ? $result : null;
    }

    /**
     * Get all users
     * @return array
     */
    public function fetchAllUsers()
    {
        $query = 'SELECT * FROM users';

        $stmt = Db::getConnection()->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Delete user
     *
     * @param $id
     */
    public function delete($id)
    {
        $query = 'DELETE FROM users';
        $query .= ' WHERE id = :id';

        $stmt = Db::getConnection()->prepare($query);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}