//TODO: Почему не пропадает модалка?
function addNewTeacher(){
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/createTeacher.php',
        data: $("#addTeacherForm").serialize()
    }).done(function (data) {
        alert(data);
        // TODO: Добавить обновление таблички
        $('#addNewTeacher').hide();
        $(".container-fluid").append("<div class='alert alert-success alert-dismissible' id='success-added-teacher'role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Добавлен новый преподаватель. </div>");
        setTimeout(function () {
            $('#success-added-teacher').hide();
        }, 3000);
        $(".table").append("<td class='information'>" + data + "</td>");
        //$("#teacher-table-data").append(data);
        //location.reload();
    });
    return false;
}

function addNewStudio(){
  $.ajax({
    type: "POST",
    url: '/dance_api/api/functions/createStudio.php',
    data: $("#addStudioForm").serialize()
  });
  $.done(function (data) {
    alert(data);
    $("#addStudioForm").append("<div class='alert alert-success alert-dismissible' id='success-added-teacher'role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Новая студия создана.</div>");
  });
  return false;
}

//TODO: Обновление элемента
function deleteTeacher(selectedId) {
    var answer = confirm('Вы уверены, что хотите удалить выбранный элемент?');
    if(answer == true) {
        $.ajax({
            type: "POST",
            url: '/dance_api/api/functions/deleteTeacher.php',
            data: {'id_teacher': selectedId}
        }).done(function (data) {
            alert(data);
            console.log(data);
            $("#teacher-table-data").remove("<td class='information'>" + data + "</td>");
        });
        return false;
    } else alert(data); return false;
}

function deleteAllTeachers() {
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/deleteAllTeachers.php',
        data: $("#DeleteAllTeachers").serialize()
    }).done(function(data){
        console.log(data);
        location.reload();
    })
}

function registerUser() {
    //TODO: Обработка ошибок есть, но на фронте их не видно
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/registerUser.php',
        data: $("#registerUserForm").serialize()
    }).done(function (data) {
        var json = JSON.parse(data);
        console.log(json);
        $('#display_errors').html('');
        if(json) {
            if(json.name){
                $('#display_errors').append(json.name);
            }
            if(json.email){
                $('#display_errors').append(json.email);
            }
            if(json.password){
                $('#display_errors').append(json.password);
            }
            if(json.message){
                $("#registerUserForm").append("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Аккаунт зарегистрирован. Подтвердите Ваш аккаунт, данные отправлены на E-Mail.  На <a href='/index.php'>главную</a> страницу.</div>");
            }
        }
    });
    return false;
}
