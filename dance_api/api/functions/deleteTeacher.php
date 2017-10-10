<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
include_once '../config/database.php';
include_once '../objects/teachers.php';

// get database connection
$database = new Database();
$db = $database->getConnection('localhost','api_db', 'root','');

$teacher = new Teacher($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($_POST['deleteTeacherBtn'])) {
    $selected = !empty($_POST['deleteTeacherBtn']) ? trim($_POST['deleteTeacherBtn']) : null;
    if ($teacher->deleteTeacher($selected)) {
        echo '{';
        echo '"message": "Teacher was deleted."';
        echo '}';
    }
    else {
        echo '{';
        echo '"message": "Unable to delete teacher."';
        echo '}';
    }
}