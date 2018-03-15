<!doctype html>
<html lang="ru">
<head>
    <link href="/style/css/bootstrap.css" rel="stylesheet">
    <link href="/style/css/register_form.css" rel="stylesheet">
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
    <title>Регистрация</title>
</head>
<body>

<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<div class="wrapper">
    <form id="registerUserForm" class="form-signin" method="post">
        <div id="form-content">
            <h2 class="form-signin-heading">Регистрация нового пользователя</h2>
            <span id="display_errors"></span><br>
            <input type="text" class="form-control" name="username" id="username" placeholder="Фамилия Имя" required="" autofocus=""/>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail" required="" autofocus="" style="margin-top: 5px;"/>
            <input type="password" class="form-control" name="password" id="password" placeholder="Пароль" required="" style="margin-top: 5px;"/>
            <p style="margin: 5px 10px 10px; font-size: 10px; font-style: italic;">
                <input type="checkbox" name="user_type"> Подтверждаю, что являюсь руководителем танцевальной студии
            </p>
            <button type="button" class="btn btn-lg btn-success btn-block" style="margin-bottom: 10px; margin-top: 20px;" onclick="window.registerUser()">Зарегистрироваться</button>
        </div>
    </form>
</div>
</body>
</html>
