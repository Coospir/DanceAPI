<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Client.class.php';

$database = new Database();
$db = $database->getConnection();

$client = new Client($db);


$surnameClient = !empty($_POST['surname']) ? trim($_POST['surname']) : null;
$nameClient = !empty($_POST['name']) ? trim($_POST['name']) : null;
$patronymicClient = !empty($_POST['patronymic']) ? trim($_POST['patronymic']) : null;
$emailClient = !empty($_POST['email']) ? trim($_POST['email']) : null;
$phone_numberClient = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
$phone_dubl_numberClient = !empty($_POST['phone_dubl']) ? trim($_POST['phone_dubl']) : null;
$addressClient = !empty($_POST['address']) ? trim($_POST['address']) : null;
$groupClient = $_POST['groups'];

if($client->CreateClient($surnameClient, $nameClient, $patronymicClient, $emailClient, $phone_numberClient, $phone_dubl_numberClient, $addressClient, $groupClient)) {
    /*   echo <<< START
           <tr>
           <td class="information">$surnameTeacher $nameTeacher $patronymicTeacher</td>
           <td class="information">$emailTeacher</td>
           <td class="information">$phone_numberTeacher</td>
           <td class="information">$styleTeacher</td>

           <td><button type="submit" name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher()">Удалить</button></td>
           </tr>
START;*/
    echo json_encode($client->data);
} else {
    echo json_encode($client->errors);
}
