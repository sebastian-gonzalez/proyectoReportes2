<?php
session_start();
//Finalizacion de la session transcurridos 10 minutos
$minutosparafinalizar = 10;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutosparafinalizar * 60))) {
	session_unset();     // unset $_SESSION   
	session_destroy();   // destroy session data  
	header('location: ../login.php');
	echo '<script language="javascript">alert("Tiempo de la session expirado");</script>';
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 1) {
		header('location: ../login.php');
	}
}
$nombre_usu = $_SESSION['nombre_usu'];

?>

<?php include("../include/conexion.php"); ?>

<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#" />
	<title>Usuarios</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<!-- CSS personalizado -->
	<link rel="stylesheet" href="../assets/mainTable.css">


	<!--datables CSS básico-->
	<link rel="stylesheet" type="text/css" href="../assets/datatables/datatables.min.css" />
	<!--datables estilo bootstrap 4 CSS-->
	<link rel="stylesheet" type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="../css/css/nav/adminlte.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
	<link rel="icon" href="../images/favicon.ico" type="image/gif" />

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
					<a class="nav-link"  href="../logout.php" >
						<i class="fa fa-power-off"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		</ul>
		</nav>
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4 navcolor">
			<!-- Brand Logo -->
			<a href="inicio_admin.php" class="brand-link">
				<img src="../images/admin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">Inicio</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="../images/user.jpg" class="img-circle elevation-2" alt="User Image">
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
			<br />
			<div class="container">
				<div class="row">
					<div class="col-lg-12">

						<button id="btnNuevo" type="button" class="btn btn-primary" data-toggle="modal" title="xd"><i class="material-icons">library_add</i></button>

						<button type="button" class="btn btn-primary" data-toggle="modal" onclick="window.location.href='import_excel.php';"><i class="material-icons">upload_file</i></button>

					</div>
				</div>
			</div>
			<br>

			<div class="container caja">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%">
								<thead class="text-center">
									<tr>
										<th>user_id</th>
										<th>Cedula</th>
										<th>Nombre</th>
										<th>Apellido</th>
										<th>Correo</th>
										<th>Contraseña</th>
										<th>Tipo Rol</th>
										<th>Programa</th>
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

			<!--Modal para agregar usuario-->
			<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" action="../include/admin/add_usuario.php">
							<div class="modal-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Cedula:</label>
											<input type="number" class="form-control" name="cedula_usu" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Nombre</label>
											<input type="text" class="form-control" name="nombre_usu" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Apellido</label>
											<input type="text" class="form-control" name="apellido_usu" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Correo</label>
											<input type="email" class="form-control" name="correo_usu" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-9">
										<div class="form-group">
											<label for="" class="col-form-label">Contraseña</label>
											<input type="password" class="form-control" name="contrasena_usu" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label for="" class="col-form-label">Tipo rol</label>

											<select name="id_rol_usu" class="form-control" required>
												<option disabled selected value="">Seleccione el rol</option>
												<option value="1">Administrador</option>
												<option value="2">Docente</option>
												<option value="3">Coordinador</option>
												<option value="4">Estudiante</option>
											</select>
										</div>

									</div>
								</div>

								<div class="row">
									<div class="col-lg-7">
										<div class="form-group">
											<label for="" class="col-form-label">Programa</label>

											<select name="id_programa_usu" class="form-control" required>

												<?php
												$sql = mysqli_query($con, "SELECT * FROM programa  ");
												echo '	<option disabled selected value="">Seleccione el programa</option>';

												while ($valores = mysqli_fetch_array($sql)) {

													echo '<option value="' . $valores["id_programa"] . '">' . $valores["nombre_pro"] . '</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
								<button type="submit" name="add_usuario" class="btn btn-dark">Guardar</button>
							</div>

						</form>
					</div>
				</div>
			</div>


			<!--Modal para editar usuario-->
			<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="formUsuarios">
							<div class="modal-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Cedula:</label>
											<input type="number" class="form-control" id="cedula_usu" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Nombre</label>
											<input type="text" class="form-control" id="nombre_usu" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Apellido</label>
											<input type="text" class="form-control" id="apellido_usu" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="" class="col-form-label">Correo</label>
											<input type="text" class="form-control" id="correo_usu" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-9">
										<div class="form-group">
											<label for="" class="col-form-label">Contraseña</label>
											<input type="password" class="form-control" id="contrasena_usu">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label for="" class="col-form-label">Tipo rol</label>

											<select name="id_rol_usu" name="id_rol_usu" id="id_rol_usu" class="form-control" required>
												<option disabled selected value="">Seleccione el rol</option>
												<option value="1">Administrador</option>
												<option value="2">Docente</option>
												<option value="3">Coordinador</option>
												<option value="4">Estudiante</option>
											</select>
										</div>

									</div>
								</div>



								<div class="row">
									<div class="col-lg-7">
										<div class="form-group">
											<label for="" class="col-form-label">Programa</label>

											<select name="id_programa_usu" name="id_programa_usu" id="id_programa_usu" class="form-control" required>

												<?php
												$sql = mysqli_query($con, "SELECT * FROM programa  ");
												echo '	<option disabled selected value="">Seleccione el programa</option>';

												while ($valores = mysqli_fetch_array($sql)) {

													echo '<option value="' . $valores["id_programa"] . '">' . $valores["nombre_pro"] . '</option>';
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
	<script src="../assets/jquery/jquery-3.3.1.min.js"></script>
	<script src="../assets/popper/popper.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

	<!-- datatables JS -->
	<script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>

	<script type="text/javascript" src="../include/admin/js/usuarios.js"></script>

	<script src="../assets/js/nav/adminlte.js"></script>


</body>

</html>