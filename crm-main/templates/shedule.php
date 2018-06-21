<?php
include __DIR__ . '/../templates/template.php';
include __DIR__ . '/../../dance_api/api/config/Database.class.php';
include __DIR__ . '/../../dance_api/api/objects/Shedule.class.php';

$db = new Database();
$db = $db->getConnection();

?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Расписание танцевальной студии
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <input type="text" class="form-control pull-left" id="search-shedule" placeholder="Поиск..">
        <div class="form-group">
            <button class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#addNewTrain"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить занятие</button>
            <form id="deleteAllTrainingsForm" method="post">
                <input type="button" class="btn btn-danger btn-sm navbar-btn" id="deleteAllTrainingsBtn" name="deleteAllTrainingsBtn" onclick="window.deleteAllTrainings()" value="Очистить расписание">
            </form>
        </div>
        <?php if(!empty($shedule_arr["shedule"])) : ?>
            <?php foreach ($shedule_arr["shedule"] as $shedule) : ?>
                <div class="col-md-4" id="shedule-cards" style="padding-left: 0px;">
                    <div class="panel panel-danger" id="shedule<? echo $shedule["id_shedule"]; ?>">
                        <div class="panel-heading">
                            <?= date_format(new DateTime($shedule["date"]), 'l jS F Y') ?>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> Начало занятия: <?= date_format(new DateTime($shedule["time"]), 'H:i'); ?> <br>
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> Длительность занятия (чч:мм): <?= $shedule["training_duration"]?> <br>
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Место проведения: <?= $shedule["place"]?> <br>
                                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Группа: <?= $shedule["group_name"]?> <br>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Преподаватель: <?= $shedule["teacher_surname"] ." ".$shedule["teacher_name"]?> <br>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
            <!--</form> -->
        <?php elseif (empty($shedule_arr["shedule"])) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Внимание!</strong> Расписание отсутствует.
            </div>
        <?php endif; ?>
    </div>
</div>



