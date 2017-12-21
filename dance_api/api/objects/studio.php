<?php
class Studio {
	private $conn;

	public function __construct($db){
		$this->conn = $db;
	}

	public function CreateStudio($name, $address, $phone){
		$query = "INSERT INTO `studios` (name, address, phone) VALUES (:name, :address, :phone)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(":name", $name);
		$stmt->bindValue(":address", $address);
		$stmt->bindValue(":phone", $phone);
		try {
			if($stmt->execute()){
				echo 'Создание сущности "Студия" успешно!';
				return true;
			}else{
				echo 'Ошибка при создании сущности "Студия": ';
				echo $stmt->errorInfo();
				return false;
			}
		} catch(Exception $e){
			echo 'Ошибка при создании сущности "Студия": ';
			echo $e->getMessage();
		}
	}

}
