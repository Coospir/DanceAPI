<?php
//header("Access-Control-Allow-Origin: *");
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/User.class.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$name = !empty($_POST['name']) ? trim($_POST['name']) : null;
$password = !empty($_POST['password']) ? trim($_POST['password']) : null;
$remember_me = !empty($_POST['rememberMe']) ? trim($_POST['rememberMe']) : null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->Auth($name, $password);
    if(empty($user->errors)){
        echo json_encode($user->success);
    } else {
        echo json_encode($user->errors);
    }
}