<?php
include __DIR__ . '/../templates/template.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../../dance_api/api/config/database.php';
include_once __DIR__ . '/../../dance_api/api/objects/Teacher.class.php';
$database = new Database();
$db = $database->getConnection();

$teacher = new Teacher($db);
$num = $teacher->ShowCountTeachers();

?>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Рабочий стол
					<small></small>
				</h1>
			</div>
        <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-file-text fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $num; ?></div>
                    <div>Количество преподавателей</div>
                  </div>
                </div>
              </div>
              <a href="/dance_api/api/functions/show_teachers.php">
                <div class="panel-footer">
                  <span class="pull-left">Перейти в раздел "Преподаватели"</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class='huge'>5</div>
                    <div>Количество групп</div>
                  </div>
                </div>
              </div>
              <a href="groups.php">
                <div class="panel-footer">
                  <span class="pull-left">Подробнее</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class='huge'>50</div>
                    <div>Количество клиентов</div>
                  </div>
                </div>
              </div>
              <a href="clients.php">
                <div class="panel-footer">
                  <span class="pull-left">Подробнее</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>
</div>

