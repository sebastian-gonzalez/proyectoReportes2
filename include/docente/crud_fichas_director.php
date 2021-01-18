<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 2) {
        header('location: ../login.php');
    }
}
?>

<?php
include_once '../../include/database.php';
$db = new Database();
$id_s = $_SESSION['id_usuario'];

$query_ficha = $db->connect()->prepare("SELECT *FROM lista_ficha WHERE id_lista_usuario =$id_s");
$query_ficha->execute();
$row_ficha = $query_ficha->fetch(PDO::FETCH_NUM);


if ($row_ficha == true) {
    $id_lis = $row_ficha[0];
    $_SESSION['id_lista'] = $id_lis;

    $id_lis_u = $row_ficha[1];
    $_SESSION['id_lista_usuario'] = $id_lis_u;

    $id_lis_fi = $row_ficha[2];
    $_SESSION['id_lista_ficha'] = $id_lis_fi;

    $id_rol_fi = $row_ficha[3];
    $_SESSION['id_rol_ficha'] = $id_rol_fi;
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

           //Director no agrega


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

    //Director no elimina

    case 4:

        $user = $_SESSION['id_usuario'];

        $consulta = "SELECT * 
        FROM ficha 
        INNER JOIN lista_ficha ON ficha.id_ficha = lista_ficha.id_lista_ficha
        INNER JOIN programa ON ficha.id_programa_ficha = programa.id_programa
        INNER JOIN estado  ON ficha.id_estado_ficha = estado.id_estado
        WHERE id_lista_usuario=$user  AND id_rol_ficha= 2";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
