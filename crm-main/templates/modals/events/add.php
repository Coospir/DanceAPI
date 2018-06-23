<form id="addEventForm" method="post">
    <div id="addNewEvent" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание нового события</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Наименование события" required>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="date" id="date" placeholder="Дата проведения" required>
                    </div>
                    <div class="form-group">
                        <label for="id_teacher">Выберите преподавателя:</label>
                        <?php if(!empty($teachers_arr)) : ?>
                            <select class="form-control" id="teacher" name="teacher" required>
                                <?php foreach($teachers_arr as $teacher) : ?>
                                    <option value='<?= $teacher["id_teacher"]?>'><?= $teacher['surname']." ".$teacher['name'].". Преподает: ".$teacher['style'];?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif(empty($teachers_arr)) : ?>
                            <select class="form-control" id="teacher" name="teacher">
                                <option>Список преподавателей отсутствует</option>
                            </select>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="price" id="price" placeholder="Цена за вход (руб.)">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" name="addNewEvent" class="btn btn-success" id="add-event-btn" onclick="window.addNewEvent()" value="Создать">
                    <button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="/style/js/jquery-3.2.1.min.js"></script>
<script src="/style/js/functions_jquery.js"></script>
<script src="/dance_api/api/functions/ajax.js"></script>
