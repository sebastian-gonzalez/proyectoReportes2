<?php
session_start();
//Finalizacion de la session transcurridos 10 minutos
$minutosparafinalizar = 10;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutosparafinalizar * 60))) {
	session_unset();     // unset $_SESSION   
	session_destroy();   // destroy session data  
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

$id_usuario = $_SESSION['id_usuario'];
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
	<title>Perfil Administrador</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/mainTable.css">
	<link rel="stylesheet" href="../../assets/css/perfil.css">
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
			<div class="container">
				<div class="content">
					<br></br>

					<div class="titulo">
						<h1> <i class="fa fa-user-circle-o  order-md-2"></i>Perfil UNIAJC</h1>
					</div>
					<br />
					<hr />


					<?php
					$sql = "SELECT*FROM usuarios WHERE id_usuario=$id_usuario";
					$resultset = mysqli_query($con, $sql) or die("database error:" . mysqli_error($con));

					while ($record = mysqli_fetch_assoc($resultset)) {


					?>

						<div class="row featurette">
							<div class="col-md-7 order-md-2 ">

								<div class="campo col-md-12">
									<h3>Nombre:</h3>

									<h4><?php echo $record['nombre_usu']; ?></h4>
									<hr />

								</div>

								<div class="campo col-md-12">
									<h3>Apellido:</h3>

									<h4><?php echo $record['apellido_usu']; ?></h4>
									<hr />

								</div>

								<div class="campo col-md-12">
									<h3>Cedula:</h3>

									<h4><?php echo $record['cedula_usu']; ?></h4>
									<hr />

								</div>

								<div class="campo col-md-12">
									<h3>Correo:</h3>

									<h4><?php echo $record['correo_usu']; ?></h4>
									<hr />

								</div>


							</div>
							<div class="col-md-5 order-md-1">

								<img src="../../assets/images/uniajc.png" width="100%">

								<br />
								<br />
								<br />
								<br />
								<br />


								<center> <button id="btneditarusuarios" type="button" class="btn btn-info navcolor" data-toggle="modal" tooltip-dir="top"><i class="">Editar usuario </i></button> </center>


							</div>

						</div>




						<div class="modal fade" id="modalCRUD1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form method="POST" action="../../edit_profile.php">
										<div class="modal-body">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-form-label">Cedula:</label>
														<input type="number" class="form-control" value="<?php echo  $record['cedula_usu']; ?>" name="cedula_usu" required>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-form-label">Nombre</label>
														<input type="text" class="form-control" value="<?php echo $record['nombre_usu']; ?>" name="nombre_usu" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-form-label">Apellido</label>
														<input type="text" class="form-control" value="<?php echo $record['apellido_usu']; ?>" name="apellido_usu" required>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-form-label">Correo</label>
														<input type="text" class="form-control" value="<?php echo $record['correo_usu']; ?>" name="correo_usu" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-9">
													<div class="form-group">
														<label for="" class="col-form-label">Contraseña</label>
														<input type="password" class="form-control" name="contrasena_usu">
													</div>
												</div>
											</div>



										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
											<button type="submit" name="edit_profile" class="btn btn-dark">Guardar</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					<?php



					} ?>







				</div>

				<!-- jQuery -->
				<!-- jQuery, Popper.js, Bootstrap JS -->
				<script src="../../assets/js/jquery-3.5.1.js"></script>


				<script src="../../assets/popper/popper.min.js"></script>
				<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

				<!-- datatables JS -->
				<script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>

				<script type="text/javascript" src="../../controlador/admin/js/usuarios.js"></script>

				<script src="../../assets/js/nav/adminlte.js"></script>

</body>

</html>