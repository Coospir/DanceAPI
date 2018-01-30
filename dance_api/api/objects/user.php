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
    public $errors;

    public function __construct($db){
        $this->conn = $db;
    }

    public function signup($name, $email, $password) {
		if($this->isValid($name, $email, $password)){
			try {
				$query = "INSERT INTO `user` (name, email ,password) VALUES (:name, :email, :password)";
				$stmt = $this->conn->prepare($query);
				$stmt->bindValue(":name", $name);
				$stmt->bindValue(":email", $email);
				$stmt->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
				$stmt->execute();
			}catch (PDOException $exception) {
				error_log($exception->getMessage());
			}
		}
	}

	public function emailExists($email){
    	try {
    		$query = "SELECT COUNT(*) FROM `user` WHERE email = :email LIMIT 1";
			$stmt = $this->conn->prepare($query);
    		$stmt->execute([':email' => $email]);
    		$rowCount = $stmt->fetchColumn();
    		return $rowCount == 1;
		} catch (PDOException $exception) {
    		error_log($exception->getMessage());
    		return false;
		}
	}
	public function isValid($name, $email, $password) {
    	$this->errors = [];

    	if($name == '') {
    		var_dump("TEST1");
    		$this->errors['name'] = 'Введите корректное имя пользователя!';
		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			var_dump("TEST2");
    		$this->errors['email'] = 'Введите корректный E-Mail!';
		}

		if($this->emailExists($email)) {
			var_dump("TEST3");
    		$this->errors['email'] = 'Введенный E-Mail адрес занят!';
		}

		if(strlen($password) < 5) {
			var_dump("TEST4");
			$this->errors['password'] = 'Длина пароля должна быть не менее 5 символов!';
		}

		return empty($this->errors);
	}
}
