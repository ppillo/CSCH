/**
 * Created by Sam on 15/01/2017.
 */
/*Form Validator Start*/

function validateText(id) {

    if ($("#" + id).val() == null || $("#" + id).val() == "") {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        div.addClass("has-error has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error");
        $("#glypcn" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

function validateLengthPost(id) {

    if ($("#" + id).val().length != 4) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        $("#errorPost" + id).remove();
        div.addClass("has-error has-feedback no-margin");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        div.append('<span id="errorPost' + id + '" class="data-error no-margin">Needs 4 numbers</span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error marginBottom");
        $("#glypcn" + id).remove();
        $("#errorPost" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

function validateLength(id) {

    if ($("#" + id).val().length != 14) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        $("#error" + id).remove();
        div.addClass("has-error has-feedback marginBottom");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        div.append('<span id="error' + id + '" class="data-error"><p>Needs 10 numbers to be valid phone number</p></span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error marginBottom");
        $("#glypcn" + id).remove();
        $("#error" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

function validateLengthWWCC(id) {

    if ($("#" + id).val().length != 11) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        $("#error" + id).remove();
        div.addClass("has-error has-feedback marginBottom");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        div.append('<span id="error' + id + '" class="data-error">Needs 10 numbers to be valid number</span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error marginBottom");
        $("#glypcn" + id).remove();
        $("#error" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

function validateEmail(id) {
    var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    if (!email_regex.test($("#" + id).val() || $("#" + id).val() == null || $("#" + id).val() == "")) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        $("#errorPost" + id).remove();
        div.addClass("has-error has-feedback marginBottom");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        div.append('<span id="errorPost' + id + '" class="data-error">Invalid email address</span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error marginBottom");
        $("#glypcn" + id).remove();
        $("#errorPost" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

function validateUsername(id) {
    var user_regex = /^[a-zA-Z0-9._-]+[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    if (!user_regex.test($("#" + id).val())) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        div.addClass("has-error has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error");
        $("#glypcn" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

function validateSelect(id) {
    if ($("#" + id).val() == null || $("#" + id).val() == "") {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        $("#error" + id).remove();
        div.addClass("has-error has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error no-margin");
        $("#glypcn" + id).remove();
        $("#error" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

function validateEmpty(id) {
    if ($("#" + id).val() == null || $("#" + id).val() == "") {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        $("#error" + id).remove();
        div.removeClass("has-error no-margin");
        return true;
    }
}
function validateChosen(id) {
    if ($("#" + id).val() == null || $("#" + id).val() == "") {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        $("#errorPost" + id).remove();
        div.addClass("has-error has-feedback marginBottom");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        div.append('<span id="errorPost' + id + '" class="data-error">Please choose a Custodian</span>');
        return false;
    }
    else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error marginBottom");
        $("#glypcn" + id).remove();
        $("#errorPost" + id).remove();
        div.addClass("has-success has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback"></span>');
        return true;
    }
}

