<?php
/**
 * Created by PhpStorm.
 * User: COOSPIR-PC
 * Date: 23.10.2017
 * Time: 14:02
 */
//header("Access-Control-Allow-Origin: *");
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Event.class.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

$surname = !empty($_POST['surname']) ? trim($_POST['surname']) : null;
$name = !empty($_POST['name']) ? trim($_POST['name']) : null;
$id_event = !empty($_POST['events']) ? trim($_POST['events']) : null;
$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
$phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $event->signUpEvent($surname, $name, $id_event, $email, $phone);
    if(empty($event->errors)){
        echo json_encode($event->data);
    } else {
        echo json_encode($event->errors);
    }

}
