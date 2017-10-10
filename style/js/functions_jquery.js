/**
 * Created by COOSPIR-PC on 15.09.2017.
 */
/*$(document).ready(function() {
        $(".WhyWe").slideDown("slow");
});*/
$(document).ready(function () {
    $("#phone").mask("9(999)999-99-99");
});

setTimeout(function () {
    $(".alert").slideToggle('fast');
}, 4000);


$(function()	{
    $('.info').click(function(e)	{
        //ловим элемент, по которому кликнули
        var t = e.target || e.srcElement;
        //получаем название тега
        var elm_name = t.tagName.toLowerCase();
        //если это инпут - ничего не делаем
        if(elm_name == 'input')	{return false;}
        var val = $(this).html();
        var code = '<input type="text" id="edit" value="'+val+'" />';
        $(this).empty().append(code);
        $('#edit').focus();
        $('#edit').blur(function()	{
            var val = $(this).val();
            $(this).parent().empty().html(val);
        });
    });
});

$(window).keydown(function(event){
    //ловим событие нажатия клавиши
    if(event.keyCode == 13) {	//если это Enter
        $('#edit').blur();	//снимаем фокус с поля ввода
    } /*else if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
        // Разрешаем: Ctrl+A
        (event.keyCode == 65 && event.ctrlKey === true) ||
        // Разрешаем: home, end, влево, вправо
        (event.keyCode >= 35 && event.keyCode <= 39)) {
        // Ничего не делаем
        return;
    }
    else {
        // Обеждаемся, что это цифра, и останавливаем событие keypress
        if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault();
        }
    }*/

});
