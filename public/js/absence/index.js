var signaturePad;
$(document).ready(function () {
    getTopics();
    //Start Initializing libs
    var canvas = document.querySelector("canvas");
    var parentWidth = $(canvas).parent().outerWidth();

    canvas.setAttribute("width", parentWidth);
    this.signaturePad = new SignaturePad(canvas);
    var signaturePad = new SignaturePad(
        document.getElementById("signature-pad")
    );

    document.getElementById("clear").addEventListener("click", function () {
        signaturePad.clear();
        //var x = document.getElementById("sign_prev");
        //x.style.display = "none";
        document.getElementById("signature64").value = "";
    });

    signaturePad.onEnd = function () {
        var data = signaturePad.toDataURL("image/png");
        $("#signature64").val(data);
    };
    /*
    signaturePad = $('#signaturePad').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.signature('clear');
        $("#signature64").val('');
    });
    */
    $('#absence_date').datepicker({
        dateFormat: "yy-mm-dd",
        //minDate:0,
        //maxDate:0,
    });
    assignDateNow();
    let topic_id = $("#topic_id").val();
    $("#topic_id")
        .select2({
            ajax: {
                url: "/api/topic/listtopic-select2",
                dataType: "json",
                type: "POST",
                data: function (params) {
                    //console.log(params)
                    return {
                        searchTerm: params.term,
                        id: topic_id,
                    };
                },
                processResults: function (response) {
                    console.log(response)
                    return {
                        results: response,
                    };
                },
                cache: true,
            },
        })
        .on("select2:select", function (e) {
            var data = e.params.data;
            //console.log(data)
        });
    //End Initilizing Libs
   $('body').on('submit', '#frm-add-abs', function(e){
       e.preventDefault();
       $.ajax({
        type: "POST",
        url: "/api/absence",
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function () {
            $("#btnSave").attr("disabled", true);
        },
        success: function (response) {
            console.log(response)
            let success = response.success
            let status = response.status
            if(status == 400){
                $.confirm({
                    title: 'Message',
                    columnClass: 'small',
                    content: 'You have done absent today',
                    buttons: {
                        somethingElse: {
                            text: 'Ok',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action: function(){
                                location.reload();
                            }
                        }
                    }
                });
            }
            if (status == 401) {
                $.confirm({
                    title: "Message",
                    content: "Dont have topics name today !",
                    columnClass: 'small',
                    buttons: {
                        somethingElse: {
                            text: "Ok",
                            btnClass: "btn-warning",
                            keys: ["enter", "shift"],
                            action: function () {
                                location.reload();
                            },
                        },
                    },
                });
            }
            if(success){
                $.confirm({
                    title: 'Message ',
                    columnClass: 'small',
                    content: 'Absence has been submitted !',
                    buttons: {
                        somethingElse: {
                            text: 'Ok',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action: function(){
                                location.reload();
                            }
                        }
                    }
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //console.log(xhr.responseJSON);
            showMessageValidate(xhr);
            $("#btnSave").attr("disabled", false);
        },
    });
   });
    
});

function addAbsence(){
    let absence_date = $('#absence_date').val();
    let name = $('#name').val();
    let email = $('#email').val();
    let position = $('#position').val();
    let signed = $('#signature64').val();
    if( (absence_date == "") || (name=="") || (position == "") || (signed == "") || (email == "")){
        $.alert({
            title: 'Message',
            content: 'All field must be entered',
        });
        return;
    }

    form = $('#frm-add-abs').serialize();
    $.ajax({
        type: "POST",
        url: "/api/absence",
        data: form,
        success: function (response) {
            console.log(response)
            let success = response.success
            if(success){
                $.confirm({
                    title: 'Message ',
                    content: 'Absence has been submitted !',
                    buttons: {
                        somethingElse: {
                            text: 'Ok',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action: function(){
                                location.reload();
                            }
                        }
                    }
                });
            }
        }
    });
}
function showMessageValidate(xhr){
    $("#err_topic_id").html("");
    $("#err_name").html("");
    $("#err_absence_date").html("");
    $("#err_email").html("");
    $("#err_position").html("");
    $("#err_signed").html("");
    let err_topic_id = xhr.responseJSON.topic_id
    let err_absence_date = xhr.responseJSON.absence_date;
    let err_position = xhr.responseJSON.position;
    let err_name = xhr.responseJSON.name;
    let err_email = xhr.responseJSON.email;
    let err_signed = xhr.responseJSON.signed;
    $("#err_topic_id").html(err_topic_id).attr("class", "badge badge-danger");
    $("#err_name").html(err_name).attr("class", "badge badge-danger");
    $("#err_email").html(err_email).attr("class", "badge badge-danger");
    $("#err_absence_date").html(err_absence_date).attr("class", "badge badge-danger");
    $("#err_position").html(err_position).attr("class", "badge badge-danger");
    $("#err_signed").html(err_signed).attr("class", "badge badge-danger");
}
function clearMessagedValidate(){
    $("#err_topic_id").html("");
    $("#err_name").html("");
    $("#err_absence_date").html("");
    $("#err_email").html("");
    $("#err_position").html("");
    $("#err_signed").html("");
}

function getTopics(){
    jQuery.ajax({
        type: "get",
        url: "/api/topic/current-date/",
        beforeSend: function () {},
        success: function (response) {
            console.log(response)
            let topic_id=""
            if(!response){
                $("#topic_id").val(0);
            } else {
                topic_id = response.id;
                $("#topic_id").val(topic_id);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseJSON)
            /*
            $.alert({
                title: "Message",
                content: "Failed get data",
            });
            */
        },
        complete: function () {},
    });
}

function assignDateNow(){
    $("#absence_date").datepicker().datepicker("setDate", new Date());
}
