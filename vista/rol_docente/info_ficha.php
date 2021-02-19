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




<?php
include("../../controlador/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil Docente</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/perfil.css">
    <link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="icon" href="../../assets/images/favicon.ico" type="image/gif" />





</head>

<body class="hold-transition sidebar-mini sidebar-collapse">



    <div class="wrapper">
        <!-- Navbar -->
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
            <!-- Content Header (Page header) -->
            <div class="container">

                <section>
                    <h1>Informacion de la ficha</h1>
                </section>

                <?php
                $ficha = mysqli_real_escape_string($con, (strip_tags($_GET["ficha"], ENT_QUOTES)));
                ?>


                <?php


                $consultatitulo = "SELECT fi.id_ficha,fi.titulo_ficha
                FROM ficha fi 
                WHERE fi.id_ficha=$ficha";
                $resultset = mysqli_query($con, $consultatitulo) or die("database error:" . mysqli_error($con));

                while ($record = mysqli_fetch_assoc($resultset)) {
                    $titu_ficha = $record['titulo_ficha']

                ?>
                    <hr />
                    <h4> Titulo </h4>

                    <h6><?php echo $titu_ficha  ?> </h6>
                <?php
                }
                ?>


                <!-- primera modal titulo -->
                <?php
                $consultaacamposficha1 = "SELECT  campos.descripcion_campo,  campos.valor_campo
                FROM  ficha fi , campos_fichas campos
                WHERE fi.id_ficha=$ficha
                AND fi.id_ficha = campos.fk_id_ficha ";
                $resultset = mysqli_query($con, $consultaacamposficha1) or die("database error:" . mysqli_error($con));

                while ($record = mysqli_fetch_assoc($resultset)) {
                    $descri_campo = $record['descripcion_campo'];
                    $valo_campo = $record['valor_campo'];

                ?>

                    <div>

                        <hr />
                        <h4><?php echo $descri_campo  ?></h4>

                        <h6><?php echo $valo_campo  ?> </h6>
                    </div>

                <?php
                }
                ?>

                <!-- segundo modal-->
                <hr />


                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Ficha de anteproyecto:</label>
                            <br />
                            <a class="btn btn-info" <?php echo 'href="revision_documento.php?tipo=pdf& ficha=' . $ficha . '  "'; ?>> <i class='fa fa-file-pdf-o'></i></a>
                        </div>
                    </div>  
                    <div class="col-lg-6">
                    <div class="form-group">
                            <label for="" class="col-form-label">Anteproyecto completo:</label>
                            <br />
                            <a class="btn btn-info" <?php echo 'href="revision_documento.php?tipo=anteproyecto& ficha=' . $ficha . '  "'; ?>> <i class='fa fa-file-pdf-o'></i></a>
                        </div>
                    </div>


                </div>
            </div>
        </div>







        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="../../assets/js/jquery-3.5.1.js"></script>

        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- datatables JS -->

        <script type="text/javascript" src="../../controlador/docente/js/doc_ficha_asignada_jurado.js"></script>
        <script src="../../assets/js/nav/adminlte.js"></script>



</body>


</html>