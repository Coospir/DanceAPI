<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 22.10.2017
 * Time: 15:43
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class User {
    private $conn;
    public $errors = [];
    public $success= [];

    public function __construct($db){
        $this->conn = $db;
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

	public function isValidAuth($name, $password) {
	    $this->errors = [];
	    $this->success = [];
        //ToDo: что на счет генерации токена, записи в бд? как чекать жизнь токена - cron?
        $query = "SELECT * FROM `users` WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->execute();
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $valid_pass = password_verify($password, $user_data['password']);
        if(!$user_data AND !$valid_pass) {
            $this->errors['user_data'] = 'Неверный логин или пароль!';
        } elseif(empty($this->errors) AND $user_data){
            $this->success['message'] = "Авторизация успешна!";
            $_SESSION['logged_user'] = $user_data['email'];
        }
        return empty($this->errors);
    }
}
