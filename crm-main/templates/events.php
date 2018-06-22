<?php
include __DIR__ . '/../templates/template.php';
include __DIR__ . '/../../dance_api/api/config/Database.class.php';
include __DIR__ . '/../../dance_api/api/objects/Event.class.php';

$db = new Database();
$db = $db->getConnection();

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
                <input type="button" class="btn btn-danger btn-sm navbar-btn" id="deleteAllEventsBtn" name="deleteAllEventsBtn" onclick="alert('I am working!');" value="Очистить список событий">
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


