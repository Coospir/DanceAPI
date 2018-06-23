<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include __DIR__ . '/../dance_api/api/config/Database.class.php';
include __DIR__ . '/../dance_api/api/objects/Teacher.class.php';
include __DIR__ . '/../dance_api/api/objects/Group.class.php';
include __DIR__ . '/../dance_api/api/objects/Shedule.class.php';
include __DIR__ . '/../dance_api/api/objects/Event.class.php';

$database = new Database();
$db = $database->getConnection();

$teacher = new Teacher($db);
$stmt = $teacher->ReadTeacher();
$num_teachers = $teacher->ShowCountTeachers();

if($num_teachers > 0) {
    $teachers_arr = array();
    $teachers_arr["teachers"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $teacher_item = array(
            "id_teacher" => $id_teacher,
            "surname" => $surname,
            "name" => $name,
            "patronymic" => $patronymic,
            "email" => $email,
            "phone" => $phone,
            "style" => $style
        );
        array_push($teachers_arr["teachers"], $teacher_item);
    }
}

$event = new Event($db);
$stmt = $event->ReadEvents();
$num_events = $event->ShowCountEvents();

if($num_events > 0) {
    $events_arr = array();
    $events_arr["events"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $events_item = array(
            "id_event" => $id_event,
            "name" => $name,
            "date" => $date,
            "price" => $price,
            "teacher_surname" => $teacher_surname,
            "teacher_name" => $teacher_name
        );
        array_push($events_arr["events"], $events_item);
    }
}

$group = new Group($db);
$stmt = $group->ReadGroups();
$num_groups = $group->ShowCountGroups();


if($num_groups > 0) {
    $groups_arr = array();
    $groups_arr["groups"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $groups_item = array(
            "id_group" => $id_group,
            "group_name" => $group_name,
            "level" => $level,
            "training_duration" => $training_duration,
            "price" => $price,
            "id_teacher" => $id_teacher,
            "teacher_surname" => $teacher_surname,
            "teacher_name" => $teacher_name
        );
        array_push($groups_arr["groups"], $groups_item);
    }
}


$shedule = new Shedule($db);
$stmt = $shedule->ReadShedule();
$num_tr = $shedule->ShowCountTrainings();

if($num_tr > 0) {
    $shedule_arr = array();
    $shedule_arr["shedule"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $shedule_item = array(
            "id_shedule" => $id_shedule,
            "date" => $date,
            "time" => $time,
            "place" => $place,
            "group_name" => $group_name,
            "training_duration" => $training_duration,
            "teacher_surname" => $teacher_surname,
            "teacher_name" => $teacher_name

        );
        array_push($shedule_arr["shedule"], $shedule_item);
    }
}

?>
<!doctype html>
<html lang="ru">
<head>
    <link href="/style/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Jura|Ubuntu+Mono" rel="stylesheet">
    <!--<meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.85, user-scalable=0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/style/js/jquery-3.2.1.min.js"></script>
    <script src="/style/js/bootstrap.js"></script>
    <script src="/style/js/functions_jquery.js"></script>
    <script src="/dance_api/api/functions/ajax.js"></script>
    <script src="/crm-main/js/maskedinput.js"></script>
    <title>NICHOSI DC</title>
</head>
<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<div class="jumbotron">
    <div class="container text-center">
        <br>
        <h1 style="color: white; font-size: 80px;">NICHOSI DANCE CENTRE</h1>
        <p style="font-size: 24px; text-align: center; color: white">START. GROW. EXPLAIN.</p>
    </div>
</div>
<?php
//TODO: Можно ли оставить такую проверочку?

if(!$database->getConnection()) {
    echo "<div class='alert alert-danger' style='text-align: center'><b>Проблема с подключением к базе данных DanceCMS:</b> обратитесь в тех. поддержку.</div>";
}
?>
<div class="container">
    <div class="WhyWe">
        <h1 style="text-align: center;">Преподаватели нашей танцевальной студии</h1>
        <div class="container" style="margin-top: 50px;">
            <?php if(!empty($teachers_arr["teachers"])) : ?>
                <?php foreach ($teachers_arr["teachers"] as $teacher) : ?>
                    <div class="col-md-4" id="teachers-cards" style="padding-left: 0px;">
                        <div class="panel panel-info" id="teacher<? echo $teacher["id_teacher"]; ?>">
                            <div class="panel-heading">
                                <b><?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?></b>
                            </div>
                            <div class="panel-body">
                                <p><b>Преподаваемые стили: </b><?= $teacher['style']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
            <?php elseif (empty($teachers_arr["teachers"])) : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Внимание!</strong> Список преподавателей пуст.
                </div>
            <?php endif; ?>

            <h1 style="text-align: center;">Список танцевальных групп</h1>
            <div class="container" style="margin-top: 50px;">
                <?php if(!empty($groups_arr["groups"])) : ?>
                <?php foreach ($groups_arr["groups"] as $group) : ?>
                    <div class="col-md-4" id="teachers-cards" style="padding-left: 0px;">
                        <div class="panel panel-info" id="group<? echo $group["id_group"]; ?>">
                            <div class="panel-heading">
                                <b><?= $group["group_name"]." - ".$group["level"]?></b>
                            </div>
                            <div class="panel-body">
                                <p>Длительность занятия: <?= $group['training_duration']; ?></p>
                                <p>Стоимость абонемента (8 занятий): <?= $group['price']; ?></p>
                                <p>Преподаватель: <?= $group['teacher_surname']." ".$group['teacher_name'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php elseif (empty($teachers_arr["teachers"])) : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Внимание!</strong> Список групп пуст.
                </div>
            <?php endif; ?>

            <h1 style="text-align: center;">Расписание занятий</h1>
            <div class="container" style="margin-top: 50px;">
                <?php if(!empty($shedule_arr["shedule"])) : ?>
                    <?php foreach ($shedule_arr["shedule"] as $shedule) : ?>
                        <div class="col-md-4" id="shedule-cards" style="padding-left: 0px;">
                            <div class="panel panel-info" id="shedule<? echo $shedule["id_shedule"]; ?>">
                                <div class="panel-heading">
                                    <b><?= date_format(new DateTime($shedule["date"]), 'l jS F Y') ?></b>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span> Начало занятия: <?= date_format(new DateTime($shedule["time"]), 'H:i'); ?> <br>
                                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span> Длительность занятия (чч:мм): <?= $shedule["training_duration"]?> <br>
                                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Место проведения: <?= $shedule["place"]?> <br>
                                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Группа: <?= $shedule["group_name"]?> <br>
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Преподаватель: <?= $shedule["teacher_surname"] ." ".$shedule["teacher_name"]?> <br>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>
                    <!--</form> -->
                <?php elseif (empty($shedule_arr["shedule"])) : ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Внимание!</strong> Расписание отсутствует.
                    </div>
                <?php endif; ?>

            <h1 style="text-align: center;">Записаться на событие/мастер-класс</h1>
            <form class="form-horizontal" id="signUpEventForm" name="signUpEventForm" method="post">
                <span id="display_errors"></span><br>
                <div class="form-group">
                    <label for="surname">Ваша фамилия:</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                </div>
                <div class="form-group">
                    <label for="name">Ваше имя:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="name">Выберите событие:</label>
                        <?php if(!empty($events_arr["events"])) : ?>
                        <select class="form-control" id="events" name="events" required>
                        <?php foreach($events_arr["events"] as $event) : ?>
                            <option value='<?= $event["id_event"]?>'><?= $event['name'].". Проводит: ".$event['teacher_surname']." ".$event['teacher_name'].". ".'Дата проведения: '. date_format(new DateTime($event['date']), 'd.m.Y'); ?></option>
                        <?php endforeach; ?>
                        </select>
                        <?php elseif(empty($events_arr["events"])) : ?>
                        <select class="form-control" id="events" name="events">
                            <option>Ближайшие мероприятия отстутствуют</option>
                        </select>
                        <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Электронный адрес:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="button" name="signUpEventBtn" class="btn btn-info" id="sign-up-event-btn" onclick="window.signUpEvent()" value="Записаться на событие">
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>

