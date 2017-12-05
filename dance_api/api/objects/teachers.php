<?php

class Teacher {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function ReadTeacher() {
        $query = "SELECT * FROM `teachers` ORDER BY `surname` DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function CreateTeacher($surname, $name, $patronymic, $mail, $phone, $style, $id_user){
        $query = "INSERT INTO `teachers`(surname, name, patronymic, email, phone, style, id_user) VALUES (:surname, :name, :patronymic, :mail, :phone, :style, :id_user)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
		$stmt->bindValue(":email", $mail);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":style", $style);
        $stmt->bindValue(":id_user", $id_user);
        if($stmt->execute()){
            return true;
        }else{
            var_dump($stmt);
            return false;
        }
    }

    public function UpdateTeacher($id, $surname, $name, $patronymic, $phone_number, $email) {
        $query = "UPDATE `teachers` SET surname=:surname, name=:name, patronymic=:patronymic, phone_number=:phone_number, email=:email WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
        $stmt->bindValue(":phone_number", $phone_number);
        $stmt->bindValue(":email", $email);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function DeleteTeacher($id) {
        $query = "DELETE FROM `teachers` WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function DeleteAllTeachers() {
        $query = "TRUNCATE TABLE `teachers`";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

	public function ShowCountTeachers(){
    	$query = "SELECT COUNT(*) as count FROM `teachers`";
    	$stmt = $this->conn->prepare($query);
		$result = $stmt->fetchAll();
    	if($stmt->execute()){
    		return $result;
		} else {
    		return false;
		}
	}

}
