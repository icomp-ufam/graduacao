/**
 * Created by Denis on 18/12/2015.
 */
$(document).ready(function() {
    $("#pw2").keyup(validate);
});

function validate() {
    var password1 = $("#pw1").val();
    var password2 = $("#pw2").val();
	
	if(password1.length < 6 || password1.length > 10)
	{
        $("#status").show();
        $("#status").text("O tamanho da senha deve ser entre 6 e 10 caracteres!!");
    }
	else{
		if(password1 == password2) {
			//$("#status").text("valid");
			$("#status").hide();
		}
		else {
			$("#status").show();
			$("#status").text("A senha não confere!!");
		}
	}

}