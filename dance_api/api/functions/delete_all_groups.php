<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
include_once '../config/Database.class.php';
include_once '../objects/Group.class.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$group = new Group($db);
if ($group->DeleteAllGroups()) {
    echo json_encode($group->data);
} else {
    echo json_encode($group->errors);
}
