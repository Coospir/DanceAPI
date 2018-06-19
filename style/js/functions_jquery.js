/**
 * Created by COOSPIR-PC on 15.09.2017.
 */
/*$(document).ready(function() {
        $(".WhyWe").slideDown("slow");
});*/

$(document).ready(function () {
    $("#phone").mask("9(999)999-99-99");
    $("#phone_dubl").mask("9(999)999-99-99");
    $("#training_duration").mask("99:99");
});

$(window).on('load', function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});
});

