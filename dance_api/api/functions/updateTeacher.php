<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/teachers.php';

// get database connection
$database = new Database();
$db = $database->getConnection('localhost','api_db', 'root','');

// prepare product object
$teacher = new Teacher($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$teacher->id = $data->id;

// set product property values
$teacher->surname = $data->surname;
$teacher->name = $data->name;
$teacher->patronymic = $data->patronymic;
$teacher->date_of_birth = $data->date_of_birth;
$teacher->phone_number = $data->phone_number;
$teacher->email = $data->email;

// update the product
if($teacher->UpdateTeacher('1', 'Иванов', 'Евгений', 'Алексеевич', '1999-03-15', '888', 'ttt@yandex.ru')){
    echo '{';
    echo '"message": "Teacher was updated."';
    echo '}';
}

// if unable to update the product, tell the user
else{
    echo '{';
    echo '"message": "Unable to update teacher."';
    echo '}';
}
?>
