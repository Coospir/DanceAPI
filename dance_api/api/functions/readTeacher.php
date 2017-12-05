<?php
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/


include_once __DIR__. '/../config/database.php';
include_once __DIR__. '/../objects/teachers.php';

$database = new Database();
$db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');

$teacher = new Teacher($db);


$stmt = $teacher->ReadTeacher();
$num = $teacher->ShowCountTeachers();

//TODO: Что-то метод показа кол-ва преподавателей не сработал :с
if($num > 0) {

    $teachers_arr = array();
    $teachers_arr["teachers"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $teacher_item = array(
            "id" => $id,
            "surname" => $surname,
            "name" => $name,
            "patronymic" => $patronymic,
            "email" => $mail,
            "phone" => $phone,
            "style" => $style,
			"id_user" => 1
        );
        array_push($teachers_arr["teachers"], $teacher_item);
    }
    include __DIR__ . '/../../../crm-main/templates/teachers.php';
}
    else {
        //echo json_encode(array("message" => "No teachers found."));
		include __DIR__ . '/../../../crm-main/templates/teachers.php';
    }


