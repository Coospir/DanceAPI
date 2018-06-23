<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Event {
    private $conn;
    public $errors = [];
    public $success = [];
    public $data = [];

    public function __construct($db){
        $this->conn = $db;
    }

    public function ReadEvents() {
        $query = "SELECT events_teachers.id_event, events_teachers.id_teacher, events.id_event, events.name, events.date, events.price, teachers.id_teacher, teachers.surname as teacher_surname, teachers.name as teacher_name FROM events_teachers RIGHT JOIN events ON (events_teachers.id_event = events.id_event) LEFT JOIN teachers ON (teachers.id_teacher = events_teachers.id_teacher)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function CreateEvent($name, $date, $id_teacher, $price) {
        $this->errors = [];
        $result = false;
        try {
            $query = "INSERT INTO `events`(name, date, price) VALUES(:name, :date, :price)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":date", $date);
            $stmt->bindValue(":price", $price);
            if($stmt->execute()) {
                $id_event = $this->conn->lastInsertId();
                var_dump("ID event: ".$id_event);
                var_dump("ID teacher: ".$id_teacher);
                $events_teachers = "INSERT INTO `events_teachers`(id_event, id_teacher) VALUES(:event, :teacher)";
                $stmt = $this->conn->prepare($events_teachers);
                $stmt->bindValue(":event", $id_event);
                $stmt->bindValue(":teacher", $id_teacher);
                $stmt->execute();
                $this->data[] = 'Событие создано!';
                $result = true;
            } else {
                $this->errors[] = 'Ошибка при создании события: ' . $stmt->errorInfo();
                $result = false;
            }
        } catch(Exception $e) {
            $this->errors[] = 'Непредвиденная ошибка при создании события -> ' . $e->getMessage();
        }
        return $result;
    }

    public function DeleteEvent($id) {
        $query = "DELETE FROM `events` WHERE id_event=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        try {
            if($stmt->execute()){
                $this->data[] = 'Удаление события прошло успешно!';
                return true;
            } else {
                $this->errors[] = 'Ошибка при удалении события: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e){
            $this->errors[] = 'Ошибка при удалении события: '.$e->getMessage();
            return false;
        }
    }

    public function DeleteAllEvents() {
        $query = "DELETE FROM `events`";
        $stmt = $this->conn->prepare($query);
        try {
            if($stmt->execute()) {
                $this->data[] = 'Очистка списка событий прошло успешно!';
                return true;
            } else {
                $this->errors = 'Ошибка при очистке списка событий: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e) {
            $this->errors[] = 'Ошибка очистки списка событий: ' .$e->getMessage();
            return false;
        }
    }

    public function signUpEvent($surname, $name, $event, $email, $phone) {
        if($this->isValidSignUpEvent($surname, $name, $event, $email, $phone)){
            try {
                $query = "INSERT INTO `reg_events`(surname, name, id_event, email, phone) VALUES (:surname, :name, :event, :email, :phone)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(":surname", $surname);
                $stmt->bindValue(":name", $name);
                $stmt->bindValue(":event", $event);
                $stmt->bindValue(":email", $email);
                $stmt->bindValue(":phone", $phone);
                $stmt->execute();
            } catch(Exception $e) {
                $this->errors[] = 'Error: ' . $e->getMessage();
            }
        }
    }

    public function ShowCountEvents(){
        $query = "SELECT COUNT(*) FROM `events`";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            return $result[0][0];
        } else {
            return false;
        }
    }

    public function isValidSignUpEvent($surname, $name, $event, $email, $phone) {
        $this->errors = [];
        $this->success = [];

        if($surname == '') {
            $this->errors['surname'] = 'Введите корректную фамилию!';
        }

        if($name == '') {
            $this->errors['name'] = 'Введите корректное имя!';
        }

        if($event == null) {
            $this->errors['id_event'] = 'Не выбрано событие для записи!';
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors['email'] = 'Введите корректный E-Mail!';
        }

        if($phone == '') {
            $this->errors['phone'] = 'Введите корректный контактный телефон!';
        }

        if(empty($this->errors)){
            $this->success['message'] = 'Вы успешно записались на событие!';
        }
        return empty($this->errors);
    }

}