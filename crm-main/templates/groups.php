<?php
include __DIR__ . '/../templates/template.php';
include __DIR__ . '/../../dance_api/api/config/Database.class.php';
include __DIR__ . '/../../dance_api/api/objects/User.class.php';

$db = new Database();
$db = $db->getConnection();


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
        <input type="text" class="form-control pull-left" id="search-client" placeholder="Поиск..">
        <div class="form-group">
            <button class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#addNewGroup"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить группу</button>
            <form id="deleteAllGroupsForm" method="post">
                <input type="button" class="btn btn-danger btn-sm navbar-btn" id="deleteAllGroupsBtn" name="deleteAllGroupsBtn" onclick="alert('I am working!');" value="Очистить список групп">
            </form>
        </div>
        <?php if(!empty($groups_arr["groups"])) : ?>
            <?php foreach ($groups_arr["groups"] as $group) : ?>
                <div class="col-md-4" id="groups-cards" style="padding-left: 0px;">
                    <div class="panel panel-primary" id="group<? echo $group["id_group"]; ?>">
                        <div class="panel-heading">
                            <?= $group['name']; ?>
                        </div>
                        <div class="panel-body">
                            <p><b>Уровень: </b><?= $group['level']; ?></p>
                            <p><b>Длительность занятия: </b><?= $group['training_duration']; ?></p>
                            <p><b>Преподаватель: </b><?php echo "Связать с преподавателями"; /*$group['trainer']; */?></p>
                            <button type="submit" style="align-content: flex-end; " name="deleteGroupBtn" class="btn btn-danger btn-xs" onclick="window.deleteGroup('<?= $group['id_group'] ?>')"><span class="glyphicon glyphicon-trash"></span> Удалить</button>
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


