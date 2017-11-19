<!doctype html>
<html lang="ru">
<head>
    <link href="/style/css/bootstrap.css" rel="stylesheet">
    <link href="/style/css/datatables.css" rel="stylesheet">
    <link href="/style/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/style/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/style/css/buttons.dataTables.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Jura|Ubuntu+Mono" rel="stylesheet">
    <!--    <meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.85, user-scalable=0">
    -->    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/style/js/jquery-3.2.1.min.js"></script>
    <script src="/style/js/datatables.js"></script>
    <script src="/style/js/dataTables.bootstrap.js"></script>
    <script src="/style/js/bootstrap.js"></script>
    <script src="/style/js/functions_jquery.js"></script>
    <script src="/style/js/maskedinput.js"></script>
    <script src="/dance_api/api/functions/ajax.js"></script>

    <!--<script src="/style/js/encoding-indexes.js"></script>
    <script src="/style/js/encoding.js"></script>-->
    <title>DanceCRM</title>
</head>
<body>

<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/dance_system/main.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> В меню</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/dance_api/api/functions/readTeacher.php">Преподаватели</a></li>
            <li><a href="#">Группы</a></li>
            <li><a href="#">Клиенты</a></li>
            <li><a href="#">Расписание</a></li>
            <li><a href="#">События</a></li>
            <li><a href="#">Настройки</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <button class="btn btn-success btn-sm navbar-btn" data-toggle="modal" data-target="#addNewTeacher"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить преподавателя</button>
            <button class="btn btn-info btn-sm navbar-btn" id="get-csv" onclick="exportTableToCSV('teachers.csv')"><span class="glyphicon glyphicon-export" aria-hidden="true"></span> Экспорт таблицы в CSV-файл</button>
            <button class="btn btn-danger btn-sm navbar-btn" data-toggle="modal" data-target="#deleteAllTeachers"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Удалить всех преподавателей</button>
        </ul>
    </div>
</nav>
<div class="panel panel-default" style="margin-top: -20px;">
    <div class="panel-heading">
        <h1 style="color: black; text-align: center; font-size:41px;"><?= $title; ?></h1>
    </div>
</div>
