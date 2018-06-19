<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    /*header("Content-Type: application/json; charset=UTF-8");*/
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    // include database and object file
    include_once '../config/Database.class.php';
    include_once '../objects/Teacher.class.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    $teacher = new Teacher($db);
        if ($teacher->DeleteAllTeachers()) {
            echo json_encode($teacher->data);
        } else {
            echo json_encode($teacher->errors);
    }
