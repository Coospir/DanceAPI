//TODO: Почему не пропадает модалка?
function addNewTeacher(){
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/create_teacher.php',
        data: $("#addTeacherForm").serialize()

    }).done(function (data) {
        alert(data);
        // TODO: Добавить обновление таблички
        //$('#addNewTeacher').hide();
        //$(".container-fluid").append("<div class='alert alert-success alert-dismissible' id='success-added-teacher'role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Добавлен новый преподаватель. </div>");
        /*setTimeout(function () {
            $('#success-added-teacher').hide();
        }, 3000);*/
        //$(".table").append("<td class='information'>" + data + "</td>");
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
        url: '/dance_api/api/functions/register_user.php',
        data: $("#registerUserForm").serialize()
    }).done(function (data) {
        var json = JSON.parse(data);
        console.log(json);
        $('#display_errors').html('');
        if(json) {
            if(json.name){
                $('#display_errors').append("<span class='label label-danger'>" + json.name + "</span><br>");
            }
            if(json.email){
                $('#display_errors').append("<span class='label label-danger'>" + json.email + "</span><br>");
            }
            if(json.password){
                $('#display_errors').append("<span class='label label-danger'>" + json.password + "</span><br>");
            }
            if(json.user_type){
                $('#display_errors').append("<span class='label label-danger'>" + json.user_type + "</span><br>");
            }
            if(json.message){
                $('#form-content').hide();
                $("#registerUserForm").html("<h2 class='form-signin-heading'>Аккаунт зарегистрирован.</h2><p>Подтвердите Ваш аккаунт, данные отправлены на E-Mail.</p> <p>На страницу <a href='/templates/login.php'>авторизации</a></p></div>");
            }
        }
    });
    return false;
}

function authUser() {
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/loginUser.php',
        data: $("#loginUserForm").serialize()
    }).done(function (data) {
        var json = JSON.parse(data);
        console.log(json);
    });
    return false;
}
