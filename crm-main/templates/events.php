<?php
include __DIR__ . '/../templates/template.php';
include __DIR__ . '/../../dance_api/api/config/Database.class.php';
include __DIR__ . '/../../dance_api/api/objects/Event.class.php';

$db = new Database();
$db = $db->getConnection();

$teachers_arr = $db->query("SELECT GROUP_CONCAT( dance_style.title ) as style, styles_teachers.id_teacher, teachers.id_teacher, teachers.surname, teachers.name, teachers.patronymic, teachers.email, teachers.phone FROM dance_style  RIGHT JOIN styles_teachers ON ( dance_style.id_style = styles_teachers.id_style ) RIGHT JOIN teachers ON ( teachers.id_teacher = styles_teachers.id_teacher ) GROUP BY teachers.id_teacher")->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/../templates/modals/events/add.php';

?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    События
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <input type="text" class="form-control pull-left" id="search-event" placeholder="Поиск..">
        <div class="form-group">
            <button class="btn btn-danger btn-sm navbar-btn" data-toggle="modal" data-target="#addNewEvent"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить событие</button>
            <form id="deleteAllEventsForm" method="post">
                <input type="button" class="btn btn-danger btn-sm navbar-btn" id="deleteAllEventsBtn" name="deleteAllEventsBtn" onclick="window.deleteAllEvents()" value="Очистить список событий">
            </form>
        </div>
        <?php if(!empty($events_arr["events"])) : ?>
            <?php foreach ($events_arr["events"] as $event) : ?>
                <div class="col-md-4" id="events-cards" style="padding-left: 0px;">
                    <div class="panel panel-red" id="event<? echo $event["id_event"]; ?>">
                        <div class="panel-heading">
                            <?= $event['name'] ?>
                            <button type="submit" style="align-content: flex-end; " name="deleteEventBtn" class="btn btn-danger btn-xs" onclick="window.deleteEvent('<?= $event['id_event'] ?>')"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                        <div class="panel-body">
                            <p><b>Дата проведения: </b><?= date_format(new DateTime($event['date']), 'd.m.Y'); ?></p>
                            <p><b>Преподаватель: </b><?= $event['teacher_surname'] .' '. $event['teacher_name']; ?></p>
                            <p><b>Стоимость: </b><?= $event['price']; ?> руб.</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!--</form> -->
        <?php elseif (empty($events_arr["events"])) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Внимание!</strong> Список событий пуст.
            </div>
        <?php endif; ?>
    </div>
</div>


