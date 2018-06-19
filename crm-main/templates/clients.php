<?php
include __DIR__ . '/../templates/template.php';
include __DIR__ . '/../../dance_api/api/config/Database.class.php';
include __DIR__ . '/../../dance_api/api/objects/User.class.php';

$db = new Database();
$db = $db->getConnection();
$groups = $db->query("SELECT groups.id_group, groups.name as group_name, groups.level, groups.training_duration, groups.price, teachers_groups.id_group, teachers.id_teacher, teachers.surname as teacher_surname, teachers.name as teacher_name FROM groups INNER JOIN teachers_groups ON(groups.id_group = teachers_groups.id_group) INNER JOIN teachers ON(teachers.id_teacher = teachers_groups.id_teacher)")->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/../templates/modals/clients/add.php';

?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Клиенты
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <input type="text" class="form-control pull-left" id="search-client" placeholder="Поиск..">
        <div class="form-group">
            <button class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#addNewClient"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить клиента</button>
            <form id="deleteAllClientsForm" method="post">
                <input type="button" class="btn btn-danger btn-sm navbar-btn" id="deleteAllClientsBtn" name="deleteAllClientsBtn" onclick="window.deleteAllClients()" value="Очистить список клиентов">
            </form>
        </div>
        <?php if(!empty($clients_arr["clients"])) : ?>
            <?php foreach ($clients_arr["clients"] as $client) : ?>
                <div class="col-md-4" id="clients-cards" style="padding-left: 0px;">
                    <div class="panel panel-success" id="client<? echo $client["id_client"]; ?>">
                        <div class="panel-heading">
                            <?= $client['surname'] . ' ' . $client['name'] . ' ' . $client['patronymic'] ?>
                            <button type="submit" style="align-content: flex-end; " name="deleteClientBtn" class="btn btn-success btn-xs" onclick="window.deleteClient('<?= $client['id_client'] ?>')"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                        <div class="panel-body">
                            <p><b>E-Mail: </b><?= $client['email']; ?></p>
                            <p><b>Контактный телефон: </b><?= $client['phone']; ?></p>
                            <p><b>Доп. телефон для связи: </b><?= $client['phone_dubl']; ?></p>
                            <p><b>Занимается в группах: </b><?= $client['group_name']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!--</form> -->
        <?php elseif (empty($clients_arr["clients"])) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Внимание!</strong> Список клиентов пуст.
            </div>
        <?php endif; ?>
    </div>
</div>


