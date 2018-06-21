<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Event {
    private $conn;
    public $errors = [];
    public $data = [];

    public function __construct($db){
        $this->conn = $db;
    }

    public function ReadEvents() {
        $query = "SELECT events_teachers.id_event, events_teachers.id_teacher, events.id_event, events.name, events.date, events.price, teachers.id_teacher, teachers.surname as teacher_surname, teachers.name as teacher_name FROM events_teachers INNER JOIN events ON (events_teachers.id_event = events.id_event) INNER JOIN teachers ON (teachers.id_teacher = events_teachers.id_teacher)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }



}