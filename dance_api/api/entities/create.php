<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

include_once '../objects/teachers.php';

$database = new Database();
$db = $database->getConnection('localhost','api_db', 'root','');

$teacher = new Teacher($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$teacher->surname = $data->surname;
$teacher->name = $data->name;
$teacher->patronymic = $data->patronymic;
$teacher->date_of_birth = $data->date_of_birth;
$teacher->phone_number = $data->phone_number;
$teacher->email = $data->email;

// create the product
if($teacher->create()){
    echo '{';
    echo '"message": "Entity was created."';
    echo '}';
}

// if unable to create the product, tell the user
else{
    echo '{';
    echo '"message": "Unable to create entity."';
    echo '}';
}
?>