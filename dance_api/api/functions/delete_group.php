<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Group.class.php';

$database = new Database();
$db = $database->getConnection();


$group = new Group($db);
if(isset($_POST['id_group'])) {
    $selected = !empty($_POST['id_group']) ? trim($_POST['id_group']) : null;
    if ($group->DeleteGroup($selected)) {
        echo json_encode($group->data);
    } else {
        echo json_encode($group->errors);
    }
}
