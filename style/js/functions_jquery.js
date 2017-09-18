/**
 * Created by COOSPIR-PC on 15.09.2017.
 */
$(document).ready(function() {
    $(".btn-info").click(function(){
        $(".card").slideToggle("slow", function() {
            // Animation complete.
        });
    });
});
