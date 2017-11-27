<?php
class Studio {
	private $conn;

	public function __construct($db){
		$this->conn = $db;
	}

	public function CreateStudio($name, $address, $phone, $email){
		$query = "INSERT INTO `studios` (name, address, phone, email) VALUES (:name, :address, :phone, :email)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(":name", $name);
		$stmt->bindValue(":address", $address);
		$stmt->bindValue(":phone", $phone);
		$stmt->bindValue(":email", $email);
		if($stmt->execute()){
			return true;
		} else {
			var_dump($stmt);
			return false;
		}
	}

}
