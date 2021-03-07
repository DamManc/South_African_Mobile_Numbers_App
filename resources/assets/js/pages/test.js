require("../common/app.js");

//----------INIT---------//

$(document).ready(function(){
    form_validate();
});

//---------FUNCTIONS---------//


/*
*
*HO USATO IL VALIDATE DI JQUERY, SI POSSONO CREARE DEI METODI PERSONALIZZATI,
* QUI NON HO VALIDATO IL JS PERCHè SE ALTRIMENTI NESSUN DATO SBAGLIATO ENTRAVA
* NEL SERVER E L'ESERCIZIO NON AVEVA SENSO
*
* */

function form_validate() {

    $("#form").submit(function(e) {
        e.preventDefault();
    });
    $("#form").validate({
        submitHandler: function(form) {
            ajaxSubmit();
        },
        rules: {
            phone: {
                required: true,
            },
        },
        errorPlacement: function(error, element) {
            return null;
        }
    });
}


function ajaxSubmit(){
    $('.status-response p.correct').text('');
    $('.status-response p.error').text('');
    $('.status-response p.number').text('');
    $('.status-response p.revision').text('');
    var input = {};
    input.phone = $('#phone').val();
    input.action = 'test';
    var payload = JSON.stringify(input);
    $.ajax({
        method: "POST",
        url: "/test",
        data: { _token: token, _ajpayload: payload }
    })
        .done(function(data) {
        try {
            after_ajax(data);
        } catch (e) {
            return false;
        }
    });
}

function after_ajax(resp){
    $('.status-response p.correct').text(resp.correct);
    $('.status-response p.error').text(resp.error);
    $('.status-response p.revision').text(resp.revision);
    $('.status-response p.number').text(resp.phone);
}

