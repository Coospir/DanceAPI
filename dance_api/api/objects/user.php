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
		if($this->isValid($name, $email, $password, $user_type)){
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
	public function isValid($name, $email, $password, $user_type) {
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
    	    $this->errors['user_type'] = 'Вы не выбрали тип учетной записи!';
        }

        if(empty($this->errors)){
    	    $this->success['message'] = "Регистрация успешна!";
        }

		return empty($this->errors);
	}
}
