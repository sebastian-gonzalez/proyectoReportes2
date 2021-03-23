



<?php

include("../../controlador/conexion.php");



include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();

$id_lista_usuario = $_SESSION['id_usuario'];


$consultaacamposficha = "SELECT fi.id_ficha
FROM lista_ficha lista, ficha fi 
WHERE lista.id_lista_usuario=$id_lista_usuario
AND lista.id_lista_ficha=fi.id_ficha";
$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

    $fichafinal = $record['id_ficha'];
}

$permitidos = array('application/pdf');
$limite_kb = 200000000;



?>
<?php
if (isset($_POST['add'])) {


    $id_ficha = (isset($_POST['id_ficha'])) ? $_POST['id_ficha'] : '';
    $Titulo = (isset($_POST['titulo_ficha'])) ? $_POST['titulo_ficha'] : '';
    $Descripcion = 'Anteproyecto de grado';
    $Programa = $_SESSION['id_programa_usu'];
    $Estado = 1;
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
        if ($_FILES["archivo"]["error"] > 0) {
            echo
            "<script> swal({
           allowOutsideClick: false,           
            title: '¡ERROR!',
            text: 'error al cargar la ficha de anteproyecto intentelo nuevamente',
            type: 'error',
            }).then(function(){ 
            location.href='primer_ingreso.php';
            }
            );
            ;</script>";
        }
        if ($_FILES["anteproyecto"]["error"] > 0) {
            echo
            "<script> swal({
           allowOutsideClick: false,           
            title: '¡ERROR!',
            text: 'error al cargar el anteproyecto completo{ intentelo nuevamente',
            type: 'error',
            }).then(function(){ 
            location.href='primer_ingreso.php';
            }
            );
            ;</script>";
        }

        if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024) {

            if (in_array($_FILES["anteproyecto"]["type"], $permitidos) && $_FILES["anteproyecto"]["size"] <= $limite_kb * 1024) {

                $consulta = "INSERT INTO ficha (titulo_ficha,descripcion_ficha,id_programa_ficha,id_estado_ficha)
                VALUES('$Titulo','$Descripcion', '$Programa','$Estado') ";
                $id_lista_ficha = $id_ficha;

                $resultado = $conexion->prepare($consulta);
                $validacion_id = $resultado->execute();

                //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
                if ($validacion_id = true) {
                    $id_insert  = $conexion->lastInsertId();

                    $rutaficha = "../../controlador/estudiante/pdf/$id_insert/";
                    $archivo = $rutaficha . $_FILES["archivo"]["name"];
                    if (!file_exists($rutaficha)) {
                        mkdir($rutaficha, 0777, true);
                    }

                    if (!file_exists($archivo)) {
                        $resultado = @move_uploaded_file(
                            $_FILES["archivo"]["tmp_name"],
                            $archivo
                        );
                        if ($resultado) {
                        } else {
                            echo
                            "<script> swal({
                        title: '¡ERROR!',
                        text: 'Archivo ficha no guardado',
                        type: 'error',
                        });</script>";
                        }

                        $rutaante = "../../controlador/estudiante/anteproyecto/$id_insert/";
                        $anteproyecto = $rutaante . $_FILES["anteproyecto"]["name"];
                        if (!file_exists($rutaante)) {
                            mkdir($rutaante, 0777, true);
                        }

                        if (!file_exists($anteproyecto)) {
                            $resultadoante = @move_uploaded_file(
                                $_FILES["anteproyecto"]["tmp_name"],
                                $anteproyecto
                            );
                            if ($resultadoante) {
                            } else {
                                echo
                                "<script> swal({
                       title: '¡ERROR!',
                       text: 'Archivo  de anteproyecto no guardado',
                       type: 'error',
                       });</script>";
                            }
                        }
                    } else {            //Pueden haber errores, como clave duplicada
                        $id_insert = 0;
                        echo
                        "<script> swal({
                     allowOutsideClick: false,           
                      title: '¡ERROR!',
                      text: 'error al crear la ficha porfavor inhabilite esta ficha y creala nuevamente',
                      type: 'error',
                      }).then(function(){ 
                      location.href='fichas.php';
                      }
                      );
                      ;</script>";
                    }

                    //segunda consulta 
                    $consulta1 = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
                    VALUES('$id_lista_usuario','$id_insert ', '$id_rol_ficha') ";

                    $resultado1 = $conexion->prepare($consulta1);
                    $resultado1->execute();

                    $consulta = "SELECT * FROM ficha ORDER BY id_ficha DESC LIMIT 1 ";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                    echo
                    "<script> 

                        location.href='segundo_ingreso.php';

                     ;</script>";
                }
            } else {
                echo
                "<script> swal({
                    allowOutsideClick: false,                    
                    title: '¡ERROR!',
                    text: 'El anteproyecto completo  no esta permitido o excede el tamaÑo',
                    type: 'error',
                    }).then(function(){ 
                    location.href='primer_ingreso.php';
                    }
                    );
                    ;</script>";
            }
        } else {
            
            echo
            "<script> swal({
            allowOutsideClick: false,           
            title: '¡ERROR!',
            text: 'La ficha de anteproyecto no esta permitida o excede el tamaÑo',
            type: 'error',
            }).then(function(){ 
            location.href='primer_ingreso.php';
            }
         );
         ;</script>";
        }
    }
}



if (isset($_POST['proyectofin'])) {

    $Descripcion_proyecto = "Proyecto de grado";



    if ($_FILES["proyecto"]["error"] > 0) {

        echo
        "<script>  alert('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
    </script>";  

        echo


        
        "<script> swal({
       allowOutsideClick: false,           
        title: '¡ERROR!',
        text: 'error al cargar el proyecto de grado intentelo nuevamente',
        type: 'error',
        }).then(function(){ 
        location.href='proyectofinal.php';
        }
        );
        ;</script>";
    }
    if (in_array($_FILES["proyecto"]["type"], $permitidos) && $_FILES["proyecto"]["size"] <= $limite_kb * 1024) {

        $ruta = "../../controlador/estudiante/proyecto/$fichafinal/";
        $proyecto = $ruta . $_FILES["proyecto"]["name"];
        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

        if (!file_exists($proyecto)) {
            $resultado = @move_uploaded_file(
                $_FILES["proyecto"]["tmp_name"],
                $proyecto
            );
            if ($resultado) {

                $Estado = 6;
                $consulta = "UPDATE ficha  SET  id_estado_ficha='$Estado' , descripcion_ficha ='$Descripcion_proyecto' , evaluacion_ficha = null WHERE id_ficha='$fichafinal' AND ficha.activo is null";
                $resultado = $conexion->prepare($consulta);
                $validacion_id = $resultado->execute();

                echo
                "<script> swal({
                allowOutsideClick: false,                    
                title: '¡EXITO!',
                text: 'Proyecto de grado subido correctamente',
                type: 'success',
                }).then(function(){ 
                location.href='fichas.php';
                }
                );
                ;</script>";
            } else {
                echo
                "<script> swal({
                allowOutsideClick: false,                    
                title: '¡ERROR!',
                text: 'no se pudo subir el archivo intentalo nuevamente',
                type: 'error',
                }).then(function(){ 
                location.href='fichas.php';
                }
                );
                ;</script>";

            }
        }
    } else {

        echo
        "<script> swal({
            allowOutsideClick: false,                    
            title: '¡ERROR!',
            text: 'El documento de Proyecto de grado no esta permitido o excede el tamaÑo',
            type: 'error',
            }).then(function(){ 
            location.href='proyectofinal.php';
            }
            );
            ;</script>";
    }

}
