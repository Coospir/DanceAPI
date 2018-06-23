<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Event.class.php';

$database = new Database();
$db = $database->getConnection();


$event = new Event($db);
if(isset($_POST['id_event'])) {
    $selected = !empty($_POST['id_event']) ? trim($_POST['id_event']) : null;
    if ($event->DeleteEvent($selected)) {
        echo json_encode($event->data);
    } else {
        echo json_encode($event->errors);
    }
}
