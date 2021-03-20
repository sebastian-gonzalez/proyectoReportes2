
<?php
include_once 'controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();
session_start();
$id_usuario=$_SESSION['id_usuario'];
$id_rol_usu=$_SESSION['id_rol_usu'];



if(isset($_POST ['edit_profile'])){

$Cedula = (isset($_POST['cedula_usu'])) ? $_POST['cedula_usu'] : '';
$Nombre = (isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';
$Apellido = (isset($_POST['apellido_usu'])) ? $_POST['apellido_usu'] : '';
$Correo    = (isset($_POST['correo_usu'])) ? $_POST['correo_usu'] : '';
$Contrasena    = (isset($_POST['contrasena_usu'])) ? $_POST['contrasena_usu'] : '';



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

if ($resultado_vali_cedula->fetchColumn() > 0) {

    if ($id_rol_usu == 1) {
        echo '<script>
        location.href="vista/rol_admin/perfil.php";</script>';
    } elseif ($id_rol_usu == 3) {
        echo '<script >
        location.href="vista/rol_coordinador/perfil.php";</script>';
    } elseif ($id_rol_usu == 2) {
        echo '<script >
        location.href="vista/rol_docente/perfil.php";</script>';
    } elseif ($id_rol_usu == 4) {
            echo '<script >
            location.href="vista/rol_estudiante/perfil.php";</script>';} 

} else if ($resultado_vali_correo->fetchColumn() > 0) {

    if ($id_rol_usu == 1) {
        echo '<script> 
        location.href="vista/rol_admin/perfil.php";</script>';
    } elseif ($id_rol_usu == 3) {
        echo '<script >
        location.href="vista/rol_coordinador/perfil.php";</script>';
    } elseif ($id_rol_usu == 2) {
        echo '<script >
        location.href="vista/rol_docente/perfil.php";</script>';
    } elseif ($id_rol_usu == 4) {
            echo '<script>
            location.href="vista/rol_estudiante/perfil.php";</script>';} 




}  if ($validacion_empty_contra) {


    $consulta = "UPDATE usuarios  SET cedula_usu='$Cedula',nombre_usu='$Nombre', apellido_usu='$Apellido', correo_usu='$Correo' WHERE id_usuario='$id_usuario'";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario' ";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

    if ($id_rol_usu == 1) {
        echo '<script>
        location.href="vista/rol_admin/perfil.php";</script>';
    } elseif ($id_rol_usu == 3) {
        echo '<script>
        location.href="vista/rol_coordinador/perfil.php";</script>';
    } elseif ($id_rol_usu == 2) {
        echo '<script >
        location.href="vista/rol_docente/perfil.php";</script>';
    } elseif ($id_rol_usu == 4) {
            echo '<script>
            location.href="vista/rol_estudiante/perfil.php";</script>';} 



       

} else{
    

    $consulta = "UPDATE usuarios  SET cedula_usu='$Cedula',nombre_usu='$Nombre', apellido_usu='$Apellido', correo_usu='$Correo',contrasena_usu='$Contrasena' WHERE id_usuario='$id_usuario'";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario' ";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

    if ($id_rol_usu == 1) {
        echo '<script >
        location.href="vista/rol_admin/perfil.php";</script>';
    } elseif ($id_rol_usu == 3) {
        echo '<script >
        location.href="vista/rol_coordinador/perfil.php";</script>';
    } elseif ($id_rol_usu == 2) {
        echo '<script >
        location.href="vista/rol_docente/perfil.php";</script>';
    } elseif ($id_rol_usu == 4) {
            echo '<script> 
            location.href="vista/rol_estudiante/perfil.php";</script>';} 

}
}