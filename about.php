<!doctype html>
<html lang="ru">
<head>
    <link href="style/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.85, user-scalable=0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="style/js/jquery-3.2.1.min.js"></script>
    <script src="style/js/bootstrap.js"></script>
    <script src="style/js/functions_jquery.js"></script>
    <title>Wiki Dance</title>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <a class="navbar-brand" href="#">NICHOSI CREW</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="/index.php">Главная <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link active" href="/about.php">О нас</a>
            <a class="nav-item nav-link" href="dance_system/main.php">Dance System</a>
        </div>
    </div>
</nav>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <br>
        <h1 class="display-3">Танцевальная студия <br><i>NICHOSI CREW</i></h1>
        <!--<p class="lead">Многофункциональный ресурс для интересующихся "танцевальной" культурой.</p> -->
    </div>
</div>
<div class="container">
    <form method="post" action="/dance_api/api/functions/create_teacher.php">
        <div class="form-group">
            <input type="text" class="form-control" name="surname" id="surname">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="patronymic" id="patronymic">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="birth" id="birth">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" id="phone">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="mail" id="mail">
        </div>
        <button type="submit" class="btn btn-primary" name="addNewTeacher">Submit</button>
    </form>
</div>

</body>
</html>