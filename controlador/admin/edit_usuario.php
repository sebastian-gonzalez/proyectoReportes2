<?php
include_once '../database.php';
$objeto = new Database();
$conexion = $objeto->connect();


session_start();
if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 1) {
        header('location: ../login.php');
    }
}




$Cedula = (isset($_POST['cedula_usu'])) ? $_POST['cedula_usu'] : '';
$Nombre = (isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';
$Apellido = (isset($_POST['apellido_usu'])) ? $_POST['apellido_usu'] : '';
$Correo    = (isset($_POST['correo_usu'])) ? $_POST['correo_usu'] : '';
$Contrasena    = (isset($_POST['contrasena_usu'])) ? $_POST['contrasena_usu'] : '';
$Rol_id    = (isset($_POST['id_rol_usu'])) ? $_POST['id_rol_usu'] : '';
$Programa_id    = (isset($_POST['id_programa_usu'])) ? $_POST['id_programa_usu'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';

$Contrasena = password_hash($Contrasena, PASSWORD_DEFAULT);

// Validacion para saber si un usuario ya posee la cedula ingresada
$consulta_validacion_cedula = "SELECT COUNT(*) FROM usuarios WHERE cedula_usu=$Cedula and id_usuario !=$id_usuario";
$resultado_vali_cedula = $conexion->prepare($consulta_validacion_cedula);
$data_vali_cedula = $resultado_vali_cedula->execute();

// Validacion para saber si un usuario ya posee el correo ingresado
$consulta_validacion_correo = "SELECT COUNT(*) FROM usuarios WHERE correo_usu='$Correo' and id_usuario !=$id_usuario";
$resultado_vali_correo = $conexion->prepare($consulta_validacion_correo);
$data_vali_correo = $resultado_vali_correo->execute();


$validacion_empty_contra=empty($_POST['contrasena_usu']);
$validacionUsuario = true;


if ($resultado_vali_cedula->fetchColumn() > 0) {

    
    //$error="0";
    $validacionUsuario = false;
    //echo 'validacion ' . $validacionUsuario;
    print json_encode(array('success' => 0));
    

} else if ($resultado_vali_correo->fetchColumn() > 0) {
    
    $validacionUsuario = false;
    print json_encode(array('success' => 1));
    
} 

if ($validacion_empty_contra == true &&  $validacionUsuario == true ) {


  
     
    $consulta = "UPDATE usuarios  SET cedula_usu='$Cedula',nombre_usu='$Nombre', apellido_usu='$Apellido', correo_usu='$Correo',id_rol_usu='$Rol_id', id_programa_usu='$Programa_id' WHERE id_usuario='$id_usuario'";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario' AND activo is null ";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    
    print json_encode(array('success' => 3));



} else if ($validacion_empty_contra == false &&  $validacionUsuario == true ) {
    

    $consulta = "UPDATE usuarios  SET cedula_usu='$Cedula',nombre_usu='$Nombre', apellido_usu='$Apellido', correo_usu='$Correo',contrasena_usu='$Contrasena',id_rol_usu='$Rol_id', id_programa_usu='$Programa_id' WHERE id_usuario='$id_usuario'";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'AND activo is null ";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
   

    print json_encode(array('success' => 4));
    //print json_encode($data, JSON_UNESCAPED_UNICODE);
        
}
