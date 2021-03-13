

<?php



$db = new Database();
$id_s = $_SESSION['id_usuario'];


$query_ficha = $db->connect()->prepare("SELECT id_lista ,id_lista_usuario ,id_lista_ficha, id_rol_ficha FROM lista_ficha lista,ficha fi WHERE id_lista_usuario =$id_s AND fi.id_ficha=lista.id_lista_ficha AND fi.activo is null");
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
if (isset($_POST['add_director'])) {


     $id_lista_usuario_director = (isset($_POST['id_lista_usuario_director'])) ? $_POST['id_lista_usuario_director'] : '';

     // Validacion para saber si el director por agregar ya existe en la ficha
     $consulta_validacion = "SELECT COUNT(*) FROM lista_ficha WHERE id_lista_usuario=$id_lista_usuario_director and id_lista_ficha =$id_lis_fi";
     $resultado_vali = $conexion->prepare($consulta_validacion);
     $data_vali = $resultado_vali->execute();

    // Validacion para saber si la ficha ya cuneta con un director
     $consulta_validacion_2 = "SELECT COUNT(*) FROM lista_ficha WHERE id_lista_ficha = $id_lis_fi and id_rol_ficha =2 ";
     $resultado_vali_2 = $conexion->prepare($consulta_validacion_2);
     $data_vali_2 = $resultado_vali_2->execute();

     if ($resultado_vali->fetchColumn() > 0) {
          
          echo 
          "<script> swal({
               title: '¡ERROR!',
               text: 'El director ya ha sido asignado a esta ficha',
               type: 'error',
             }).then(function(){ 
               location.href='fichas.php';
               }
            );
            ;</script>";


     } else if ($resultado_vali_2->fetchColumn() > 0) {
     
          "<script> swal({
               title: '¡ERROR!',
               text: 'El director ya ha sido asignado a esta ficha',
               type: 'error',
             }).then(function(){ 
               location.href='fichas.php';
               }
            );
            ;</script>";
        


          
     }else {

          //asignar director

          $id_lista_usuario2 = (isset($_POST['id_lista_usuario_director'])) ? $_POST['id_lista_usuario_director'] : '';
          $id_lista_ficha = $_SESSION['id_lista_ficha'];
          $id_rol_ficha = 2;


          $consulta_participante = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
         VALUES('$id_lista_usuario2','$id_lista_ficha', '$id_rol_ficha') ";

          $resultado_participante = $conexion->prepare($consulta_participante);
          $resultado_participante->execute();
          echo 
         
               "<script> swal({
                    title: '¡Exito!',
                    text: 'Director Asignado',
                    type: 'success',
                  }).then(function(){ 
                    location.href='fichas.php';
                    }
                 );
                 ;</script>";
     }
}
