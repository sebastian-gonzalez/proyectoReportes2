

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

include("../../controlador/conexion.php");



include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();

$id_lista_usuario = $_SESSION['id_usuario'];


$consultaacamposficha ="SELECT fi.id_ficha
FROM lista_ficha lista, ficha fi 
WHERE lista.id_lista_usuario=$id_lista_usuario
AND lista.id_lista_ficha=fi.id_ficha";
$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

    $fichafinal = $record['id_ficha'];
}





?>
<?php
if (isset($_POST['add'])) {


    $id_ficha = (isset($_POST['id_ficha'])) ? $_POST['id_ficha'] : '';


    $Titulo = (isset($_POST['titulo_ficha'])) ? $_POST['titulo_ficha'] : '';
    $Descripcion = 'Anteproyecto de grado';

    $Programa = $_SESSION['id_programa_usu'];

    $Estado = 1;

    //TABLA LISTA_FICHA//

    $id_lista_usuario = $_SESSION['id_usuario'];

    $id_lista_ficha = $id_ficha;
    $id_rol_ficha = 1;

    $consulta_validacion = "SELECT COUNT(*) FROM lista_ficha , ficha WHERE ficha.id_ficha = lista_ficha.id_lista_ficha and id_lista_usuario=$id_lista_usuario and ficha.activo is null ";
    $resultado_vali = $conexion->prepare($consulta_validacion);
    $data_vali = $resultado_vali->execute();

    if ($resultado_vali->fetchColumn() > 0) {


        echo
        "<script> swal({
        title: '¡ERROR!',
        text: 'El Usuario ya posee una ficha',
        type: 'error',
      }).then(function(){ 
        location.href='fichas.php';
        }
     );
     ;</script>";
    } else {

        $consulta = "INSERT INTO ficha (titulo_ficha,descripcion_ficha,id_programa_ficha,id_estado_ficha)
    VALUES('$Titulo','$Descripcion', '$Programa','$Estado') ";

        $id_lista_ficha = $id_ficha;

        $resultado = $conexion->prepare($consulta);
        $validacion_id = $resultado->execute();

        //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
        if ($validacion_id = true) {
            $id_insert  = $conexion->lastInsertId();
        } else {
            //Pueden haber errores, como clave duplicada
            $id_insert = 0;

            echo
            "<script> swal({
        title: '¡ERROR!',
        text: 'No se ejecuto la primera consulta',
        type: 'error',
      });</script>";
        }

        if ($_FILES["archivo"]["error"] > 0) {
            echo
            "<script> swal({
        title: '¡ERROR!',
        text: 'Error al cargar la ficha',
        type: 'error',
      });</script>";
        } else {
            $permitidos = array('application/pdf');
            $limite_kb = 200000000;
            if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024) {
                $ruta = "../../controlador/estudiante/pdf/$id_insert/";
                $archivo = $ruta . $_FILES["archivo"]["name"];
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (!file_exists($archivo)) {
                    $resultado = @move_uploaded_file(
                        $_FILES["archivo"]["tmp_name"],
                        $archivo
                    );
                }
                if ($resultado) {
                    echo
                    "<script> swal({
        title: '¡ERROR!',
        text: 'Archivo guardado',
        type: 'success',
      });</script>";
                } else {
                    echo
                    "<script> swal({
        title: '¡ERROR!',
        text: 'Archivo no guardado',
        type: 'error',
      });</script>";
                }
            } else {
                echo "el archivo no esta permitido o excede el tamaño maximo";
            }
        }

        if ($_FILES["anteproyecto"]["error"] > 0) {
            echo "Error al cargar archvio de anteproyecto";
        } else {
            $permitidos = array('application/pdf');
            $limite_kb = 200000000;
            if (in_array($_FILES["anteproyecto"]["type"], $permitidos) && $_FILES["anteproyecto"]["size"] <= $limite_kb * 1024) {
                $ruta = "../../controlador/estudiante/anteproyecto/$id_insert/";
                $archivo = $ruta . $_FILES["anteproyecto"]["name"];
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (!file_exists($archivo)) {
                    $resultado = @move_uploaded_file(
                        $_FILES["anteproyecto"]["tmp_name"],
                        $archivo
                    );
                }
                if ($resultado) {
                    echo "anteproyecto guardado";
                } else {
                    echo " anteproyecto no guardado";
                }
            } else {
                echo
                "<script> swal({
        title: '¡ERROR!',
        text: 'El ante proyecto no esta permitido o excede el tamano',
        type: 'error',
      }).then(function(){ 
        location.href='fichas.php';
        }
     );
     ;</script>";
            }
        }

        //segunda consulta 
        $consulta1 = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
         VALUES('$id_lista_usuario','$id_insert ', '$id_rol_ficha') ";

        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();

        $consulta = "SELECT * FROM ficha ORDER BY id_ficha DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


        header('Location:segundo_ingreso.php');
    }
}

if (isset($_POST['proyecto'])) {




    $Estado = 6;

    //TABLA LISTA_FICHA//









    $consulta = "UPDATE ficha  SET  id_estado_ficha='$Estado' WHERE id_ficha='$fichafinal'";
    $resultado = $conexion->prepare($consulta);
    $validacion_id = $resultado->execute();




    //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
    if ($validacion_id = true) {
        $id_insert  = $conexion->lastInsertId();
    } else {
        //Pueden haber errores, como clave duplicada
        $id_insert = 0;

        echo
        "<script> swal({
        title: '¡ERROR!',
        text: 'No se Realizo la primera consulta',
        type: 'error',
      });</script>";
    }

    if ($_FILES["proyecto"]["error"] > 0) {
        echo
        "<script> swal({
        title: '¡ERROR!',
        text: 'Error al cargar la ficha',
        type: 'error',
      });</script>";
    } else {
        $permitidos = array('application/pdf');
        $limite_kb = 200000000;
        if (in_array($_FILES["proyecto"]["type"], $permitidos) && $_FILES["proyecto"]["size"] <= $limite_kb * 1024) {
            $ruta = "../../controlador/estudiante/proyecto/$fichafinal/";
            $archivo = $ruta . $_FILES["proyecto"]["name"];
            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }
            if (!file_exists($archivo)) {
                $resultado = @move_uploaded_file(
                    $_FILES["proyecto"]["tmp_name"],
                    $archivo
                );
            }
            if ($resultado) {
                echo
                "<script> swal({
        title: '¡ERROR!',
        text: 'Archivo guardado',
        type: 'success',
      });</script>";
            } else {
                echo
                "<script> swal({
        title: '¡ERROR!',
        text: 'Archivo no guardado',
        type: 'error',
      });</script>";
            }
        } else {
            echo "el archivo no esta permitido o excede el tamaño maximo";
        }
    }
}
