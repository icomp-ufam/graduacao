/**
 * Created by Denis on 18/12/2015.
 */
$(document).ready(function() {
    $("#pw2").keyup(validate);
});

function validate() {
    var password1 = $("#pw1").val();
    var password2 = $("#pw2").val();

    if(password1 == password2) {
        //$("#status").text("valid");
        $("#status").hide();
    }
    else {
        $("#status").show();
        $("#status").text("A senha não confere!!");
    }

}