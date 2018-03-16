<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

include_once __DIR__. '/../config/database.php';
include_once __DIR__ . '/../objects/Studio.class.php';

$database = new Database();
$db = $database->getConnection();

$studio = new Studio($db);

$name_studio = !empty($_POST['name']) ? trim($_POST['name']) : null;
$address_studio = !empty($_POST['address']) ? trim($_POST['address']) : null;
$phone_studio = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

//ToDo: проблема с созданием танцевальной студии (внешние ключи)
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$studio->CreateStudio($name_studio, $address_studio, $phone_studio);
    if(empty($studio->errors)){
        echo json_encode($studio->success);
    } else {
        echo json_encode($studio->errors);
    }
}
