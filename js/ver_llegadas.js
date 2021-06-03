

//seleccionar tipo orden en modal, nos ayuda a buscar y los mandamos a la siguiente 
//pagina y los metemos donde esta el id mostrar_datoss que es en la tabla
$(document).on('click', '#buscar', function(e) {
    var codigo=$('#codigo').val();
    var fechai=$('#fechai').val();
    var fechaf=$('#fechaf').val();
  
  
     $.ajax({
       type: 'POST',
       url:'mostrar_llegadas.php',
       data: {codigo:codigo,fechai:fechai,fechaf:fechaf},
       dataType:'html',
       success: function(datax) {
        $("#mostrar_datoss").html(datax);
       }
     });
  });
  