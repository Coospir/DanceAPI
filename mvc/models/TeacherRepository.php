<?php

/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/

include "Teacher.php";

class TeacherRepository {
    protected $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    private function read($row){
        $result = new Teacher();
        $result->id = $row["id_teacher"];
        $result->surname = $row["surname"];
        $result->name = $row["name"];
        $result->patronymic = $row["patronymic"];
        $result->email = $row["email"];
        $result->phone = $row["phone"];
        $result->id_style = $row["id_style"];
        return $result;
    }

    public function getById($id){
        $sql = "SELECT * FROM teachers WHERE id_teacher=:id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
        $rows = $q->fetchAll();
        return $this->read($rows);
    }

    public function getAll($filter) {
        $surname = "%" . $filter["surname"] . "%";
        $name = "%" . $filter["name"] . "%";
        $patronymic = "%" . $filter["patronymic"] . "%";
        $email = "%" . $filter["email"] . "%";
        $phone = "%" . $filter["phone"] . "%";
        $id_style = "%" . $filter["id_style"] . "%";

        $sql = "SELECT * FROM teachers";
        $q = $this->db->prepare($sql);
       /* $q->bindParam(":surname", $surname);
        $q->bindParam(":name", $name);
        $q->bindParam(":patronymic", $patronymic);
        $q->bindParam(":email", $email);
        $q->bindParam(":phone", $phone);
        $q->bindParam(":id_style", $id_style);*/
        $q->execute();
        $rows = $q->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

    public function insert($data) {
        $sql = "INSERT INTO teachers (surname, name, patronymic, email, phone, id_style) VALUES (:surname, :name, :patronymic, :email, :phone, :id_style)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":surname", $data["surname"]);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":patronymic", $data["patronymic"]);
        $q->bindParam(":email", $data["email"]);
        $q->bindParam(":phone", $data["phone"]);
        $q->bindParam(":id_style", $data["id_style"]);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }

    public function update($data){
        $sql = "UPDATE teachers SET surname=:surname, name=:name, patronymic=:patronymic, email=:email, phone=:phone, id_style=:id_style WHERE id_teacher=:id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":surname", $data["surname"]);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":patronymic", $data["patronymic"]);
        $q->bindParam(":email", $data["email"]);
        $q->bindParam(":phone", $data["phone"]);
        $q->bindParam(":id_style", $data["id_style"]);
        $q->execute();
    }

    public function remove($id){
        $sql = "DELETE FROM teachers WHERE id_teacher = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
    }

}