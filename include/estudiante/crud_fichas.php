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
include_once '../../include/database.php';
$objeto = new Database();
$conexion = $objeto->connect();


$usuario_check = $_SESSION['id_usuario'];

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



switch ($opcion) {
    case 1:

        //AGREGAR = add_ficha.php
    break;
    case 2:
        $consulta = "UPDATE ficha  SET titulo_ficha='$Titulo',descripcion_ficha='$Descripcion', id_programa_ficha='$Programa', id_estado_ficha='$Estado' WHERE id_ficha='$id_ficha'";

        $resultado = $conexion->prepare($consulta);
        $validacion_id = $resultado->execute();

        //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
        if ($validacion_id = true) {
            $id_insert  = $conexion->lastInsertId();
        } else {
            //Pueden haber errores, como clave duplicada
            $id_insert = 0;
            echo "no se ejecuto la primera consulta ";
        }


        $consulta1 = "UPDATE lista_ficha  SET id_lista_usuario='$id_lista_usuario',id_lista_ficha='$id_lista_ficha', id_rol_ficha='$id_rol_ficha'";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();



        $consulta = "SELECT * FROM ficha WHERE id_ficha='$id_ficha' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:

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



        $consulta = "DELETE FROM lista_ficha WHERE id_lista_ficha='$id_ficha' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta1 = "DELETE FROM ficha WHERE id_ficha='$id_ficha' ";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        break;



    case 4:
        $consulta = "SELECT * FROM ficha INNER JOIN programa INNER JOIN estado WHERE id_programa_ficha=id_programa AND id_estado_ficha=id_estado";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
