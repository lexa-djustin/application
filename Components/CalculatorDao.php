<?php

namespace Components;

use Components\Db;

class CalculatorDao
{

    /**
     * @param array $data
     */
    public function save(array $data)
    {
        if ($data['user_id']) {
            $row = $this->findByUserId($data['user_id']);
        } else {
            $row = null;
        }

        $now = date('Y-m-d H:i:s');

        if ($row) {
            $data['date_edited'] = $now;

            $query = 'UPDATE `calculator` SET ';

            foreach ($data as $name => $value) {
                $query .= "`{$name}` = :{$name},";
            }

            $query = rtrim($query, ',');
            $query .= ' WHERE user_id = :user_id';

            $stmt = Db::getConnection()->prepare($query);
        } else {
            $data['date_added'] = $data['date_edited'] = $now;
            $columns = array_keys($data);
            $query = 'INSERT INTO `calculator` ';
            $query .= "(`" . implode("`, `", $columns) . "`) ";
            $query .= 'VALUES ';
            $query .= "(:" . implode(", :", $columns) . ")";

            $stmt = Db::getConnection()->prepare($query);
            $stmt->bindParam('date_added', $data['date_added']);
        }

        $stmt->bindParam('date_edited', $data['date_edited']);
        $stmt->bindParam('user_id', $data['user_id'], \PDO::PARAM_INT);
        $stmt->bindParam('data', $data['data']);
        $stmt->bindParam('submitted', $data['submitted']);

        $stmt->execute();
    }

    /**
     * @param int $userId
     *
     * @return array|null
     */
    public function findByUserId($userId)
    {
        $query = 'SELECT * FROM calculator WHERE user_id = ?';
        $stmt = Db::getConnection()->prepare($query);
        $stmt->execute([$userId]);

        $result = $stmt->fetch();

        return $result ? $result : null;
    }
}