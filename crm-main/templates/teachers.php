<?php
    include __DIR__ . '/../templates/template.php';
    include __DIR__ . '/../../dance_api/api/config/database.php';

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
					<small></small>
				</h1>
			</div>
    </div>
  </div>
  <div class="container-fluid">
      <div class="form-group">
          <input type="text" class="form-control pull-right" id="search" placeholder="Поиск..">
      </div>
    <button class="btn btn-info btn-xs navbar-btn" data-toggle="modal" data-target="#addNewTeacher"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить преподавателя</button>
    <button type="submit" class="btn btn-success btn-xs navbar-btn" name="download-csv" id="download-csv" onclick="window.downloadCSV()"><span class="glyphicon glyphicon-export" aria-hidden="true"></span> Экспорт в CSV</button>
      <?php if(!empty($teachers_arr["teachers"])) : ?>
          <!--<form role="form" class="form-horizontal" method="post" action="/crm-main/templates/modals/teachers/update.php"> -->
              <table class="table table-bordered table-hover col-12 col-sm-12 col-lg-12 table-responsive" id="teacher-table">
                <thead>
                <tr class="head">
                  <th><input type="checkbox" id="checkAll"></th>
                  <th>Преподаватель</th>
                  <th>E-Mail</th>
                  <th>Контактный телефон</th>
                  <th>Стиль/-и</th>
                  <th>Функции</th>
                </tr>
                </thead>
                <tbody id="teacher-table-data">
				<?php
                    foreach ($teachers_arr["teachers"] as $teacher) : ?>
                      <tr>
                        <td class="information"><input class="checkbox" type="checkbox" name="teachers[]" value="<?php echo $teacher["id_teacher"]; ?>"></td>
                        <td class="information"><?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?></td>
                        <td class="information"><?= $teacher['email']; ?></td>
                        <td class="information"><?= $teacher['phone']; ?></td>
                        <td class="information"><?/*= $teacher['title']; */ echo "Как здесь совместить вывод из 3-х таблиц?" ?></td>
                        <td>
                            <button type="submit" style="align-content: flex-end; " class="btn btn-warning btn-xs" id="updateTeacherBtn" name="updateTeacherBtn" value="<?php echo $teacher['id_teacher']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Изменить</button>
                            <button class="btn btn-success btn-xs navbar-btn" id="update-teacher-button" name="update-teacher-button" data-toggle="modal" data-target="#update-teacher" value="<?php echo $teacher['id_teacher']; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Изменить информацию</button>
                            <button type="submit" style="align-content: flex-end; " name="deleteTeacherBtn" class="btn btn-danger btn-xs" onclick="window.deleteTeacher('<?= $teacher['id_teacher'] ?>')"><span class="glyphicon glyphicon-trash"></span> Удалить</button>
                        </td>
                      </tr>
				<?php endforeach; ?>
                </tbody>
              </table>
          <!--</form> -->
           <?php elseif (empty($teachers_arr["teachers"])) : ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
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

</script>
