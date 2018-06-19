<form id="addClientForm" method="post">
    <div id="addNewClient" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавление нового клиента</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Фамилия" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Имя" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="patronymic" id="patronymic" placeholder="Отчество">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone_dubl" id="phone_dubl" placeholder="Доп. телефон">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Адрес">
                    </div>
                    <div class="form-group">
                        <p>Выберите группу/-ы для клиента:</p>
                        <?php
                        foreach ($groups as $g) {
                            echo "<input type='checkbox' name='groups[]' value=".$g['id_group']."><rt>"." Группа: ".$g['group_name']." - ".$g['level'].". Преподаватель: ".$g['teacher_surname']." ".$g['teacher_name']."<br>";
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" name="addNewClient" class="btn btn-success" id="add-client-btn" onclick="window.addNewClient()" value="Создать">
                    <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="/style/js/jquery-3.2.1.min.js"></script>
<script src="/style/js/functions_jquery.js"></script>
<script src="/dance_api/api/functions/ajax.js"></script>
<script src="/crm-main/js/maskedinput.js"></script>
