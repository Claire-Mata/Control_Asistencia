//aqui asignamos el horario por si lo modifica
$( "#horarios" ).submit(function( event ) {
  event.preventDefault();
  var stringDatos = $("#horarios").serialize();
  //aqui lo mandamos por ajax
  $.ajax({
    type: 'POST',
    url: 'config_horario.php',
    data: stringDatos,
    dataType: 'json',
    success: function(datos) {
      alert(datos.mensaje);
    }
  });
});
  