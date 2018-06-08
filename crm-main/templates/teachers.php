<?php
include __DIR__ . '/../templates/template.php';
include __DIR__ . '/../../dance_api/api/config/database.php';
include __DIR__ . '/../../dance_api/api/objects/User.class.php';

$db = new Database();
$db = $db->getConnection();
$modal_styles = $db->query("SELECT * FROM dance_style")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../templates/modals/teachers/add.php';

?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Преподаватели
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <input type="text" class="form-control pull-left" id="search" placeholder="Поиск..">
        <div class="form-group">
            <button class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#addNewTeacher"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить преподавателя</button>
            <button type="submit" class="btn btn-danger btn-sm navbar-btn" id="deleteAllTeachers" name="deleteAllTeachers" onclick="window.deleteAllTeachers()"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Очистить список преподавателей</button>
        </div>
        <?php if(!empty($teachers_arr["teachers"])) : ?>
            <?php foreach ($teachers_arr["teachers"] as $teacher) : ?>
                    <div class="col-md-4" id="teacher-cards" style="padding-left: 0px;">
                        <div class="panel panel-info" id="teacher<? echo $teacher["id_teacher"]; ?>">
                            <div class="panel-heading">
                                <?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?>
                            </div>
                            <div class="panel-body">
                                <p><b>E-Mail: </b><?= $teacher['email']; ?></p>
                                <p><b>Контактный телефон: </b><?= $teacher['phone']; ?></p>
                                <p><b>Стили танца: </b><?= $teacher['style']; ?></p>
                                <button type="submit" style="align-content: flex-end; " name="deleteTeacherBtn" class="btn btn-danger btn-xs" onclick="window.deleteTeacher('<?= $teacher['id_teacher'] ?>')"><span class="glyphicon glyphicon-trash"></span> Удалить</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <!--</form> -->
        <?php elseif (empty($teachers_arr["teachers"])) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Внимание!</strong> Список преподавателей пуст.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include __DIR__ . '/../templates/modals/teachers/update_modal.php'; ?>
<script>
    // Select All checkboxes
    $(document).ready(function() {
        $("#checkAll").click(function () {
            if(this.checked) {
                $(".checkbox").each(function () {
                    this.checked = true;
                });
            } else {
                $(".checkbox").each(function () {
                    this.checked = false;
                })
            }
        })
    });

    /*if($('#checkAll').prop('checked')) {
        alert('Привет!');
    } else {
        alert('Выделены!');
    }*/

</script>
