<?php

namespace Components;

use Components\Db;

class CalculatorDao
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
     * @param int $formId
     *
     * @return array|null
     */
    public function findByUserIdAndFormId($userId, $formId)
    {
        $query = 'SELECT * FROM calculator WHERE user_id = ? AND id = ?';
        $stmt = Db::getConnection()->prepare($query);
        $stmt->execute([$userId, $formId]);

        $result = $stmt->fetch();
        return $result ? $result : null;
    }

    /**
     * @param int $userId
     * @return array
     */
    public function fetchAllUserForms($userId)
    {
        $query = 'SELECT * FROM calculator WHERE user_id = ?';

        $stmt = Db::getConnection()->prepare($query);
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    /**
     * @param int $id
     *
     * @return array|null
     */
    public function findById($id)
    {
        $query = 'SELECT * FROM calculator WHERE id = ?';
        $stmt = Db::getConnection()->prepare($query);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result ? $result : null;
    }
}