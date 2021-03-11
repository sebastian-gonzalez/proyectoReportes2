<!--SweetAlert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>


<?php
session_start();
if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 4) {
        header('location: ../login.php');
    }
}

$id_usuario = $_SESSION['id_usuario'];

?>

<?php
include('../database.php');
include('../conexion.php');

$objeto = new Database();
$conexion = $objeto->connect();
$descripcion_pregprog = "Pregunta problematizadora";
$descripcion_pregsis = "Pregunta sistematizadora";
$descripcion_objgen = "Objetivo general";
$descripcion_objespe = "Objetivo especifico";

?>
<?php

$consultaidficha = "SELECT lista.id_lista,lista.id_lista_usuario, lista.id_lista_ficha FROM lista_ficha lista, ficha fi WHERE lista.id_lista_usuario=$id_usuario AND fi.id_ficha = lista.id_lista_ficha ";
$resultset = mysqli_query($con, $consultaidficha) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {
    $idficha = $record['id_lista_ficha'];
}
echo  ".";






if (isset($_POST['add'])) {








    $pregunta_problematizadora = (isset($_POST['pregpro'])) ? $_POST['pregpro'] : '';


    $consulta_pregunta = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
          VALUES('$descripcion_pregprog','$pregunta_problematizadora', '$idficha') ";
    $resultado_pregunta = $conexion->prepare($consulta_pregunta);
    $resultado_pregunta->execute();

    if (isset($_POST['addspreg'])) {

        foreach ($_POST['addspreg'] as $key => $value) {
            $id_lista_preg = $_POST['addspreg'][$key];



            $consulta_pregsiste = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
         VALUES('$descripcion_pregsis','$id_lista_preg', '$idficha') ";
            $resultado_pregsiste = $conexion->prepare($consulta_pregsiste);
            $resultado_pregsiste->execute();
        }
    }



    $objetivo_gen = (isset($_POST['objgen'])) ? $_POST['objgen'] : '';


    $consulta_objgen = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
                    VALUES('$descripcion_objgen','$objetivo_gen', '$idficha') ";
    $resultado_objgen = $conexion->prepare($consulta_objgen);
    $resultado_objgen->execute();
    if (isset($_POST['addsobj'])) {
        foreach ($_POST['addsobj'] as $key => $value) {
            $id_lista_obj = $_POST['addsobj'][$key];



            $consulta_objespe = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
                   VALUES('$descripcion_objespe','$id_lista_obj', '$idficha') ";
            $resultado_objespe = $conexion->prepare($consulta_objespe);
            $resultado_objespe->execute();
        }
    }
    echo
    "<script> swal({
        title: '¡Exito!',
        text: 'Campos agregados',
        type: 'success',
      }).then(function(){ 
        location.href='../../vista/rol_estudiante/fichas.php';
        }
     );
     ;</script>";
}
