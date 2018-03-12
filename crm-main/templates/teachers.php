<?php
  include __DIR__ . '/../templates/template.php';
  include __DIR__ . '/../../dance_api/api/config/database.php';

  $db = new Database();

  $db = $db->getConnection();

  $modal_styles = $db->query("SELECT * FROM dance_style")->fetchAll(PDO::FETCH_ASSOC);

  include __DIR__ . '/../templates/modals/teachers/add.php';
  //include __DIR__ . '/../templates/modals/teachers/update.php';
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
    <button class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#addNewTeacher"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить преподавателя</button>
    <button type="submit" class="btn btn-success btn-sm navbar-btn" name="download-csv" id="download-csv"><span class="glyphicon glyphicon-export" onclick="window.downloadCSV()" aria-hidden="true"></span> Экспорт в CSV</button>
      <a href="#" id="stackable-table" class="btn btn-primary btn-sm">Изменить вид таблицы</a>
		   <?php if(!empty($teachers_arr["teachers"])) : ?>
              <table class="table table-bordered table-hover col-12 col-sm-12 col-lg-12 table-responsive" id="teacher-table">
                <thead>
                <tr class="head">
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
                    <td class="information"><?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?></td>
                    <td class="information"><?= $teacher['email']; ?></td>
                    <td class="information"><?= $teacher['phone']; ?></td>
                    <td class="information"><?= $teacher['title']; ?></td>
                    <td>
                        <button type="submit" style="align-content: flex-end; " name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher('<?= $teacher['id_teacher'] ?>')"><span class="glyphicon glyphicon-trash"></span> Удалить</button>
                        <button type="submit" style="align-content: flex-end; " name="updateTeacherBtn" class="btn btn-warning" onclick="window.updateTeacher('<?= $teacher['id_teacher'] ?>')"><span class="glyphicon glyphicon-pencil"></span> Изменить</button>
                      </td>
                  </tr>
				<?php endforeach; ?>
                </tbody>
              </table>
		  <?php elseif (empty($teachers_arr["teachers"])) : ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Внимание!</strong> Список преподавателей пуст.
            </div>
		  <?php endif; ?>

      </div>
		</div>
	</div>
