<?php
include __DIR__ . '/../templates/template.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../../dance_api/api/config/Database.class.php';
include_once __DIR__ . '/../../dance_api/api/objects/Teacher.class.php';
include_once __DIR__ . '/../../dance_api/api/objects/Group.class.php';
include_once __DIR__ . '/../../dance_api/api/objects/Client.class.php';
include_once __DIR__ . '/../../dance_api/api/objects/Event.class.php';
include_once __DIR__ . '/../../dance_api/api/objects/Shedule.class.php';
$database = new Database();
$db = $database->getConnection();

$teacher = new Teacher($db);
$group = new Group($db);
$client = new Client($db);
$event = new Event($db);
$shedule = new Shedule($db);

$num_teachers = $teacher->ShowCountTeachers();
$num_groups = $group->ShowCountGroups();
$num_clients = $client->ShowCountClients();
$num_events = $event->ShowCountEvents();
$num_tr = $shedule->ShowCountTrainings();

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
          <div class="col-lg-3 col-md-3">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-file-text fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class='huge'>
                        <?php echo $num_teachers; ?>
                    </div>
                    <div>Количество преподавателей</div>
                  </div>
                </div>
              </div>
              <a href="/dance_api/api/functions/read_teachers.php">
                <div class="panel-footer">
                  <span class="pull-left">Перейти в раздел "Преподаватели"</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="panel panel-green">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class='huge'>
                        <?php echo $num_groups; ?>
                    </div>
                    <div>Количество групп</div>
                  </div>
                </div>
              </div>
              <a href="/dance_api/api/functions/read_groups.php">
                <div class="panel-footer">
                  <span class="pull-left">Перейти в раздел "Группы"</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="panel panel-yellow">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class='huge'>
                        <?php echo $num_clients; ?>
                    </div>
                    <div>Количество клиентов</div>
                  </div>
                </div>
              </div>
              <a href="/dance_api/api/functions/read_clients.php">
                <div class="panel-footer">
                  <span class="pull-left">Перейти в раздел "Клиенты"</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
            <div class="col-lg-3 col-md-3">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <?php echo $num_events; ?>
                                </div>
                                <div>Ближайшие события</div>
                            </div>
                        </div>
                    </div>
                    <a href="/dance_api/api/functions/read_events.php">
                        <div class="panel-footer">
                            <span class="pull-left">Перейти в раздел "События"</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <?php echo $num_tr; ?>
                                </div>
                                <div>Количество распределенных дней с тренировками на неделю</div>
                            </div>
                        </div>
                    </div>
                    <a href="/dance_api/api/functions/read_events.php">
                        <div class="panel-footer">
                            <span class="pull-left">Перейти в раздел "Расписание"</span>
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

<script>
    $(".huge").spincrement();
</script>

