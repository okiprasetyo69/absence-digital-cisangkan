var tableListAbsence;

$(document).ready(function () {
    //Start Initializing libs
    var today = moment().format("YYYY-MM-DD");
    document.getElementById("absence_date").value = today;
    $("#absence_date").datepicker({
        dateFormat: "yy-mm-dd",
    });
    //End Initializing libs

    //Start function
    listTableAbsence();
    //getDataExport();
    //End function

    //Event trigger
    $("#search").on("keyup", function () {
        listTableAbsence();
    });
    $("#absence_date").on("change", function () {
        listTableAbsence();
        getDataExport();
        getTopicFiltered();
    });
    
    
    $('#btn-export').on('click', function(){
        /*
        $("#table-export-excel").table2excel({
            exclude:".noExl",
            name:"Report Absence",
            filename:"Report Absence",
            fileext:".xls",
            exclude_img:false,
            exclude_links:false,
            exclude_inputs:false,
        });
        */
        //$("#modalExportExcel").modal("hide");
        //window.location.href= '/absence/export_to_excel/';
        let absence_date_filter = $("#absence_date").val();
        window.location.href= '/absence/export-pdf/'+absence_date_filter;
    })
    

    //End Event trigger
});

function listTableAbsence() {
    var form = $("form")[0];
    var formdata = new FormData(form);
    $("#tableListAbsence").DataTable().clear().destroy();
    tableListAbsence = $("#tableListAbsence").DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        searching: false,
        orderable: [
            [0, "desc"],
            [1, "asc"],
        ],
        language: {
            emptyTable: "Data tidak tersedia",
            zeroRecords: "Tidak ada data yang ditemukan",
            infoFiltered: "",
            infoEmpty: "",
            paginate: {
                previous: "‹",
                next: "›",
            },
            info: "Show _START_ till _END_ From _TOTAL_ Absence",
            aria: {
                paginate: {
                    previous: "Previous",
                    next: "Next",
                },
            },
        },
        ajax: {
            url: "/api/listabsence",
            contentType: "application/json",
            type: "POST",
            data: function (d) {
                //console.log(d);
                var dataparam = {
                    draw: d.draw,
                    page: d.start / d.length + 1,
                    length: d.length,
                    search_text: $("#search").val(),
                    absence_date: $("#absence_date").val(),
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
                data: "absence_date",
                width: "13%",
            },
            {
                data: "name",
                width: "20%",
            },
            {
                data: "position",
                width: "5%",
            },
            {
                data: "email",
                width: "10%",
            },
            {
                data: "topic",
            },
            {
                data: null,
                width: "5%",
            },
        ],
        columnDefs: [
            {
                targets: 0,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                    $(td).html(tableListAbsence.page.info().start + row + 1);
                },
            },
            {
                targets: 1,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                    let act_date = moment(rowData.absence_date).format(
                        "DD-MM-YYYY"
                    );
                    $(td).html(act_date);
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
                },
            },
            {
                targets: 4,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                },
            },
            {
                targets: 5,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                    let topic_name = rowData.topic.topic_name;
                    $(td).html(topic_name);
                },
            },
            {
                targets: 6,
                searchable: false,
                orderable: false,
                createdCell: function (td, cellData, rowData, row, col) {
                    $(td).addClass("text-center");
                    let name = rowData.name;
                    let signature = rowData.signature_url;
                    var html =
                        "<label onclick='signatureDetail(\"" +
                        name +
                        '", "' +
                        signature +
                        "\")'><i class='fa fa-ellipsis-h'></i></label>";
                    $(td).html(html);
                },
            },
        ],
    });
}

function signatureDetail(name, signature) {
    //console.log(name, signature);
    let img_signature =
        '<img src="http://localhost:8000/' +
        signature +
        '" style="width:100%; height:100%;" />';
    $(".img-signature").html("");
    $("#modal-title").html(name);
    $(".img-signature").append(img_signature);
    $("#modalSignature").modal("toggle");
}

function exportSignExcel() {
    let absence_date_filter = $("#absence_date").val();
    window.location.href= '/absence/export-pdf/'+absence_date_filter;
    console.log(absence_date_filter);
   
    //getDataExport();
    //getTopicFiltered();
    //$("#modal-title-export").html("Report Absence");
    //$("#modalExportExcel").modal("toggle");

    //let absence_date_val = $('#absence_date').val();
    //window.location.href = '/absence/export_excel/'+ absence_date_val;
    //window.location.href = '/absence/export-pdf/'+absence_date_filter;
}

function getDataExport() {
    let absence_date_filter = $("#absence_date").val();
    jQuery.ajax({
        type: "post",
        url: "/api/absence/absence-filter",
        data: {
            absence_date: absence_date_filter,
        },
        beforeSend: function () {
            //$("body").loading();
        },
        success: function (response) {
            //console.log(response)
            let row = "";
            $(".rowData").html("");
            $.each(response, function (i, val) {
                row +=
                    '<tr class="text-center"><td>' +
                    val.name +
                    "</td> <td>" +
                    val.email +
                    "</td><td>" +
                    val.position +
                    '</td><td> <img src="http://localhost:8000/' +
                    val.signature_url +
                    '" style="height:50px; width:50px;" /> </td> </tr>';
            });
            $(".rowData").append(row);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = "failed get data";
        },
        complete: function () {
            //$("body").loading("stop");
        },
    });
}

function getTopicFiltered() {
    let absence_date_filter = $("#absence_date").val();
    jQuery.ajax({
        type: "post",
        url: "/api/topic/filter-date",
        data: {
            event_date: absence_date_filter,
        },
        beforeSend: function () {},
        success: function (response) {
            //console.log(response)
            if (response) {
                $("#event_date_report").html(
                    moment(response.event_date).format("YYYY-MM-DD")
                );
                $("#topic_name_report").html(response.topic_name);
            } else {
                $("#event_date_report").html("-");
                $("#topic_name_report").html("-");
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseJSON);
        },
        complete: function () {},
    });
}

//fnExcelReport cannot get image
function fnExcelReport() {
    
    var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange;
    var j = 0;
    tab = document.getElementById("table-export-excel"); // id of table

    for (j = 0; j < tab.rows.length; j++) {
        tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        // If Internet Explorer
        txtArea1.document.open("txt/html", "replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus();
        sa = txtArea1.document.execCommand(
            "SaveAs",
            true,
            "Report Absence.xls"
        );
    } //other browser not tested on IE 11
    else
        sa = window.open(
            "data:application/vnd.ms-excel," + encodeURIComponent(tab_text)
        );

    return sa;
    
   
}
