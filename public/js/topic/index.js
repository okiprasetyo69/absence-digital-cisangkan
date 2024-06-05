var tableTopic;

$(document).ready(function () {
   
    var today = moment().format('YYYY-MM-DD');

    document.getElementById("event_date_filter").value = today;
    $('#event_date_filter').datepicker({
        dateFormat: "yy-mm-dd",
        setDate: new Date(),
        autoclose: true
    });
    
    listTable();

    document.getElementById("event_date").value = today;
    $('#event_date').datepicker({
        "dateFormat": "yy-mm-dd",
    });

    $("#search").on("keyup", function () {
        listTable();
    });

    $('#event_date_filter').on('change', function(){
        listTable()
    })

    //Add or Edit
    $("body").on("submit", "#frm-add-topic", function (e) {
        e.preventDefault();
        var formData = $("#frm-add-topic").serialize();
        $.ajax({
            type: "post",
            url: "/api/topic",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#btn-save").attr("disabled", true);
            },
            success: function (response) {
                //console.log(response);
                document.getElementById("frm-add-topic").reset();
                $("#modalAddTopic").modal("toggle");
                $.confirm({
                    title: "Message ",
                    content: "Topic data has been changed !",
                    buttons: {
                        somethingElse: {
                            text: "Ok",
                            btnClass: "btn-success",
                            keys: ["enter", "shift"],
                            action: function () {
                                tableTopic.ajax.reload();
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
    $("#tableTopic").DataTable().clear().destroy();
    tableTopic = $("#tableTopic").DataTable({
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
            info: "Show _START_ till _END_ dari _TOTAL_ Topics",
            aria: {
                paginate: {
                    previous: "Previous",
                    next: "Next",
                },
            },
        },
        ajax: {
            url: "/api/topic/list-topic",
            contentType: "application/json",
            type: "POST",
            data: function (d) {
                //console.log(d);
                var dataparam = {
                    draw: d.draw,
                    page: d.start / d.length + 1,
                    length: d.length,
                    search_text: $("#search").val(),
                    event_date :  $("#event_date_filter").val(),
                };
                console.log(dataparam)
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
                data: "topic_name",
            },
            {
                data: "event_date",
            },
            {
                data: "location",
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
                    $(td).html(tableTopic.page.info().start + row + 1);
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
                    let evet_date = moment(rowData.event_date).format('YYYY-MM-DD');
                    $(td).html(evet_date);
                },
            },
            {
                targets: 3,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                },
            },
            {
                targets: 4,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                    let topic_id = rowData.id;
                    //console.log(id)
                    let html = ""
                    if(topic_id == null ){
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
                        "<li><a class='text-dark' href='#' onclick='deleteTopic(" +
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
function addTopic() {
    $("#modal-title").html("Add Topic");
    $("#topic_id").val("");
    $("#topic_name").val("");
    $("#location").val("");
    clearMessagedValidate();
    $("#btn-save").attr('disabled', false);
    $("#modalAddTopic").modal("toggle");
}
function edit(id) {
    jQuery.ajax({
        type: "get",
        url: "/api/topic/detail/" + id,
        beforeSend: function () {},
        success: function (response) {
            console.log(response)
            topic_id = response.id;
            event_date =  moment(response.event_date).format('YYYY-MM-DD')
            $("#modal-title").html("Edit");
            $("#btn-save").show();
            $("#btn-save").attr('disabled', false);

            $("#topic_id").val(topic_id);

            $("#topic_name").val(response.topic_name);
            $("#topic_name").attr("readonly", false);
            $("#event_date").val(event_date);
            $("#event_date").attr("readonly", false);
            $("#location").val(response.location);
            $("#location").attr("readonly", false);

            clearMessagedValidate();
            $("#modalAddTopic").modal("toggle");
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
        url: "/api/topic/detail/" + id,
        beforeSend: function () {},
        success: function (response) {
            event_date =  moment(response.event_date).format('YYYY-MM-DD')
            $("#modal-title").html("Detail");
            $("#topic_id").val(response.id);
            $("#topic_name").val(response.topic_name);
            $("#topic_name").attr("readonly", true);
            $("#event_date").val(event_date);
            $("#event_date").attr("readonly", true);
            $("#location").val(response.location);
            $("#location").attr("readonly", true);
            $("#btn-save").hide();
            $("#modalAddTopic").modal("toggle");
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
function deleteTopic(id) {
    $.confirm({
        title: "Delete Topic",
        content: "Are you sure delete this topic ?",
        buttons: {
            cancel: {
                text: "Cancel",
                btnClass: "btn-default",
            },
            confirm: {
                text: "Delete topic",
                btnClass: "btn-danger",
                action: function () {
                    removeTopic(id);
                },
            },
        },
    });
}
function removeTopic(id) {
    jQuery.ajax({
        type: "post",
        url: "/api/topic/delete/" + id,
        beforeSend: function () {
            //$("body").loading();
        },
        success: function () {
            listTable();
            $.confirm({
                title: "Message ",
                content: "Success delete topic !",
                buttons: {
                    somethingElse: {
                        text: "Ok",
                        btnClass: "btn-success",
                        keys: ["enter", "shift"],
                        action: function () {
                            tableTopic.ajax.reload();
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

function showMessageValidate(xhr) {
    $("#err_topic_name").html("");
    $("#err_event_date").html("");
    $("#err_location").html("");
    let err_topic_name = xhr.responseJSON.topic_name;
    let err_event_date = xhr.responseJSON.event_date;
    let err_location = xhr.responseJSON.location;
    $("#err_topic_name").html(err_topic_name).attr("class", "badge badge-danger");
    $("#err_event_date").html(err_event_date).attr("class", "badge badge-danger");
    $("#err_location").html(err_location).attr("class", "badge badge-danger");
}
function clearMessagedValidate(){
    $("#err_topic_name").html("");
    $("#err_event_date").html("");
    $("#err_location").html("");
}
