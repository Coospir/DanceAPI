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


    function createTeacher($surname, $name, $patronymic, $date_of_birth, $phone_number, $email, $style, $social_page, $passport, $about){
        $query = "INSERT INTO `teachers`(surname, name, patronymic, date_of_birth, phone_number, email, style, social_page, passport, about) VALUES (:surname, :name, :patronymic, :date_of_birth, :phone_number, :email, :style, :social_page, :passport, :about)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
        $stmt->bindValue(":date_of_birth", $date_of_birth);
        $stmt->bindValue(":phone_number", $phone_number);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":style", $style);
        $stmt->bindValue(":social_page", $social_page);
        $stmt->bindValue(":passport", $passport);
        $stmt->bindValue(":about", $about);
        if($stmt->execute()){
            return true;
        }else{
            var_dump($stmt);
            return false;
        }
    }

    function updateTeacher($id, $surname, $name, $patronymic, $date_of_birth, $phone_number, $email) {
        $query = "UPDATE `teachers` SET surname=:surname, name=:name, patronymic=:patronymic, date_of_birth=:date_of_birth, phone_number=:phone_number, email=:email WHERE id=:id";
        $stmt = $this->conn->prepare($query);
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

    function deleteAllTeachers() {
        $query = "TRUNCATE TABLE `teachers`";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

}