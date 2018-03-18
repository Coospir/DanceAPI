//TODO: Почему не пропадает модалка?
function addNewTeacher(){
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/create_teacher.php',
        data: $("#addTeacherForm").serialize()
    }).done(function (data) {
        alert(data);
    });
    return false;
}
//todo: open modal, then serialize of form and selectedId (не обязательно)
function updateTeacher() {
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/update_teacher.php',
        data: $("#update-teacher-form").serialize()
    }).done(function(data) {
        alert(data);
        $("#teacher-table-data").html("<td class='information'>" + data + "</td>");
    });
    return false;
}

//TODO: Обновление элемента, удаление через implode и цикл
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
    }).done(function(data) {
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
            //alert (json.message);
            if(json.message){
                $('#form-content').hide();
                $("#registerUserForm").html("<h2 class='form-signin-heading'>Аккаунт зарегистрирован.</h2><p>Подтвердите Ваш аккаунт, данные отправлены на E-Mail.</p> <p>На страницу <a href='/templates/login.php'>авторизации</a></p></div>");
                //ToDo: обновление страницы убрать
                //location.replace("https://dancecrm.ru/templates/login.php");
            }
        }
    });
    return false;
}

function authUser() {
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/login_user.php',
        data: $("#loginUserForm").serialize()
    }).done(function (data) {
        var json = JSON.parse(data);
        console.log(json);
        $('#display_errors').html('');
        //ToDo: обновление страницы убрать
        if(json) {
            if(json.user_name) {
                $('#display_errors').append("<span class='label label-danger'>" + json.user_name + "</span><br>");
            }
            if(json.user_password) {
                $('#display_errors').append("<span class='label label-danger'>" + json.user_password + "</span><br>");
            }
            if(json.user_password_verify) {
                $('#display_errors').append("<span class='label label-danger'>" + json.user_password_verify + "</span><br>");
            }
            if(json.message) {
                $('#form-content').hide();
                console.log(json.token);
                document.cookie='access_token='+json.token+';path=/';
                alert('Успешно авторизован!');
            }
        }
    });
    return false;
}

function addNewStudio() {
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/create_studio.php',
        data: $("#addStudioForm").serialize()
    }).done(function (data) {
        var json = JSON.parse(data);
        console.log(json);
        $('#display_errors').html('');
        if(json) {
            if(json.name) {
                $('#display_errors').append("<span class='label label-danger'>" + json.name + "</span><br>");
            }

            if(json.studio_exists) {
                $('#display_errors').append("<span class='label label-danger'>" + json.studio_exists + "</span><br>");
            }

            if(json.address) {
                $('#display_errors').append("<span class='label label-danger'>" + json.address + "</span><br>");
            }

            if(json.phone) {
                $('#display_errors').append("<span class='label label-danger'>" + json.phone + "</span><br>");
            }

            if(json.message) {
                alert('success');
            }
        }
/*
        $("#addStudioForm").append("<div class='alert alert-success alert-dismissible' id='success-added-teacher' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Новая студия создана.</div>");
*/
    });
    return false;
}

// Searching
$(document).ready(function(){
    $("#search").keyup(function(){
        _this = this;
        $.each($("#teacher-table tbody tr"), function() {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });
});


//CSV
function downloadCSV(){
    $("table").table_download({
        format: "csv",
        separator: ",",
        filename: "data",
        linkname: "Export",
        quotes: "\"",
        newline: "\r\n"
    });
}

