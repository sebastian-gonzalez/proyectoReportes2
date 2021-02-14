<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 3) {
        header('location: ../../login.php');
    }
}
$nombre_usu = $_SESSION['nombre_usu'];


include('../../controlador/conexion.php');
include('../../controlador/database.php');
include("../../controlador/coordinador/add_jurado.php");

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

    <!--Select2-->
    <link rel="stylesheet" type="text/css" href="../../assets/select2/select2.min.css" />



    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="icon" href="../../assets/images/favicon.ico" type="image/gif" />
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">

    <!-- Site wrapper -->
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
					<a class="nav-link"  href="../../logout.php" >
						<i class="fa fa-power-off"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

	
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4 navcolor">
			<!-- Brand Logo -->
			<a href="inicio_coordinador.php" class="brand-link">
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
									<a href="revision_fichas_director.php" class="nav-link">
										<i class="fa fa-user nav-icon"></i>
										<p>Fichas directores</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="revision_fichas_coordinador.php" class="nav-link">
										<i class="fa fa-pencil-square-o nav-icon"></i>
										<p>Fichas Evaluadores</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="revision_fichas_evaluador.php" class="nav-link">
										<i class="fa fa-black-tie nav-icon"></i>
										<p>Fichas Jurados</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="revision_fichas_jurado.php" class="nav-link">
										<i class="fa fa-check-square-o nav-icon"></i>
										<p>Fichas Completas</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="revision_fichas_terminadas.php" class="nav-link">
										<i class="fa fa-bookmark nav-icon"></i>
										<p>Todas las Fichas</p>
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

            <br />

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

                                            <select id="id_lista_usuario_ju" name="id_lista_usuario_ju" class="form-control" multiple="multiple" style="width: 15em;" required>
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
                                include('../../controlador/coordinador/captador_Datos.php');
                                ?>

                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            </div>


                    </div>

                </div>
            </div>


            </form>
        </div>


    </div>
    </div>




    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../../assets/js/jquery-3.5.1.js"></script>
    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>

    <script type="text/javascript" src="../../controlador/coordinador/js/ficha_asignada_evaluador.js"></script>

    <!-- Select2 -->

    <script src="../../assets/select2/select2.min.js"></script>
    <script src="../../assets/js/nav/adminlte.js"></script>


</body>

</html>