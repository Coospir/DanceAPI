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
                <input type="button" class="btn btn-danger btn-sm navbar-btn" id="deleteAllClientsBtn" name="deleteAllClientsBtn" onclick="alert('I am working!');" value="Очистить список клиентов">
            </form>
        </div>
        <?php if(!empty($clients_arr["clients"])) : ?>
            <?php foreach ($clients_arr["clients"] as $client) : ?>
                <div class="col-md-4" id="clients-cards" style="padding-left: 0px;">
                    <div class="panel panel-info" id="client<? echo $client["id_client"]; ?>">
                        <div class="panel-heading">
                            <?= $client['surname'] . ' ' . $client['name'] . ' ' . $client['patronymic'] ?>
                        </div>
                        <div class="panel-body">
                            <p><b>E-Mail: </b><?= $client['email']; ?></p>
                            <p><b>Контактный телефон: </b><?= $client['phone']; ?></p>
                            <p><b>Доп. телефон для связи: </b><?= $client['phone_dubl']; ?></p>
                            <p><b>Занимается в группах: </b><?= $client['groups']; ?></p>
                            <button type="submit" style="align-content: flex-end; " name="deleteClientBtn" class="btn btn-danger btn-xs" onclick="window.deleteClient('<?= $client['id_client'] ?>')"><span class="glyphicon glyphicon-trash"></span> Удалить</button>
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


