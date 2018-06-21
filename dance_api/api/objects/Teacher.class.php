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
        $query = "SELECT GROUP_CONCAT( dance_style.title ) as style, styles_teachers.id_teacher, teachers.id_teacher, teachers.surname, teachers.name, teachers.patronymic, teachers.email, teachers.phone FROM dance_style  RIGHT JOIN styles_teachers ON ( dance_style.id_style = styles_teachers.id_style ) RIGHT JOIN teachers ON ( teachers.id_teacher = styles_teachers.id_teacher ) GROUP BY teachers.id_teacher";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function CreateTeacher($surname, $name, $patronymic, $mail, $phone, array $styles) {
        $this->errors = [];
        $result = false;
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
                $this->data[] = 'Преподаватель создан!';
                $result=true;
            } else {
                $this->errors[] = 'Ошибка при создании преподавателя: ' . $stmt->errorInfo();
            }
        } catch(Exception $e){
            $this->errors[] = 'Непредвиденная ошибка при создании преподавателя -> ' . $e->getMessage();
        }
        return $result;
    }

    // При нажатии на кнопку удалить все связаные стили у преподаваетеля из промежуточной таблицы и вставить
    public function UpdateTeacher($id_teacher, $surname, $name, $patronymic, $email, $phone, array $styles) {
        $this->errors = [];
        $bool = false;

        $query = "UPDATE `teachers` SET id_teacher = :id_teacher, surname = :surname, name = :name, patronymic = :patronymic, email = :email, phone = :phone WHERE id_teacher =:id_teacher";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id_teacher", $id_teacher);
        $stmt->bindValue(":surname", $surname);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":patronymic", $patronymic);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":phone", $phone);
        try {
            if($stmt->execute()){
                $this->data[] = "Успешное изменение данных преподавателя №". $id_teacher;
                echo json_encode($this->data);
            } else {
                $this->errors[] = "Ошибка при изменении данных у преподавателя ". $id_teacher." : " . $stmt->errorInfo();
                echo json_encode($this->errors);
            }
        } catch(Exception $e){
            echo "Ошибка при изменении данных у преподавателя ". $id_teacher." : " . $e->getMessage();
            echo json_encode($this->errors);
        }

        var_dump($id_teacher);
        $query_delete = "DELETE FROM `styles_teachers` WHERE styles_teachers.id_teacher = :id";
        $stmt = $this->conn->prepare($query_delete);
        $stmt->bindValue(":id", $id_teacher);
        try {
            if($stmt->execute()){
                $this->data[] = "Успешное удаление совпадающих стилей у преподавателя ". $id_teacher ." информации!";
                echo json_encode($this->data);
            } else {
                $this->errors[] = "Ошибка при удалении совпадающих стилей у преподавателя ". $id_teacher." : " . $stmt->errorInfo();
                echo json_encode($this->errors);
            }
        } catch(Exception $e){
            echo "Ошибка при удалении совпадающих стилей у преподавателя ". $id_teacher." : " . $e->getMessage();
            echo json_encode($this->errors);
        }

        try {
            $query_styles = "INSERT INTO `styles_teachers`(id_style, id_teacher) VALUES";
            $flag = true;
            foreach($styles as $s) {
                if(!$flag) {
                    $query_styles .= ",";
                }
                var_dump($s);
                $query_styles .= "(".(int)$s.", ".$id_teacher.")";
                $flag = false;
            }
            $this->conn->query($query_styles);
            $bool = true;
            $this->data[] = "Информация о преподавателе изменена!";
            echo json_encode($this->data);
        } catch(Exception $e){
            echo 'Ошибка при изменении информации: ' . $e->getMessage();
            echo json_encode($this->errors);
        }

        return $bool;


    }

    public function DeleteTeacher($id) {
        $query = "DELETE FROM `teachers` WHERE id_teacher=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        try {
            if($stmt->execute()){
                $this->data[] = 'Удаление преподавателя прошло успешно!';
                return true;
            } else {
                $this->errors[] = 'Ошибка при удалении преподавателя: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e){
            $this->errors[] = 'Ошибка при удалении преподавателя:'.$e->getMessage();
            return false;
        }
    }

    public function DeleteAllTeachers() {
        $query = "DELETE FROM `teachers`";
        $stmt = $this->conn->prepare($query);
        try {
            if($stmt->execute()) {
                $this->data[] = 'Очистка списка преподавателей прошло успешно!';
                return true;
            } else {
                $this->errors = 'Ошибка при очистке списка преподавателей: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e) {
            $this->errors[] = 'Ошибка очистки списка преподавателей: ' .$e->getMessage();
            return false;
        }
    }

    //TODO: Не работает метод ShowCountTeachers() (см. в read_teachers.php)
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
