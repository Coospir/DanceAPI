<?php
//header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Shedule.class.php';

$database = new Database();
$db = $database->getConnection();

$shedule = new Shedule($db);
$stmt = $shedule->ReadShedule();
//$num = $shedule->ShowCountTrainings();
$num = 5;

if($num > 0) {
    $shedule_arr = array();
    $shedule_arr["shedule"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $shedule_item = array(
            "id_shedule" => $id_shedule,
            "date" => $date,
            "time" => $time,
            "place" => $place,
            "group_name" => $group_name,
            "training_duration" => $training_duration,
            "teacher_surname" => $teacher_surname,
            "teacher_name" => $teacher_name

        );
        array_push($shedule_arr["shedule"], $shedule_item);
    }
    include __DIR__ . '/../../../crm-main/templates/shedule.php';
} else {
    include __DIR__ . '/../../../crm-main/templates/shedule.php';
}


