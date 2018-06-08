<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    /*header("Content-Type: application/json; charset=UTF-8");*/
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/Teacher.class.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection('localhost','h117710_api_db', 'h117710_root','DanceCRM');

    $teacher = new Teacher($db);
    if(isset($_POST['deleteAllTeachers'])) {
        if ($teacher->DeleteAllTeachers()) {
            echo json_encode($teacher->data);
        } else {
            echo json_encode($teacher->errors);
        }
    }
