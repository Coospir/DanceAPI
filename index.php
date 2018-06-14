<!doctype html>
<html lang="ru">
<head>
    <link href="style/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Jura|Ubuntu+Mono" rel="stylesheet">
    <!--<meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.85, user-scalable=0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="style/js/jquery-3.2.1.min.js"></script>
    <script src="style/js/bootstrap.js"></script>
    <script src="style/js/functions_jquery.js"></script>
    <script src="/dance_api/api/functions/ajax.js"></script>
    <title>DanceCMS</title>
</head>
<body>
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="jumbotron">
        <div class="container text-center">
            <br>
            <h1 style="color: white; font-size: 80px;">Dance Studio CMS</h1>
            <p style="font-size: 24px; text-align: center; color: white">Первая, бесплатная и удобная система управления контентом танцевальной студии.</p>
            <a class="btn btn-info justify-content-center" style="font-size: 18px" href="/templates/login.php">Войти в систему</a> <b class="lead" style="color:white">или</b>
            <a class="btn btn-info justify-content-center" style="font-size: 18px" href="/templates/register.php">Регистрация нового пользователя</a>
        </div>
    </div>
    <?php
	    //TODO: Можно ли оставить такую проверочку?
      require __DIR__ . "/dance_api/api/config/Database.class.php";
      $database = new Database();
      if(!$database->getConnection()) {
        echo "<div class='alert alert-danger' style='text-align: center'><b>Проблема с подключением к базе данных DanceCMS:</b> обратитесь в тех. поддержку.</div>";
      }
    ?>
    <div class="container">
        <div class="WhyWe">
            <h1 style="text-align: center;">Почему стоит выбрать именно нас?</h1>
                <div class="container" style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-md-4" style="margin-top: 10px;">
                            <img class="rounded center-block"  src="/icons/easy.png" alt="Простота">
                            <h2 style="text-align: center">Простота</h2>
                            <p style="text-align: center; font-size: 16px;">Отзывчивый и понятный интерфейс, в котором разберется каждый.</p>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px;">
                            <img class="rounded center-block" src="/icons/settings.png" alt="Простота">
                            <h2 style="text-align: center">Функциональность</h2>
                            <p style="text-align: center; font-size: 16px; ">Мощная и гибкая система для удобной работы с ресурсами танцевальной студии.</p>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px;">
                            <img class="rounded center-block" src="/icons/free.png" alt="Простота">
                            <h2 style="text-align: center">Свободный доступ</h2>
                            <p style="text-align: center; font-size: 16px;">Все базовые функции аккаунта предоставляются совершенно бесплатно!</p>
                        </div>
                    </div>
                </div>
        </div>

    </div>
</body>
</html>
