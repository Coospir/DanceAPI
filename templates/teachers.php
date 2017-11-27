<?php if(!empty($teachers_arr["teachers"])) : ?>
        <div class="table">
            <table class="table" id="teacher-table">
                <thead>
                <tr>
                    <!--<th>#</th>-->
                    <th>Фамилия Имя Отчество</th>
                    <th>Контактный телефон</th>
                    <th>E-Mail</th>
                    <th>Соц. сеть (url)</th>
                    <th>Направление/-я</th>
                    <!--<th>Действие</th>-->
                </tr>
                </thead>
                <tbody id="teacher-table-data">
                    <?php foreach ($teachers_arr["teachers"] as $teacher) : ?>
                        <tr>
                            <!--<th scope="row">/*= $teacher['id'] */</th>-->
                            <td class="information"><?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['patronymic'] ?></td>
                            <td class="information"><?= $teacher['phone_number']; ?></td>
                            <td class="information"><?= $teacher['email']; ?></td>
                            <td class="information"><?= $teacher['social_page']; ?></td>
                            <td class="information"><?= $teacher['style']; ?> <button type="submit" style="align-content: flex-end; " name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher('<?= $teacher['id'] ?>')">Удалить</button></td>
<!--                            <td><button type="submit" name="deleteTeacherBtn" class="btn btn-danger" onclick="window.deleteTeacher('<?/*= $teacher['id'] */?>')">Удалить</button></td>
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
