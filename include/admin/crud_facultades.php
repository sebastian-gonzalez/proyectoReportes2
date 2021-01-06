<?php
include_once '../bd/conexion.php';
$objeto = new Database();
$conexion = $objeto->connect();


$user_id = (isset($_POST['id_facultad'])) ? $_POST['id_facultad'] : '';
$Nombre = mysqli_real_escape_string($con, (strip_tags($_POST['nombre_facultad'], ENT_QUOTES))); //Escanpando caracteres 


switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO facultad (nombre_facultad) VALUES('$Nombre')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM facultad ORDER BY user_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "UPDATE facultad  SET nombre_facultad='$Nombre' WHERE user_id='$user_id'";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM facultad WHERE user_id='$user_id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "DELETE FROM facultad WHERE user_id='$user_id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM facultad";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
