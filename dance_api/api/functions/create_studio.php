<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Studio.class.php';

$database = new Database();
$db = $database->getConnection();

$studio = new Studio($db);
$user = new User($db);

$name_studio = !empty($_POST['name']) ? trim($_POST['name']) : null;
$address_studio = !empty($_POST['address']) ? trim($_POST['address']) : null;
$phone_studio = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
$token = $_COOKIE["auth_token"];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($token === null) {
        $studio->errors['error_token'] = 'Ошибка авторизации!';
    }
	$studio->CreateStudio($name_studio, $address_studio, $phone_studio, $token);
    if(empty($studio->errors)){
        echo json_encode($studio->success);
    } else {
        echo json_encode($studio->errors);
    }
}
