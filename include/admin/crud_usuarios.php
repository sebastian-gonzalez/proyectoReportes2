<?php
include_once '../../include/database.php';
$objeto = new Database();
$conexion = $objeto->connect();

$Cedula = (isset($_POST['cedula_usu'])) ? $_POST['cedula_usu'] : '';
$Nombre = (isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';
$Apellido = (isset($_POST['apellido_usu'])) ? $_POST['apellido_usu'] : '';
$Correo    = (isset($_POST['correo_usu'])) ? $_POST['correo_usu'] : '';
$Contrasena    = (isset($_POST['contrasena_usu'])) ? $_POST['contrasena_usu'] : '';
$Rol_id    = (isset($_POST['id_rol_usu'])) ? $_POST['id_rol_usu'] : '';
$Programa_id    = (isset($_POST['id_programa_usu'])) ? $_POST['id_programa_usu'] : '';

$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';





switch ($opcion) {
    case 1:
        //agregar
    case 2:
     //editar
    case 3:
        $consulta = "DELETE FROM usuarios WHERE id_usuario='$id_usuario' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4:
        $consulta = "SELECT * FROM usuarios INNER JOIN rol_usu INNER JOIN programa WHERE id_rol_usu=id_rol AND  id_programa_usu=id_programa";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
