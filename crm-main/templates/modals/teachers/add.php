<form id="addTeacherForm" method="post">
    <div id="addNewTeacher" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавление информации о новом преподавателе</h4>
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
                            <input type="email" class="form-control" name="mail" id="mail" placeholder="E-Mail">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон">
                        </div>
                        <div class="form-group">
                            <p>Выберите стиль/-ли преподавателя:</p>
                                <?php
                                    foreach ($modal_styles as $style) {
                                        echo "<input type='checkbox' name='styles[]' value=".$style['id_style']."><rt>"." ".$style['title']."<br>";
                                    }
                                ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="button" name="addNewTeacher" class="btn btn-success" id="add-teacher-btn" onclick="window.addNewTeacher()" value="Создать">
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
