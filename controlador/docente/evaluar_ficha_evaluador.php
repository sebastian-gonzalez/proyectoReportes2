


<?php
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();
include('../conexion.php');






if (isset($_POST['guardar'])) {



    $id_ficha = mysqli_real_escape_string($con, (strip_tags($_GET["ficha"], ENT_QUOTES)));
    $id_estado_ficha = (isset($_POST['id_estado_ficha'])) ? $_POST['id_estado_ficha'] : '';
    $evaluacion_ficha = (isset($_POST['evaluacion_ficha'])) ? $_POST['evaluacion_ficha'] : '';

    $consulta = "UPDATE ficha  SET id_estado_ficha='$id_estado_ficha', evaluacion_ficha='$evaluacion_ficha'  WHERE id_ficha='$id_ficha'";

    $resultado = $conexion->prepare($consulta);
    $validacion_id = $resultado->execute();

    if (isset($_FILES['evaluacion'])) {
        
        if ($_FILES["evaluacion"]["error"] > 0) {
            echo "Error al cargar archvio de evaluacion";
        } else {
            $permitidos = array('application/pdf');
            $limite_kb = 200000000;
            if (in_array($_FILES["evaluacion"]["type"], $permitidos) && $_FILES["evaluacion"]["size"] <= $limite_kb * 1024) {
                $ruta = "../../controlador/estudiante/evaluacion/$id_ficha/";
                $archivo = $ruta . $_FILES["evaluacion"]["name"];
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (!file_exists($archivo)) {
                    $resultado = @move_uploaded_file(
                        $_FILES["evaluacion"]["tmp_name"],
                        $archivo
                    );
                }
                if ($resultado) {
                    echo "evaluacion guardado";
                } else {
                    echo " evaluacion no guardado";
                }
            } else {
                echo
                "<script> swal({
        title: '¡ERROR!',
        text: 'la evaluacion no esta permitido o excede el tamano',
        type: 'error',
      }).then(function(){ 
        location.href='fichas.php';
        }
     );
     ;</script>";
            }
        }
    }
   

}
