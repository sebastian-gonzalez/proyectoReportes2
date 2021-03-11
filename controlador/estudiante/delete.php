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

$id_ficha = (isset($_POST['id_ficha'])) ? $_POST['id_ficha'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$archivo = (isset($_POST['archivo'])) ? $_POST['archivo'] : '';
$Titulo = (isset($_POST['titulo_ficha'])) ? $_POST['titulo_ficha'] : '';
$Descripcion = 'Proyecto de Grado';

$Programa = $_SESSION['id_programa_usu'];

$Estado = 1;

//TABLA LISTA_FICHA//

$id_lista_usuario = $_SESSION['id_usuario'];

$id_lista_ficha = $id_ficha;
$id_rol_ficha = 1;

eliminarAR("pdf/$id_ficha");


function eliminarAR($carpeta)
{
    foreach (glob($carpeta . "/*") as $archivo_carpeta) {
        if (is_dir($archivo_carpeta)) {
            eliminarAR($archivo_carpeta);
        } else {
            unlink($archivo_carpeta);
        }
    }
    rmdir($carpeta);
}

eliminarAR1("anteproyecto/$id_ficha");


function eliminarAR1($carpeta)
{
    foreach (glob($carpeta . "/*") as $archivo_carpeta) {
        if (is_dir($archivo_carpeta)) {
            eliminarAR1($archivo_carpeta);
        } else {
            unlink($archivo_carpeta);
        }
    }
    rmdir($carpeta);
}


$consulta1 = "UPDATE ficha  SET activo='n' WHERE id_ficha='$id_ficha'  ";
$resultado1 = $conexion->prepare($consulta1);
$resultado1->execute();

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;

