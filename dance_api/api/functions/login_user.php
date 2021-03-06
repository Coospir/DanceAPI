<?php
//header("Access-Control-Allow-Origin: *");
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/User.class.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
$password = !empty($_POST['password']) ? trim($_POST['password']) : null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->Auth($email, $password);
    if(empty($user->errors)){
        echo json_encode($user->success);
    } else {
        echo json_encode($user->errors);
    }
}