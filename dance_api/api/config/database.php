<?php

class Database {
    public $conn;
    public function getConnection($host, $db_name, $user_name, $password){
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=".$host.";dbname=".$db_name, $user_name, $password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception){
            echo "Connection error: ". $exception->getMessage();
        }
        return $this->conn;
    }
}

