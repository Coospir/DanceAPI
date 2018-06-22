<?php

class Shedule {
    private $conn;
    public $errors = [];
    public $data = [];

    public function __construct($db){
        $this->conn = $db;
    }

    public function ReadShedule() {
        $query = "SELECT shedule.id_shedule, shedule.date, shedule.time, shedule.place, shedule.id_group, groups.id_group, groups.name as group_name, groups.level, groups.training_duration as training_duration, groups.price, teachers_groups.id_group, teachers.id_teacher, teachers.surname as teacher_surname, teachers.name as teacher_name FROM shedule RIGHT JOIN groups ON(shedule.id_group = groups.id_group) LEFT JOIN teachers_groups ON(groups.id_group = teachers_groups.id_group) INNER JOIN teachers ON(teachers.id_teacher = teachers_groups.id_teacher) GROUP BY shedule.date";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function CreateTraining() {

    }

    public function DeleteTraining($id) {

    }

    public function DeleteShedule() {

    }

    public function ShowCountTrainings(){
        $query = "SELECT COUNT(*) FROM `shedule`";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            return $result[0][0];
        } else {
            return false;
        }
    }
}