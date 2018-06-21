<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Group {
    private $conn;
    public $errors = [];
    public $data = [];

    public function __construct($db){
        $this->conn = $db;
    }

    public function ReadGroups() {
        $query = "SELECT groups.id_group, groups.name as group_name, groups.level, groups.training_duration, groups.price, teachers_groups.id_group, teachers.id_teacher, teachers.surname as teacher_surname, teachers.name as teacher_name FROM groups LEFT JOIN teachers_groups ON(groups.id_group = teachers_groups.id_group) LEFT JOIN teachers ON(teachers.id_teacher = teachers_groups.id_teacher)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function CreateGroup($name, $level, $training_duration, $price, $teacher) {
        $this->errors = [];
        $result = false;
        try {
            $query = "INSERT INTO `groups`(name, level, training_duration, price) VALUES(:name, :level, :training_duration, :price)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":level", $level);
            $stmt->bindValue(":training_duration", $training_duration);
            $stmt->bindValue(":price", $price);
            if($stmt->execute()) {
                $id = $this->conn->lastInsertId();
                $query_groups = "INSERT INTO `teachers_groups`(id_teacher, id_group) VALUES(:id_teacher, :id_group)";
                $stmt = $this->conn->prepare($query_groups);
                $stmt->bindValue(":id_teacher", $teacher);
                $stmt->bindValue(":id_group", $id);
                if($stmt->execute()) {
                    $this->data[] = 'Группа создана!';
                    $result = true;
                } else {
                    $this->errors[] = 'Ошибка при создании группы: ' . $stmt->errorInfo();
                }
            } else {
                $this->errors[] = 'Ошибка при создании группы: ' . $stmt->errorInfo();
            }
        } catch(Exception $e){
            $this->errors[] = 'Непредвиденная ошибка при создании группы -> ' . $e->getMessage();
        }
        return $result;
    }

    public function DeleteGroup($id) {
        $query = "DELETE FROM `groups` WHERE id_group=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        try {
            if($stmt->execute()){
                $this->data[] = 'Удаление группы прошло успешно!';
                return true;
            } else {
                $this->errors[] = 'Ошибка при удалении группы: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e){
            $this->errors[] = 'Непредвиденная ошибка при удалении группы:'.$e->getMessage();
            return false;
        }
    }

    public function DeleteAllGroups() {
        $query = "DELETE FROM `groups`";
        $stmt = $this->conn->prepare($query);
        try {
            if($stmt->execute()) {
                $this->data[] = 'Очистка списка групп прошло успешно!';
                return true;
            } else {
                $this->errors = 'Ошибка при очистке списка групп: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e) {
            $this->errors[] = 'Ошибка очистки списка групп: ' .$e->getMessage();
            return false;
        }
    }

    public function ShowCountGroups(){
        $query = "SELECT COUNT(*) FROM `groups`";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            return $result[0][0];
        } else {
            return false;
        }
    }


}