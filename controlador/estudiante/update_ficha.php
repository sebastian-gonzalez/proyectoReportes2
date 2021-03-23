

<?php



$id_s = $_SESSION['id_usuario'];

?>
<?php
if (isset($_POST['mod'])) {


    $consultaacamposficha = "SELECT fi.id_ficha,fi.titulo_ficha
    FROM lista_ficha lista, ficha fi 
    WHERE lista.id_lista_usuario=$id_s
    AND fi.id_ficha = lista.id_lista_ficha 
    AND fi.activo is null
 
    ";

    $resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

    while ($record = mysqli_fetch_assoc($resultset)) {

        $fichaaprobada = $record['id_ficha'];
    }

    $id_ficha = $fichaaprobada;



    $id_lista_ficha = $id_ficha;

    //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
    if ($validacion_id = true) {
        $id_insert = $id_ficha;
    } else {
        //Pueden haber errores, como clave duplicada
        echo
        "<script> Swal.fire({
            allowOutsideClick: false,                    
            title: '¡ERROR!',
            text: 'Documento de ficha de anteproyecto invalido o supera el limite maximo de peso',
            icon : 'error',
            }).then(function(){ 
            location.href='info_ficha.php';
            }
            );
            ;</script>";
    }
    if ($_FILES["archivo"]["error"] > 0) {
        echo
        "<script> Swal.fire({
            allowOutsideClick: false,                    
            title: '¡ERROR!',
            text: 'Documento de ficha de anteproyecto invalido o supera el limite maximo de peso',
            icon : 'error',
            }).then(function(){ 
            location.href='info_ficha.php';
            }
            );
            ;</script>";
    } else {
        $permitidos = array('application/pdf');
        $limite_kb = 200000000;
        if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024) {
            $ruta = "../../controlador/estudiante/pdf/$id_insert/";
            $archivo = $ruta . $_FILES["archivo"]["name"];

            if (!file_exists($ruta)) {
                mkdir($ruta);
            }
            if (!file_exists($archivo)) {
                $resultado = @move_uploaded_file(
                    $_FILES["archivo"]["tmp_name"],
                    $archivo
                );
            }

            if ($resultado) {
                echo
                "<script> Swal.fire({
                    allowOutsideClick: false,                    
                    title: '¡EXITO!',
                    text: 'Documento de ficha de anteproyecto subido correctamente',
                    icon : 'success',
                    }).then(function(){ 
                    location.href='info_ficha.php';
                    }
                    );
                    ;</script>";
            } else {
                echo
                "<script> Swal.fire({
                    allowOutsideClick: false,                    
                    title: '¡ERROR!',
                    text: 'Documento de ficha de anteproyecto invalido o supera el limite maximo de peso',
                    icon : 'error',
                    }).then(function(){ 
                    location.href='info_ficha.php';
                    }
                    );
                    ;</script>";
            }
        } else {
            echo
            "<script> Swal.fire({
                allowOutsideClick: false,                    
                title: '¡ERROR!',
                text: 'Documento de ficha de anteproyecto o supera el limite maximo de peso',
                icon : 'error',
                }).then(function(){ 
                location.href='info_ficha.php';
                }
                );
                ;</script>";
        }
    }
}


if (isset($_POST['modantepro'])) {
    $consultaacamposficha = "SELECT fi.id_ficha,fi.titulo_ficha
    FROM lista_ficha lista, ficha fi 
    WHERE lista.id_lista_usuario=$id_s
    AND fi.activo is null
    AND fi.id_ficha = lista.id_lista_ficha 
 
    ";
    $resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

    while ($record = mysqli_fetch_assoc($resultset)) {

        $fichaaprobada = $record['id_ficha'];
    }

    $id_ficha = $fichaaprobada;



    $id_lista_ficha = $id_ficha;

    //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
    if ($validacion_id = true) {
        $id_insert = $id_ficha;
    } else {
        echo
        "<script> Swal.fire({
            allowOutsideClick: false,                    
            title: '¡ERROR!',
            text: 'Documento de anteproyecto completo invalido o supera el limite maximo de peso',
            icon : 'error',
            }).then(function(){ 
            location.href='info_ficha.php';
            }
            );
            ;</script>";
    }
    if ($_FILES["archivo"]["error"] > 0) {
        echo
        "<script> Swal.fire({
            allowOutsideClick: false,                    
            title: '¡ERROR!',
            text: 'Documento de anteproyecto completo invalido o supera el limite maximo de peso',
            icon : 'error',
            }).then(function(){ 
            location.href='info_ficha.php';
            }
            );
            ;</script>";
           } else {
        $permitidos = array('application/pdf');
        $limite_kb = 200000000;
        if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024) {
            $ruta = "../../controlador/estudiante/anteproyecto/$id_insert/";
            $archivo = $ruta . $_FILES["archivo"]["name"];

            if (!file_exists($ruta)) {
                mkdir($ruta);
            }
            if (!file_exists($archivo)) {
                $resultado = @move_uploaded_file(
                    $_FILES["archivo"]["tmp_name"],
                    $archivo
                );
            }

            if ($resultado) {
                echo
                "<script> Swal.fire({
                    allowOutsideClick: false,                    
                    title: '¡EXITO!',
                    text: 'Documento de anteproyecto completo subido correctamente',
                    icon : 'success',
                    }).then(function(){ 
                    location.href='info_ficha.php';
                    }
                    );
                    ;</script>";
            } else {
                echo
                "<script> Swal.fire({
                    allowOutsideClick: false,                    
                    title: '¡ERROR!',
                    text: 'Documento de anteproyecto completo invalido o supera el limite maximo de peso',
                    icon : 'error',
                    }).then(function(){ 
                    location.href='info_ficha.php';
                    }
                    );
                    ;</script>";
            }
        } else {
            echo
            "<script> Swal.fire({
                allowOutsideClick: false,                    
                title: '¡ERROR!',
                text: 'Documento de anteproyecto completo invalido o supera el limite maximo de peso',
                icon : 'error',
                }).then(function(){ 
                location.href='info_ficha.php';
                }
                );
                ;</script>";
        }
    }
}




if (isset($_POST['modanpro'])) {
    $consultaacamposficha = "SELECT fi.id_ficha,fi.titulo_ficha
    FROM lista_ficha lista, ficha fi 
    WHERE lista.id_lista_usuario=$id_s
    AND fi.activo is null
    AND fi.id_ficha = lista.id_lista_ficha 
 
    ";
    $resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

    while ($record = mysqli_fetch_assoc($resultset)) {

        $fichaaprobada = $record['id_ficha'];
    }

    $id_ficha = $fichaaprobada;



    $id_lista_ficha = $id_ficha;

    //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
    if ($validacion_id = true) {
        $id_insert = $id_ficha;
    } else {
        //Pueden haber errores, como clave duplicada
        $id_insert = 0;
    }
    if ($_FILES["archivo"]["error"] > 0) {
        echo
        "<script> Swal.fire({
            allowOutsideClick: false,                    
            title: '¡ERROR!',
            text: 'No se pudo subir el documento intentelo nuevamente',
            icon : 'error',
            }).then(function(){ 
            location.href='info_ficha.php';
            }
            );
            ;</script>";
    } else {
        $permitidos = array('application/pdf');
        $limite_kb = 200000000;
        if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024) {
            $ruta = "../../controlador/estudiante/proyecto/$id_insert/";
            $archivo = $ruta . $_FILES["archivo"]["name"];

            if (!file_exists($ruta)) {
                mkdir($ruta);
            }
            if (!file_exists($archivo)) {
                $resultado = @move_uploaded_file(
                    $_FILES["archivo"]["tmp_name"],
                    $archivo
                );
            }
            if ($resultado) {
                echo
                "<script> Swal.fire({
                    allowOutsideClick: false,                    
                    title: '¡EXITO!',
                    text: 'Documento de proyecto de grado subido correctamente',
                    icon : 'success',
                    }).then(function(){ 
                    location.href='info_ficha.php';
                    }
                    );
                    ;</script>";
            } else {
                echo
                "<script> Swal.fire({
                    allowOutsideClick: false,                    
                    title: '¡ERROR!',
                    text: 'Documento de proyecto de grado invalido o supera el limite maximo de peso',
                    icon : 'error',
                    }).then(function(){ 
                    location.href='info_ficha.php';
                    }
                    );
                    ;</script>";
            }
        } else {
            echo
            "<script> Swal.fire({
                allowOutsideClick: false,                    
                title: '¡ERROR!',
                text: 'Documento de proyecto de grado invalido o supera el limite maximo de peso',
                icon : 'error',
                }).then(function(){ 
                location.href='info_ficha.php';
                }
                );
                ;</script>";
        }
    }
}
