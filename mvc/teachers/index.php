<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.02.2018
 * Time: 18:56
 */
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
header('Content-Type: text/html; charset=utf-8', true);
include "../models/TeacherRepository.php";

$config = include __DIR__ . "/../db/config.php";
$db = new PDO($config["db"], $config["username"], $config["password"]);
$teachers = new TeacherRepository($db);

switch ($_SERVER["REQUEST_METHOD"]){
    case "GET":
        $result = $teachers->getAll([
            "surname" => $_GET["surname"],
            "name" => $_GET["name"],
            "patronymic" => $_GET["patronymic"],
            "email" => $_GET["email"],
            "phone" => $_GET["phone"],
            "id_style" => $_GET["id_style"]
        ]);
        break;

    case "POST":
        $result = $teachers->insert([
            "surname" => $_POST["surname"],
            "name" => $_POST["name"],
            "patronymic" => $_POST["patronymic"],
            "email" => $_POST["email"],
            "phone" => $_POST["phone"],
            "id_style" => $_POST["id_style"]
        ]);
        break;

    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);
        $result = $teachers->update([
            "id_teacher" => intval($_PUT["id_teacher"]),
            "surname" => $_PUT["surname"],
            "name" => $_PUT["name"],
            "patronymic" => $_PUT["patronymic"],
            "email" => $_PUT["email"],
            "phone" => $_PUT["phone"],
            "id_style" => $_PUT["id_style"]
        ]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $_DELETE);
        $result = $teachers->remove(intval($_DELETE["id_teacher"]));
        break;
}

//header("Content-Type: application/json");
echo json_encode($result);