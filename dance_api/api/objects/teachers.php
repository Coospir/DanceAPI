<?php

class Teacher {
    private $conn;
    private $table_name = "teachers";

    public $id;
    public $surname;
    public $name;
    public $patronymic;
    public $date_of_birth;
    public $phone_number;
    public $email;

    public function __construct($db){
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY `surname` DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }
}