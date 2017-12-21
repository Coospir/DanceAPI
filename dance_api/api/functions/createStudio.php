<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

include_once __DIR__. '/../config/database.php';
include_once __DIR__ . '/../objects/studio.php';

$database = new Database();
$db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');

$studio = new Studio($db);

$NameStudio = !empty($_POST['name']) ? trim($_POST['name']) : null;
$AddresStudio = !empty($_POST['address']) ? trim($_POST['address']) : null;
$PhoneStudio = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

var_dump($NameStudio, $AddresStudio, $PhoneStudio);
if($studio->CreateStudio($NameStudio, $AddresStudio, $PhoneStudio)) {
	echo "ОК";
}
