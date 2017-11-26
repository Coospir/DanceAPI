<!-- Modal Window Add Teacher -->
<div id="addNewTeacher" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавление информации о новом преподавателе</h4>
            </div>
            <div class="modal-body">
                <form id="addTeacherForm" method="post">
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
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="mail" id="mail" placeholder="E-Mail">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="style" id="style" placeholder="Направление(-я)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="social_page" id="social_page" placeholder="Ссылка на соц. сеть">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" name="addNewTeacher" onclick="window.addNewTeacher()">Создать</button>
                <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Window Delete All Teachers -->
<div id="deleteAllTeachers" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Вы уверены, что хотите удалить всех преподавателей?</h4>
            </div>
            <div class="modal-body">
                <form id="deleteAllTeachers" method="post">
                    <div class="form-group">
                        <p>После удаления данных восстановить Вы их не сможете. Удалить?</p>
                        <button class="btn btn-warning btn-sm navbar-btn" id="delete-teachers" onclick="window.deleteAllTeachers()"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Удалить всех преподавателей</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>
