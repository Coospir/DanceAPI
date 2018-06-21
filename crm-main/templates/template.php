<?php
    include __DIR__ . '/../../dance_api/api/config/Database.class.php';
    include __DIR__ . '/../../dance_api/api/objects/User.class.php';

    $db = new Database();
    $db = $db->getConnection();

    $user = new User($db);

    if (isset($_COOKIE["auth_token"])) {
    $info = $user->GetInfoByToken($_COOKIE["auth_token"]);
    if($info) {
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="cms_main_page">
    <meta name="author" content="cms_main_page">
    <title>DanceCMS</title>
    <link href="/crm-main/styles/css/bootstrap.css" rel="stylesheet">
    <link href="/crm-main/styles/css/sb-admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=cyrillic" rel="stylesheet">
    <script src="/crm-main/js/jquery-3.2.1.min.js"></script>
    <script src="/crm-main/js/maskedinput.js"></script>
    <script src="/dance_api/api/functions/ajax.js"></script>
    <script src="/crm-main/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/crm-main/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="/crm-main/js/jquery.metadata.js"></script>
    <script type="text/javascript" src="/crm-main/js/table2download.js"></script>
    <script type="text/javascript" src="/crm-main/js/stacktable.js"></script>
    <script type="text/javascript" src="/crm-main/js/jquery.spincrement.js"></script>
</head>

<body>


<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-user"></i> <?php echo $info["name"]; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Профиль</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> Выйти</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/crm-main/templates/dashboard.php"> Рабочий стол</a>
                </li>
                <li>
                    <a href="/dance_api/api/functions/read_teachers.php"> Преподаватели</a>
                </li>
                <li>
                    <a href="/dance_api/api/functions/read_groups.php"> Группы</a>
                </li>
                <li>
                    <a href="/dance_api/api/functions/read_clients.php"> Клиенты</a>
                </li>
                <li>
                    <a href="/dance_api/api/functions/read_shedule.php"> Расписание</a>
                </li>
                <li>
                    <a href="/dance_api/api/functions/read_events.php"> События</a>
                </li>
            </ul>
        </div>
    </nav>
</body>
<?php
    }
} else header('Location: https://dancecrm.ru/templates/login.php');
?>
</html>
