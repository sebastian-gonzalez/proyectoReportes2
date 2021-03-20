<?php
session_start();
//Finalizacion de la session transcurridos 10 minutos
$minutosparafinalizar = 10;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutosparafinalizar * 60))) {
	session_unset();     
	session_destroy();  
	echo '<script language="javascript">alert("Tiempo de la session expirado");</script>';
	header('location: ../../login.php');
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 1) {
		header('location: ../../login.php');
	}
}
$nombre_usu = $_SESSION['nombre_usu'];

?>

<?php include("../../controlador/conexion.php"); ?>

<!doctype html>
<html lang="eS">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#" />
	<title>Facultad</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<!-- CSS personalizado -->
	<link rel="stylesheet" href="../../assets/mainTable.css">


	<!--datables CSS básico-->
	<link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css" />
	<!--datables estilo bootstrap 4 CSS-->
	<link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
			<a href="inicio_admin.php" class="brand-link">
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
									<a href="usuarios.php" class="nav-link">
										<i class="fa fa-users nav-icon"></i>
										<p>Usuarios</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="programas.php" class="nav-link">
										<i class="fa fa-graduation-cap nav-icon"></i>
										<p>Programas</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="facultad.php" class="nav-link">
										<i class="fa fa-cubes nav-icon"></i>
										<p>Facultad</p>
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

      <br></br>
    <div class="container">
        <div class="row">

            <div class="col-lg-12">

                <button id="btnNuevo" type="button" class="btn btn-primary" data-toggle="modal"  data-toggle="Agregar Programa" data-placement="top" title="Agregar Programa" ><i class="material-icons">library_add</i></button>
            </div>
        </div>
    </div>
    <br>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaProgramas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id_programa</th>
                                <th>Nombre Programa</th>
                                <th>Titulo</th>
                                <th>Facultad</th>
                                <th>Acciones</th>

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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formProgramas">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Nombre Programa:</label>
                                    <input type="text" class="form-control" id="nombre_pro" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Titulo</label>
                                    <input type="text" class="form-control" id="titulo_pro" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Facultad Perteneciente</label>

                                    <select name="id_facultad_pro" name="id_facultad_pro" id="id_facultad_pro" class="form-control" required>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT * FROM facultad WHERE activo is null");
                                        echo '	<option disabled selected value="">Seleccione la facultad</option>';

                                        while ($valores = mysqli_fetch_array($sql)) {

                                            echo '<option value="' . $valores["id_facultad"] . '">' . $valores["nombre_facultad"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
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

		<script type="text/javascript" src="../../controlador/admin/js/programa.js"></script>
		<!-- jQuery -->

		<script src="../../assets/js/nav/adminlte.js"></script>
		<!-- AdminLTE for demo purposes -->


</body>

</html>