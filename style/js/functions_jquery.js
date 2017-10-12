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


$(function(){
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

window.onload = function () {
    var modal = document.getElementById('addTeacherModal');
    var btn = document.getElementById('addTeacherBtn');
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        $("#addTeacherModal").slideToggle('fast');
        modal.style.display = "block";
    }
    span.onclick = function() {
        $("#addTeacherModal").slideDown('slow');
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if(event.target == modal){

            $("#addTeacherModal").slideToggle('fast');
            modal.style.display = "none";
        }
    }
}



function exportTableToCSV($table, filename) {

    var $rows = $table.find('tr:has(td)'),

        // Temporary delimiter characters unlikely to be typed by keyboard
        // This is to avoid accidentally splitting the actual contents
        tmpColDelim = String.fromCharCode(11), // vertical tab character
        tmpRowDelim = String.fromCharCode(0), // null character

        // actual delimiter characters for CSV format
        colDelim = '","',
        rowDelim = '"\r\n"',

        // Grab text from table into CSV formatted string
        csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

        // Data URI
        csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    $(this)
        .attr({
            'download': filename,
            'href': csvData,
            'target': '_blank'
        });
}

function getTeachersCSV() {
    alert(123);
    exportTableToCSV(this, [$('#teacher-table'), 'teachers.csv']);
}

/*
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], { type: "text/csv", charset: "utf8" });
    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);

        csv.push(row.join(","));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}*/
