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

	public function isValidAuth($email, $password) {
	    $this->errors = [];
	    $this->success = [];
        $pass_from_db = '';
        $email_from_db = '';

        $query = "SELECT email, password FROM `users` WHERE email = :email, password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":password", $pass_from_db);
        $stmt->bindValue(":email", $email_from_db);
        $stmt->execute([':password' => $pass_from_db, ":email" => $email_from_db]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $valid_pass = password_verify($password, $pass_from_db);
        if(!$valid_pass) {
            $this->errors['pass'] = 'Неверный пароль!';
        } elseif(!($this->emailExists($email))) {
            $this->errors['email'] = 'Данный E-Mail адрес не зарегистрирован!';
        } elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors['email'] = 'Введите корректный E-Mail!';
        } elseif(empty($this->errors) AND $user_data){
            $this->success['message'] = "Регистрация успешна!";
        }
        return empty($this->errors);
    }



	public function authenticate($email, $password) {
        $this->errors = [];
        $this->success =[];
        try {
            if($this->isValidAuth($email, $password)) {
                $_SESSION['logged_user'] = $user_data['email'];
            }
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            return false;
        }

    }

}
