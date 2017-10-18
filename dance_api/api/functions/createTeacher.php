<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/
include_once '../config/database.php';

include_once '../objects/teachers.php';

$database = new Database();
$db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');

$teacher = new Teacher($db);

$surnameTeacher = !empty($_POST['surname']) ? trim($_POST['surname']) : null;
$nameTeacher = !empty($_POST['name']) ? trim($_POST['name']) : null;
$patronymicTeacher = !empty($_POST['patronymic']) ? trim($_POST['patronymic']) : null;
$dateTeacher = !empty($_POST['birth']) ? trim($_POST['birth']) : null;
$phone_numberTeacher = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
$emailTeacher = !empty($_POST['mail']) ? trim($_POST['mail']) : null;
$styleTeacher = !empty($_POST['style']) ? trim($_POST['style']) : null;
$socialPageTeacher = !empty($_POST['social_page']) ? trim($_POST['social_page']) : null;
$passportTeacher = !empty($_POST['passport']) ? trim($_POST['passport']) : null;
$aboutTeacher = !empty($_POST['about']) ? trim($_POST['about']) : null;

if($teacher->createTeacher($surnameTeacher, $nameTeacher, $patronymicTeacher, $dateTeacher, $phone_numberTeacher, $emailTeacher, $styleTeacher, $socialPageTeacher, $passportTeacher, $aboutTeacher)){
    echo '{';
    echo '"message": "New teacher was created."';
    echo '}';
} else {
    echo '{';
    echo '"message": "Unable to create teacher."';
    echo '}';
}
