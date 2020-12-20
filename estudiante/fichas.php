<?php

session_start();




if (!isset($_SESSION['rol'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['rol'] != 4) {
        header('location: ../login.php');
    }
}


?>



<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos de Fichas</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap1.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
        .content {
            margin-top: 80px;
        }
    </style>

</head>

<body>

    <?php include('nav.php'); ?>

    <div class="container">
        <div class="content">

            <h2>Lista de Fichas </h2>

            <hr />

            <?php
            if (isset($_GET['aksi']) == 'delete') {
                // escaping, additionally removing everything that could be (html/javascript-) code

                $nik = $_SESSION['id_usuario'];
                $cek = mysqli_query($con, "SELECT * FROM fichas  WHERE usuario_id='$nik'");
                if (mysqli_num_rows($cek) == 0) {
                    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
                } else {

                    $delete = mysqli_query($con, "DELETE FROM fichas  WHERE usuario_id='$nik'");
                    if ($delete) {
                        echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
                    }
                }
            }
            ?>


            <br />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>

                        <th>Titulo</th>
                        <th>Programa</th>
                        <th>Jurado</th>
                        <th>Evaluador</th>
                        <th>Director</th>
                        <th>Compañero</th>
                        <th>Estado</th>
                        <th>Herramientas</th>
                        <th>Documento</th>


                    </tr>
                    <?php
                    $nik = $_SESSION['id_usuario'];
                    $sql = mysqli_query($con, "SELECT * FROM fichas INNER JOIN usuarios WHERE compa_id = id_usuario and  usuario_id =$nik or compa_id =$nik ORDER By id_fi ASC");

                    while ($record = mysqli_fetch_assoc($sql)) {

                        $compa = $record['nombre'] . ' ' . $record['apellido'];
                    }

                    $sql = mysqli_query($con, "SELECT * FROM fichas INNER JOIN usuarios WHERE jurado = id_usuario and  usuario_id =$nik or compa_id =$nik ORDER By id_fi ASC");

                    while ($record2 = mysqli_fetch_assoc($sql)) {

                        $jurado = $record2['nombre'] . ' ' . $record2['apellido'];
                        break;
                    }

                    $sql = mysqli_query($con, "SELECT * FROM fichas INNER JOIN usuarios WHERE evaluador = id_usuario and  usuario_id =$nik or compa_id =$nik ORDER By id_fi ASC");

                    while ($record3 = mysqli_fetch_assoc($sql)) {

                        $evaluador = $record3['nombre'] . ' ' . $record3['apellido'];
                        break;
                    }
                    $sql = mysqli_query($con, "SELECT * FROM fichas INNER JOIN usuarios WHERE director_id = id_usuario and  usuario_id =$nik or compa_id =$nik ORDER By id_fi ASC");

                    while ($record4 = mysqli_fetch_assoc($sql)) {

                        $director = $record4['nombre'] . ' ' . $record4['apellido'];
                        break;
                    }

                    $sql = mysqli_query($con, "SELECT * FROM fichas INNER JOIN programas WHERE programa_id = id_p and  usuario_id =$nik or compa_id =$nik ORDER By id_fi ASC");

                    while ($record5 = mysqli_fetch_assoc($sql)) {

                        $programa = $record5['nombre_prog'];
                        break;
                    }
                    $sql = mysqli_query($con, "SELECT * FROM fichas INNER JOIN estado_ficha WHERE estado_id = id_e and  usuario_id =$nik or compa_id =$nik ORDER By id_fi ASC");

                    while ($record6 = mysqli_fetch_assoc($sql)) {

                        $estado = $record6['estado'];
                        break;
                    }

                    $nik = $_SESSION['id_usuario'];

                    //LLamado de la tabla HPTA FICHA
                    $sql_consulta = mysqli_query($con, "SELECT * FROM fichas INNER JOIN usuarios WHERE usuario_id=id_usuario  and  usuario_id =$nik or compa_id =$nik   ORDER By id_fi ASC");


                    if (mysqli_num_rows($sql_consulta) == 0) {
                    } else {

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($sql_consulta)) {

                            echo '
						<tr>
						
							
                            <td>' . $row['titulo'] . '</td>
                            <td>' . $programa . '</td>
                            <td>' . $jurado . '</td>
                            <td>' . $evaluador . '</td>
                            <td>' . $director . '</td>
                            <td>' . $compa . '</td>
                            <td>' . $estado . '</td>
							<td>

							<a href="editar_ficha.php?nik=' . $row['id_fi'] . '" title="Editar datos" class="	"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
							<a href="fichas.php?aksi=delete&nik=' . $row['id_fi'] . '" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos ' . $row['titulo'] . '?\')" class=" "><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                            </td>
                            <td>
                            <a href="documento.php" class=" "><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Documento</span></a> 
                            </td>
						</tr>
						';
                            $no++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <center>
        <p>&copy; Sistemas Web <?php echo date("Y"); ?></p </center> <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script src="../js/bootstrap.min.js"></script>
</body>

</html>