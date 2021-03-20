<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 4) {
        header('location: ../login.php');
    }
}

?>
<?php
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();

//TABLA FICHA//

$id_ficha = (isset($_POST['valorfi'])) ? $_POST['valorfi'] : '';




//TABLA LISTA_FICHA//


//eliminarAR("pdf/$id_ficha");


//function eliminarAR($carpeta)
//{
//    foreach (glob($carpeta . "/*") as $archivo_carpeta) {
//        if (is_dir($archivo_carpeta)) {
//            eliminarAR($archivo_carpeta);
//        } else {
//            unlink($archivo_carpeta);
//        }
//    }
//    rmdir($carpeta);
//}

//eliminarAR1("anteproyecto/$id_ficha");


//function eliminarAR1($carpeta)
//{
//   foreach (glob($carpeta . "/*") as $archivo_carpeta) {
//        if (is_dir($archivo_carpeta)) {
//            eliminarAR1($archivo_carpeta);
//        } else {
//            unlink($archivo_carpeta);
//        }
//    }
//    rmdir($carpeta);
//}


$consulta1 = "UPDATE ficha  SET id_estado_ficha=1 WHERE id_ficha='$id_ficha'  ";
$resultado1 = $conexion->prepare($consulta1);
$resultado1->execute();

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
