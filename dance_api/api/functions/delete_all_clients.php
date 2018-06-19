<?php
include_once '../config/Database.class.php';
include_once '../objects/Client.class.php';

$database = new Database();
$db = $database->getConnection();

$client = new Client($db);
if ($client->DeleteAllClients()) {
    echo json_encode($client->data);
} else {
    echo json_encode($client->errors);
}
