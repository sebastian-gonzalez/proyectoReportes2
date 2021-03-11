<?php
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();



$Nombre = (isset($_POST['nombre_facultad'])) ? $_POST['nombre_facultad'] : '';



$id_facultad = (isset($_POST['id_facultad'])) ? $_POST['id_facultad'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO facultad (nombre_facultad) VALUES('$Nombre')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM facultad WHERE activo IS null ORDER BY id_facultad DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "UPDATE facultad SET nombre_facultad='$Nombre' WHERE id_facultad='$id_facultad'";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM facultad WHERE id_facultad='$id_facultad' AND  activo IS  null ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "UPDATE facultad SET activo='n' WHERE id_facultad='$id_facultad'";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM facultad WHERE id_facultad='$id_facultad' AND  activo IS  null ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4:
        $consulta = "SELECT * FROM facultad WHERE  activo IS  null";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;
}



print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
