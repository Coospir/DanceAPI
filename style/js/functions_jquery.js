/**
 * Created by COOSPIR-PC on 15.09.2017.
 */
/*$(document).ready(function() {
        $(".WhyWe").slideDown("slow");
});*/

$(document).ready(function () {
    $("#phone").mask("9(999)999-99-99");
});

$(window).on('load', function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});
});


$(document).ready(function(){
    $('#teacher-table').DataTable();
});

function CheckForm() {
  var requiredField = $("#addStudioForm").children("[required=required]"); // Получаем все элементы, которые указаны как обязательные к заполнению
  for (var i = 0; i < requiredField.length; i++) { // Обходим все полученные элементы
    if ($(requiredField[i]).val() == '') { // Если хотя бы одно из обязательных полей не заполнено
      //alert("Заполните все обязательные поля"); // Выводим сообщение об ошибке
      requiredField.css({'border-color':'#d8512d'});
      return false; // Возвращаем false
    }
  }
  return true; // Если все обязательные поля заполнены - возвращаем true
}
