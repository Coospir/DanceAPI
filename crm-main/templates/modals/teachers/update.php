<?php
include_once __DIR__ . '/../../../../dance_api/api/config/Database.class.php';
include_once __DIR__ . '/../../../../dance_api/api/objects/Teacher.class.php';

$database = new Database();
$db = $database->getConnection();
$teacher = new Teacher($db);
$teachers = $db->prepare("SELECT * FROM `teachers` WHERE teachers.id_teacher=:id");
$teachers -> bindValue(":id", $_POST['updateTeacherBtn']);
$teachers -> execute();
$data_teachers = $teachers->fetch(PDO::FETCH_ASSOC);

$all_styles = $db->query("SELECT * FROM dance_style")->fetchAll(PDO::FETCH_ASSOC);

$styles_arr = array();
$styles = $db->prepare("SELECT id_style as id FROM styles_teachers WHERE styles_teachers.id_teacher=:id");
$styles -> bindValue(":id", $_POST['updateTeacherBtn']);
$styles -> execute();
    while ($row = $styles->fetch(PDO::FETCH_ASSOC)) {
    array_push($styles_arr, $row["id"]);
}

?>

<!doctype html>
<html lang="ru">
<head>
    <link href="/style/css/bootstrap.css" rel="stylesheet">
    <link href="/style/css/update_teacher_form.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Jura|Ubuntu+Mono" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/style/js/jquery-3.2.1.min.js"></script>
    <script src="/style/js/bootstrap.js"></script>
    <script src="/style/js/functions_jquery.js"></script>
    <script src="/dance_api/api/functions/ajax.js"></script>
    <title>Изменение данных</title>
</head>
<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<div class="wrapper">
    <form id="updateTeacherForm" class="form-update-teacher" method="post">
        <h2 class="form-update-teacher-heading">Изменение информации преподавателя</h2>
        <div class="form-group">
            <input type="hidden"  class="form-control" name="id_teacher" id="id_teacher" value="<?php echo $data_teachers['id_teacher']; ?>"
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="surname" id="surname" placeholder="Фамилия" value="<?php echo $data_teachers['surname']; ?>" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="name" id="name" placeholder="Имя" value="<?php echo $data_teachers['name']; ?>" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="patronymic" id="patronymic" placeholder="Отчество" value="<?php echo $data_teachers['patronymic']; ?>">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="mail" id="mail" placeholder="E-Mail" value="<?php echo $data_teachers['email']; ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон" value="<?php echo $data_teachers['phone']; ?>">
        </div>
        <div class="form-group">
            <p>Выберите стиль/-ли преподавателя:</p>
            <?php
            foreach ($all_styles as $style) {
                if(in_array($style["id_style"], $styles_arr)) {
                    echo "<input type='checkbox' checked id='styles' name='styles[]' value=".$style['id_style']."><rt>"." ".$style['title']."<br>";
                } else {
                    echo "<input type='checkbox' id='styles' name='styles[]' value=".$style['id_style']."><rt>"." ".$style['title']."<br>";
                }
            }
            ?>
        </div>
        <input type="submit" name="updateTeacher" class="btn btn-success btn-sm navbar-btn" id="updateTeacher" onclick="window.updateTeacher()" value="Сохранить изменения">
    </form>
</div>
</body>
</html>
<script src="/style/js/jquery-3.2.1.min.js"></script>
<script src="/style/js/functions_jquery.js"></script>
<script src="/dance_api/api/functions/ajax.js"></script>
<script src="/crm-main/js/maskedinput.js"></script>
