<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include __DIR__ . '/../dance_api/api/config/Database.class.php';
include __DIR__ . '/../dance_api/api/objects/Teacher.class.php';

$database = new Database();
$db = $database->getConnection();

$teacher = new Teacher($db);
$stmt = $teacher->ReadTeacher();
$num = $teacher->ShowCountTeachers();

if($num > 0) {
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
        <h1 style="text-align: center;">Наши преподаватели</h1>
        <div class="container" style="margin-top: 50px;">

            <?php if(!empty($teachers_arr["teachers"])) : ?>
                <?php foreach ($teachers_arr["teachers"] as $teacher) : ?>
                    <div class="col-md-4" id="teachers-cards" style="padding-left: 0px;">
                        <div class="panel panel-primary" id="teacher<? echo $teacher["id_teacher"]; ?>" style="background-color: #1AA6B7">
                            <div class="panel-heading">
                                <?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?>
                            </div>
                            <div class="panel-body">
                                <p><b>Стили танца: </b><?= $teacher['style']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!--</form> -->
            <?php elseif (empty($teachers_arr["teachers"])) : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Внимание!</strong> Список преподавателей пуст.
                </div>
            <?php endif; ?>
            <br>
            <br>
            <h1 style="text-align: center;">Запись на событие</h1>
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="name">Ваше имя:</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="surname">Ваша фамилия:</label>
                    <input type="text" class="form-control" id="surname">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон:</label>
                    <input type="text" class="form-control" id="phone">
                </div>
                <div class="form-group">
                    <label for="pwd">Электронный адрес:</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <button type="submit" class="btn btn-default">Записаться</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>

