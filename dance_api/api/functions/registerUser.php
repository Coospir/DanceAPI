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


//TODO: Что-то ошибки не выводятся в register.php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$user->signup($username, $email, $password);
	if(empty($user->errors)){
		echo json_encode($user->success);
	} else echo json_encode($user->errors);
}


        //var_dump("Error");
/*if($user->signup($_POST) {
    http_response_code(200);
    echo '{';
    echo '"message": "New user registered."';
    echo '}';
} else {
    http_response_code(404);
    echo '{';
    echo '"error": "Невозможно зарегистрировать пользователя."';
    echo '}';
}*/


