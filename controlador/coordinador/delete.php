<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 3) {
        header('location: ../../login.php');
    }
}

?>
<?php
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();

//TABLA FICHA//

$id_ficha = (isset($_POST['id_ficha'])) ? $_POST['id_ficha'] : '';



$consulta1 = "UPDATE ficha  SET activo='N' WHERE id_ficha='$id_ficha'  ";
$resultado1 = $conexion->prepare($consulta1);
$resultado1->execute();

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;



?>