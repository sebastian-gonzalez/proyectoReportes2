
<?php
include_once '../database.php';
$objeto = new Database();
$conexion = $objeto->connect();

if (isset($_POST['add_usuario'])) {


    $Cedula = (isset($_POST['cedula_usu'])) ? $_POST['cedula_usu'] : '';
    $Nombre = (isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';
    $Apellido = (isset($_POST['apellido_usu'])) ? $_POST['apellido_usu'] : '';
    $Correo    = (isset($_POST['correo_usu'])) ? $_POST['correo_usu'] : '';
    $Contrasena  = (isset($_POST['contrasena_usu'])) ? $_POST['contrasena_usu'] : '';
    $Rol_id    = (isset($_POST['id_rol_usu'])) ? $_POST['id_rol_usu'] : '';
    $Programa_id    = (isset($_POST['id_programa_usu'])) ? $_POST['id_programa_usu'] : '';
    $id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';

   

    
    // Validacion para saber si un usuario ya posee la cedula ingresada
    $consulta_validacion_cedula = "SELECT COUNT(*) FROM usuarios WHERE cedula_usu=$Cedula";
    $resultado_vali_cedula = $conexion->prepare($consulta_validacion_cedula);
    $data_vali_cedula = $resultado_vali_cedula->execute();

    // Validacion para saber si un usuario ya posee el correo ingresado
    $consulta_validacion_correo = "SELECT COUNT(*) FROM usuarios WHERE correo_usu='$Correo'";
    $resultado_vali_correo = $conexion->prepare($consulta_validacion_correo);
    $data_vali_correo = $resultado_vali_correo->execute();

    if ($resultado_vali_cedula->fetchColumn() > 0) {
        echo '<script language="javascript">alert("Intente con una cedula diferente");
        location.href="../../rol_admin/usuarios.php";</script>';
    } else if ($resultado_vali_correo->fetchColumn() > 0) {
        echo '<script language="javascript">alert("Intente con un correo diferente");
        location.href="../../rol_admin/usuarios.php";</script>';
    } else {

        $consulta = "INSERT INTO usuarios (cedula_usu,nombre_usu,apellido_usu,correo_usu,contrasena_usu,id_rol_usu,id_programa_usu)
    VALUES('$Cedula','$Nombre', '$Apellido','$Correo','$Contrasena', '$Rol_id', '$Programa_id')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM usuarios ORDER BY id_usuario DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        echo '<script language="javascript">alert("Exito");
        location.href="../../rol_admin/usuarios.php";</script>';

    }
}
