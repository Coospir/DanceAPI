$(function() {
    alert("TEST");
    $.ajax({
        type: "GET",
        url: "/mvc/styles/"
    }).done(function (styles) {
        styles.unshift({ id_style: "", name: ""});

        $("#jsGrid").jsGrid({
            height: "70%",
            width: "100%",
            filtering: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,

            pageSize: 15,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete client?",
            controller: {
                loadData: function (filter) {
                    return $.ajax({
                        type: "GET",
                        url: "/mvc/teachers/",
                        data: filter,
                        success: function(r){
                            alert(r);
                        }
                    });
                },
                insertItem: function (item) {
                    return $.ajax({
                        type: "POST",
                        url: "/mvc/teachers/index.php",
                        data: item
                    });
                },
                updateItem: function (item) {
                    return $.ajax({
                        type: "PUT",
                        url: "/mvc/teachers/index.php",
                        data: item
                    });
                },
                deleteItem: function (item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/mvc/teachers/index.php",
                        data: item
                    });
                }
            },
            fields: [
                { name: "surname", title: "Surname", type: "text", width: 150, valueField: "surname", textField: "surname" },
                { name: "name", title: "Name", type: "text", width: 150 },
                { name: "patronymic", title: "Patronymic", type: "text", width: 150 },
                { name: "email", title: "Email", type: "text", width: 200 },
                { name: "phone", title: "Phone", type: "text", width: 100 },
                { name: "id_style", title: "Style", type: "select", width: 80, items: styles, valueField: "id_style", textField: "name" },
                { type: "control" }
            ]
        });
    });
});