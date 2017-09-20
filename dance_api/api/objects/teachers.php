<?php

class Teacher {
    private $conn;
    private $table_name = "teachers";

    public function __construct($db){
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY `surname` DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }

    function createTeacher($surname, $name, $patronymic, $date_of_birth, $phone_number, $email){
        // query to insert record
        $query = "INSERT INTO `teachers`(surname, name, patronymic, date_of_birth, phone_number, email) VALUES (:surname, :name, :patronymic, :date_of_birth, :phone_number, :email)";
        // prepare query
        print_r($surname);
        $stmt = $this->conn->prepare($query);

        print_r($stmt);
        // bind values
        $stmt->bindValue(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
        $stmt->bindValue(":date_of_birth", $date_of_birth);
        $stmt->bindValue(":phone_number", $phone_number);
        $stmt->bindValue(":email", $email);
    // execute query
        print_r($stmt);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}