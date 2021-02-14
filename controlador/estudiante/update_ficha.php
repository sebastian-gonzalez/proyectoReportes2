
<?php

$objeto = new Database();
$conexion = $objeto->connect();

?>
<?php
if (isset($_POST['mod'])) {


    $id_ficha = $_SESSION['id_de_ficha'];


    $Titulo = (isset($_POST['titulo_ficha'])) ? $_POST['titulo_ficha'] : '';
    $Descripcion = 'Proyecto de Grado';

    $Programa = $_SESSION['id_programa_usu'];

    $Estado = 1;

    //TABLA LISTA_FICHA//

    $id_lista_usuario = $_SESSION['id_usuario'];

    $id_lista_ficha = $id_ficha;
    $id_rol_ficha = 1;

    

        $consulta = "UPDATE ficha  SET titulo_ficha='$Titulo', id_estado_ficha='$Estado' WHERE id_ficha='$id_ficha'";

        $id_lista_ficha = $id_ficha;

        $resultado = $conexion->prepare($consulta);
        $validacion_id = $resultado->execute();

        //if evta problemas con la el PK autoincrement y obliga  que la primera consulta sea verdadera para proceder
        if ($validacion_id = true) {
            $id_insert = $id_ficha ;
        } else {
            //Pueden haber errores, como clave duplicada
            $id_insert = 0;
            echo '<script language="javascript">alert("El director ya ha sido asignado a esta ficha");
          </script>';
        }
        if ($_FILES["archivo"]["error"] > 0) {
            echo "Error al cargar archvio";
        } else {
            $permitidos = array('application/pdf');
            $limite_kb = 200000000;
            if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024) {
                $ruta = "../controlador/estudiante/pdf/$id_insert/";
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
                    echo "archivo guardado";
                } else {
                    echo " archivo no guardado";
                }
            } else {
                echo "el archivo no esta permitido o excede el tamaño maximo";
            }
        }
        header('Location:fichas.php');
    
}
