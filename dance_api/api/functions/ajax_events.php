<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Event.class.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);
$stmt = $event->ReadEvents();
$num = $event->ShowCountEvents();
$error_events = [
    "events" => false
];

if($num > 0) {
    $events_arr = array();
    $events_arr["events"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $events_item = array(
            "id_event" => $id_event,
            "name" => $name,
            "date" => $date,
            "price" => $price,
            "teacher_surname" => $teacher_surname,
            "teacher_name" => $teacher_name
        );
        array_push($events_arr["events"], $events_item);
    }
}
if(!empty($events_arr["events"])) {
    echo json_encode($events_arr["events"]);
} else {
    echo json_encode($error_events);
}
