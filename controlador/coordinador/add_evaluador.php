<?php

$db = new Database();
$conexion = $db->connect();
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
if (isset($_POST['add_evaluador'])) {
     $id_lista_ficha =  $_SESSION['id_fichas_evaluador'];
     foreach ($_POST['id_lista_usuario_ev'] as $key => $value) {
          $id_lista_usuario = $_POST['id_lista_usuario_ev'][$key];
          $id_lista_ficha = $_SESSION['id_fichas_evaluador'];
          $id_rol_ficha = 3;


          $consulta_validacion = "SELECT * FROM lista_ficha WHERE id_lista_ficha =$id_lista_ficha AND (id_lista_usuario=$id_lista_usuario AND id_rol_ficha = 2)";
          $resultado_vali = $conexion->prepare($consulta_validacion);
          $data_vali = $resultado_vali->execute();

          if ($resultado_vali->fetchColumn() > 0) {
               echo '<script language="javascript">alert("La ficha no puede asignar ese evaluador");
          location.href="revision_fichas_coordinador.php";</script>';
          } else {

               $consulta_participante = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
         VALUES('$id_lista_usuario','$id_lista_ficha', '$id_rol_ficha') ";
               $resultado_participante = $conexion->prepare($consulta_participante);
               $resultado_participante->execute();
               echo '<script>
               location.href="revision_fichas_coordinador.php";</script>';
          }
     }
}
