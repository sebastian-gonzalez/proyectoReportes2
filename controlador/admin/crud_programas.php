<?php
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();



$Nombre = (isset($_POST['nombre_pro'])) ? $_POST['nombre_pro'] : '';
$Titulo = (isset($_POST['titulo_pro'])) ? $_POST['titulo_pro'] : '';
$Facultad_id = (isset($_POST['id_facultad_pro'])) ? $_POST['id_facultad_pro'] : '';

$id_programa = (isset($_POST['id_programa'])) ? $_POST['id_programa'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO programa (nombre_pro,titulo_pro,id_facultad_pro) VALUES('$Nombre', '$Titulo','$Facultad_id')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM programa WHERE activo IS null ORDER BY id_programa DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "UPDATE programa SET nombre_pro='$Nombre',titulo_pro='$Titulo',id_facultad_pro='$Facultad_id' WHERE id_programa='$id_programa'";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM programa WHERE id_programa='$id_programa'AND activo IS null ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "UPDATE programa SET activo='N' WHERE id_programa='$id_programa' ";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM programa WHERE id_programa='$id_programa' AND activo IS null ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4:
        $consulta = "SELECT * FROM programa ama INNER JOIN facultad WHERE id_facultad_pro=id_facultad AND ama.activo IS null";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
