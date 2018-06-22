<?php
include __DIR__ . '/../templates/template.php';
include __DIR__ . '/../../dance_api/api/config/Database.class.php';
include __DIR__ . '/../../dance_api/api/objects/User.class.php';

$db = new Database();
$db = $db->getConnection();

$teachers_arr = $db->query("SELECT GROUP_CONCAT( dance_style.title ) as style, styles_teachers.id_teacher, teachers.id_teacher, teachers.surname, teachers.name, teachers.patronymic, teachers.email, teachers.phone FROM dance_style INNER JOIN styles_teachers ON ( dance_style.id_style = styles_teachers.id_style ) INNER JOIN teachers ON ( teachers.id_teacher = styles_teachers.id_teacher ) GROUP BY teachers.id_teacher")->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/../templates/modals/groups/add.php';
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Группы
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <input type="text" class="form-control pull-left" id="search-group" placeholder="Поиск..">
        <div class="form-group">
            <button class="btn btn-success btn-sm navbar-btn" data-toggle="modal" data-target="#addNewGroup"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить группу</button>
            <form id="deleteAllGroupsForm" method="post">
                <input type="button" class="btn btn-success btn-sm navbar-btn" id="deleteAllGroupsBtn" name="deleteAllGroupsBtn" onclick="window.deleteAllGroups()" value="Очистить список групп">
            </form>
        </div>
        <?php if(!empty($groups_arr["groups"])) : ?>
            <?php foreach ($groups_arr["groups"] as $group) : ?>
                <div class="col-md-4" id="groups-cards" style="padding-left: 0px;">
                    <div class="panel panel-green" id="group<? echo $group["id_group"]; ?>">
                        <div class="panel-heading">
                            <?= $group['group_name']; ?>
                            <button type="submit" style="align-content: flex-end; " name="deleteGroupBtn" class="btn btn-success btn-xs" onclick="window.deleteGroup('<?= $group['id_group'] ?>')"><span class="glyphicon glyphicon-trash"></span> </button>
                        </div>
                        <div class="panel-body">
                            <p><b>Уровень: </b><?= $group['level']; ?></p>
                            <p><b>Длительность занятия: </b><?= $group['training_duration']; ?></p>
                            <p><b>Стоимость абонемента (8 занятий): </b><?= $group['price'] . " руб." ?></p>
                            <p><b>Преподаватель: </b><?= $group['teacher_surname'] . " " .$group['teacher_name'] ?></p>
                            <button type="submit" style="align-content: flex-end; " name="updateGroupBtn" class="btn btn-success btn-xs" onclick="window.updateGroup('<?= $group['id_group'] ?>')"><span class="glyphicon glyphicon-trash"></span> Изменить</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!--</form> -->
        <?php elseif (empty($groups_arr["groups"])) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Внимание!</strong> Список групп пуст.
            </div>
        <?php endif; ?>
    </div>
</div>


