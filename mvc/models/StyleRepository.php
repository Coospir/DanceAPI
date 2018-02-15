<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.02.2018
 * Time: 16:11
 */
include "Style.php";

class StyleRepository {
    protected $db;
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    private function read($row){
        $result = new Style();
        $result->id_style = $row["id_style"];
        $result->name = $row["name"];
        return $result;
    }

    public function getAll(){
        $sql = "SELECT * FROM dance_style";
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchAll();
        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

}