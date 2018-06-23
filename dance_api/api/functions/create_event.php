<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/
include_once __DIR__ . '/../config/Database.class.php';
include_once __DIR__ . '/../objects/Event.class.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

$event_name = !empty($_POST['name']) ? trim($_POST['name']) : null;
$event_date = !empty($_POST['date']) ? trim($_POST['date']) : null;
$event_id_teacher = !empty($_POST['teacher']) ? trim($_POST['teacher']) : null;
$event_price = !empty($_POST['price']) ? trim($_POST['price']) : null;

if($event->CreateEvent($event_name, $event_date, $event_id_teacher, $event_price)) {
    /*   echo <<< START
           <tr>
           <td class="information">$surnameTeacher $nameTeacher $patronymicTeacher</td>
           <td class="information">$emailTeacher</td>
           <td class="information">$phone_numberTeacher</td>
           <td class="information">$styleTeacher</td>

           <td><button type="submit" name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher()">Удалить</button></td>
           </tr>
START;*/
    echo json_encode($event->data);
} else {
    echo json_encode($event->errors);
}
