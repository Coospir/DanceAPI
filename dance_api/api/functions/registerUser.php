<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 23.10.2017
 * Time: 14:02
 */
//header("Access-Control-Allow-Origin: *");
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$username = !empty($_POST['username']) ? trim($_POST['username']) : null;
$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
$password = !empty($_POST['password']) ? trim($_POST['password']) : null;
$user_type = '';
//ToDo: Не ловится ошибка, если не выбрана галочка подтверждения
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(empty($user->errors) && isset($_POST['user_type'])){
        $user_type = 'director';
        $user->signup($username, $email, $password, $user_type);
        echo json_encode($user->success);
    } else echo json_encode($user->errors);
}


