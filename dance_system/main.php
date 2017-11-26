<!doctype html>
<html lang="ru">
<head>
    <link href="../style/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Jura|Ubuntu+Mono" rel="stylesheet">
<!--    <meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.85, user-scalable=0">
-->    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../style/js/jquery-3.2.1.min.js"></script>
    <script src="../style/js/bootstrap.js"></script>
    <script src="../style/js/functions_jquery.js"></script>
    <title>DanceCRM</title>
</head>
<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/index.php" style="font-size: 18px;"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выход из системы</a>
        </div>
        <form class="navbar-form navbar-right">
            <!--<div class="form-group">
                <input type="text" class="form-control" placeholder="Поиск..">
            </div>
            <button type="submit" class="btn btn-default">Найти</button>-->
        </form>
    </div>
</nav>
<div class="container" style="margin-top: 50px;">
    <div class="WhyWe">
        <h1 style="text-align: center; font-size: 44px;">Выберите пункт меню для начала работы:</h1>
            <div class="row" style="margin-top: 40px;">
                <div class="col-md-4" id="card" style="margin-top: 50px;" onclick="location.href='/../dance_api/api/functions/readTeacher.php'">
                    <img class="rounded center-block" src="/icons/teachers.png" alt="Преподаватели">
                    <h3 style="text-align: center">Преподаватели</h3>
                    <p style="text-align: center">Система, в которой разберется каждый</p>
                </div>
                <div class="col-md-4" id="card" style="margin-top: 50px;" onclick="location.href=''">
                    <img class="rounded center-block" src="/icons/groups.png" alt="Группы">
                    <h3 style="text-align: center">Группы</h3>
                    <p style="text-align: center">Танцевальные группы Вашей танцевальной студии</p>
                </div>
                <div class="col-md-4" id="card" style="margin-top: 50px;" onclick="location.href=''">
                    <img class="rounded center-block" src="/icons/clients.png" alt="Клиенты">
                    <h3 style="text-align: center">Клиенты</h3>
                    <p style="text-align: center">Клиенты Вашей танцевальной студии</p>
                </div>
                <div class="col-md-4" id="card" style="margin-top: 50px;" onclick="location.href=''">
                    <img class="rounded center-block" src="/icons/shedule.png" alt="Расписание">
                    <h3 style="text-align: center">Расписание</h3>
                    <p style="text-align: center">Расписание Вашей танцевальной студии</p>
                </div>
                <div class="col-md-4" id="card" style="margin-top: 50px;" onclick="location.href=''">
                    <img class="rounded center-block" src="/icons/action.png" alt="События">
                    <h3 style="text-align: center">События</h3>
                    <p style="text-align: center">Различные мероприятия Вашей танцевальной студии</p>
                </div>
                <div class="col-md-4" id="card" style="margin-top: 50px;" onclick="location.href=''">
                    <img class="rounded center-block" src="/icons/stngs.png" alt="Настройки">
                    <h3 style="text-align: center">Настройки</h3>
                    <p style="text-align: center">Настройки Вашей танцевальной студии</p>
                </div>
            </div>
        </div>
    <hr>

</div>
</body>
</html>
