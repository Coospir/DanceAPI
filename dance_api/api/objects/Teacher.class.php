<?php

class Teacher {
    private $conn;
    public $errors = [];
    public $data = [];
    public function __construct($db){
        $this->conn = $db;
    }

    //TODO: сделать нормальный метод для добавления ид_препода и ид_стиля в промежуточную
    public function ReadTeacher() {
        $query = "SELECT teachers.id_teacher, teachers.surname, teachers.name, teachers.patronymic, teachers.email, teachers.phone FROM teachers";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function CreateTeacher($surname, $name, $patronymic, $mail, $phone, $style) {
        $this->errors = [];
        $query = "INSERT INTO `teachers`(surname, name, patronymic, email, phone) VALUES (:surname, :name, :patronymic, :email, :phone)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
		$stmt->bindValue(":email", $mail);
        $stmt->bindValue(":phone", $phone);
		try {
			if($stmt->execute()){
                $this->data[] = 'Успешное создание сущности "Преподаватель"';
                echo json_encode($this->data);
			} else {
				$this->errors[] = 'Ошибка при создании сущности "Преподаватель": ' . $stmt->errorInfo();
				echo json_encode($this->errors);
			}
		} catch(Exception $e){
			echo 'Непредвиденная ошибка при создании сущности "Преподаватель": ' . $e->getMessage();
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

    //TODO: Не работает метод ShowCountTeachers() (см. в show_teachers.php)
	public function ShowCountTeachers(){
    	$query = "SELECT COUNT(*) FROM `teachers`";
    	$stmt = $this->conn->prepare($query);
    	if($stmt->execute()){
            $result = $stmt->fetchAll();
    		return $result[0][0];
		} else {
    		return false;
		}
	}

	public function ShowStyles() {
	    $query = "SELECT teachers.id_style, dance_style.id_style , dance_style.title FROM teachers, dance_style WHERE teachers.id_style = dance_style.id_style";
	    $stmt = $this->conn->prepare($query);
	    if($stmt->execute()){
	        $result = $stmt->fetchAll();
	        return $result;
        } else {
	        return false;
        }

    }

}
