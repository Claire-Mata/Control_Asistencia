<?php
//aqui se hcace el de eliminar
function despedir(){
    //la conexion con la base de datos
    include("conexion.php");
    //se trae el codigo del empleado
    $nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
    //se trae los datos de ese empleado
    $cek = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$nik'");
    //si no se encuentra nada
    if(mysqli_num_rows($cek) == 0){
        header('Location: reporteEmp.php?res=2');
        return <<<_MSJ
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert" id="alert">
                No se encontraron datos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        _MSJ;
    }else{
        //aqui se cambia el estado, porque es para despedir al usuario
        $delete = mysqli_query($con, "UPDATE `empleados` SET `estado` = '0' WHERE `codigo` = '$nik'");
        //se borra de la tabla
        if($delete){
            header('Location: reporteEmp.php?res=1');
        }else{
            header('Location: reporteEmp.php?res=3');
        }
    }	
}
//lo mandamos a llamar
if(isset($_GET['aksi']) == 'delete'){
    despedir();
}

?>