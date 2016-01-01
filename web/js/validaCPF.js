/**
 * Created by Denis on 18/12/2015.
 */
$(document).ready(function() {
  $("#loginform-cpf").keyup(validate);
});

function validate() {

  var strCPF = $("#loginform-cpf").val();
  var Soma;
  var Resto;
  var resultado=true;
  Soma = 0;

  if (strCPF == "00000000000") resultado = false;
  if (strCPF == "11111111111") resultado = false;
  if (strCPF == "22222222222") resultado = false;
  if (strCPF == "33333333333") resultado = false;
  if (strCPF == "44444444444") resultado = false;
  if (strCPF == "55555555555") resultado = false;
  if (strCPF == "66666666666") resultado = false;
  if (strCPF == "77777777777") resultado = false;
  if (strCPF == "88888888888") resultado = false;
  if (strCPF == "99999999999") resultado = false;
    
  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  
  Resto = (Soma * 10) % 11;
  
  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  
  if (Resto != parseInt(strCPF.substring(9, 10)) ) resultado = false;
  
  
  Soma = 0;
  
  for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
  
  Resto = (Soma * 10) % 11;
  
  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  
  if (Resto != parseInt(strCPF.substring(10, 11) ) ) resultado = false;

  if(resultado == true) {
    $("#status").hide();
  }
  else {
    $("#status").show();
    $("#status").text("CPF Inválido!!!");
  }

  //console.log(resultado);
}
