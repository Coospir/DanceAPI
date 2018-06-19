<?php
// required headers
header("Access-Control-Allow-Origin: *");
/*header("Content-Type: application/json; charset=UTF-8");*/
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Client.class.php';

$database = new Database();
$db = $database->getConnection();

$client = new Client($db);
if(isset($_POST['id_client'])) {
    $selected = !empty($_POST['id_client']) ? trim($_POST['id_client']) : null;
    if ($client->DeleteClient($selected)) {
        echo json_encode($client->data);
    } else {
        echo json_encode($client->errors);
    }
}
