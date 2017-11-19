<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 22.10.2017
 * Time: 15:43
 */

class User {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    function registerUser($username, $password, $email) {
        $user_exists = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($user_exists);
        $stmt -> bindValue(":username", $username);
        $stmt->execute();
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($row){
            $error = "Ошибка: логин занят";
        }
        $email_exists = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($email_exists);
        $stmt -> bindValue(":email", $email);
        $stmt->execute();
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($row){
            $error = "Ошибка: почта уже зарегистрирована";
        }

        if(!$error){
            $query = "INSERT INTO users (username, password, email, join_date) VALUES (:username, :password, :email, now())";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":username", $username);
            //var_dump($username);
            $stmt->bindValue(":password", md5($password));
            $stmt->bindValue(":email", $email);
            try{
                $result = $stmt->execute();
            }catch (Exception $e) {
                echo $e->getMessage();
            }


            if(($result) && (!$row)){
                $success = "Успешно";
                return true;
            }
        } else return false;
    }

    function loginUser($email, $password) {
        try {

        }catch(PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() .'}}';
        }
    }
}