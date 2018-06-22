<?php
//header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Teacher.class.php';

$database = new Database();
$db = $database->getConnection();

$teacher = new Teacher($db);
$stmt = $teacher->ReadTeacher();
$num = $teacher->ShowCountTeachers();
$error_teachers = [
  "teachers" => false
];

if($num > 0) {
    $teachers_arr = array();
    $teachers_arr["teachers"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $teacher_item = array(
            "id_teacher" => $id_teacher,
            "surname" => $surname,
            "name" => $name,
            "patronymic" => $patronymic,
            "email" => $email,
            "phone" => $phone,
            "style" => $style
        );
        array_push($teachers_arr["teachers"], $teacher_item);
    }
}
if(!empty($teachers_arr["teachers"])) {
    echo json_encode($teachers_arr["teachers"]);
} else {
    echo json_encode($error_teachers);
}
