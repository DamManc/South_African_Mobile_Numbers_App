require("../common/app.js");

//----------INIT-----------//

$(document).ready(function () {
    btn_update();
    delete_file();
    submit_file();
    api_end_point();
});

//--------FUNCTIONS--------//

function btn_update() {
    $(".upload_btn").on("click", function () {
        $(".status-session p").text("");
    });
}

function delete_file() {
    $(".delete_btn").on("click", function () {
        document.getElementById("form").reset();
        $(".status-session p").text("File and results is deleted");
        $.ajax({
            url: "/delete",
            type: "DELETE",
            data: { _token: token },
        }).done(function () {
            $(
                ".result,.download_btn_acc, .download_btn_rev, .download_btn_inc, .apiEnd"
            ).removeClass("active");
        });
    });
}

function submit_file() {
    $("#form").on("submit", function (event) {
        event.preventDefault();
    });
    $("#submit").on("click", function (event) {
        if ($(".upload_btn")[0].files.length == 0) {
            $(".status-session p").text("You must upload a file");
        } else if (
            $(".upload_btn")[0].files[0].type == "application/vnd.ms-excel"
        ) {
            upload_file();
        } else {
            $(".status-session p").text("You must upload a CSV file");
            event.preventDefault();
        }
    });
}

/*
 *
 * NELLA FETCH HO FATTO UN
 * ULTERIORE CONTROLLO SUL RESPONSE DEL SERVER,
 * NEL PHONECONTROLLER SE IL VALIDATOR FALLISCE HO MESSO UN RESPONSE 500
 *
 * */

function upload_file() {
    var formData = new FormData();
    var fileInput = document.querySelector("form input[type=file]");
    var attachment = fileInput.files[0];
    formData.append("file", attachment, "file");
    fetch("/upload", {
        headers: {
            Accept: "multipart/form-data",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token,
        },
        method: "POST",
        body: formData,
    }).then(function (response) {
        if (response.ok) {
            $(
                ".result,.download_btn_acc, .download_btn_rev, .download_btn_inc, .apiEnd "
            ).addClass("active");
        } else {
            $(".status-session p").text("The file is must to be an CSV..");
        }
    });
}

<<<<<<< HEAD
function api_end_point() {
    $(".apiEnd").on("click", function (event) {
=======

function api_end_point(){
    $(".apiEnd").on("click", function (event){
>>>>>>> 1a7a2636f7c42be7a9af80eeecc2e22627a2b0b3
        $.ajax({
            method: "POST",
            url: "/apiendpoint",
            data: { _token: token },
        }).done(function (data) {
            try {
                document.body.innerHTML = data;
            } catch (e) {
                return false;
            }
        });
    });
}
