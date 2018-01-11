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
  <title>DanceCRM</title>
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<div class="jumbotron">
  <div class="container">
    <h1 class="text-center" style="color: white">Dance Studio CRM</h1><hr>
    <h3 class="text-center" style="color: white">Остался последний штрих! Создайте Вашу танцевальную студию, чтобы завершить базовую настройку аккаунта!</h3>
  </div>
</div>
<div class="container">
  <form class="form-control-static" id="addStudioForm" method="post">
    <div class="form-group">
      <input type="text" class="form-control input-lg" name="name" id="name" placeholder="Название студии *" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control input-lg" name="address" id="address" placeholder="Адрес студии *" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control input-lg" name="phone" id="phone" placeholder="Контактный телефон">
    </div>
    <p class="text-info text-center"><b>Звездочкой * обозначены поля, обязательные для заполнения.</b></p>
    <button type="button" class="btn btn-lg center-block btn-info" id="add-studio-btn" name="addNewStudio" onclick="window.addNewStudio()">Завершить настройку</button>
  </form>
</div>
</body>
</html>

