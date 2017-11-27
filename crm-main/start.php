<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="crm_main_page">
	<meta name="author" content="crm_main_page">
	<title>DS Admin</title>
	<!-- Bootstrap Core CSS -->
	<link href="/crm-main/styles/bootstrap.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="/crm-main/styles/sb-admin.css" rel="stylesheet">

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
		<!-- Top Menu Items -->
		<ul class="nav navbar-right top-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
				<ul class="dropdown-menu message-dropdown">
					<li class="message-preview">
						<a href="#">
							<div class="media">
								<span class="pull-left">
									<img class="media-object" src="http://placehold.it/50x50" alt="">
								</span>
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
								<span class="pull-left">
									<img class="media-object" src="http://placehold.it/50x50" alt="">
								</span>
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
								<span class="pull-left">
									<img class="media-object" src="http://placehold.it/50x50" alt="">
								</span>
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
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
				<ul class="dropdown-menu alert-dropdown">
					<li>
						<a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#">View All</a>
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
		<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li class="active">
					<a href="/crm-main/start.php"> Рабочий стол</a>
				</li>
				<li>
					<a href="charts.html"> Преподаватели</a>
				</li>
				<li>
					<a href="tables.html"> Группы</a>
				</li>
				<li>
					<a href="forms.html"> Клиенты</a>
				</li>
				<li>
					<a href="bootstrap-elements.html"> Расписание</a>
				</li>
				<li>
					<a href="bootstrap-grid.html"> События</a>
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
		<!-- /.navbar-collapse -->
	</nav>

	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Рабочий стол
						<small>Информация о студии</small>
					</h1>

					<!--<ol class="breadcrumb">
						<li>
							<i class="fa fa-dashboard"></i>  <a href="index.html">Рабочий стол</a>
						</li>
						<li class="active">
							<i class="fa fa-file"></i> Информация о студии
						</li>
					</ol>-->
				</div>
			</div>
			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="/crm-main/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/crm-main/js/bootstrap.min.js"></script>

</body>

</html>
