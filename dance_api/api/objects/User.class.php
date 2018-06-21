<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class User {
    private $conn;
    public $errors = [];
    public $success= [];
    public $id_user;
    public $token;
    public $user_info;

    public function __construct($db){
        $this->conn = $db;
    }

    public function authUserByToken($token) {
        try {
            $query = "SELECT id_user FROM `remembered_logins` WHERE token = :token AND DATE_ADD(expires_at, INTERVAL 30 DAY) >= NOW()";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":token", $token);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$user) {
                $this->errors['query_error'] = $this->conn->errorInfo();
            } else {
                $rowCount = $stmt->rowCount();
                if($rowCount !== 1) {
                    $this->errors['token_not_found'] = 'Не найден токен для пользователя!';
                } else {
                    $this->success['success_auth'] = 'Успешная авторизация!';
                    $this->id_user = $user['id_user'];
                    return true;
                }
            }
        }catch (PDOException $exception) {
            error_log($exception->getMessage());
        }
        return false;

    }

    public function signup($name, $email, $password, $user_type) {
        if($this->isValidSignUp($name, $email, $password, $user_type)){
            try {
                $query = "INSERT INTO `users` (name, email ,password, user_type) VALUES (:name, :email, :password, :user_type)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(":name", $name);
                $stmt->bindValue(":email", $email);
                $stmt->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
                $stmt->bindValue(":user_type", $user_type);
                $stmt->execute();
            }catch (PDOException $exception) {
                error_log($exception->getMessage());
            }
        }
    }

    public function emailExists($email){
        try {
            $query = "SELECT COUNT(*) FROM `users` WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':email' => $email]);
            $rowCount = $stmt->fetchColumn();
            return $rowCount == 1;
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            return false;
        }
    }


    public function isValidSignUp($name, $email, $password, $user_type) {
        $this->errors = [];
        $this->success = [];

        if($name == '') {
            $this->errors['name'] = 'Введите корректное имя пользователя!';
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors['email'] = 'Введите корректный E-Mail!';
        }

        if($this->emailExists($email)) {
            $this->errors['email'] = 'Введенный E-Mail адрес занят!';
        }

        if(strlen($password) < 5) {
            $this->errors['password'] = 'Длина пароля должна быть не менее 5 символов!';
        }

        if($user_type == '') {
            $this->errors['user_type'] = 'Подтвердите пользовательское соглашение!';
        }

        if(empty($this->errors)){
            $this->success['message'] = "Регистрация успешна!";
        }
        return empty($this->errors);
    }

    public function verifyPass($email, $password) {
        //ToDO: исправить запрос
        $this->errors = [];
        $this->success = [];
        try {
            $query = "SELECT id, name, email, password, user_type FROM `users` WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $valid_pass = password_verify($password, $user['password']);
            if($valid_pass) {
                $this->id_user = $user['id'];
                return true;
            } else return false;
        } catch(PDOException $exception) {
            error_log($exception->getMessage());
            return false;
        }
    }
    //ToDo: ошибки в логике авторизации
    public function isValidAuth($name, $password) {
        $this->errors = [];
        $this->success = [];

        if ($name === '') {
            $this->errors['user_email'] = 'Не заполнено поле "Электронный адрес"!';
        }
        if ($password === '') {
            $this->errors['user_password'] = 'Не заполнено поле "Пароль"!';
        }
        if (!$this->verifyPass($name, $password)) {
            $this->errors['user_password_verify'] = 'Неверный пароль!';
        }
        if (empty($this->errors)) {
            $this->success['message'] = "Авторизация успешна!";
        }

        try {
            $query = "SELECT * FROM studios";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute();
            $count = $stmt->rowCount();
            if($result && $count > 0) {
                $this->success['studio_already_exists'] = "success";
            } else {
                $this->errors['studio_not_exists'] = "not found";
            }
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            return false;
        }
        return empty($this->errors);
    }

    public function Auth($email, $password) {
        if($this->isValidAuth($email, $password)){
            $this->token = bin2hex(openssl_random_pseudo_bytes(16));
            try {
                $query = "INSERT INTO `remembered_logins` (token, id_user , expires_at) VALUES (:token, :id_user, NOW())";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(":token", $this->token);
                $stmt->bindValue(":id_user", $this->id_user);
                if (!$stmt->execute()) {
                    $this->errors['insert'] = $this->conn->errorInfo();
                } else {
                    $this->success['token'] = $this->token;
                }
            } catch (PDOException $exception) {
                error_log($exception->getMessage());
            }
        }
    }

    public function GetInfoByToken($token) {
        $this->errors = [];
        $this->success = [];
        try {
            $query = "SELECT name, email, user_type FROM users INNER JOIN remembered_logins ON users.id = remembered_logins.id_user WHERE remembered_logins.token = :token";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":token", $token);
            if(!$stmt->execute()) {
                $this->errors['access_denied'] = $this->conn->errorInfo();
                return $this->errors['access_denied'];
            } else {
                $this->success['access_success'] = "Access applied for this token";
                $this->user_info = $stmt->fetch(PDO::FETCH_ASSOC);
                return $this->user_info;
            }
        } catch (PDOException $exception) {
            $error_info = error_log($exception->getMessage());
            return $exception->getMessage();
        }
    }


}
