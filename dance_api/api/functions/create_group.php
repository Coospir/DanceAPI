<?php
    include_once __DIR__ . '/../config/Database.class.php';
    include_once __DIR__ . '/../objects/Group.class.php';

    $database = new Database();
    $db = $database->getConnection();

    $group = new Group($db);

    $name_group = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $level_group = !empty($_POST['level']) ? trim($_POST['level']) : null;
    $training_duration_group = !empty($_POST['training_duration']) ? trim($_POST['training_duration']) : null;
    $price_group = !empty($_POST['price']) ? trim($_POST['price']) : null;
    $teacher_group = $_POST['teacher-for-group'];

    if($group->CreateGroup($name_group, $level_group, $training_duration_group, $price_group, $teacher_group)) {
        echo json_encode($group->data);
    } else {
        echo json_encode($group->errors);
    }
