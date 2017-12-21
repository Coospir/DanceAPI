<?php

class Teacher {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function ReadTeacher() {
        $query = "SELECT id_teacher, surname, name, patronymic, email, phone, style FROM `teachers`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function CreateTeacher($surname, $name, $patronymic, $mail, $phone, $style){
        $query = "INSERT INTO `teachers`(surname, name, patronymic, email, phone, style) VALUES (:surname, :name, :patronymic, :email, :phone, :style)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
		$stmt->bindValue(":email", $mail);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":style", $style);
        var_dump ($surname,$name,$patronymic,$mail,$phone,$style);
		try {
			if($stmt->execute()){
				echo 'Создание сущности "Преподаватель" успешно!';
				return true;
			}else{
				echo 'Ошибка при создании сущности "Преподаватель": ';
				echo $stmt->errorInfo();
				return false;
			}
		} catch(Exception $e){
			echo 'Ошибка при создании сущности "Преподаватель": ';
			echo $e->getMessage();
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
        $query = "DELETE FROM `teachers` WHERE id_teacher=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
		try {
			if($stmt->execute()){
				echo 'Удаление сущности "Преподаватель" c ID = '.$id.' прошло успешно!';
				return true;
			} else {
				echo 'Ошибка при удалении сущности "Преподаватель" с ID = '.$id.': ';
				echo $stmt->errorInfo();
				return false;
			}
		} catch(Exception $e){
			echo 'Ошибка при удалении сущности "Преподаватель" с ID = '.$id.':';
			echo $e->getMessage();
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
    	$query = "SELECT COUNT(*) FROM `teachers`";
    	$stmt = $this->conn->prepare($query);
		$result = $stmt->fetchAll();
    	if($stmt->execute()){
    		return $result;
		} else {
    		return false;
		}
	}

}
