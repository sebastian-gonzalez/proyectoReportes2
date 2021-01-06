<?php
include_once '../bd/conexion.php';
$objeto = new Database();
$conexion = $objeto->connect();



$user_id = (isset($_POST['id_programa'])) ? $_POST['id_programa'] : '';
$Nombre = mysqli_real_escape_string($con, (strip_tags($_POST['nombre_pro'], ENT_QUOTES))); //Escanpando caracteres 	                                    
$Titulo = mysqli_real_escape_string($con, (strip_tags($_POST["titulo_pro"], ENT_QUOTES))); //Escanpando caracteres 
$Facultad_id    = mysqli_real_escape_string($con, (strip_tags($_POST["id_facultad_pro"], ENT_QUOTES))); //Escanpando caracteres 


switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO programa (nombre_pro,titulo_pro,id_facultad_pro) VALUES('$Nombre', '$Titulo','$Facultad_id')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM programa ORDER BY user_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "UPDATE programa SET nombre_pro='$Nombre',titulo_pro='$Titulo',id_facultad_pro='$Facu_id' WHERE user_id='$user_id' ";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM programa WHERE user_id='$user_id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "DELETE FROM programa WHERE user_id='$user_id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM programa";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
