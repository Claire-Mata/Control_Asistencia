//aqui hacemos la magia de marcar
//primero validamos que solo uno se pueda checkear
$(document).ready(function () {
  $( "#codigo" ).focus();
  $("input[name=entrada]").change(function () {
        $( "#salida" ).prop( "checked", false );
  	});
    $("input[name=salida]").change(function () {
        $( "#entrada" ).prop( "checked", false );
    });
});

//esto nos ayuda a que depende de la hora se checkeara automaticamente 
//la entrada o salida
//si es mayor a las 13 se chekeara la salida
$('#codigo').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == 13){
    event.preventDefault();
    const tiempo=1000;
    setTimeout(function() {
        consultar();},tiempo);
  }
});

//y aqui mandamos por ajax si marco entrada o salida
function consultar(){
  var marca='E';
  var codigo=$('#codigo').val();
  if( $("#entrada").is(':checked')) {
     marca=$("#entrada").val()
  }
  if( $("#salida").is(':checked')) {
    marca=$("#salida").val()
  }
  if (codigo!="") {
    $.ajax({
      type: 'POST',
      url: 'ins_marca_dia.php',
      data: {codigo:codigo,marca:marca},
      dataType: 'json',
      //luego solo se limpia los campos
      success: function(data) {
            $( "#codigo" ).focus();
            $( "#codigo" ).val("");
          $( ".mensajes" ).text(data.mensaje);
      }
    });
  }
}
