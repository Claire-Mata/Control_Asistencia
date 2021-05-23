
$(document).ready(function () {
  $( "#codigo" ).focus();
  $("input[name=entrada]").change(function () {
        $( "#salida" ).prop( "checked", false );
  	});
    $("input[name=salida]").change(function () {
        $( "#entrada" ).prop( "checked", false );
    });
});

$('#codigo').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == 13){
       event.preventDefault();
       const tiempo=1000;
       setTimeout(function() {
       	    consultar();},tiempo);
    }
});



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
        success: function(data) {
          //  alert("operacion:"+data.operacion);
             $( "#codigo" ).focus();
             $( "#codigo" ).val("");
            $( ".mensajes" ).text(data.mensaje);
            
          //alert("nombre:"+data.nombre);
        }
      });
    }
}
