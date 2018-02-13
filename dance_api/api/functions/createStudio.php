<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

include_once __DIR__. '/../config/database.php';
include_once __DIR__ . '/../objects/studio.php';

$database = new Database();
$db = $database->getConnection();

$studio = new Studio($db);

$errors = false;
$NameStudio = !empty($_POST['name']) ? trim($_POST['name']) : null;
if(strlen($NameStudio) == 0) {
	echo "Не заполнено поле 'Название студии'!";
	$errors = true;
	exit;
}
$AddressStudio = !empty($_POST['address']) ? trim($_POST['address']) : null;
if(strlen($AddressStudio) == 0) {
	echo "Не заполнено поле 'Адрес студии'!";
	$errors = true;
	exit;
}
$PhoneStudio = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

var_dump($NameStudio, $AddressStudio, $PhoneStudio);
//ToDo: проблема с созданием танцевальной студии (внешние ключи)
if($studio->CreateStudio($NameStudio, $AddressStudio, $PhoneStudio) && $errors != true) {
	echo "ОК";
}
