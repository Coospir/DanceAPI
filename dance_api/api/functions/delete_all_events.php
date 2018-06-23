<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
include_once '../config/Database.class.php';
include_once '../objects/Event.class.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$event = new Event($db);
if ($event->DeleteAllEvent()) {
    echo json_encode($event->data);
} else {
    echo json_encode($event->errors);
}
