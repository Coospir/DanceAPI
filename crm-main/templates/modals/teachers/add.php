<script src="/crm-main/js/maskedinput.js"></script>
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
            <input type="email" class="form-control" name="mail" id="mail" placeholder="E-Mail">
          </div>
					<div class="form-group">
						<input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="style" id="style" placeholder="Направление(-я)" required>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="add-teacher-btn" name="addNewTeacher" onclick="window.addNewTeacher()">Создать</button>
				<button class="btn btn-danger" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
