<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 1) {
        header('location: ../login.php');
    }
}


?>


<?php
include("../include/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos de empleados</title>

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
            <h2>Lista de Programas Academicos <a class="item" href="add_programa.php">( + )</a> </h2>
            <hr />

            <?php
            if (isset($_GET['aksi']) == 'delete') {
                // escaping, additionally removing everything that could be (html/javascript-) code

                $nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
                $cek = mysqli_query($con, "SELECT * FROM programa  WHERE id_programa='$nik'");
                if (mysqli_num_rows($cek) == 0) {
                    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
                } else {

                    $delete = mysqli_query($con, "DELETE FROM programa  WHERE id_programa='$nik'");
                    if ($delete) {
                        echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
                    }
                }
            }
            ?>

            <form class="form-inline" method="get">
                <div class="form-group">


                    <select name="filter" class="form-control" onchange="form.submit()">
                        <option value="0">Seleccione Facultad:</option>
                        <?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);
                        $sql = mysqli_query($con, "SELECT * FROM facultad");
                        while ($valores = mysqli_fetch_array($sql)) {
                            echo '<option value="' . $valores["id_facultad"] . '">' . $valores["nombre_facultad"] . '</option>';
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">&nbsp;</label>
                            <div class="col-sm-6">
                                <input type="submit" href="/programas.php" class="btn btn-sm btn-primary" value="Limpiar filtros">

                            </div>
                    </select>

                </div>
            </form>
            <br />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>


                        <th>Nombre del Programa</th>
                        <th>Titulo</th>
                        <th>Facultad</th>




                    </tr>
                    <?php
                    if ($filter) {
                        $sql = mysqli_query($con, "SELECT * FROM programa INNER JOIN facultad WHERE id_facultad=id_facultad_pro and id_facultad='$filter' ORDER BY id_programa ASC");
                    } else {
                        $sql = mysqli_query($con, "SELECT * FROM programa INNER JOIN facultad WHERE id_facultad=id_facultad_pro ORDER By id_programa ASC");
                    }
                    if (mysqli_num_rows($sql) == 0) {
                        echo '<tr><td colspan="8">No hay datos.</td></tr>';
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($sql)) {

                            echo '
						<tr>
					
							
							<td>' . $row['nombre_pro'] . '</td>
                            <td>' . $row['titulo_pro'] . '</td>      
                            <td>' . $row['nombre_facultad'] . '</td>
							
							
							<td>

								<a href="editar_programa.php?nik=' . $row['id_programa'] . '" title="Editar datos" class="	"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="programas.php?aksi=delete&nik=' . $row['id_programa'] . '" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos ' . $row['nombre_pro'] . '?\')" class=" "><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
        <p>&copy; Sistemas Web <?php echo date("Y"); ?></p </center>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script src="../js/bootstrap.min.js"></script>
</body>

</html>