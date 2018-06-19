<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Client.class.php';

$database = new Database();
$db = $database->getConnection();

$client = new Client($db);
$stmt = $client->ReadClient();
$num = $client->ShowCountClients();

if($num > 0) {
    $clients_arr = array();
    $clients_arr["clients"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $clients_item = array(
            "id_client" => $id_client,
            "surname" => $surname,
            "name" => $name,
            "patronymic" => $patronymic,
            "email" => $email,
            "phone" => $phone,
            "phone_dubl" => $phone_dubl,
            "address" => $address,
            "group_name" => $group_name
        );
        array_push($clients_arr["clients"], $clients_item);
    }
    include __DIR__ . '/../../../crm-main/templates/clients.php';
} else {
    include __DIR__ . '/../../../crm-main/templates/clients.php';
}
