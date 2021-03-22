<!--SweetAlert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

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
echo'<body>';
if (isset($_POST['add_jurado'])) {


     
     $id_listaj_ficha =  $_SESSION['id_fichas_jurado']; 

     $id_lista_usuario = (isset($_POST['id_lista_usuario_ju'])) ? $_POST['id_lista_usuario_ju'] : '';
   



     $consulta_validacion = "SELECT * FROM lista_ficha WHERE id_lista_ficha =$id_listaj_ficha AND id_lista_usuario=$id_lista_usuario AND id_rol_ficha = 2  AND lista_ficha.activo is null";
     $resultado_vali = $conexion->prepare($consulta_validacion);
     $data_vali = $resultado_vali->execute();

     if ($resultado_vali->fetchColumn() > 0) {
          echo
          "<script> swal({
              allowOutsideClick: false,
              title: '¡Atencion!',
              text: 'Este docente ya se encuentra como director',
              type: 'error',
            }).then(function(){ 
              location.href='../../vista/rol_coordinador/revision_fichas_evaluador.php';
              }
           );
           ;</script>";
     } else {
          //asignar evaluador
          $id_lista_usuario = (isset($_POST['id_lista_usuario_ju'])) ? $_POST['id_lista_usuario_ju'] : '';
          $id_listaj_ficha= $_SESSION['id_fichas_jurado'];
          $id_rol_ficha = 4;
          $consulta_participante = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
         VALUES('$id_lista_usuario','$id_listaj_ficha', '$id_rol_ficha') ";
          $resultado_participante = $conexion->prepare($consulta_participante);
          $resultado_participante->execute();
          echo
          "<script> swal({
              allowOutsideClick: false,
              title: 'Exito!',
              text: 'Jurado asignado correctamente',
              type: 'success',
            }).then(function(){ 
              location.href='../../vista/rol_coordinador/revision_fichas_evaluador.php';
              }
           );
           ;</script>";
     }
}
echo'</body>';
