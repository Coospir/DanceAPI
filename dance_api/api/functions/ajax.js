//TODO: Почему не пропадает модалка?
function addNewTeacher(){
    $.ajax({
        type: "POST",
        url: '/dance_api/api/functions/create_teacher.php',
        data: $("#addTeacherForm").serialize()
    }).done(function (data) {
        var json = JSON.parse(data);
        alert(json[0]);
        $('#addNewTeacher').remove();
        $('#teacher-cards').html(json[0]);
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

//TODO: Проблема с JSON'ом
function deleteTeacher(selectedId) {
    var answer = confirm('Вы уверены, что хотите удалить выбранный элемент?');
    if(answer === true) {
        $.ajax({
            type: "POST",
            url: '/dance_api/api/functions/delete_teacher.php',
            data: {'id_teacher': selectedId}
        }).done(function (data) {
            var json = JSON.parse(data);
            alert(json[0]);
            alert('Привет мир');
            $("#teacher" + selectedId).remove();

        });
        return false;
    } else alert(data); return false;
}

function deleteAllTeachers() {
    $.ajax({
        url: '/dance_api/api/functions/delete_all_teachers.php',
        type: "POST"
    }).done(function(data){
            console.log(data);
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
                document.cookie='auth_token='+json.token+';path=/';
                alert(json.message);
                window.location.href = '/crm-main/templates/studio/add.php';
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

            if(json.create_studio) {
                $('#display_errors').append("<span class='label label-danger'>" + json.create_studio + "</span><br>");
            }

            if(json.error_token) {
                $('#display_errors').append("<span class='label label-danger'>" + json.error_token + "</span><br>");
            }

            if(json.message) {
                $('#addStudioForm').hide();
                $('#studioAdd').append("<div class='alert alert-success'>Вы успешно создали студию!</div>");
                setTimeout(function(){
                    window.location.href = '/crm-main/templates/dashboard.php';
                }, 3000);
            }
        }
        /*
         $("#addStudioForm").append("<div class='alert alert-success alert-dismissible' id='success-added-teacher' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Успешно!</strong> Новая студия создана.</div>");
         */
    });
    return false;
}

$(document).ready(function(){
    $("#search-teacher").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#teachers-cards .panel").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $("#search-client").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#clients-cards .panel").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
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

