<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
  <meta name="description" content="crm_main_page">
	<meta name="author" content="crm_main_page">
	<title>DanceCRM</title>
	<link href="/crm-main/styles/css/bootstrap.css" rel="stylesheet">
	<link href="/crm-main/styles/css/sb-admin.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=cyrillic" rel="stylesheet">
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
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> История <b class="caret"></b></a>
				<ul class="dropdown-menu message-dropdown">
					<li class="message-preview">
						<a href="#">
							<div class="media">
								<div class="media-body">
									<h5 class="media-heading">
										<strong>John Smith</strong>
									</h5>
									<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
									<p>Lorem ipsum dolor sit amet, consectetur...</p>
								</div>
							</div>
						</a>
					</li>
					<li class="message-preview">
						<a href="#">
							<div class="media">
								<div class="media-body">
									<h5 class="media-heading">
										<strong>John Smith</strong>
									</h5>
									<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
									<p>Lorem ipsum dolor sit amet, consectetur...</p>
								</div>
							</div>
						</a>
					</li>
					<li class="message-preview">
						<a href="#">
							<div class="media">
								<div class="media-body">
									<h5 class="media-heading">
										<strong>John Smith</strong>
									</h5>
									<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
									<p>Lorem ipsum dolor sit amet, consectetur...</p>
								</div>
							</div>
						</a>
					</li>
					<li class="message-footer">
						<a href="#">Посмотреть все сообщения..</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Юзернейм <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"><i class="fa fa-fw fa-user"></i> Профиль</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-gear"></i> Настройки</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#"><i class="fa fa-fw fa-power-off"></i> Выйти</a>
					</li>
				</ul>
			</li>
		</ul>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li>
					<a href="/crm-main/templates/dashboard.php"> Рабочий стол</a>
				</li>
				<li>
					<a href="/dance_api/api/functions/show_teachers.php"> Преподаватели</a>
				</li>
				<li>
					<a href="/crm-main/templates/groups.php"> Группы</a>
				</li>
				<li>
					<a href="/crm-main/templates/clients.php"> Клиенты</a>
				</li>
				<li>
					<a href="/crm-main/templates/shedule.php"> Расписание</a>
				</li>
				<li>
					<a href="/crm-main/templates/events.php"> События</a>
				</li>
				<li>
					<a href="javascript:;" data-toggle="collapse" data-target="#settings"><i class="fa fa-fw fa-arrows-v"></i> Настройки <i class="fa fa-fw fa-caret-down"></i></a>
					<ul id="settings" class="collapse">
						<li>
							<a href="#">Общие настройки</a>
						</li>
						<li>
							<a href="#">Бэкап</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
    <script src="/crm-main/js/jquery-3.2.1.min.js"></script>
    <script src="/crm-main/js/maskedinput.js"></script>
    <script src="/dance_api/api/functions/ajax.js"></script>
    <script src="/crm-main/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/crm-main/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="/crm-main/js/jquery.metadata.js"></script>
    <script type="text/javascript" src="/crm-main/js/table2download.js"></script>
    <script type="text/javascript" src="/crm-main/js/stacktable.js"></script>
</body>
</html>
