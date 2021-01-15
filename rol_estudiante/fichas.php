<?php
include('../include/estudiante/add_ficha.php')




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


    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../assets/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/gif" />

</head>

<body>
    <?php include('nav.html');


    ?>


    <header>

    </header>
    <br></br>
    <br></br>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">




                <button id="btnNuevo1" type="button" class="btn btn-primary" data-toggle="modal"><i class="material-icons">library_add</i></button>


                <?php 

$consulta_validacion = "SELECT COUNT(*) FROM ficha";
$resultado_vali = $conexion->prepare($consulta_validacion);
$data_vali = $resultado_vali->execute();


if ($resultado_vali->fetchColumn() > 0) {

    echo ' <button id="btnParticipantes" type="button" class="btn btn-primary" data-toggle="modal"><i class="material-icons" >person_add</i></button>';
    

}else{
    echo ' ';

}

?>
          


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

    <!--Modal para CRUD-->
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
                                    <label for="" class="col-form-label">Titulo</label>
                                    <input type="text" class="form-control" id="titulo_ficha" required>
                                </div>
                            </div>

                        </div>


                        <div class="form-group" enctype="multipart/form-data">
                            <label for="" class="col-form-label">Documento</label>
                            <div class="col-lg-6">
                                <input type="file" id="archivo" required>

                            </div>
                        </div>





                    </div>
                    <div class="modal-footer">


                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modalCRUD1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Titulo</label>
                                    <input type="text" class="form-control" name="titulo_ficha" required>
                                </div>
                            </div>

                        </div>


                        <div class="form-group" enctype="multipart/form-data">
                            <label for="" class="col-form-label">Documento</label>
                            <div class="col-lg-6">
                                <input type="file" name="archivo" required>

                            </div>
                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                        <button input type="submit" name="add" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>



    <div class="modal fade" id="modalParticipantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?php
        include("../include/conexion.php");

        include("../include/estudiante/add_compañero.php");

        ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Compañero </label>

                                    <select name="id_lista_usuario" id="id_lista_usuario" class="form-control" required>
                                        <?php

                                        $programa = $_SESSION['id_programa_usu'];
                                        $user = $_SESSION['id_usuario'];
                                        $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_programa_usu = $programa AND id_rol_usu =4 AND id_usuario != $user");
                                        echo '	<option disabled selected value="">Seleccione su Compañero</option>';

                                        while ($valores = mysqli_fetch_array($sql)) {

                                            echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_usu"] . " " . $valores["apellido_usu"] . '</option>';
                                            '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>


                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Director</label>

                                    <select name="id_lista_usuario_director" id="id_lista_usuario_director" class="form-control" required>
                                        <?php
                                        $programa = $_SESSION['id_programa_usu'];

                                        $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_programa_usu = $programa AND id_rol_usu =2 ");
                                        echo '	<option disabled selected value="">Seleccione su director</option>';

                                        while ($valores = mysqli_fetch_array($sql)) {

                                            echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_usu"] . " " . $valores["apellido_usu"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>







                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                        <button input type="submit" name="add_participante" class="btn btn-dark">Guardar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>

    <script type="text/javascript" src="../include/estudiante/js/ficha.js"></script>


</body>

</html>
