<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/
print_r($_POST);
include_once '../config/database.php';

include_once '../objects/teachers.php';

$database = new Database();
$db = $database->getConnection('localhost','api_db', 'root','');

$teacher = new Teacher($db);

// get posted data
/*$data = json_decode(file_get_contents("php://input"));

$teacher->surname = $data->surname;
$teacher->name = $data->name;
$teacher->patronymic = $data->patronymic;
$teacher->date_of_birth = $data->date_of_birth;
$teacher->phone_number = $data->phone_number;
$teacher->email = $data->email;*/

if(isset($_POST['addNewTeacher'])) {
    $surnameTeacher = !empty($_POST['surname']) ? trim($_POST['surname']) : null;
    $nameTeacher = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $patronymicTeacher = !empty($_POST['patronymic']) ? trim($_POST['patronymic']) : null;
    $dateTeacher = !empty($_POST['birth']) ? trim($_POST['birth']) : null;
    $phone_numberTeacher = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
    $emailTeacher = !empty($_POST['mail']) ? trim($_POST['mail']) : null;
} else echo "Error!";

if($teacher->createTeacher($surnameTeacher, $nameTeacher, $patronymicTeacher, $dateTeacher, $phone_numberTeacher, $emailTeacher)){


    echo '{';
    echo '"message": "New teacher was created."';
    echo '}';
} else {
    echo '{';
    echo '"message": "Unable to create teacher."';
    echo '}';
}
