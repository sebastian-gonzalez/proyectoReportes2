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
include_once '../../controlador/database.php';
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
        $consulta = "UPDATE ficha  SET titulo_ficha='$Titulo', id_estado_ficha='$Estado' WHERE id_ficha='$id_ficha'";

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
        $consulta = "SELECT * FROM ficha WHERE id_ficha='$id_ficha' AND activo is null ";
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



        $consulta1 = "UPDATE ficha  SET activo='n' WHERE id_ficha='$id_ficha' ";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        break;



    case 4:


        $id_ficha_vali = $_SESSION['id_lista_ficha'];

        $consulta = "SELECT * FROM ficha 
        INNER JOIN programa ON ficha.id_programa_ficha = programa.id_programa
        INNER JOIN estado ON ficha.id_estado_ficha = estado.id_estado
        INNER JOIN lista_ficha ON ficha.id_ficha = lista_ficha.id_lista_ficha
        WHERE ficha.activo is null AND id_lista_usuario = $id_lista_usuario LIMIT 1";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
