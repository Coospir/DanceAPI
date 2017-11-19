function addNewTeacher(){
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/createTeacher.php',
        data: $("#addTeacherForm").serialize()
    }).done(function (data) {
        //alert(data);
        //console.log(data);
        // TODO: Добавить обновление таблички
        $('#addNewTeacher').modal('hide');
        $(".panel").append("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Добавлен новый преподаватель. </div>");
        /*$("#teacher-table").append("<td class='information'>" + data + "</td>");*/
        $("#teacher-table-data").append(data);
        //location.reload();
    });
    return false;
}


function deleteTeacher(selectedId) {
    var answer = confirm('Вы уверены, что хотите удалить выбранный элемент?');
    if(answer == true) {
        $.ajax({
            type: "POST",
            url: '/dance_api/api/functions/deleteTeacher.php',
            data: {'id': selectedId}
        }).done(function (data) {
            //alert(data);
            console.log(data);
            location.reload();
        });
        return false;
    } else return false;
}

function deleteAllTeachers() {
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/deleteAllTeachers.php',
        data: $("#deleteAllTeachers").serialize()
    }).done(function(data){
        console.log(data);
        location.reload();
    })
}

function registerUser() {
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/registerUser.php',
        data: $("#registerUserForm").serialize()
    }).done(function (data, status, xhr) {
        alert($.parseJSON(data.responseText).message);
        $("#username").val('');
        $("#email").val('');
        $("#password").val('');
        $("#registerUserForm").append("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Аккаунт зарегистрирован. Подтвердите Ваш аккаунт, данные отправлены на E-Mail.  На <a href='/index.php'>главную</a> страницу.</div>");
    }).fail(function (data){
        alert($.parseJSON(data.responseText).message);
    });
    return false;
}
