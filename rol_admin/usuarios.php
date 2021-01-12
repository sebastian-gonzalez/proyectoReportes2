<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 1) {
		header('location: ../login.php');
	}
}


?>

<?php include("../include/conexion.php"); ?>

<!doctype html>
<html lang="en">

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
	<link rel="icon" href="images/favicon.ico" type="image/gif" />

</head>

<body>
	<?php include('nav.html'); ?>

	<header>

	</header>
	<br></br>
	<br></br>


	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<button id="btnNuevo" type="button" class="btn btn-primary" data-toggle="modal"><i class="material-icons">library_add</i></button>
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

	<!--Modal para CRUD-->
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
									<input type="text" class="form-control" id="contrasena_usu" required>
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

	<!-- jQuery, Popper.js, Bootstrap JS -->
	<script src="../assets/jquery/jquery-3.3.1.min.js"></script>
	<script src="../assets/popper/popper.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

	<!-- datatables JS -->
	<script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>

	<script type="text/javascript" src="../include/admin/js/usuarios.js"></script>


</body>

</html>