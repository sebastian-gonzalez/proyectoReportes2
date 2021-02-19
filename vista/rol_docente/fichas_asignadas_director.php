<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 2) {
        header('location: ../../login.php');
    }
}
$nombre_usu = $_SESSION['nombre_usu'];


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
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../../assets/mainTable.css">

    <?php
    include('../../controlador/conexion.php');
    ?>

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="icon" href="../../images/favicon.ico" type="image/gif" />

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">
                    <i class="fa fa-power-off"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 navcolor">
        <!-- Brand Logo -->
        <a href="inicio_docente.php" class="brand-link">
            <img src="../../assets/images/admin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Inicio</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../../assets/images/user.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="perfil.php" class="d-block"> <?php echo $nombre_usu ?></a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="fichas_asignadas_director.php" class="nav-link">
                                    <i class="fa fa-user nav-icon"></i>
                                    <p>Fichas directores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="fichas_asignadas_evaluador.php" class="nav-link">
                                    <i class="fa fa-files-o nav-icon"></i>
                                    <p>Fichas Evaluador</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="fichas_asignadas_jurado.php" class="nav-link">
                                    <i class="fa fa-book nav-icon"></i>
                                    <p>Fichas Jurado</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="fichas_aprobadas.php" class="nav-link">
                                    <i class="fa fa-check-square-o nav-icon"></i>
                                    <p>Fichas Aprobadas</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        </br>
        <!-- Content Header (Page header) -->

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


        <!-- Modal Participantes  -->
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
                            include('../../controlador/docente/captador_Datos.php');
                            ?>

                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        </div>


                </div>

            </div>
        </div>
        <!-- Modal agregar actas  -->
        <div class="modal fade" id="modalCRUDedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="repetir">


                    <?php
                    include('../../controlador/docente/editar_pdf_director.php');
                    ?>

                </div>

            </div>
        </div>






    </div>



    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../../assets/js/jquery-3.5.1.js"></script>

    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>

    <script type="text/javascript" src="../../controlador/docente/js/doc_ficha_asignada_director.js"></script>
    <script src="../../assets/js/nav/adminlte.js"></script>


</body>

</html>