<?php

session_start();

if (!isset($_SESSION['rol'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['rol'] != 1) {
		header('location: ../login.php');
	}
}


?>



<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nuevo Usuario</title>

	<!-- Bootstrap -->

	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/bootstrap1.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>

<body>

	<?php include("nav.php"); ?>

	<div class="container">
		<div class="content">
			<h2>formulario&raquo; Agregar nuevo usuario</h2>
			<hr />

			<?php
			if (isset($_POST['add'])) {

				$Cedula = mysqli_real_escape_string($con, (strip_tags($_POST['cedula'], ENT_QUOTES))); //Escanpando caracteres 	
				$Nombre = mysqli_real_escape_string($con, (strip_tags($_POST['nombre'], ENT_QUOTES))); //Escanpando caracteres 		                                    
				$Apellido = mysqli_real_escape_string($con, (strip_tags($_POST["apellido"], ENT_QUOTES))); //Escanpando caracteres 
				$Correo	= mysqli_real_escape_string($con, (strip_tags($_POST["correo"], ENT_QUOTES))); //Escanpando caracteres 
				$Contrasena	= mysqli_real_escape_string($con, (strip_tags($_POST["contrasena"], ENT_QUOTES))); //Escanpando caracteres 
				$Rol_id	= mysqli_real_escape_string($con, (strip_tags($_POST["rol_id"], ENT_QUOTES))); //Escanpando caracteres 
				$Facultad_id	= mysqli_real_escape_string($con, (strip_tags($_POST["facultad_idd"], ENT_QUOTES))); //Escanpando caracteres 

				$insert = mysqli_query($con, "INSERT INTO usuarios (cedula,nombre,apellido,correo,contrasena,rol_id,facultad_idd)
															VALUES('$Cedula','$Nombre', '$Apellido','$Correo','$Contrasena', '$Rol_id', '$Facultad_id')") or die(mysqli_error($con));

				if ($insert) {
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">

				<div class="form-group">
					<label class="col-sm-3 control-label">Cedula</label>
					<div class="col-sm-4">
						<input type="number" name="cedula" class="form-control" placeholder="cedula" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" class="form-control" placeholder="nombre" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-4">
						<input type="text" name="apellido" class="form-control" placeholder="apellido" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Correo</label>
					<div class="col-sm-4">
						<input type="email" name="correo" class="form-control" placeholder="correo" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Contraseña</label>
					<div class="col-sm-4">
						<input type="text" name="contrasena" class="form-control" placeholder="contrasena" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Rol</label>
					<div class="col-sm-4">

						<select name="rol_id" name="rol_id" id="rol_id" class="form-control" required>
							<option disabled selected value="">Seleccione el rol</option>
							<option value="1">Administrador</option>
							<option value="2">Docente</option>
							<option value="3">Coordinador</option>
							<option value="4">Estudiante</option>
						</select>
					</div>

				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Facultad perteneciente</label>
					<div class="col-sm-4">
						<select name="facultad_idd" name="facultad_idd" id="facultad_idd" class="form-control" required>

							<?php
							$sql = mysqli_query($con, "SELECT * FROM facultades  ");
							echo '	<option disabled selected value="">Seleccione la facultad</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_f"] . '">' . $valores["nombre_facu"] . '</option>';
							}
							?>
						</select>
					</div>
				</div>

				<br>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">

					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('.date').datepicker({
			format: 'dd-mm-yyyy',
		})
	</script>
</body>

</html>