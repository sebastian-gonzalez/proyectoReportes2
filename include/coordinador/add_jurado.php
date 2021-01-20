<?php

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
if (isset($_POST['add_jurado'])) {

     $id_lista_usuario = (isset($_POST['id_lista_usuario_ju'])) ? $_POST['id_lista_usuario_ju'] : '';

     $consulta_validacion = "SELECT COUNT(*) FROM lista_ficha WHERE id_lista_usuario=$id_lista_usuario";
     $resultado_vali = $conexion->prepare($consulta_validacion);
     $data_vali = $resultado_vali->execute();

     if ($resultado_vali->fetchColumn() > 0) {
          echo '<script language="javascript">alert("La ficha ya posee ese jurado");
     location.href="revision_fichas_coordinador.php";</script>';
     } else {

               //asignar companero
               $id_lista_usuario = (isset($_POST['id_lista_usuario_ju'])) ? $_POST['id_lista_usuario_ju'] : '';
               $id_lista_ficha = $_SESSION['id_lista_ficha'];
               $id_rol_ficha = 4;

               $consulta_participante = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
         VALUES('$id_lista_usuario','$id_lista_ficha', '$id_rol_ficha') ";

               $resultado_participante = $conexion->prepare($consulta_participante);
               $resultado_participante->execute();
               echo '<script language="javascript">alert("exito");
               location.href="revision_fichas_coordinador.php";</script>';
               
          }
     }

