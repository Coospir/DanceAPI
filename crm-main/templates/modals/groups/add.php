<form id="addGroupForm" method="post">
    <div id="addNewGroup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание новой группы</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Название группы" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="level" id="level" placeholder="Уровень (начинающие, продолжающие, профи)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="training_duration" id="training_duration" placeholder="Длительность занятия (чч:мм)" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="price" id="price" placeholder="Стоимость абонемента (месяц)" required>
                    </div>
                    <div class="form-group">
                        <p>Выберите преподавателя группы:</p>
                        <select class="form-control" id="teacher-for-group" name="teacher-for-group" required>
                            <?php
                            for($i = 0; $i < count($teachers_arr); $i++)
                            {
                                echo "<option value=".$teachers_arr[$i]['id_teacher'].">".$teachers_arr[$i]['surname']." ".$teachers_arr[$i]['name']." - ".$teachers_arr[$i]['style']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" name="addNewGroup" class="btn btn-success" id="add-group-btn" onclick="window.addNewGroup()" value="Создать">
                    <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="/style/js/jquery-3.2.1.min.js"></script>
<script src="/style/js/functions_jquery.js"></script>
<script src="/dance_api/api/functions/ajax.js"></script>

