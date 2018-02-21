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
                        <select class="form-control" name="style" id="style"><option value="Hip-Hop">Hip-Hop</option></select>
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
<script src="/style/js/jquery-3.2.1.min.js"></script>
<script src="/style/js/functions_jquery.js"></script>
<script src="/dance_api/api/functions/ajax.js"></script>
<script src="/crm-main/js/maskedinput.js"></script>
