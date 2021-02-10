<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 4) {
		header('location: ../login.php');
	}
}

$nombre_usu = $_SESSION['nombre_usu'];

?>


<?php
include("../include/conexion.php");

?>

<?php
include_once '../include/database.php';

$db = new Database();
$id_s = $_SESSION['id_usuario'];


$query_ficha = $db->connect()->prepare("SELECT *FROM lista_ficha WHERE id_lista_usuario =$id_s");
$query_ficha->execute();
$row_ficha = $query_ficha->fetch(PDO::FETCH_NUM);


if ($row_ficha == true) {
	$id_lis = $row_ficha[0];
	$_SESSION['id_lista'] = $id_lis;

	$id_lis_u = $row_ficha[1];
	$_SESSION['id_lista_usuario'] = $id_lis_u;

	$id_lis_fi = $row_ficha[2];
	$_SESSION['id_lista_ficha'] = $id_lis_fi;

	$id_rol_fi = $row_ficha[3];
	$_SESSION['id_rol_ficha'] = $id_rol_fi;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Estudiante</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/mainTable.css">
	<link rel="stylesheet" href="../css/css/nav/adminlte.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
	<link rel="icon" href="../images/favicon.ico" type="image/gif" />



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
					<a class="nav-link"  href="../logout.php" >
						<i class="fa fa-power-off"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		</ul>
		</nav>

		<?php

if (!isset($_SESSION['id_lista_ficha'])) {  echo " 
		<!-- Main Sidebar Container -->
		<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
			<!-- Brand Logo -->
			<a href='inicio_docente.php' class='brand-link'>
				<img src='../images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
				<span class='brand-text font-weight-light'>Inicio</span>
			</a>

			<!-- Sidebar -->
			<div class='sidebar'>
				<!-- Sidebar user (optional) -->
				<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
					<div class='image'>
						<img src='../images/user.jpg' class='img-circle elevation-2' alt='User Image'>
					</div>
					<div class='info'>
						<a href='perfil.php' class='d-block'>  $nombre_usu </a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class='mt-2'>
					<ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class='nav-item menu-open'>

							<ul class='nav nav-treeview'>
								<li class='nav-item'>
									<a href='primer_ingreso.php' class='nav-link'>
										<i class='fa fa-plus-square-o nav-icon'></i>
										<p>Crear Ficha</p>
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
		";
	} else { echo " 
		<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
			<!-- Brand Logo -->
			<a href='inicio_docente.php' class='brand-link'>
				<img src='../images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
				<span class='brand-text font-weight-light'>Inicio</span>
			</a>

			<!-- Sidebar -->
			<div class='sidebar'>
				<!-- Sidebar user (optional) -->
				<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
					<div class='image'>
						<img src='../images/user.jpg' class='img-circle elevation-2' alt='User Image'>
					</div>
					<div class='info'>
						<a href='perfil.php' class='d-block'>  $nombre_usu </a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class='mt-2'>
					<ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class='nav-item menu-open'>

							<ul class='nav nav-treeview'>
								<li class='nav-item'>
									<a href='fichas.php' class='nav-link'>
										<i class='fa fa-book nav-icon'></i>
										<p>Gestion Ficha</p>
									</a>
								</li>
								<li class='nav-item'>
									<a href='documento.php' class='nav-link'>
										<i class='fa fa-file-pdf-o nav-icon'></i>
										<p>Ver documento</p>
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

		";
	}
	?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="container">
				<br></br>
				<h2>Estudiante</h2>

				<section>
					<h1>Bienvenido(a) <?php echo $_SESSION['nombre_usu']; ?></h1>
				</section>
				<hr />

				<center>
					<img src="../images/uniajc.png" width="50%">
				</center>
			</div>
		</div>
	</div>

	<script src="../assets/jquery/jquery-3.3.1.min.js"></script>

	<script src="../assets/js/nav/adminlte.js"></script>

</body>

</html>