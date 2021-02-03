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


    <?php 
   //id ficha para evaluador
    $id_ficha_compa = (isset($_POST['id_fichas_evaluador'])) ? $_POST['id_fichas_evaluador'] : '';
    $_SESSION['id_fichas_evaluador'] = $id_ficha_compa;

    //id ficha para jurado
    $id_ficha_jurado = (isset($_POST['id_fichas_jurado'])) ? $_POST['id_fichas_jurado'] : '';
    $_SESSION['id_fichas_jurado'] = $id_ficha_jurado;

    ?>

    

    

    <!-- Modal Jurado  -->

    <div class="modal fade" id="modalJurado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formJurado" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Jurado</label>

                                    <select id="id_lista_usuario_ju" name="id_lista_usuario_ju" class="form-control" multiple="multiple"   style="width: 15em;"  required>
                                        <?php

                                        $programa = $_SESSION['id_programa_usu'];
                                        $user = $_SESSION['id_usuario'];
                                        $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_programa_usu = $programa AND id_rol_usu =2 AND id_usuario != $user");

                                        while ($valores = mysqli_fetch_array($sql)) {

                                            echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_usu"] . " " . $valores["apellido_usu"] . '</option>';
                                            '</option>';
                                        }
                                        ?>
                                    </select> 

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                            <button input type="submit" name="add_jurado" class="btn btn-dark">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal ""Participantes"""  -->
    <div class="modal fade" id="modalParticipantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formFichas" enctype="multipart/form-data">
                    <div class="modal-body" id="id">

                        <?php
                        include('../include/coordinador/captador_Datos.php');
                        ?>

                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    </div>


            </div>

        </div>
    </div>

    
    </form>
    </div>



    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../assets/jquery/jquery-3.5.1.js"></script>
    <script src="../assets/jquery/jquery-3.5.1.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>

    <script type="text/javascript" src="../include/coordinador/js/ficha_asignada_evaluador.js"></script>

    <!-- Select2 -->

    <script src="../assets/select2/select2.min.js"></script>

</body>

</html>