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
$db = $database->getConnection();

$teacher = new Teacher($db);
/*$data = json_decode(file_get_contents("php://input"));*/
if(isset($_POST['id_teacher'])) {
    $selected = !empty($_POST['id_teacher']) ? trim($_POST['id_teacher']) : null;
    if ($teacher->DeleteTeacher($selected)) {
        return true;
    }
    else {
        return false;
    }
}
