<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Group.class.php';

$database = new Database();
$db = $database->getConnection();

$group = new Group($db);
$stmt = $group->ReadGroups();
//$num = $teacher->ShowCountTeachers();
$num = 5;

if($num > 0) {
    $groups_arr = array();
    $groups_arr["groups"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $groups_item = array(
            "id_group" => $id_client,
            "name" => $name,
            "level" => $patronymic,
            "training_duration" => $email,
            "price" => $phone,
            //"id_teacher" => $id_teacher
        );
        array_push($groups_arr["groups"], $groups_item);
    }
    include __DIR__ . '/../../../crm-main/templates/clients.php';
} else {
    include __DIR__ . '/../../../crm-main/templates/clients.php';
}
