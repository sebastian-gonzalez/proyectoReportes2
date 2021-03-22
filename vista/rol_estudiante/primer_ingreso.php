<?php



session_start();
if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 4) {
		header('location: ../login.php');
	}
}
?>
<?php

$nombre_usu = $_SESSION['nombre_usu'];


include("../../controlador/conexion.php");


include_once '../../controlador/database.php';

$db = new Database();
$id_s = $_SESSION['id_usuario'];


$query_ficha = $db->connect()->prepare("SELECT *FROM lista_ficha lista,ficha fi WHERE id_lista_usuario =$id_s AND fi.id_ficha=lista.id_lista_ficha AND fi.activo is null");
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


$consultaacamposficha = "SELECT fi.id_ficha
FROM lista_ficha lista, ficha fi 
WHERE lista.id_lista_usuario=$id_s
AND fi.id_estado_ficha=3
AND fi.activo is null
";
$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

	$fichaaprobada = $record['id_ficha'];
}




$consultaacamposfichageneral = "SELECT fi.id_ficha
	FROM lista_ficha lista, ficha fi 
	WHERE fi.id_ficha=lista.id_lista_ficha
	AND lista.id_lista_usuario=$id_s
	AND fi.id_estado_ficha in (1,2,4,5,6)	
	AND fi.activo is null
";
$resultset = mysqli_query($con, $consultaacamposfichageneral) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

	$fichaenanteproyecto = $record['id_ficha'];
}
?>





<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#" />
	<title>Primer Ficha</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<!-- CSS personalizado -->
	<link rel="stylesheet" href="../../assets/mainTable.css">


	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
	<link rel="icon" href="../../assets/images/favicon.ico" type="image/gif" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
	<script src="../../assets/js/jquery-3.5.1.js"></script>


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

		<?php

		if (!isset($fichaaprobada) && !isset($fichaenanteproyecto)) {
			echo " 
<!-- Main Sidebar Container -->
<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
	<!-- Brand Logo -->
	<a href='inicio_estudiante.php' class='brand-link'>
		<img src='../../assets/images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
		<span class='brand-text font-weight-light'>Inicio</span>
	</a>

	<!-- Sidebar -->
	<div class='sidebar'>
		<!-- Sidebar user (optional) -->
		<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
			<div class='image'>
				<img src='../../assets/images/user.jpg' class='img-circle elevation-2' alt='User Image'>
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
		} else if (isset($fichaenanteproyecto)) {
			echo  " 
<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
	<!-- Brand Logo -->
	<a href='inicio_estudiante.php' class='brand-link'>
		<img src='../../assets/images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
		<span class='brand-text font-weight-light'>Inicio</span>
	</a>

	<!-- Sidebar -->
	<div class='sidebar'>
		<!-- Sidebar user (optional) -->
		<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
			<div class='image'>
				<img src='../../assets/images/user.jpg' class='img-circle elevation-2' alt='User Image'>
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



					</ul>
				</li>

			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

";
		} else if (isset($fichaaprobada)) {
			echo  " 
	<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
		<!-- Brand Logo -->
		<a href='inicio_estudiante.php' class='brand-link'>
			<img src='../../assets/images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
			<span class='brand-text font-weight-light'>Inicio</span>
		</a>

		<!-- Sidebar -->
		<div class='sidebar'>
			<!-- Sidebar user (optional) -->
			<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
				<div class='image'>
					<img src='../../assets/images/user.jpg' class='img-circle elevation-2' alt='User Image'>
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
							<a href='proyectofinal.php' class='nav-link'>
								<i class='fa fa-plus-square-o nav-icon'></i>
								<p>Agregar Proyecto</p>
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




			<div class="container ">

				<?php include('../../controlador/estudiante/add_ficha.php'); ?>



				<section>
					<h2>Crear ficha de anteproyecto</h2>
				</section>
				<hr />
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="" class="col-form-label">Titulo de la ficha</label>
									<textarea type="text" class="form-control" name="titulo_ficha" required></textarea>
								</div>
							</div>
						</div>


						<div class="form-group" enctype="multipart/form-data">
							<label for="" class="col-form-label">Ficha de anteproyecto</label>
							<div class="col-lg-6">
								<input type="file"   name="archivo" required>
							</div>
						</div>
						<div class="form-group" enctype="multipart/form-data">
							<label for="" class="col-form-label">Anteproyecto completo</label>
							<div class="col-lg-6">
								<input type="file" name="anteproyecto" required>
							</div>
						</div>

					</div>

					<button input type="submit" name="add" id="btnGuardar" class="btn btn-primary">Continuar registro</button>

				</form>

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
	<script type="text/javascript" src="../../controlador/estudiante/js/ficha.js"></script>
	<script src="../../assets/js/nav/adminlte.js"></script>



</body>

</html>