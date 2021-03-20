<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 3) {
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

//TABLA FICHA//

$id_ficha = (isset($_POST['id_ficha'])) ? $_POST['id_ficha'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$Estado = (isset($_POST['id_estado_ficha'])) ? $_POST['id_estado_ficha'] : '';
$Evaluacion = (isset($_POST['evaluacion_ficha'])) ? $_POST['evaluacion_ficha'] : '';






switch ($opcion) {
    case 1:

           //Director no agrega


        break;
    case 2:
        $consulta = "UPDATE ficha  SET id_estado_ficha='$Estado', evaluacion_ficha='$Evaluacion'  WHERE id_ficha='$id_ficha'";

        $resultado = $conexion->prepare($consulta);
        $validacion_id = $resultado->execute();

        break;
    case 3:

    //Director no elimina

    case 4:

        $programa = $_SESSION['id_programa_usu'];
        $consulta = "SELECT distinct fi.id_ficha,
        fi.titulo_ficha,
        fi.descripcion_ficha,
        fi.id_programa_ficha,
        fi.id_estado_ficha,
        fi.evaluacion_ficha,
        fi.fecha_ficha,
        pr.nombre_pro,
        es.nombre_estado
FROM ficha fi, lista_ficha lf, programa pr, estado es, rol_lista rl WHERE fi.id_ficha = lf.id_lista_ficha
AND fi.id_programa_ficha = pr.id_programa
AND fi.id_estado_ficha = es.id_estado
AND fi.id_programa_ficha = pr.id_programa
AND rl.id_rol_lista = lf.id_rol_ficha 
AND fi.id_programa_ficha = $programa
AND fi.id_estado_ficha IN (3,6)  
AND fi.activo is null
AND fi.id_ficha IN (
SELECT id_lista_ficha FROM lista_ficha WHERE id_lista_ficha NOT IN(
SELECT id_lista_ficha FROM lista_ficha  WHERE id_rol_ficha NOT IN (1,2,3) 
GROUP BY id_lista_ficha))";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
