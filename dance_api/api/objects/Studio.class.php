<?php
include_once "User.class.php";
class Studio {
    private $conn;
    public $errors = [];
    public $success = [];
    public $user;

    public function __construct($db){
        $this->conn = $db;
        $this->user = new User($db);
    }


    public function CreateStudio($name, $address, $phone, $token)
    {
        $this->errors = [];
        $this->success = [];
        if ($this->user->authUserByToken($token)) {
            if ($this->isValidInfo($name, $address, $phone)) {
                try {
                    $query = "INSERT INTO `studios` (name, address, phone, id_user) VALUES (:name, :address, :phone, :id_user)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindValue(":name", $name);
                    $stmt->bindValue(":address", $address);
                    $stmt->bindValue(":phone", $phone);
                    $stmt->bindValue(":id_user", $this->user->id_user);
                    if (!$stmt->execute()) {
                        $this->errors['create_studio'] = $this->conn->errorInfo();
                    } else {
                        $this->success['message'] = "Создание студии '" . $name . "' успешно!";
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            }
        }
    }



    public function isValidInfo($name, $address, $phone) {
        $this->errors = [];
        $this->success = [];

        if($name == '') {
            $this->errors['name'] = 'Введите корректное название студии!';
        }

        if($this->studioExists($name)) {
            $this->errors['studio_exists'] = 'Такое название студии уже занято!';
        }

        if($address == '') {
            $this->errors['address'] = 'Введите корректный адрес студии!';
        }

        if($phone == '') {
            $this->errors['phone'] = 'Введите корректный номер телефона студии!';
        }

        return empty($this->errors);

    }

    public function studioExists($name) {
        try {
            $query = "SELECT COUNT(*) FROM `studios` WHERE name = :name LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':name' => $name]);
            $rowCount = $stmt->fetchColumn();
            return $rowCount == 1;
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            return false;
        }
    }

}
