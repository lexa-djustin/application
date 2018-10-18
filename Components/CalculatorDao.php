<?php

namespace Components;

use Components\Db;

class CalculatorDao{

    public function save(array $data, $id = null)
    {
        $now = date('Y-m-d H:i:s');

        if($id > 0){
            $data['date_edited'] = $now;
        }else{
            $data['date_added'] = $data['date_edited'] = $now;
            $columns = array_keys($data);
            $query = 'INSERT INTO `calculator` ';
            $query .= "(`" . implode("`, `", $columns) . "`) ";
            $query .= 'VALUES ';
            $query .= "(:" . implode(", :", $columns) . ")";

            $stmt = Db::getConnection()->prepare($query);
            $stmt->bindParam('date_added',$data['date_added']);
            $stmt->bindParam('date_edited',$data['date_edited']);
            $stmt->bindParam('user_id',$data['user_id'], \PDO::PARAM_INT);
            $stmt->bindParam('data',$data['data']);
            $stmt->bindParam('submitted',$data['submitted']);
        }

        $stmt->execute();
    }

}