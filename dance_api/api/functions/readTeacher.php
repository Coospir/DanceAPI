<?php
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/


include_once '../config/database.php';
include_once '../objects/teachers.php';

$database = new Database();
$db = $database->getConnection('localhost','api_db', 'root','');

$teacher = new Teacher($db);

$stmt = $teacher->readTeacher();
$num = $stmt->rowCount();

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
            "date_of_birth" => $date_of_birth,
            "phone_number" => $phone_number,
            "email" => $email
        );

        array_push($teachers_arr["teachers"], $teacher_item);
    }
    echo json_encode($teachers_arr);

}
    else {
        echo json_encode(array("message" => "No teachers found."));
    }


