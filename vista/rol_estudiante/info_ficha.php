<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 4) {
		header('location: ../../login.php');
	}
}

$nombre_usu = $_SESSION['nombre_usu'];


include("../../controlador/conexion.php");



include_once '../../controlador/database.php';

$db = new Database();
$id_s = $_SESSION['id_usuario'];

include("../../controlador/estudiante/update_ficha.php");
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



$consultaacamposficha = "SELECT fi.id_ficha
FROM lista_ficha lista, ficha fi 
WHERE lista.id_lista_usuario=$id_s
AND fi.id_estado_ficha=6
";
$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

	$fichaaprobada = $record['id_ficha'];
}

$consultaacamposfichas = "SELECT fi.id_ficha,fi.titulo_ficha
FROM lista_ficha lista, ficha fi 
WHERE lista.id_lista_usuario=$id_s
AND fi.id_ficha = lista.id_lista_ficha 

";
$resultset = mysqli_query($con, $consultaacamposfichas) or die("database error:" . mysqli_error($con));

while ($records = mysqli_fetch_assoc($resultset)) {

	$ficha_id_final = $records['id_ficha'];
}



$consultaacamposfichageneral = "SELECT fi.id_ficha
	FROM lista_ficha lista, ficha fi 
	WHERE fi.id_ficha=lista.id_lista_ficha
	AND lista.id_lista_usuario=$id_s
	AND fi.id_estado_ficha in (1,2,3,4,5)
	
";
$resultset = mysqli_query($con, $consultaacamposfichageneral) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

	$fichaenanteproyecto = $record['id_ficha'];
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
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
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

		<?php

		if (!isset($id_lis_fi)) {
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
		} else if (isset($id_lis_fi) && isset($fichaenanteproyecto)) {
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
		} else if (isset($id_lis_fi) && isset($fichaaprobada)) {
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
		}
		?>



		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->

			<div class="container">

				<section>
					<h1>Ficha de anteproyecto de grado</h1>
				</section>
				<hr />

				<section>
					<h2>Titulo</h2>
				</section>



				<hr />

				<?php
				$consultaacamposficha = "SELECT fi.id_ficha,fi.titulo_ficha
				FROM lista_ficha lista, ficha fi 
				WHERE lista.id_lista_usuario=118
				AND fi.id_ficha = lista.id_lista_ficha ";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {
					$titu_ficha = $record['titulo_ficha']



				?>
					<button href='#edit_titu' class='btn btn-primary derechaubicacion' data-toggle='modal'> <i class='fa fa-pencil'></i></button>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<p><?php echo $titu_ficha; ?></p>
							</div>
						</div>
					</div>


					<div class="modal fade" id="edit_titu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">


									<h4 class="modal-title" id="myModalLabel"> Editar Titulo </h4>
									<button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
								</div>
								<div class="modal-body">
									<div class="container-fluname">
										<form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?aktr=edit&nikfi=' . $record['id_ficha'] . '"'; ?>>
											<div class="modal-body">


												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label for="" class="col-form-label">Titulo </label>

															<input type="text" class="form-control largocampo" name="titu_ficha" required value='<?php echo $titu_ficha ?>'>

														</div>
													</div>


												</div>
											</div>
											<div class="modal-footer">

												<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
												<button input type="submit" name="edit_titu" class="btn btn-dark">Guardar</button>
											</div>

									</div>


									</form>
								</div>

							</div>
						</div>
					</div>
				<?php
				}
				?>
				<hr />

				<section>
					<h2>Planteamiento del Problema</h2>
				</section>
				<hr />
				<!-- primera modal titulo -->
				<?php
				$consultaacamposficha1 = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha
								FROM lista_ficha lista, ficha fi , campos_fichas campos
								WHERE lista.id_lista_usuario=$id_s
								AND fi.id_ficha = lista.id_lista_ficha 
								AND fi.id_ficha = campos.fk_id_ficha 
								AND fi.descripcion_ficha LIKE '%Anteproyecto de grado%'
								AND campos.descripcion_campo LIKE '%Pregunta problematizadora%'";
				$resultset = mysqli_query($con, $consultaacamposficha1) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {
					$validarpreg = $record['valor_campo'];
				}
				$consultaacamposficha = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha
				FROM lista_ficha lista, ficha fi , campos_fichas campos
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha 
				AND fi.id_ficha = campos.fk_id_ficha 
				AND fi.descripcion_ficha LIKE '%Anteproyecto de grado%'
				AND campos.descripcion_campo LIKE '%Pregunta problematizadora%'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));


				if (isset($validarpreg)) {
					while ($record = mysqli_fetch_assoc($resultset)) {
						$valor_mostrar = $record['valor_campo'];
						$idcampo1 = $record['id_campo'];
						include("modal_campo_ficha.php");
					}
					echo "

					<div class='row'>
						<div class='col-lg-12'>
							<div class='form-group'>
							<label class='col-form-label'>Pregunta Problematizadora </label>
							<button href='#edit_$idcampo1' class='btn btn-primary derechaubicacion' data-toggle='modal'> <i class='fa fa-pencil'></i></button>
								<hr />
							
								<p> $valor_mostrar </p>
							</div>
						</div>
					</div>

				";
				} else {
					echo "

					<div class='row'>
						<div class='col-lg-12'>
							<div class='form-group'>
							<label class='col-form-label'>Pregunta Problematizadora </label>
							<button href='#create_pregugen' class='btn btn-info derechaubicacion' data-toggle='modal'> <i class='fa fa-plus'></i></button>
		
						
							</div>
						</div>
					</div>

				";
				}

				?>
				<!-- segundo modal-->
				<hr />

				<div class="modal fade" id="create_pregugen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">


								<h4 class="modal-title" id="myModalLabel"> Crear Pregunta problematizadora </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="container-fluname">
									<form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?ak=crear&nikfi=' . $id_lis_fi . '"'; ?>>
										<div class="modal-body">


											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-form-label">Pregunta Problematizadora </label>

														<input type="text" class="form-control largocampo" name="valor_campo" required>

													</div>
												</div>


											</div>
										</div>
										<div class="modal-footer">

											<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
											<button input type="submit" name="crearpregpro" class="btn btn-dark">Guardar</button>
										</div>

								</div>


								</form>
							</div>

						</div>
					</div>
				</div>

				<label class="col-form-label">Pregunta sistematizadoras </label>
				<button href="#create_pregu" class="btn btn-info derechaubicacion" data-toggle="modal"> <i class='fa fa-plus'></i></button>

				<div class="modal fade" id="create_pregu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">


								<h4 class="modal-title" id="myModalLabel"> Crear Pregunta sistematizadora </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="container-fluname">
									<form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?ak=crear&nikfi=' . $id_lis_fi . '"'; ?>>
										<div class="modal-body">


											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-form-label">Pregunta sistematizadora </label>

														<input type="text" class="form-control largocampo" name="valor_campo" required>

													</div>
												</div>


											</div>
										</div>
										<div class="modal-footer">

											<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
											<button input type="submit" name="crearpreg" class="btn btn-dark">Guardar</button>
										</div>

								</div>


								</form>
							</div>

						</div>
					</div>
				</div>


				<?php
				//




				$consultaacamposficha = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha 
				FROM lista_ficha lista, ficha fi , campos_fichas campos
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha 
				AND fi.id_ficha = campos.fk_id_ficha 
				AND fi.descripcion_ficha LIKE '%Anteproyecto de grado%'
				AND campos.descripcion_campo LIKE '%Pregunta sistematizadora'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {

					include("modal_campo_ficha.php");

				?>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<hr />
								<?php
								echo '
								<a href="../../controlador/estudiante/editar_campos_ficha.php?aksi=delete&nik=' . $record['id_campo'] . '" class="btn btn-danger derechaubicacion" data-toggle="modal"> <i class="fa fa-trash-o"></i></a>'
								?>

								<button href="#edit_<?php echo $record['id_campo']; ?>" class="btn btn-primary derechaubicacion" data-toggle="modal"> <i class='fa fa-pencil'></i></button>

								<p><?php echo $record['valor_campo']; ?></p>
							</div>
						</div>
					</div>
				<?php
				}
				?>

				<!-- segundo modal preguntas  -->

				<hr />

				<!-- segundo modal objetivos  -->
				<section>
					<h2>Obejtivos</h2>
				</section>
				<hr />

				<?php
				$consultaacamposficha1 = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha
				FROM lista_ficha lista, ficha fi , campos_fichas campos
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha 
				AND fi.id_ficha = campos.fk_id_ficha 
				AND fi.descripcion_ficha LIKE '%Anteproyecto de grado%'
				AND campos.descripcion_campo LIKE '%Objetivo general%'";
				$resultset = mysqli_query($con, $consultaacamposficha1) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {

					$validarobj = $record['valor_campo'];
				}
				//
				$consultaacamposficha = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha
				FROM lista_ficha lista, ficha fi , campos_fichas campos
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha 
				AND fi.id_ficha = campos.fk_id_ficha 
				AND fi.descripcion_ficha LIKE '%Anteproyecto de grado%'
				AND campos.descripcion_campo LIKE '%Objetivo general%'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				if (isset($validarobj)) {
					while ($record = mysqli_fetch_assoc($resultset)) {
						$valor_mostrar = $record['valor_campo'];
						$idcampo1 = $record['id_campo'];
						include("modal_campo_ficha.php");
					}
					echo "

					<div class='row'>
						<div class='col-lg-12'>
							<div class='form-group'>
							<label class='col-form-label'>Objetivo General </label>
							<button href='#edit_$idcampo1' class='btn btn-primary derechaubicacion' data-toggle='modal'> <i class='fa fa-pencil'></i></button>
								<hr />
							
								<p> $valor_mostrar </p>
							</div>
						</div>
					</div>

				";
				} else {
					echo "

					<div class='row'>
						<div class='col-lg-12'>
							<div class='form-group'>
							<label class='col-form-label'>Objetivo General </label>
							<button href='#create_objetivogen' class='btn btn-info derechaubicacion' data-toggle='modal'> <i class='fa fa-plus'></i></button>
		
						
							</div>
						</div>
					</div>

				";
				}

				?>

				<div class="modal fade" id="create_objetivogen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">


								<h4 class="modal-title" id="myModalLabel"> Crear Objetivo general </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="container-fluname">
									<form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?ak=crear&nikfi=' . $id_lis_fi . '"'; ?>>
										<div class="modal-body">


											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-form-label">Objetivo general </label>

														<input type="text" class="form-control largocampo" name="valor_campo" required>

													</div>
												</div>


											</div>
										</div>
										<div class="modal-footer">

											<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
											<button input type="submit" name="crearobjgen" class="btn btn-dark">Guardar</button>
										</div>

								</div>


								</form>
							</div>

						</div>
					</div>
				</div>

				<hr />
				<label for="" class="col-form-label">Objetivos especificos </label>
				<button href="#create_obj" class="btn btn-info derechaubicacion" data-toggle="modal"> <i class='fa fa-plus'></i></button>

				<div class="modal fade" id="create_obj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">


								<h4 class="modal-title" id="myModalLabel"> Crear Objetivo Especifico </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="container-fluname">
									<form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?akitoy=crear_ob_es&nikfis=' . $id_lis_fi . '"'; ?>>
										<div class="modal-body">


											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-form-label">Obejetivo especifico </label>

														<input type="text" class="form-control largocampo" name="valor_campo" required>

													</div>
												</div>


											</div>
										</div>
										<div class="modal-footer">

											<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
											<button input type="submit" name="crearobj" class="btn btn-dark">Guardar</button>
										</div>

								</div>


								</form>
							</div>

						</div>
					</div>
				</div>



				<?php
				//
				$consultaacamposficha = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha
				FROM lista_ficha lista, ficha fi , campos_fichas campos
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha 
				AND fi.id_ficha = campos.fk_id_ficha 
				AND fi.descripcion_ficha LIKE '%Anteproyecto de grado%'
				AND campos.descripcion_campo LIKE '%Objetivo especifico%'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {

					include("modal_campo_ficha.php");

				?>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<hr />
								<?php
								echo '
								<a href="../../controlador/estudiante/editar_campos_ficha.php?aksi=delete&nik=' . $record['id_campo'] . '" class="btn btn-danger derechaubicacion" data-toggle="modal"> <i class="fa fa-trash-o"></i></a>'
								?>

								<button href="#edit_<?php echo $record['id_campo']; ?>" class="btn btn-primary derechaubicacion" data-toggle="modal"> <i class='fa fa-pencil'></i></button>

								<p><?php echo $record['valor_campo']; ?></p>
							</div>
						</div>
					</div>
				<?php
				}
				?>


				<hr />

				<section>
					<h1>Documentos</h1>
				</section>
				<hr />

				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="" class="col-form-label">ficha de anteproyecto:</label>
							<br />
							<a class="btn btn-info" href='documento.php'><i class='fa fa-file-pdf-o'></i></a>



							<button id="btneditarficha" type="button" class="btn btn-primary editarficha" data-toggle="modal" tooltip-dir="top"><i class='fa fa-pencil'> </i></button>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="" class="col-form-label">Anteproyecto completo:</label>
							<br />
							<a class="btn btn-info" href="documentoanteproyecto.php"><i class='fa fa-file-pdf-o'></i></a>


							<button id="btneditarfichaanteproyecto" type="button" class="btn btn-primary editarficha" data-toggle="modal" tooltip-dir="top"><i class='fa fa-pencil'> </i></button>
						</div>
					</div>


				</div>

				<hr />
				<section>
					<h1>Evaluacion</h1>
				</section>
				<hr />

				<?php
				//
				$consultaacamposficha = "SELECT fi.id_ficha,fi.evaluacion_ficha
					FROM lista_ficha lista, ficha fi , campos_fichas campos
					WHERE lista.id_lista_usuario=$id_s
					AND fi.id_ficha = lista.id_lista_ficha 
					AND fi.id_ficha = campos.fk_id_ficha 
					AND fi.descripcion_ficha LIKE '%Anteproyecto de grado%'
					AND campos.descripcion_campo LIKE '%Pregunta problematizadora%'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {



				?>


					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="" class="col-form-label">Evaluacion:</label>
								<p><?php echo $record['evaluacion_ficha']; ?></p>
							</div>
						</div>
					</div>
				<?php
				}
				?>
				<div class="row">

					<div class="col-lg-12">
						<div class="form-group">
							<label for="" class="col-form-label">Documento Evaluacion:</label>
							<br />
							<a class="btn btn-primary" href="documentoanteproyecto.php"><i class='fa fa-file-pdf-o'></i></a>
						</div>
					</div>
				</div>


			</div>
		</div>


		<?php

		?>





		<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="post" action="" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group" enctype="multipart/form-data">
								<label for="" class="col-form-label">Documento</label>
								<div class="col-lg-6">

									<?php
									$nik = $_SESSION['id_usuario'];
									$sql = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista_usuario=$nik");
									while ($record = mysqli_fetch_assoc($sql)) {
										$id = $record['id_lista_ficha'];
									}
									$path = "../../controlador/estudiante/pdf/" . $id;

									if (is_dir($path)) {

										$verifi = @scandir($path);
									}
									if (count($verifi) >  2) {
										if (file_exists($path)) {
											$directorio = opendir($path);
											while ($archivo = readdir($directorio)) {
												if (!is_dir($archivo)) {
													echo "<div data='" . $path . "/" . $archivo . "'>
										<a href = '" . $path . "/" . $archivo . "'
										title = 'Ver Archivo Adjunto'>
										<span class='fa fa-file-pdf-o' aria-hidden='true'></span></a>";

													echo "$archivo <a href ='info_ficha.php' id = 'delete'
										title = 'Eliminar Archivo Adjunto'>
										
										<span class='fa fa-trash' aria-hidden='true'></span></a></div>";

													echo "<iframe src='../../controlador/estudiante/pdf/$id/$archivo' width='400'> </iframe>";
												}
											}
										}
									} else {

										echo '<input type="file" name="archivo">';
									}






									?>

								</div>
							</div>
						</div>
						<div class="modal-footer">

							<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
							<button input type="submit" name="mod" class="btn btn-dark">Guardar</button>
						</div>
					</form>

				</div>
			</div>
		</div>


		

		<div class="modal fade" id="modalCRUDFICHA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="post" action="" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group" enctype="multipart/form-data">
								<label for="" class="col-form-label">Documento</label>
								<div class="col-lg-6">

									<?php
									$nik = $_SESSION['id_usuario'];
									$sql = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista_usuario=$nik");
									while ($record = mysqli_fetch_assoc($sql)) {
										$id = $record['id_lista_ficha'];
									}
									$path = "../../controlador/estudiante/anteproyecto/" . $id;

									if (is_dir($path)) {

										$verifi = @scandir($path);
									}
									if (count($verifi) >  2) {
										if (file_exists($path)) {
											$directorio = opendir($path);
											while ($archivo = readdir($directorio)) {
												if (!is_dir($archivo)) {
													echo "<div data='" . $path . "/" . $archivo . "'>
										<a href = '" . $path . "/" . $archivo . "'
										title = 'Ver Archivo Adjunto'>
										<span class='fa fa-file-pdf-o' aria-hidden='true'></span></a>";

													echo "$archivo <a href ='info_ficha.php' id = 'deleteante'
										title = 'Eliminar Archivo Adjunto'>
										
										<span class='fa fa-trash' aria-hidden='true'></span></a></div>";

													echo "<iframe src='../../controlador/estudiante/anteproyecto/$id/$archivo' width='400'> </iframe>";
												}
											}
										}
									} else {

										echo '<input type="file" name="archivo">';
									}






									?>

								</div>
							</div>
						</div>
						<div class="modal-footer">

							<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
							<button input type="submit" name="modantepro" class="btn btn-dark">Guardar</button>
						</div>
					</form>

				</div>
			</div>
		</div>

		<script src="../../assets/js/jquery-3.5.1.js"></script>
		<script src="../../assets/popper/popper.min.js"></script>
		<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- datatables JS -->
		<script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>
		<script type="text/javascript" src="../../controlador/estudiante/js/ficha.js"></script>




		<script src="../../assets/js/nav/adminlte.js"></script>

</body>

</html>