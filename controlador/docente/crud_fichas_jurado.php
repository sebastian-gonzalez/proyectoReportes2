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
include_once '../../controlador/database.php';
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
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();

$id_ficha = (isset($_POST['id_ficha'])) ? $_POST['id_ficha'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$Estado = (isset($_POST['id_estado_ficha'])) ? $_POST['id_estado_ficha'] : '';



switch ($opcion) {
    case 1:

        //Director no agrega


        break;
    case 2:
        $consulta = "UPDATE ficha  SET id_estado_ficha='$Estado' WHERE id_ficha='$id_ficha'";

        $resultado = $conexion->prepare($consulta);
        $validacion_id = $resultado->execute();

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
        WHERE (id_lista_usuario=$user  AND id_rol_ficha= 4 AND id_estado_ficha = 6
        AND ficha.activo is null
        AND lista_ficha.activo is null)";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
