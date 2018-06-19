<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Client {
    private $conn;
    public $errors = [];
    public $data = [];

    public function __construct($db){
        $this->conn = $db;
    }

    public function ReadClient() {
        $query = "SELECT GROUP_CONCAT(groups.name) as group_name, clients_groups.id_client, clients.id_client, clients.surname, clients.name, clients.patronymic, clients.email, clients.phone, clients.phone_dubl, clients.address FROM groups INNER JOIN clients_groups ON(groups.id_group = clients_groups.id_group) INNER JOIN clients ON (clients.id_client = clients_groups.id_client) GROUP BY clients.id_client";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function CreateClient($surname, $name, $patronymic, $email, $phone, $phone_dubl, $address, array $groups) {
        $this->errors = [];
        $result = false;
        try {
            $query = "INSERT INTO `clients`(surname, name, patronymic, email, phone, phone_dubl, address) VALUES(:surname, :name, :patronymic, :email, :phone, :phone_dubl, :address)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":surname", $surname);
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":patronymic", $patronymic);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":phone", $phone);
            $stmt->bindValue(":phone_dubl", $phone_dubl);
            $stmt->bindValue(":address", $address);
            if($stmt->execute()){
                $id = $this->conn->lastInsertId();
                $query_groups = "INSERT INTO `clients_groups`(id_client, id_group) VALUES";
                $flag = true;
                foreach($groups as $g) {
                    if(!$flag) {
                        $query_groups .= ",";
                    }
                    $query_groups .= "(".(int)$id.", ".$g.")";
                    $flag = false;
                }
                $this->conn->query($query_groups);
                $this->data[] = 'Клиент создан!';
                $result=true;
            } else {
                $this->errors[] = 'Ошибка при создании группы: ' . $stmt->errorInfo();
            }
        } catch(Exception $e){
            $this->errors[] = 'Непредвиденная ошибка при создании группы -> ' . $e->getMessage();
        }
        return $result;
    }

    public function DeleteClient($id) {
        $query = "DELETE FROM `clients` WHERE id_client=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        try {
            if($stmt->execute()){
                $this->data[] = 'Удаление клиента прошло успешно!';
                return true;
            } else {
                $this->errors[] = 'Ошибка при удалении клиента: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e){
            $this->errors[] = 'Непредвиденная ошибка при создании группы -> '.$e->getMessage();
            return false;
        }
    }

    public function DeleteAllClients() {
        $query = "DELETE FROM `clients`";
        $stmt = $this->conn->prepare($query);
        try {
            if($stmt->execute()) {
                $this->data[] = 'Очистка списка клиентов прошла успешно!';
                return true;
            } else {
                $this->errors = 'Ошибка при очистке списка клиентов: '.$stmt->errorInfo();
                return false;
            }
        } catch(Exception $e) {
            $this->errors[] = 'Непредвиденная ошибка при очистке списка клиентов -> ' .$e->getMessage();
            return false;
        }
    }

    public function ShowCountClients(){
        $query = "SELECT COUNT(*) FROM `clients`";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            return $result[0][0];
        } else {
            return false;
        }
    }


}