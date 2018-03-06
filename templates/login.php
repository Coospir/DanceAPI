<!doctype html>
<html lang="ru">
<head>
    <link href="/style/css/bootstrap.css" rel="stylesheet">
    <link href="/style/css/login_form.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Jura|Ubuntu+Mono" rel="stylesheet">
    <!--    <meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.85, user-scalable=0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/style/js/jquery-3.2.1.min.js"></script>
    <script src="/style/js/bootstrap.js"></script>
    <script src="/style/js/functions_jquery.js"></script>
    <script src="/dance_api/api/functions/ajax.js"></script>
    <title>Авторизация</title>
</head>
<body>

<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<div class="wrapper">
    <form id="loginUserForm" class="form-signin" method="post">
        <h2 class="form-signin-heading">Авторизация в системе</h2>
        <span id="display_errors"></span><br>
        <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail" required="" autofocus="" />
        <input type="password" class="form-control" name="password" id="password" placeholder="Пароль" required="" style="margin-top: 5px;"/>
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Запомнить меня
        <button class="btn btn-lg btn-success btn-block" style="margin-top: 20px;" type="submit" onclick="window.authUser()">Войти</button>
    </form>
</div>
</body>
</html>