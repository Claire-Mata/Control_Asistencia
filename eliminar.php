<?php

function despedir(){
        include("conexion.php");
	
        $nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
        $cek = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$nik'");
        if(mysqli_num_rows($cek) == 0){
            header('Location: reporteEmp.php?res=2');
            return <<<_MSJ
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert" id="alert">
                    No se encontraron datos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            _MSJ;
        }else{
            //este es para la opcion que aparece eliminar, pero como no haremos eso aqui, lo podes quitar
            $delete = mysqli_query($con, "UPDATE `empleados` SET `estado` = '0' WHERE `codigo` = '$nik'");
            if($delete){
                header('Location: reporteEmp.php?res=1');
            }else{
                header('Location: reporteEmp.php?res=3');
            }
        }	
}

if(isset($_GET['aksi']) == 'delete'){
    despedir();
}

?>