var signaturePad;

$(document).ready(function () {
    var canvas = document.querySelector("canvas");
    var parentWidth = $(canvas).parent().outerWidth();

    canvas.setAttribute("width", parentWidth);
    this.signaturePad = new SignaturePad(canvas);
    var signaturePad = new SignaturePad(
        document.getElementById("signature-pad")
    );

    document.getElementById("clear").addEventListener("click", function () {
        signaturePad.clear();

        document.getElementById("signature64").value = "";
    });

    signaturePad.onEnd = function () {
        var data = signaturePad.toDataURL("image/png");
        $("#signature64").val(data);
    };

    //Start Initializing libs
    /*
    init();
    signaturePad = $('#signaturePad').signature({
        syncField: '#signature64', 
        syncFormat: 'PNG',
        guideline: true, 
        guidelineOffset: 25, 
        guidelineIndent: 20, 
        guidelineColor: '#000000',
        thickness: 4,
    }).bind('signaturechange', function(event, ui){
        $('body').css('overflow', 'hidden')
    });
    
    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.signature('clear');
        $("#signature64").val('');
        $('body').css('overflow', 'auto')
    });
    */
    $("#absence_date").datepicker({
        dateFormat: "yy-mm-dd",
    });
    assignDateNow();
    getTopics()
    //End Initilizing Libs
   
    $("body").on("submit", "#frm-add-abs", function (e) {
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
                console.log(response);
                let success = response.success;
                let status = response.status;
                if (status == 400) {
                    $.confirm({
                        title: "Message",
                        content: "You have done absent today !",
                        columnClass: 'small',
                        buttons: {
                            somethingElse: {
                                text: "Ok",
                                btnClass: "btn-warning",
                                keys: ["enter", "shift"],
                                action: function () {
                                    $("#frm-add-abs").each(function () {
                                        this.reset();
                                    });
                                    assignDateNow();
                                    signaturePad.clear();
                                    $("#signature64").val("");
                                    $("#btnSave").attr("disabled", false);
                                },
                            },
                        },
                    });
                }
                if (status == 401) {
                    $.confirm({
                        title: "Message",
                        content: "Don't have agenda today !",
                        columnClass: 'small',
                        buttons: {
                            somethingElse: {
                                text: "Ok",
                                btnClass: "btn-warning",
                                keys: ["enter", "shift"],
                                action: function () {
                                    $("#frm-add-abs").each(function () {
                                        this.reset();
                                    });
                                    assignDateNow();
                                    signaturePad.clear();
                                    $("#signature64").val("");
                                    $("#btnSave").attr("disabled", false);
                                },
                            },
                        },
                    });
                }
                if (success) {
                    $.confirm({
                        title: "Message ",
                        content: "Absence has been submitted !",
                        columnClass: 'small',
                        buttons: {
                            somethingElse: {
                                text: "Ok",
                                btnClass: "btn-success",
                                keys: ["enter", "shift"],
                                action: function () {
                                    $("#frm-add-abs").each(function () {
                                        this.reset();
                                    });
                                    assignDateNow();
                                    clearMessagedValidate();
                                    signaturePad.clear();
                                    $("#btnSave").attr("disabled", false);
                                    $("#signaturePad").val("");
                                },
                            },
                        },
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

function assignDateNow(){
    $("#absence_date").datepicker().datepicker("setDate", new Date());
}
function showMessageValidate(xhr) {
    $("#err_name").html("");
    $("#err_absence_date").html("");
    $("#err_email").html("");
    $("#err_position").html("");
    $("#err_signed").html("");
    let err_absence_date = xhr.responseJSON.absence_date;
    let err_position = xhr.responseJSON.position;
    let err_name = xhr.responseJSON.name;
    let err_email = xhr.responseJSON.email;
    let err_signed = xhr.responseJSON.signed;
    $("#err_name").html(err_name).attr("class", "badge badge-danger");
    $("#err_email").html(err_email).attr("class", "badge badge-danger");
    $("#err_absence_date")
        .html(err_absence_date)
        .attr("class", "badge badge-danger");
    $("#err_position").html(err_position).attr("class", "badge badge-danger");
    $("#err_signed").html(err_signed).attr("class", "badge badge-danger");
}
function clearMessagedValidate() {
    $("#err_name").html("");
    $("#err_absence_date").html("");
    $("#err_email").html("");
    $("#err_position").html("");
    $("#err_signed").html("");
}

function touchHandler(event) {
    var touch = event.changedTouches[0];
    var simulatedEvent = document.createEvent("MouseEvent");
    simulatedEvent.initMouseEvent(
        {
            touchstart: "mousedown",
            touchmove: "mousemove",
            touchend: "mouseup",
        }[event.type],
        true,
        true,
        window,
        1,
        touch.screenX,
        touch.screenY,
        touch.clientX,
        touch.clientY,
        false,
        false,
        false,
        false,
        0,
        null
    );
    touch.target.dispatchEvent(simulatedEvent);
    //event.preventDefault();// you can remove preventDefault if it creates problem with other functionalities
}

function init() {
    document.addEventListener("touchstart", touchHandler, true);
    document.addEventListener("touchmove", touchHandler, true);
    document.addEventListener("touchend", touchHandler, true);
    document.addEventListener("touchcancel", touchHandler, true);
    $("#signaturePad").css("overflow", "hidden");
}

function getTopics(){
    jQuery.ajax({
        type: "get",
        url: "/api/topic/current-date/",
        beforeSend: function () {},
        success: function (response) {
            //console.log(response)
            let topic_id=""
            let topic_name=""
            if(!response){
                $("#topic_id").val(0);
                $("#topic_name").html("Absence Digital Cisangkan");
            } else {
                topic_id = response.id;
                topic_name = response.topic_name;
                $("#topic_id").val(topic_id);
                $("#topic_name").html("Topic Name : " +  topic_name);
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