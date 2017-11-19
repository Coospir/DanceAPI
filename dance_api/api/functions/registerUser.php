<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 23.10.2017
 * Time: 14:02
 */




header("Access-Control-Allow-Origin: *");

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');

$user = new User($db);

$username = !empty($_POST['username']) ? trim($_POST['username']) : null;
$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
$password = !empty($_POST['password']) ? trim($_POST['password']) : null;

if($user->registerUser($username, $password, $email)) {
    http_response_code(200);
    echo '{';
    echo '"message": "New user registered."';
    echo '}';
} else {
    http_response_code(404);
    echo '{';
    echo '"error": "Невозможно зарегистрировать пользователя."';
    echo '}';
}


