<?php
session_start();
if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 4) {
        header('location: ../../login.php');
    }
}


?>

<?php
include('../database.php');
include('../conexion.php');

$objeto = new Database();
$conexion = $objeto->connect();
$descripcionficha = "Pregunta sistematizadora";
$descripcionfichaobj = "Objetivo especifico";
$descripcionfichapregpro = "Pregunta problematizadora";
$descripcionfichaobjgen = "Objetivo general";
?>
<?php






if (isset($_POST['editcampo'])) {



    $valor_ficha = mysqli_real_escape_string($con, (strip_tags($_POST['valor_campo'], ENT_QUOTES))); //+

    if (isset($_GET['aksis']) == 'edit') {


        // escaping, additionally removing everything that could be (html/javascript-) code

        $nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));

        $query = "UPDATE campos_fichas SET valor_campo= '" . $valor_ficha . "'  WHERE id_campo=" . $nik;
        $update = mysqli_query($con, $query);


        if ($update) {
            header("Location: ../../vista/rol_estudiante/info_ficha.php");
        } else {
            echo
            "<script> swal({
               title: '¡ERROR!',
               text: 'No se pudieron editar los datos',
               type: 'error',
             });</script>";
        }
    }
}


if (isset($_POST['edit_titu'])) {



    $titulo_ficha = mysqli_real_escape_string($con, (strip_tags($_POST['titu_ficha'], ENT_QUOTES))); //+

    if (isset($_GET['aktr']) == 'edit') {


        // escaping, additionally removing everything that could be (html/javascript-) code

        $nik = mysqli_real_escape_string($con, (strip_tags($_GET["nikfi"], ENT_QUOTES)));


        $query = "UPDATE ficha SET titulo_ficha='" . $titulo_ficha . "' WHERE id_ficha=" . $nik;
        $update1 = mysqli_query($con, $query);


        if ($update1) {
            header("Location: ../../vista/rol_estudiante/info_ficha.php");
        } else {
            echo
            "<script> swal({
               title: '¡ERROR!',
               text: 'No se pudo crear el dato',
               type: 'error',
             });</script>";
        }
    }
}

if (isset($_POST['crearpregpro'])) {



    $valor_ficha = mysqli_real_escape_string($con, (strip_tags($_POST['valor_campo'], ENT_QUOTES))); //+

    if (isset($_GET['ak']) == 'crear') {


        // escaping, additionally removing everything that could be (html/javascript-) code

        $nikfi = mysqli_real_escape_string($con, (strip_tags($_GET["nikfi"], ENT_QUOTES)));



        $query = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
        VALUES('" . $descripcionfichapregpro . "','" . $valor_ficha . "', '" . $nikfi . "') ";
        $crear = mysqli_query($con, $query);




        if ($crear) {
            header("Location: ../../vista/rol_estudiante/info_ficha.php");
        } else {
            echo
            "<script> swal({
               title: '¡ERROR!',
               text: 'No se pudo crear el dato',
               type: 'error',
             });</script>";
        }
    }
}

if (isset($_POST['crearpreg'])) {



    $valor_ficha = mysqli_real_escape_string($con, (strip_tags($_POST['valor_campo'], ENT_QUOTES))); //+

    if (isset($_GET['ak']) == 'crear') {


        // escaping, additionally removing everything that could be (html/javascript-) code

        $nikfi = mysqli_real_escape_string($con, (strip_tags($_GET["nikfi"], ENT_QUOTES)));

        $query = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
        VALUES('" . $descripcionficha . "','" . $valor_ficha . "', '" . $nikfi . "') ";
        $crear = mysqli_query($con, $query);




        if ($crear) {
            header("Location: ../../vista/rol_estudiante/info_ficha.php");
        } else {
            echo
            "<script> swal({
               title: '¡ERROR!',
               text: 'No se pudo crear el dato',
               type: 'error',
             });</script>";
        }
    }
}

if (isset($_POST['crearobjgen'])) {



    $valor_ficha = mysqli_real_escape_string($con, (strip_tags($_POST['valor_campo'], ENT_QUOTES))); //+

    if (isset($_GET['ak']) == 'crear') {


        // escaping, additionally removing everything that could be (html/javascript-) code

        $nikfi = mysqli_real_escape_string($con, (strip_tags($_GET["nikfi"], ENT_QUOTES)));

        $query = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
        VALUES('" . $descripcionfichaobjgen . "','" . $valor_ficha . "', '" . $nikfi . "') ";
        $crear = mysqli_query($con, $query);




        if ($crear) {
            header("Location: ../../vista/rol_estudiante/info_ficha.php");
        } else {
            echo
            "<script> swal({
               title: '¡ERROR!',
               text: 'No se pudo crear el dato',
               type: 'error',
             });</script>";
        }
    }
}

if (isset($_POST['crearobj'])) {



    $valor_ficha = mysqli_real_escape_string($con, (strip_tags($_POST['valor_campo'], ENT_QUOTES))); //+

    if (isset($_GET['akitoy']) == 'crear_ob_es') {


        // escaping, additionally removing everything that could be (html/javascript-) code

        $nikfis = mysqli_real_escape_string($con, (strip_tags($_GET["nikfis"], ENT_QUOTES)));

        $query1 = "INSERT INTO campos_fichas (descripcion_campo,valor_campo,fk_id_ficha)
        VALUES('" . $descripcionfichaobj . "','" . $valor_ficha . "','" . $nikfis . "')";
        $crear1 = mysqli_query($con, $query1);




        if ($crear1) {
            header("Location: ../../vista/rol_estudiante/info_ficha.php");
        } else {
            echo
            "<script> swal({
               title: '¡ERROR!',
               text: 'No se pudo crear el dato',
               type: 'error',
             });</script>";
        }
    }
}





if (isset($_GET['aksi']) == 'delete') {


    // escaping, additionally removing everything that could be (html/javascript-) code

    $nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));

    $consulta = "UPDATE campos_fichas SET activo='n' WHERE id_campo='$nik'";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();


    if ($consulta) {
        header("Location: ../../vista/rol_estudiante/info_ficha.php");
    } else {
        echo
        "<script> swal({
           title: '¡ERROR!',
           text: 'No se pudo inabilitar el dato',
           type: 'error',
         });</script>";
    }
}
?>

