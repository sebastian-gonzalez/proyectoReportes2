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

$consultaacamposfichas = "SELECT fi.id_ficha,fi.titulo_ficha
FROM lista_ficha lista, ficha fi 
WHERE lista.id_lista_usuario=$id_s
AND fi.id_ficha = lista.id_lista_ficha 
AND fi.activo is null

";
$resultset = mysqli_query($con, $consultaacamposfichas) or die("database error:" . mysqli_error($con));

while ($records = mysqli_fetch_assoc($resultset)) {

	$ficha_id_final = $records['id_ficha'];
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
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
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

		include("../../controlador/estudiante/update_ficha.php");

		?>




		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->

			<div class="container">

				<section>
					<h1>Ficha</h1>
				</section>
				<hr />
				<?php

				$consulta_validacion_esta = "SELECT fi.id_ficha,fi.id_estado_ficha
				FROM lista_ficha lista, ficha fi 
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha
				AND fi.activo is null";
				$resultset = mysqli_query($con, $consulta_validacion_esta) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {
					$id_estado_ficha_barra = $record['id_estado_ficha'];
				}
				if ($id_estado_ficha_barra == 1) {
					echo '	<div class="progress">
					<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 20%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">20%</div>
				  </div>	
				  <h6>ESTADO: La ficha de anteproyecto se encuentra a la espera de su respectiva evaluacion</h6>
				 ';
				} else if ($id_estado_ficha_barra == 2) {
					echo '	<div class="progress">
					<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 40%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">40%</div>
				  </div>	
				  <h6>ESTADO: La ficha de anteproyecto se encuentra a la espera de la correccion por parte del estudiante</h6>
				  <button type="button" class="btn btn btn-info "  id="validacion_ficha" >Validar ficha de anteproyecto</button>
				  <input type="hidden"  id="validacion_estudiante" value="'.$id_lis_fi.'" ></input>

				 ';
				} else if ($id_estado_ficha_barra == 3) {
					echo '	<div class="progress">
						<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">60%</div>
					  </div>	
					  <h6>ESTADO: ficha de anteproyecto aprobado el proceso se encuentra a la espera de subir el proyecto de grado</h6>
					 ';
				} else if ($id_estado_ficha_barra == 6) {
					echo '	<div class="progress">
					<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 80%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">80%</div>
				  </div>	
				  <h6>ESTADO: El proyecto de grado se encuentra a al espera de su respectiva evaluacion</h6>
				 ';
				} else if ($id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {
					echo '	<div class="progress">
					<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">100%</div>
				  </div>	
				  <h6>ESTADO: El proyecto de grado ya fue finalizado</h6>
				 ';
				}

				?>

				<section>
					<h2>Titulo</h2>
				</section>



				<hr />

				<?php
				$consultaacamposficha = "SELECT fi.id_ficha,fi.titulo_ficha
				FROM lista_ficha lista, ficha fi 
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha
				AND fi.activo is null ";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {
					$titu_ficha = $record['titulo_ficha'];




					if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

						echo "				
						<button href='#edit_titu' class='btn btn-primary derechaubicacion' data-toggle='modal'> <i class='fa fa-pencil'></i></button>
	
						<div class='row'>
							<div class='col-lg-12'>
								<div class='form-group'>
									<p>$titu_ficha</p>
								</div>
							</div>
						</div>";
					} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {

						echo "				

	
						<div class='row'>
							<div class='col-lg-12'>
								<div class='form-group'>
									<p>$titu_ficha</p>
								</div>
							</div>
						</div>";
					}

				?>

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
								AND fi.activo is null
								AND campos.descripcion_campo LIKE '%Formulación del Problema%'";
				$resultset = mysqli_query($con, $consultaacamposficha1) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {
					$validarpreg = $record['valor_campo'];
				}
				$consultaacamposficha = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha
				FROM lista_ficha lista, ficha fi , campos_fichas campos
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha 
				AND fi.id_ficha = campos.fk_id_ficha 
				AND fi.activo is null
				AND campos.descripcion_campo LIKE '%Formulación del Problema%'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));


				if (isset($validarpreg)) {
					while ($record = mysqli_fetch_assoc($resultset)) {
						$valor_mostrar = $record['valor_campo'];
						$idcampo1 = $record['id_campo'];
						include("modal_campo_ficha.php");
					}


					if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

						echo "						<div class='row'>
						<div class='col-lg-12'>
							<div class='form-group'>
							<label class='col-form-label'>Formulación del Problema</label>
							<button href='#edit_$idcampo1' class='btn btn-primary derechaubicacion' data-toggle='modal'> <i class='fa fa-pencil'></i></button>
								<hr />
							
								<p> $valor_mostrar </p>
							</div>
						</div>
					</div>			";
					} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {

						echo "							<div class='row'>
						<div class='col-lg-12'>
							<div class='form-group'>
							<label class='col-form-label'>Formulación del Problema</label>

								<hr />
							
								<p> $valor_mostrar </p>
							</div>
						</div>
					</div>		";
					}
				} else {

					if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

						echo "

						<div class='row'>
							<div class='col-lg-12'>
								<div class='form-group'>
								<label class='col-form-label'>Formulación del Problema</label>
								<button href='#create_pregugen' class='btn btn-info derechaubicacion' data-toggle='modal'> <i class='fa fa-plus'></i></button>
			
							
								</div>
							</div>
						</div>
	
					";
					} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {
						echo "

						<div class='row'>
							<div class='col-lg-12'>
								<div class='form-group'>
								<label class='col-form-label'>Formulación del Problema</label>

			
							
								</div>
							</div>
						</div>
	
					";
					}
				}

				?>
				<!-- segundo modal-->
				<hr />

				<div class="modal fade" id="create_pregugen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">


								<h4 class="modal-title" id="myModalLabel"> Ingresar Formulación del Problema </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="container-fluname">
									<form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?ak=crear&nikfi=' . $id_lis_fi . '"'; ?>>
										<div class="modal-body">


											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-form-label">Formulación del Problema </label>

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
				<?php


				if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

					echo "	<label class='col-form-label'>Sistematización del problema </label>
				<button href='#create_pregu' class='btn btn-info derechaubicacion' data-toggle='modal'> <i class='fa fa-plus'></i></button> ";
				} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {

					echo "<label class='col-form-label'>Sistematización del problema</label> ";
				}
				?>


				<div class="modal fade" id="create_pregu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">


								<h4 class="modal-title" id="myModalLabel"> Sistematización del problema </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="container-fluname">
									<form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?ak=crear&nikfi=' . $id_lis_fi . '"'; ?>>
										<div class="modal-body">


											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-form-label">Sistematización del problema </label>

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
				AND fi.activo is null
				AND campos.activo is null
				AND campos.descripcion_campo LIKE '%Sistematización del problema%'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {

					include("modal_campo_ficha.php");

				?>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<hr />

								<?php

								if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

									echo "
									<a href='../../controlador/estudiante/editar_campos_ficha.php?aksi=delete&nik=" . $record["id_campo"] . "' class='btn btn-danger derechaubicacion' data-toggle='modal'> <i class='fa fa-trash-o'></i></a>
								
	
									<button href='#edit_" . $record["id_campo"] . "' class='btn btn-primary derechaubicacion' data-toggle='modal'> <i class='fa fa-pencil'></i></button>
	
									<p> " . $record["valor_campo"] . " </p>
									";
								} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {
									echo "
	
									<p> " . $record["valor_campo"] . " </p>
									";
								}
								?>

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
					<h2>Objetivos</h2>
				</section>
				<hr />

				<?php
				$consultaacamposficha1 = "SELECT fi.id_ficha, campos.id_campo,  campos.descripcion_campo,  campos.valor_campo,  campos.fk_id_ficha
				FROM lista_ficha lista, ficha fi , campos_fichas campos
				WHERE lista.id_lista_usuario=$id_s
				AND fi.id_ficha = lista.id_lista_ficha 
				AND fi.id_ficha = campos.fk_id_ficha 
				AND fi.activo is null
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
				AND fi.activo is null
				AND campos.descripcion_campo LIKE '%Objetivo general%'";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				if (isset($validarobj)) {
					while ($record = mysqli_fetch_assoc($resultset)) {
						$valor_mostrar = $record['valor_campo'];
						$idcampo1 = $record['id_campo'];
						include("modal_campo_ficha.php");
					}

					if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

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
					} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {

						echo "

						<div class='row'>
							<div class='col-lg-12'>
								<div class='form-group'>
								<label class='col-form-label'>Objetivo General </label>

									<hr />
								
									<p> $valor_mostrar </p>
								</div>
							</div>
						</div>
	
					";
					}
				} else {

					if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

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
					} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {

						echo "

						<div class='row'>
							<div class='col-lg-12'>
								<div class='form-group'>
								<label class='col-form-label'>Objetivo General </label>

			
							
								</div>
							</div>
						</div>
	
					";
					}
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

				<?php
				if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

					echo "
					<label for='' class='col-form-label'>Objetivos especificos </label>
					<button href='#create_obj' class='btn btn-info derechaubicacion' data-toggle='modal'> <i class='fa fa-plus'></i></button>
					
					";
				} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {

					echo "	<label for='' class='col-form-label'>Objetivos especificos </label>		";
				}


				?>


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
				AND fi.activo is null
				AND campos.activo is null
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

								if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

									echo "
									<a href='../../controlador/estudiante/editar_campos_ficha.php?aksi=delete&nik=" . $record["id_campo"] . "' class='btn btn-danger derechaubicacion' data-toggle='modal'> <i class='fa fa-trash-o'></i></a>
								
	
									<button href='#edit_" . $record["id_campo"] . "' class='btn btn-primary derechaubicacion' data-toggle='modal'> <i class='fa fa-pencil'></i></button>
	
									<p> " . $record["valor_campo"] . " </p>
									";
								} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {
									echo "
	
									<p> " . $record["valor_campo"] . " </p>
									";
								}
								?>
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
							<?php
							if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

								echo "		
								<label for='' class='col-form-label'>Ficha de anteproyecto:</label>
								<br />
								<a class='btn btn-info' href='documento.php?tipo=pdf& ficha=" . $ficha_id_final . " '; > <i class='fa fa-file-pdf-o'></i></a>
	
							
	
								<button id='btneditarficha' type='button' class='btn btn-primary editarficha' data-toggle='modal' tooltip-dir='top'><i class='fa fa-pencil'> </i></button>				";
							} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {
								echo "		
								<label for='' class='col-form-label'>Ficha de anteproyecto:</label>
								<br />
								<a class='btn btn-info' href='documento.php?tipo=pdf& ficha=" . $ficha_id_final . " '; > <i class='fa fa-file-pdf-o'></i></a>
				                ";
							}




							?>

						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?php
							if ($id_estado_ficha_barra == 2 or $id_estado_ficha_barra == 3 or $id_estado_ficha_barra == 6) {

								echo "		
								<label for='' class='col-form-label'>Anteproyecto completo:</label>
								<br />
								<a class='btn btn-info' href='documento.php?tipo=anteproyecto& ficha=" . $ficha_id_final . " '; > <i class='fa fa-file-pdf-o'></i></a>
	
							
	
								<button id='btneditarfichaanteproyecto' type='button' class='btn btn-primary editarficha' data-toggle='modal' tooltip-dir='top'><i class='fa fa-pencil'> </i></button>				";
							} else if ($id_estado_ficha_barra == 1 or $id_estado_ficha_barra == 4 or $id_estado_ficha_barra == 5) {
								echo "		
								<label for='' class='col-form-label'>Anteproyecto completo:</label>
								<br />
								<a class='btn btn-info' href='documento.php?tipo=anteproyecto& ficha=" . $ficha_id_final . " '; > <i class='fa fa-file-pdf-o'></i></a>
				                ";
							}




							?>

						</div>
					</div>


				</div>

				<hr />


				<?php

				$consultaacamposficha = "SELECT  *
                FROM evaluacion_anteproyecto
                WHERE id_lista_ficha_ante=$id_lis_fi
                AND evaluacion_anteproyecto.activo is null
                ";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {
					$eva_valid = $record['id_lista_ficha_ante'];
					$estadofin_camino = $record['estado'];



					if (isset($eva_valid)) {

						if ($estadofin_camino == 2) {
							$validacion_Esta_eva = 'En correccion';
						} else if ($estadofin_camino == 3) {
							$validacion_Esta_eva = 'Aprobado';
						}


						echo "
		

						

				<h2>Evaluacion de anteproyecto</h2>
				<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#demo'>visualizar evaluacion</button>
				<div id='demo' class='collapse'>
				<br/>
					<div class='card'>
						<div class='card-header'>
							<h3 class='card-title'>Evaluacion de ficha de anteproyecto</h3>
						</div>
						<!-- /.card-header -->
						<div class='card-body p-0'>
							<table class='table table-sm'>
								<thead>
									<tr>
										<th style='width: 10px'>#</th>
										<th>Parametro</th>
										<th style='width: 40px'>Valor</th>
									</tr>
								</thead>
	
								<tbody>


								<tr>
								<td class='bg-info'><h6></h6></td>
								<td class='bg-info'><h6>El problema de investigacion</h6></td>
								<td class='bg-info'></td>


							</tr>
									<tr>
										<td>1.</td>
										<td>PLANTEAMIENTO: Se describe claramente la situación actual (análisis causa-efecto) y la situación deseada</td>

										<td><span class='badge '>" . $record["planteamiento"] . "</span></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>FORMULACIÓN: Se formula claramente una macropregunta que sintetice el planteamiento realizado</td>

										<td><span class='badge '>" . $record["formulacion"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>SISTEMATIZACIÓN: Se formulan claramente algunas micropreguntas que jerarquizan la formulación previa</td>

										<td><span class='badge '>" . $record["sistematizacion"] . "</span></td>
									</tr>


									<tr>
									<td>4.</td>
									<td>" . $record["comentario_problema_investigacion"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>



								
								    <tr>
								    <td class='bg-info'><h6></h6></td>
							     	<td class='bg-info'><h6>OBJETIVOS</h6></td>
							     	<td class='bg-info'></td>
						     	    </tr>
									 								
								    <tr>
								    <td class='bg-warning'><h6></h6></td>
							     	<td class='bg-warning'><h6>General</h6></td>
							     	<td class='bg-warning'></td>
						     	    </tr>
							
							
									<tr>
										<td>1.</td>
										<td>Es claro, preciso y está bien planteado (redactado)</td>

										<td><span class='badge '>" . $record["objetivo_general_a"] . "</span></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>Guarda relación con el título</td>

										<td><span class='badge '>" . $record["objetivo_general_b"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Es coherente con la formulación del problema</td>

										<td><span class='badge '>" . $record["objetivo_general_c"] . "</span></td>
									</tr>

								    <tr>
								    <td class='bg-warning'><h6></h6></td>
							     	<td class='bg-warning'><h6>Especificos</h6></td>
							     	<td class='bg-warning'></td>
						     	    </tr>

									<tr>
										<td>1.</td>
										<td>Son claros, precisos y están bien planteados (redactados)</td>

										<td><span class='badge '>" . $record["objetivo_especifico_a"] . "</span></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>Son coherentes con la sistematización del problema</td>

										<td><span class='badge '>" . $record["objetivo_especifico_b"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Son coherentes con el Objetivo General</td>

										<td><span class='badge '>" . $record["objetivo_especifico_c"] . "</span></td>
									</tr>
							
									
									<tr>
									<td>4.</td>
									<td>" . $record["comentario_objetivo"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>



									  <tr>
									  <td class='bg-info'><h6></h6></td>
									   <td class='bg-info'><h6>RESULTADOS E IMPACTO ESPERADO</h6></td>
									   <td class='bg-info'></td>
									   </tr>

									   
									   <tr>
									   <td class='bg-warning'><h6></h6></td>
										<td class='bg-warning'><h6>RESULTADOS</h6></td>
										<td class='bg-warning'></td>
										</tr>

										<tr>
										<td>1.</td>
										<td>Especifica claramente resultados tangibles al finalizar el proyecto (prototipo, documento monográfico y articulo científico)</td>

										<td><span class='badge '>" . $record["resultado_a"] . "</span></td>
									</tr>										


									<tr>
										<td>2.</td>
										<td>Son coherentes con los objetivos específicos del proyecto y evidencian la solución al problema</td>

										<td><span class='badge '>" . $record["resultado_b"] . "</span></td>
									</tr>






										<tr>
										<td class='bg-warning'><h6></h6></td>
										 <td class='bg-warning'><h6>IMPACTOS</h6></td>
										 <td class='bg-warning'></td>
										 </tr>

										 <tr>
										 <td>1.</td>
										 <td>Se define claramente el impacto social y/o económico del proyecto</td>
 
										 <td><span class='badge '>" . $record["impacto_a"] . "</span></td>
									 </tr>

									<tr>
										<td>2.</td>
										<td>Se define claramente el impacto educativo, ingenieril y/o tecnológico</td>

										<td><span class='badge '>" . $record["impacto_b"] . "</span></td>
									</tr>

									<tr>
									<td>3.</td>
									<td>" . $record["comentario_problema_investigacion"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>

										 <tr>
										 <td class='bg-info'><h6></h6></td>
										  <td class='bg-info'><h6>JUSTIFICACION</h6></td>
										  <td class='bg-info'></td>
										  </tr>

										  

										  <tr>
										  <td>1.</td>
										  <td>INTERES: El Proyecto refleja el interés de los autores y puede ser de interés para alguna organización</td>
  
										  <td><span class='badge '>" . $record["interes"] . "</span></td>
									  </tr>


									<tr>
										<td>2.</td>
										<td>IMPORTANCIA: La temática es importante para la disciplina de estudio, el instituto, una empresa; suple una necesidad</td>

										<td><span class='badge '>" . $record["importancia"] . "</span></td>
									</tr>


									<tr>
										<td>3.</td>
										<td>UTILIDAD: El proyecto es útil o aplicable en algún contexto (institución educativa, empresa)</td>

										<td><span class='badge '>" . $record["utilidad"] . "</span></td>
									</tr>


									<tr>
										<td>4.</td>
										<td>FACTIBILIDAD: Existe posibilidad por factor tiempo, recurso humano, técnico y cognitivo de llevarlo a cabo</td>

										<td><span class='badge '>" . $record["factibilidad_gen"] . "</span></td>
									</tr>

									<tr>
										<td>5.</td>
										<td>PERTINENCIA: Tiene relación directa o indirecta con la carrera que esta cursando</td>

										<td><span class='badge '>" . $record["pertinencia"] . "</span></td>
									</tr>

									<tr>
									<td>6.</td>
									<td>" . $record["comentario_justificacion"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>

										  <tr>
										  <td class='bg-info'><h6></h6></td>
										   <td class='bg-info'><h6>MARCO DE REFERENCIA
                                           </h6></td>
										   <td class='bg-info'></td>
										   </tr>

										   <tr>
										   <td class='bg-warning'><h6></h6></td>
											<td class='bg-warning'><h6>HISTÓRICO</h6></td>
											<td class='bg-warning'></td>
											</tr>

									<tr>
										<td>1.</td>
										<td>La propuesta señala referentes institucionales realizados previamente</td>

										<td><span class='badge '>" . $record["historico_a"] . "</span></td>
									</tr>											

									<tr>
										<td>2.</td>
										<td>Señala estudios previos realizados en otras instituciones</td>

										<td><span class='badge '>" . $record["historico_b"] . "</span></td>
									</tr>


									<tr>
										<td>3.</td>
										<td>Señala los aportes de estos trabajos al proyecto a desarrollar</td>

										<td><span class='badge '>" . $record["historico_c"] . "</span></td>
									</tr>





											<tr>
											<td class='bg-warning'><h6></h6></td>
											 <td class='bg-warning'><h6>CONTEXTUAL</h6></td>
											 <td class='bg-warning'></td>
											 </tr>

											 <tr>
											 <td>1.</td>
											 <td>Describe el Contexto en el cual piensa desarrollar el proyecto</td>
	 
											 <td><span class='badge '>" . $record["contextual"] . "</span></td>
										 </tr>											 








											 <tr>
											 <td class='bg-warning'><h6></h6></td>
											  <td class='bg-warning'><h6>TEÓRICO</h6></td>
											  <td class='bg-warning'></td>
											  </tr>

											  
											  <tr>
											  <td>1.</td>
											  <td>Se desarrollan los elementos teóricos y tecnológicos del proyecto</td>
	  
											  <td><span class='badge '>" . $record["teorico_a"] . "</span></td>
										  </tr>



									<tr>
										<td>2.</td>
										<td>Realizan la citación bibliográfica adecuada para la estructuración teórica</td>

										<td><span class='badge '>" . $record["teorico_b"] . "</span></td>
									</tr>


									<tr>
										<td>3.</td>
										<td>Refleja construcción propia y/o análisis teórico</td>

										<td><span class='badge '>" . $record["teorico_c"] . "</span></td>
									</tr>






											  <tr>
											  <td class='bg-warning'><h6></h6></td>
											   <td class='bg-warning'><h6>CONCEPTUAL</h6></td>
											   <td class='bg-warning'></td>
											   </tr>

											   

									<tr>
										<td>1.</td>
										<td>Define la terminología específica del proyecto</td>

										<td><span class='badge '>" . $record["conceptual"] . "</span></td>
									</tr>












											   <tr>
											   <td class='bg-warning'><h6></h6></td>
												<td class='bg-warning'><h6>LEGAL</h6></td>
												<td class='bg-warning'></td>
												</tr>

												
									<tr>
										<td>1.</td>
										<td>Especifica aspectos legales que tienen impacto dentro del proyecto</td>

										<td><span class='badge '>" . $record["legal"] . "</span></td>
									</tr>







									<tr>
									<td>1.</td>
									<td>" . $record["comentario_marco"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>



												<tr>
												<td class='bg-info'><h6></h6></td>
												 <td class='bg-info'><h6>METODOLOGÍA</h6></td>
												 <td class='bg-info'></td>
												 </tr>

												 
									<tr>
										<td>1.</td>
										<td>Se formula el tipo de estudio de manera clara y precisa</td>

										<td><span class='badge '>" . $record["metodologia_a"] . "</span></td>
									</tr>


									<tr>
										<td>2.</td>
										<td>Se plantean las técnicas y fuentes de recolección de información</td>

										<td><span class='badge '>" . $record["metodologia_b"] . "</span></td>
									</tr>


									<tr>
										<td>3.</td>
										<td>Se exponen los argumentos para las elecciones anteriores</td>

										<td><span class='badge '>" . $record["metodologia_c"] . "</span></td>
									</tr>



									<tr>
										<td>4.</td>
										<td>Se definen claramente las etapas del proceso de investigación</td>

										<td><span class='badge '>" . $record["metodologia_d"] . "</span></td>
									</tr>

									<tr>
									<td>5.</td>
									<td>" . $record["comentario_metodologia"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>

												 <tr>
												 <td class='bg-info'><h6></h6></td>
												  <td class='bg-info'><h6>CRONOGRAMA DE ACTIVIDADES
												  </h6></td>
												  <td class='bg-info'></td>
												  </tr>

												  

									<tr>
										<td>1.</td>
										<td>Las etapas de la investigación siguen un proceso lógicoa</td>

										<td><span class='badge '>" . $record["cronograma_a"] . "</span></td>
									</tr>

									<tr>
										<td>2.</td>
										<td>El tiempo asignado para cada etapa es el apropiado</td>

										<td><span class='badge '>" . $record["cronograma_b"] . "</span></td>
									</tr>

									<tr>
										<td>3.</td>
										<td>La tabla o gráfico utilizado es de fácil interpretación</td>

										<td><span class='badge '>" . $record["cronograma_c"] . "</span></td>
									</tr>



									<tr>
									<td>4.</td>
									<td>" . $record["comentario_cronograma"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>



												  <tr>
												  <td class='bg-info'><h6></h6></td>
												   <td class='bg-info'><h6>RECURSOS Y PRESUPUESTO
												   </h6></td>
												   <td class='bg-info'></td>
												   </tr>


									<tr>
										<td>1.</td>
										<td>El recurso humano es suficiente y adecuado para el tema de investigación</td>

										<td><span class='badge '>" . $record["recurso_a"] . "</span></td>
									</tr>												   
									<tr>
										<td>2.</td>
										<td>Se utilizan diferentes recursos institucionales (bibliotecas, universidades, empresas…)</td>

										<td><span class='badge '>" . $record["recurso_b"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Especifica los recursos técnicos que se utilizarán en el proyecto</td>

										<td><span class='badge '>" . $record["recurso_c"] . "</span></td>
									</tr>
									<tr>
										<td>4.</td>
										<td>Se presenta correctamente el análisis presupuestal</td>

										<td><span class='badge '>" . $record["recurso_d"] . "</span></td>
									</tr>

									<tr>
									<td>5.</td>
									<td>" . $record["comentario_recurso"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>

																					  <tr>
												  <td class='bg-info'><h6></h6></td>
												   <td class='bg-info'><h6>REFERENCIAS BIBLIOGRAFÍCAS

												   </h6></td>
												   <td class='bg-info'></td>
												   </tr>
			  
									<tr>
										<td>1.</td>
										<td>El proyecto tiene diversas fuentes bibliográficas y refleja una exhaustiva revisión de la temática</td>

										<td><span class='badge '>" . $record["referencias_a"] . "</span></td>
									</tr>


									<tr>
										<td>2.</td>
										<td>Utiliza fuentes bibliográficas clásicas y vigentes dentro del campo de acción del proyecto</td>

										<td><span class='badge '>" . $record["referencias_b"] . "</span></td>
									</tr>

									<tr>
										<td>3.</td>
										<td>Utiliza fuentes bibliográficas actualizadas, confiables y con relación directa con el proyecto</td>

										<td><span class='badge '>" . $record["referencias_c"] . "</span></td>
									</tr>


									<tr>
									<td>4.</td>
									<td>" . $record["comentario_referencias"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>
												  <tr>
												  <td class='bg-info'><h6></h6></td>
												   <td class='bg-info'><h6>ANALISIS GENERAL

												   </h6></td>
												   <td class='bg-info'></td>
												   </tr>
			  
									<tr>
										<td>1.</td>
										<td>TÍTULO: Refleja claramente el tema tratado</td>

										<td><span class='badge '>" . $record["titulo"] . "</span></td>
									</tr>

									<tr>
										<td>2.</td>
										<td>NIVEL INVESTIGATIVO: La complejidad del trabajo amerita el desarrollo de un Proyecto de Grado</td>

										<td><span class='badge '>" . $record["nivel_investigativo"] . "</span></td>
									</tr>

									<tr>
										<td>3.</td>
										<td>FACTIBILIDAD: Posibilidades de realización (tiempo, conocimiento, recurso humano, técnico y económico)</td>

										<td><span class='badge '>" . $record["factibilidad"] . "</span></td>
									</tr>												   





												  <tr>
												  <td class='bg-warning'><h6></h6></td>
												   <td class='bg-warning'><h6>DOCUMENTO
												   </h6></td>
												   <td class='bg-warning'></td>
												   </tr>

									<tr>
										<td>4.</td>
										<td>Aplicación de Normas ICONTEC</td>

										<td><span class='badge '>" . $record["documento_a"] . "</span></td>
									</tr>
									
									<tr>
										<td>5.</td>
										<td>Redacción y Ortografía</td>

										<td><span class='badge '>" . $record["documento_b"] . "</span></td>
									</tr>									

									<tr>
										<td>6.</td>
										<td>Presentación general</td>

										<td><span class='badge '>" . $record["documento_c"] . "</span></td>
									</tr>
									<tr>
									<td>7.</td>
									<td>" . $record["concepto_genera"] . "</td>

									<td><span class='badge  bg-warning '>Comentario</span></td>
								    </tr>

									<tr>
									<td>8.</td>
									<td>" . $validacion_Esta_eva . "</td>

									<td><span class='badge  bg-warning '>estado</span></td>
								    </tr>
			  
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
                       ";
					} else {
						echo '	<section>
					<h4>No se ha realizado la evaluacion del anteproyecto</h1>
				</section>';
					}
				}
				?>

				<hr />



				<?php

				$path = "../../controlador/estudiante/proyecto/" . $ficha_id_final;
				if (file_exists($path)) {

					echo '	<section>
				<h1>Proyecto </h1>
			    </section>
			    <hr />';

					echo '

				   <div class="row">

				   <div class="col-lg-12">
					   <div class="form-group">
						   <label for="" class="col-form-label">Documento proyecto de grado:</label>
						   <br />
						   <a class="btn btn-info"  href="documento.php?tipo=proyecto& ficha=' . $ficha_id_final . '  "; > <i class="fa fa-file-pdf-o"></i></a>	

						   <button id="btneditarproyecto" type="button" class="btn btn-primary editarficha" data-toggle="modal" tooltip-dir="top"><i class="fa fa-pencil"> </i></button>  
						   </div>
				   </div>
			   </div>';
				} else {
					echo '	<section>
					<h4>No se ha subido el proyecto de grado</h1>
				</section>';
				}
				?>

				<hr />


				<?php

				$path = "../../controlador/estudiante/actas/" . $ficha_id_final;
				if (file_exists($path)) {

					echo '	<section>
				<h2>Actas de proyecto </h2>
			    </section>
			    <hr />';

					echo '

				   <div class="row">

				   <div class="col-lg-12">
					   <div class="form-group">
						   <label for="" class="col-form-label">Actas de encuentros:</label>
						   <br />
						   <a class="btn btn-info"  href="documento.php?tipo=actas& ficha=' . $ficha_id_final . '  "; > <i class="fa fa-file-pdf-o"></i></a>					   </div>
				   </div>
			   </div>';
				} else {
					echo '	<section>
					<h4>No se ha subido las actas del director</h1>
				</section>';
				}
				?>

				<hr />


				<?php

				$consultaacamposficha = "SELECT  *
                FROM evaluacion_proyecto
                WHERE id_lista_ficha_eva=$id_lis_fi
                AND evaluacion_proyecto.activo is null
                ";
				$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

				while ($record = mysqli_fetch_assoc($resultset)) {
					$id_evaluacion_anteproyecto = $record['id_evaluacion_anteproyecto'];


					if (isset($id_evaluacion_anteproyecto)) {
						echo "
		

						

			    	<h2>Evaluacion de Proyecto de grado</h2>
			     	<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#demoficha'>visualizar proyecto</button>
				    <div id='demoficha' class='collapse'>
				    <br/>
					<div class='card'>
						<div class='card-header'>
							<h3 class='card-title'>Evaluacion de Proyecto de grado</h3>
						</div>
						<!-- /.card-header -->
						<div class='card-body p-0'>
							<table class='table table-sm'>
								<thead>
									<tr>
										<th style='width: 10px'>#</th>
										<th>Parametro</th>
										<th style='width: 40px'>Valor</th>
									</tr>
								</thead>
	
								<tbody>


								<tr>
								<td class='bg-info'><h6></h6></td>
								<td class='bg-info'><h6>A. TRABAJO ESCRITO (VALORACION 20%):
								</h6></td>
								<td class='bg-info'>" . $record["a"] . "</td>


							</tr>
									<tr>
										<td>1.</td>
										<td>A.1 Presentación general del documento (incluye aplicación de normas)
										</td>

										<td><span class='badge '>" . $record["a1"] . "</span></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>A.2 Calidad en la redacción y pertinencia de la información (incluye referencias utilizadas)
										</td>

										<td><span class='badge '>" . $record["a2"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>A3. El producto de divulgación desarrollado cumple con estándares para la publicación (Obligatorio Profesional Universitario y Opcional Tecnologías)
										</td>

										<td><span class='badge '>" . $record["a3"] . "</span></td>
									</tr>

									


								
								    <tr>
								    <td class='bg-info'><h6></h6></td>
							     	<td class='bg-info'><h6>B. PROCESO DE DESARROLLO DEL PROYECTO (VALORACION 25%):
									 </h6></td>
							     	<td class='bg-info'> " . $record["b"] . "</td>
						     	    </tr>
									 								

							
									<tr>
										<td>1.</td>
										<td>B.1 Existe coherencia entre la formulación de problema y el desarrollo de la solución
										</td>

										<td><span class='badge '>" . $record["b1"] . "</span></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>B.2 Se cumplen los objetivos propuestos
										</td>

										<td><span class='badge '>" . $record["b2"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>B.3 El marco referencial fue suficiente y apropiado para aplicar al proyecto
										</td>

										<td><span class='badge '>" . $record["b3"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>B.4 La Metodología establecida se evidenció en el desarrollo del proyecto

										</td>

										<td><span class='badge '>" . $record["b4"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>B.5 La implementación del proyecto fue completa y de calidad

										</td>

										<td><span class='badge '>" . $record["b5"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>B.6 Los Resultados del proyecto corresponden a los resultados esperados

										</td>

										<td><span class='badge '>" . $record["b6"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>B.7 Las Conclusiones son relevantes y dan razón de lo logrado en proyecto

										</td>

										<td><span class='badge '>" . $record["b7"] . "</span></td>
									</tr>



									
								
								    <tr>
								    <td class='bg-info'><h6></h6></td>
							     	<td class='bg-info'><h6>C. SUSTENTACION DEL PROYECTO (VALORACION 15%):

									 </h6></td>
							     	<td class='bg-info'>" . $record["c"] . " </td>
						     	    </tr>
									 								

							
									<tr>
										<td>1.</td>
										<td>C.1 Se muestran dominio del del proceso de desarrollo del proyecto

										</td>

										<td><span class='badge '>" . $record["c1"] . "</span></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>C.2 Realizan un adecuado manejo del tiempo

										</td>

										<td><span class='badge '>" . $record["c2"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>C.3 Utilizan una adecuada expresión oral y corporal

										</td>

										<td><span class='badge '>" . $record["c3"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>C.4 El Vocabulario técnico es apropiado


										</td>

										<td><span class='badge '>" . $record["c4"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>C.5 Da respuestas claras y coherentes a las inquitudes de los jurados


										</td>

										<td><span class='badge '>" . $record["c5"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>C.6 Utilización de forma correcta las ayudas audiovisuales disponibles


										</td>

										<td><span class='badge '>" . $record["c6"] . "</span></td>
									</tr>
																		<tr>
										<td>3.</td>
										<td>C.7 Presentan una buena presentación personal


										</td>

										<td><span class='badge '>" . $record["c7"] . "</span></td>
									</tr>

								
								    <tr>
								    <td class='bg-info'><h6></h6></td>
							     	<td class='bg-info'><h6>D. CUMPLIMIENTO DEL PROCESO DE DESARROLLO Y CALIDAD DEL PROYECTO (40%)

									 </h6></td>
							     	<td class='bg-info'>" . $record["d"] . " </td>
						     	    </tr>
									 								

							
									<tr>
										<td>1.</td>
										<td>D.1 El (Los) estudiantes cumplieron con el desarrollo del proyecto con responsabilidad y compromiso

										</td>

										<td><span class='badge '>" . $record["d1"] . "</span></td>
									</tr>
									<tr>
										<td>2.</td>
										<td>D.2 El (Los) estudiantes apropiaron técnicas y procesos que contribuyeron al logro de los objetivos

										</td>

										<td><span class='badge '>" . $record["d2"] . "</span></td>
									</tr>
									<tr>
										<td>3.</td>
										<td>D.3 El (Los) estudiantes demostraron interés por seguir avanzando en el desarrollo de otras soluciones y etapas del proyecto

										</td>

										<td><span class='badge '>" . $record["d3"] . "</span></td>
									</tr>


						
								    <td class='bg-info'><h6></h6></td>
							     	<td class='bg-info'><h6>NOTA FINAL

									 </h6></td>
							     	<td class='bg-info'></td>
						     	    </tr>

									 <tr>
									 <td>3.</td>
									 <td>NOTA


									 </td>

									 <td><span class='badge '>" . $record["nota_final"] . "</span></td>
								 </tr>


								 <tr>
								 <td>3.</td>
								 <td>ESTADO


								 </td>

								 <td><span class='badge '>" . $record["estado_eva_pro"] . "</span></td>
							 </tr>

									 		
						
			  
								</tbody>
							</table>
						</div>
			
					</div>
                       ";
					} else {
						echo '	<section>
					<h4>No se ha realizado la evaluacion del proyecto de grado</h1>
				</section>';
					}
				}

				?>


			</div>
		</div>






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
									$sql = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista_usuario=$nik AND lista_ficha.activo is null");
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
													echo "<div id='".$archivo ."' idficha='".$id."' data='" . $path . "/" . $archivo . "'>
										<a href = '" . $path . "/" . $archivo . "'
										title = 'Ver Archivo Adjunto'>
										<span class='fa fa-file-pdf-o' aria-hidden='true'></span></a>";

													echo "$archivo <a href ='#' id = 'delete'
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
									$sql = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista_usuario=$nik AND lista_ficha.activo is null" );
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
													echo "<div id='".$archivo ."' idficha='".$id."' data='" . $path . "/" . $archivo . "'>
										<a href = '" . $path . "/" . $archivo . "'
										title = 'Ver Archivo Adjunto'>
										<input type=hidden >
										<span class='fa fa-file-pdf-o' aria-hidden='true'></span></a>";

													echo "$archivo <a href ='#' id = 'deleteante'
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



		<div class="modal fade" id="modalCRUDPROYECTO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
									$sql = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista_usuario=$nik AND lista_ficha.activo is null");
									while ($record = mysqli_fetch_assoc($sql)) {
										$id = $record['id_lista_ficha'];
									}
									$path = "../../controlador/estudiante/proyecto/" . $id;

									if (is_dir($path)) {

										$verifi = @scandir($path);
									}
									if (count($verifi) >  2) {
										if (file_exists($path)) {
											$directorio = opendir($path);
											while ($archivo = readdir($directorio)) {
												if (!is_dir($archivo)) {
													echo "<div id='".$archivo ."' idficha='".$id."' data='" . $path . "/" . $archivo . "'>
										<a href = '" . $path . "/" . $archivo . "'
										title = 'Ver Archivo Adjunto'>
										<input type=hidden >
										<span class='fa fa-file-pdf-o' aria-hidden='true'></span></a>";

													echo "$archivo <a href ='#' id = 'deleteproyecto'
										title = 'Eliminar Archivo Adjunto'>
										
										<span class='fa fa-trash' aria-hidden='true'></span></a></div>";

													echo "<iframe src='../../controlador/estudiante/proyecto/$id/$archivo' width='400'> </iframe>";
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
							<button input type="submit" name="modanpro" class="btn btn-dark">Guardar</button>
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