<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 3) {
        header('location: ../login.php');
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />
    <title>Fichas</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../assets/mainTable.css">

    <!--Select2-->
    <link rel="stylesheet" type="text/css" href="../assets/select2/select2.min.css" />

    <?php
    include('nav.php');
    include('../include/conexion.php');
    include('../include/database.php');
    include("../include/coordinador/add_jurado.php");
    include("../include/coordinador/add_evaluador.php");

    ?>

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../assets/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/gif" />

</head>

<body>

    <header>

    </header>
    <br></br>
    <br></br>


    <div class="container ">
        <div class="row ">
            <div class="col-lg-12 ">
                <div class='btn-group'>


                </div>

            </div>
        </div>
    </div>
    <br>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaFichas" class=" table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id_ficha</th>
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Programa</th>
                                <th>Estado</th>
                                <th>Evaluacion</th>
                                <th>Creacion</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formFichas" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Evaluador</label>

                                    <select id="id_lista_usuario_ev" name="id_lista_usuario_ev" class="form-control" required>
                                        <?php

                                        $programa = $_SESSION['id_programa_usu'];
                                        $user = $_SESSION['id_usuario'];
                                        $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_programa_usu = $programa AND id_rol_usu =2 AND id_usuario != $user");
                                        echo '	<option disabled selected value="">Seleccione su Evaluador</option>';

                                        while ($valores = mysqli_fetch_array($sql)) {

                                            echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_usu"] . " " . $valores["apellido_usu"] . '</option>';
                                            '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Jurado</label>

                                    <select id="id_lista_usuario_ju" name="id_lista_usuario_ju" class="form-control" required>
                                        <?php

                                        $programa = $_SESSION['id_programa_usu'];
                                        $user = $_SESSION['id_usuario'];
                                        $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_programa_usu = $programa AND id_rol_usu =2 AND id_usuario != $user");
                                        echo '	<option disabled selected value="">Seleccione su Jurado</option>';

                                        while ($valores = mysqli_fetch_array($sql)) {

                                            echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_usu"] . " " . $valores["apellido_usu"] . '</option>';
                                            '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>



                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button input type="submit" name="add_evaluador" name="add_jurado" class="btn btn-dark">Guardar</button>
                    </div>
                    bueno lo intente ;v ya vengo si escribe el negrito sigue los pasos //
                    <div id="recarga">
                        <div class="row table_modal">
                            <div>
                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th scope="col">Nombre </th>
                                            <th scope="col"> Apellido </th>
                                            <th scope="col"> Rol </th>
                                        </tr>
                                    </thead>
                                    <br></br>

                                    <?php

                                    include("../include/coordinador/captador_Datos.php");
                                    echo $id_ficha_compa;


                                    $sql = mysqli_query($con, "SELECT * FROM usuarios INNER JOIN lista_ficha INNER JOIN rol_lista ON usuarios.id_usuario = lista_ficha.id_lista_usuario AND rol_lista.id_rol_lista = lista_ficha.id_rol_ficha AND lista_ficha.id_lista_ficha = $id_ficha_compa ORDER BY id_rol_ficha");
                                    if (mysqli_num_rows($sql) == 0) {
                                        echo 'no hay datos';
                                    } else {

                                        while ($valores = mysqli_fetch_assoc($sql)) {
                                            echo '
                                            <tbody>
                                    <tr>    
                                    <td>' . $valores['nombre_usu'] . '</td>
                                    <td>' . $valores['apellido_usu'] . '</td>
                                    <td>' . $valores['nombre_rol_ficha'] . '</td>
                                    </tr>';
                                        }
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

            </div>
        </div>
        </form>
    </div>
    </div>


    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../assets/jquery/jquery-3.5.1.js"></script>
    <script src="../assets/jquery/jquery-3.5.1.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>

    <script type="text/javascript" src="../include/coordinador/js/revision_fichas_coordinador.js"></script>

    <!-- Select2 -->

    <script src="../assets/select2/select2.min.js"></script>

</body>

</html>