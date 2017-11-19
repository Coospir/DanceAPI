<?php
header("Access-Control-Allow-Origin: *");

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');
include __DIR__ . '/../../../templates/login.php';

/*if(isset($_POST['loginUserForm'])) {
    $user_email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $user_password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    if(strlen($user_email) > 1 && strlen($user_password) > 1){

    }
} else*/