<?php
  include __DIR__ . '/../templates/template.php';
  include __DIR__ . '/../templates/modals/teachers/add.php';
  include __DIR__ . '/../../dance_api/api/config/database.php';
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
    <button class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#addNewTeacher"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить преподавателя</button>
		  <?php if(!empty($teachers_arr["teachers"])) : ?>
              <table class="table table-bordered table-hover" id="teacher-table">
                <thead>
                <tr>
                  <th>Преподаватель</th>
                  <th>E-Mail</th>
                  <th>Контактный телефон</th>
                  <th>Направление/-я</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody id="teacher-table-data">

				<?php
                /*$teacher = new Teacher($db);
                $num = $teacher->ShowCountTeachers();
                var_dump($num);*/
                foreach ($teachers_arr["teachers"] as $teacher) : ?>
                  <tr>
                    <td class="information"><?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?></td>
                    <td class="information"><?= $teacher['email']; ?></td>
                    <td class="information"><?= $teacher['phone']; ?></td>
                    <td class="information"><select class="form-control"><option value="<?= $teacher['id_style']; ?>"><?= $teacher['style']; ?></option></select></td>
                    <td><button type="submit" style="align-content: flex-end; " name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher('<?= $teacher['id_teacher'] ?>')">Удалить</button></td>
                    <!--
-->                     </tr>
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
