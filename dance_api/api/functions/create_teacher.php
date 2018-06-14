<?php
    /*header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/
    include_once __DIR__ . '/../config/Database.class.php';
    include_once __DIR__ . '/../objects/Teacher.class.php';

    $database = new Database();
    $db = $database->getConnection();

    $teacher = new Teacher($db);

        $surnameTeacher = !empty($_POST['surname']) ? trim($_POST['surname']) : null;
        $nameTeacher = !empty($_POST['name']) ? trim($_POST['name']) : null;
        $patronymicTeacher = !empty($_POST['patronymic']) ? trim($_POST['patronymic']) : null;
        $emailTeacher = !empty($_POST['mail']) ? trim($_POST['mail']) : null;
        $phone_numberTeacher = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
        $styleTeacher = $_POST['styles'];

        if($teacher->CreateTeacher($surnameTeacher, $nameTeacher, $patronymicTeacher, $emailTeacher, $phone_numberTeacher, $styleTeacher)) {
         /*   echo <<< START
                <tr>
                <td class="information">$surnameTeacher $nameTeacher $patronymicTeacher</td>
                <td class="information">$emailTeacher</td>
                <td class="information">$phone_numberTeacher</td>
                <td class="information">$styleTeacher</td>
                
                <td><button type="submit" name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher()">Удалить</button></td>
                </tr>
START;*/
            echo json_encode($teacher->data);
        } else {
            echo json_encode($teacher->errors);
        }
