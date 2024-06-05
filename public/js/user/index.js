var tableUser;

$(document).ready(function () {
    listTable();
    let role_id = $("#role_id").val();
    $("#role_id")
        .select2({
            ajax: {
                url: "/api/roles",
                dataType: "json",
                type: "POST",
                data: function (params) {
                    //console.log(params)
                    return {
                        searchTerm: params.term,
                        id: role_id,
                    };
                },
                processResults: function (response) {
                    //console.log(response)
                    return {
                        results: response,
                    };
                },
                cache: true,
            },
        })
        .on("select2:select", function (e) {
            var data = e.params.data;
            let role_name = data.name;
            $("#role_name").val(role_name);
            //console.log(role_name)
        });

    $("#search").on("keyup", function () {
        listTable();
    });
    //Add or Edit
    $("body").on("submit", "#frm-add-user", function (e) {
        e.preventDefault();
        var formData = $("#frm-add-user").serialize();
        $.ajax({
            type: "post",
            url: "/api/user",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#btn-save").attr("disabled", true);
            },
            success: function (response) {
                //console.log(response);
                let user_id = response.id;
                document.getElementById("frm-add-user").reset();
                $("#modalAddUser").modal("toggle");
                $.confirm({
                    title: "Message ",
                    content: "User data has been changed !",
                    buttons: {
                        somethingElse: {
                            text: "Ok",
                            btnClass: "btn-success",
                            keys: ["enter", "shift"],
                            action: function () {
                                tableUser.ajax.reload();
                            },
                        },
                    },
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //console.log(xhr.responseJSON);
                showMessageValidate(xhr);
                //console.log(err_c_password)
                //var errorMsg = "Gagal menambahkan data";
                //showValidationMessage(xhr.responseJSON, '#frm-add-user');
                $("#btn-save").attr("disabled", false);
            },
        });
    });
});

function listTable() {
    var form = $("form")[0];
    var formdata = new FormData(form);
    $("#tableUser").DataTable().clear().destroy();
    tableUser = $("#tableUser").DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        searching: false,
        orderable: [
            [0, "desc"],
            [1, "asc"],
        ],
        language: {
            emptyTable: "Data not available",
            zeroRecords: "Data not found",
            infoFiltered: "",
            infoEmpty: "",
            paginate: {
                previous: "‹",
                next: "›",
            },
            info: "Show _START_ till _END_ dari _TOTAL_ Users",
            aria: {
                paginate: {
                    previous: "Previous",
                    next: "Next",
                },
            },
        },
        ajax: {
            url: "/api/user/listuser",
            contentType: "application/json",
            type: "POST",
            data: function (d) {
                //console.log(d);
                var dataparam = {
                    draw: d.draw,
                    page: d.start / d.length + 1,
                    length: d.length,
                    search_text: $("#search").val(),
                };
                return JSON.stringify(dataparam);
            },
            dataSrc: function (response) {
                //console.log(response)
                return response.data;
            },
        },
        columns: [
            {
                data: null,
                width: "5%",
            },
            {
                data: "name",
            },
            {
                data: "email",
            },
            {
                data: null,
                width: "15%",
            },
        ],
        columnDefs: [
            {
                targets: 0,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                    $(td).html(tableUser.page.info().start + row + 1);
                },
            },
            {
                targets: 1,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                },
            },
            {
                targets: 2,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                },
            },
            {
                targets: 3,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                    let user_id = rowData.id;
                    //console.log(id)
                    let html = ""
                    if(user_id <= 7 ){
                        html = "<i class='fas fa-ban'></i>" 
                    } else {
                        html =
                        "<div class='dropdown'>" +
                        "<button class='btn btn-light btn-sm' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>" +
                        "<i class='fa fa-ellipsis-h'></i>" +
                        "<span class='caret'></span>" +
                        "</button>" +
                        "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>" +
                        "<li><a class='text-dark detail' href='#' onclick='detail(" +
                        rowData.id +
                        ")' >Detail</a></li>" +
                        "<li><a class='text-dark edit' href='#' onclick='edit(" +
                        rowData.id +
                        ")'>Edit</a></li>" +
                        "<li><a class='text-dark' href='#' onclick='deleteUser(" +
                        rowData.id +
                        ")'>Delete</a></li>" +
                        "</ul>" +
                        "</div>";
                    }
                    $(td).html(html);
                },
            },
        ],
    });
}
function addUser() {
    $("#modal-title").html("Add");
    $("#user_id").val("");
    $("#name").val("");
    $("#name").val("");
    $("#email").val("");
    $("#role_id").val('').trigger('change')
    $("#role_name").val("");
    $("#password").val("");
    $("#c_password").val("");
    $(".lbl-password").show();
    $(".lbl-c_password").show();
    clearMessagedValidate();
    $("#btn-save").attr('disabled', false);
    $("#modalAddUser").modal("toggle");
}
function edit(id) {
    jQuery.ajax({
        type: "get",
        url: "/api/user/detail/" + id,
        beforeSend: function () {},
        success: function (response) {
            //console.log(response)
            role_id = response.role_id;
            user_id = response.id;
            $("#modal-title").html("Edit");
            $("#btn-save").show();
            $("#btn-save").attr('disabled', false);
            $("#user_id").val(user_id);
            $("#name").val(response.name);
            $("#name").attr("readonly", false);
            $("#email").val(response.email);
            $("#email").attr("readonly", false);
            $(".lbl-password").show();
            $(".lbl-c_password").show();
            $("#role_id").prop("disabled", false);
            roleSelected(role_id);
            clearMessagedValidate();
            $("#modalAddUser").modal("toggle");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.alert({
                title: "Message",
                content: "Failed get data",
            });
        },
        complete: function () {},
    });
}
function detail(id) {
    jQuery.ajax({
        type: "get",
        url: "/api/user/detail/" + id,
        beforeSend: function () {},
        success: function (response) {
            role_id = response.role_id;
            roleSelected(role_id);
            $("#role_id").prop("disabled", true);

            $("#modal-title").html("Detail");
            $("#user_id").val(response.id);
            $("#name").val(response.name);
            $("#name").attr("readonly", true);
            $("#email").val(response.email);
            $("#email").attr("readonly", true);
            $(".lbl-password").hide();
            $(".lbl-c_password").hide();
            $("#btn-save").hide();
            $("#modalAddUser").modal("toggle");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.alert({
                title: "Message",
                content: "Failed get data",
            });
        },
        complete: function () {},
    });
}
function deleteUser(id) {
    $.confirm({
        title: "Delete User",
        content: "Are you sure delete this user ?",
        buttons: {
            cancel: {
                text: "Cancel",
                btnClass: "btn-default",
            },
            confirm: {
                text: "Delete user",
                btnClass: "btn-danger",
                action: function () {
                    removeUser(id);
                },
            },
        },
    });
}
function removeUser(id) {
    jQuery.ajax({
        type: "post",
        url: "/api/user/delete/" + id,
        beforeSend: function () {
            //$("body").loading();
        },
        success: function () {
            listTable();
            $.confirm({
                title: "Message ",
                content: "Success delete user !",
                buttons: {
                    somethingElse: {
                        text: "Ok",
                        btnClass: "btn-success",
                        keys: ["enter", "shift"],
                        action: function () {
                            tableUser.ajax.reload();
                        },
                    },
                },
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = "failed delete user";
            if (xhr.responseJSON) {
                errorMsg = xhr.responseJSON.message;
            }
        },
        complete: function () {
            //$("body").loading("stop");
        },
    });
}
function roleSelected(role_id) {
    $.ajax({
        type: "POST",
        url: "/api/roles",
        data: {
            role_id: role_id,
        },
        dataType: "json",
        success: function (response) {
            //console.log(response)
            id = response[0].id;
            text = response[0].text;
            role_name = response[0].name;
            $('#role_name').val(role_name)
            $("#role_id").html("");
            let selectedOption =
                '<option selected=selected value="' +
                id +
                '"> ' +
                text +
                " </option>";
            $("#role_id").append(selectedOption);
        },
    });
}
function showMessageValidate(xhr) {
    $("#err_name").html("");
    $("#err_email").html("");
    $("#err_password").html("");
    $("#err_c_password").html("");
    $("#err_role_id").html("");
    let err_c_password = xhr.responseJSON.c_password;
    let err_password = xhr.responseJSON.password;
    let err_name = xhr.responseJSON.name;
    let err_email = xhr.responseJSON.email;
    let err_role_id = xhr.responseJSON.role_id;
    $("#err_name").html(err_name).attr("class", "badge badge-danger");
    $("#err_email").html(err_email).attr("class", "badge badge-danger");
    $("#err_password").html(err_password).attr("class", "badge badge-danger");
    $("#err_c_password")
        .html(err_c_password)
        .attr("class", "badge badge-danger");
    $("#err_role_id").html(err_role_id).attr("class", "badge badge-danger");
}
function clearMessagedValidate(){
    $("#err_name").html("");
    $("#err_email").html("");
    $("#err_password").html("");
    $("#err_c_password").html("");
    $("#err_role_id").html("");
}
