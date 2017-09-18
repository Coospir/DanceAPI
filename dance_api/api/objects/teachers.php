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

    function create(){

        // query to insert record
        $query = "INSERT INTO" . $this->table_name . "SET surname=:surname, name=:name, patronymic=:patronymic, date_of_birth=:date_of_birth, phone_number=:phone_number, email=:email";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->surname=htmlspecialchars(strip_tags($this->surname));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->patronymic=htmlspecialchars(strip_tags($this->patronymic));
        $this->date_of_birth=htmlspecialchars(strip_tags($this->date_of_birth));
        $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
        $this->email=htmlspecialchars(strip_tags($this->email));

        // bind values
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":patronymic", $this->patronymic);
        $stmt->bindParam(":date_of_birth", $this->date_of_birth);
        $stmt->bindParam(":phone_number", $this->phone_number);
        $stmt->bindParam(":email", $this->email);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}