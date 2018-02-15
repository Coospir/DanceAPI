<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.02.2018
 * Time: 16:15
 */
header('Content-Type: text/html; charset=utf-8', true);
include "../models/StyleRepository.php";
$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$countries = new StyleRepository($db);
switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $countries->getAll();
        break;
}
header("Content-Type: application/json");
echo json_encode($result);