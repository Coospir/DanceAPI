<?php
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/


include_once __DIR__. '/../config/database.php';
include_once __DIR__. '/../objects/teachers.php';

$database = new Database();
$db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');

$teacher = new Teacher($db);


$title = 'Преподаватели';

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
            "phone_number" => $phone_number,
            "email" => $email,
            "style" => $style,
            "social_page" => $social_page
        );
        array_push($teachers_arr["teachers"], $teacher_item);
    }

    include __DIR__ . '/../../../templates/header.php';
    include __DIR__ . '/../../../templates/teachers.php';
    include __DIR__ . '/../../../templates/modal_addteacher.php';
}
    else {
        //echo json_encode(array("message" => "No teachers found."));
        include __DIR__ . '/../../../templates/header.php';
        include __DIR__ . '/../../../templates/teachers.php';
        include __DIR__ . '/../../../templates/modal_addteacher.php';
    }


