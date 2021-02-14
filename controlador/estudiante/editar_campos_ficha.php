<?php
session_start();
if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 4) {
        header('location: ../../login.php');
    }
}


?>

<?php
include('../database.php');
include('../conexion.php');

$objeto = new Database();
$conexion = $objeto->connect();

?>
<?php






if (isset($_POST['editcampo'])) {
	


    $valor_ficha = mysqli_real_escape_string($con, (strip_tags($_POST['valor_campo'], ENT_QUOTES))); //+

    if (isset($_GET['aksi']) == 'edit') {


        // escaping, additionally removing everything that could be (html/javascript-) code

        $nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));

            
            $update = mysqli_query($con, "UPDATE campos_fichas SET valor_campo='$valor_ficha'  WHERE id_campo='$nik'");

       
            if ($update) {
                header("Location: ../../vista/rol_estudiante/info_ficha.php");
            } else {
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo editar los datos.
                
                </div>'
                ;
                
            }
        }
    
    
      
 






     }

?>