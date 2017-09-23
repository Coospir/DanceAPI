<?php

class Teacher {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    function readTeacher() {
        $query = "SELECT * FROM `teachers` ORDER BY `surname` DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }

    function createTeacher($surname, $name, $patronymic, $date_of_birth, $phone_number, $email){
        // query to insert record
        $query = "INSERT INTO `teachers`(surname, name, patronymic, date_of_birth, phone_number, email) VALUES (:surname, :name, :patronymic, :date_of_birth, :phone_number, :email)";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
        $stmt->bindValue(":date_of_birth", $date_of_birth);
        $stmt->bindValue(":phone_number", $phone_number);
        $stmt->bindValue(":email", $email);
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            var_dump($stmt->errorInfo());
            var_dump($date_of_birth);
            return false;
        }
    }

    function updateTeacher($id, $surname, $name, $patronymic, $date_of_birth, $phone_number, $email) {
        $query = "UPDATE `teachers` SET surname=:surname, name=:name, patronymic=:patronymic, date_of_birth=:date_of_birth, phone_number=:phone_number, email=:email WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
        $stmt->bindValue(":date_of_birth", $date_of_birth);
        $stmt->bindValue(":phone_number", $phone_number);
        $stmt->bindValue(":email", $email);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    function deleteTeacher($id) {
        $query = "DELETE FROM `teachers` WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

}