<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
class Teacher {
    private $conn;
    public $errors = [];
    public $data = [];
    public function __construct($db){
        $this->conn = $db;
    }

    //TODO: выбрать данные о преподавателе и взять данные из промежуточной
    public function ReadTeacher() {
        $query = "SELECT * FROM `teachers`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function CreateTeacher($surname, $name, $patronymic, $mail, $phone, array $styles) {
        $this->errors = [];
		try {
            $query = "INSERT INTO `teachers`(surname, name, patronymic, email, phone) VALUES(:surname, :name, :patronymic, :email, :phone)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":surname", $surname);
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":patronymic", $patronymic);
            $stmt->bindValue(":email", $mail);
            $stmt->bindValue(":email", $mail);
            $stmt->bindValue(":phone", $phone);
			if($stmt->execute()){
                $id = $this->conn->lastInsertId();
                $query_styles = "INSERT INTO `styles_teachers`(id_style, id_teacher) VALUES";
                $flag = true;
                foreach($styles as $s) {
                    if(!$flag) {
                        $query_styles .= ",";
                    }
                    $query_styles .= "(".(int)$s.", ".$id.")";
                    $flag = false;
                }
                $this->conn->query($query_styles);
                $this->data[] = 'Успешное создание сущности "Преподаватель"';
                echo json_encode($this->data);
			} else {
				$this->errors[] = 'Ошибка при создании сущности "Преподаватель": ' . $stmt->errorInfo();
				echo json_encode($this->errors);
			}
		} catch(Exception $e){
			echo 'Непредвиденная ошибка при создании сущности "Преподаватель" -> ' . $e->getMessage();
            echo json_encode($this->errors);
		}
    }

    public function UpdateTeacher($surname, $name, $patronymic, $phone, $email) {
        $query = "UPDATE `teachers` SET surname = :surname, name = :name, patronymic = :patronymic, email = :email, phone = :phone WHERE surname ='".$surname."' AND name = '".$name."' AND patronymic = '".$patronymic."' AND email = '".$email."' AND phone = '".$phone."'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":email", $email);
        try {
            if($stmt->execute()){
                $this->data[] = 'Успешное изменение информации!';
                echo json_encode($this->data);
            } else {
                $this->errors[] = 'Ошибка при изменении: ' . $stmt->errorInfo();
                echo json_encode($this->errors);
            }
        } catch(Exception $e){
            echo 'Непредвиденная ошибка при изменении информации: ' . $e->getMessage();
            echo json_encode($this->errors);
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
