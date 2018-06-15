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
        $query = "SELECT * FROM `groups`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


}