<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../objects/teachers.php';

$database = new Database();
$db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');

$teacher = new Teacher($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($_POST['id'])) {
    $selected = !empty($_POST['id']) ? trim($_POST['id']) : null;
    if ($teacher->DeleteTeacher($selected)) {
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
