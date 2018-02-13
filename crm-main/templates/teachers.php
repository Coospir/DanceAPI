<?php
  include __DIR__ . '/../templates/template.php';
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
	  <?php print_r($teachers_arr["teachers"]); ?>
    <button class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#addNewTeacher"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить преподавателя</button>
		  <?php if(!empty($teachers_arr["teachers"])) : ?>
            <div class="table">
              <table class="table" id="teacher-table">
                <thead>
                <tr>
                  <th>Фамилия Имя Отчество</th>
                  <th>E-Mail</th>
                  <th>Контактный телефон</th>
                  <th>Направление/-я</th>
                  <th></th>
                  <!--<th>Действие</th>-->
                </tr>
                </thead>
                <tbody id="teacher-table-data">
				<?php foreach ($teachers_arr["teachers"] as $teacher) : ?>
                  <tr>
                    <td class="information"><?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?></td>
                    <td class="information"><?= $teacher['email']; ?></td>
                    <td class="information"><?= $teacher['phone']; ?></td>
                    <td class="information"><?= $teacher['style']; ?></td>
                    <td><button type="submit" style="align-content: flex-end; " name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher('<?= $teacher['id_teacher'] ?>')">Удалить</button></td>
                    <!--
-->                     </tr>
				<?php endforeach; ?>
                </tbody>
              </table>
            </div>
		  <?php elseif (empty($teachers_arr["teachers"])) : ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Внимание!</strong> Список преподавателей пуст.
            </div>
		  <?php endif; ?>

      </div>
			<!--<div id="jsGrid">
				<script type="text/javascript" src="/crm-main/js/test.js"></script>
			</div>-->
		</div>
	</div>
