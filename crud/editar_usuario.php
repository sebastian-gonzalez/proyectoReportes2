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


<?php
include("../include/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de usuario</title>

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
			<h2>Datos del Usuario &raquo; Editar datos</h2>
			<hr />

			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_usuario='$nik'");


			if (mysqli_num_rows($sql) == 0) {
				header("Location: ./usuarios.php");
			} else {
				$row = mysqli_fetch_assoc($sql);
			}
			if (isset($_POST['add'])) {

				$Cedula = mysqli_real_escape_string($con, (strip_tags($_POST['cedula_usu'], ENT_QUOTES))); //Escanpando caracteres 	
				$Nombre = mysqli_real_escape_string($con, (strip_tags($_POST['nombre_usu'], ENT_QUOTES))); //Escanpando caracteres 		                                    
				$Apellido = mysqli_real_escape_string($con, (strip_tags($_POST["apellido_usu"], ENT_QUOTES))); //Escanpando caracteres 
				$Correo	= mysqli_real_escape_string($con, (strip_tags($_POST["correo_usu"], ENT_QUOTES))); //Escanpando caracteres 
				$Contrasena	= mysqli_real_escape_string($con, (strip_tags($_POST["contrasena_usu"], ENT_QUOTES))); //Escanpando caracteres 
				$Rol_id	= mysqli_real_escape_string($con, (strip_tags($_POST["id_rol_usu"], ENT_QUOTES))); //Escanpando caracteres 
				$Programa_id	= mysqli_real_escape_string($con, (strip_tags($_POST["id_programa_usu"], ENT_QUOTES))); //Escanpando caracteres 





				$update = mysqli_query($con, "UPDATE usuarios  SET cedula_usu='$Cedula',nombre_usu='$Nombre', apellido_usu='$Apellido', correo_usu='$Correo', contrasena_usu='$Contrasena', id_rol_usu='$Rol_id', id_programa_usu='$Programa_id' WHERE id_usuario='$nik'") or die(mysqli_error($con));
				if ($update) {
					header("Location: ./usuarios.php?nik=" . $nik . "&pesan=sukses");
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}

			if (isset($_GET['pesan']) == 'sukses') {
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>

			<form class="form-horizontal" action="" method="post">


				<div class="form-group">
					<label class="col-sm-3 control-label">Cedula</label>
					<div class="col-sm-4">
						<input type="number" name="cedula_usu" value="<?php echo $row['cedula_usu']; ?>" class="form-control" placeholder="Cedula" required>
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" name="nombre_usu" value="<?php echo $row['nombre_usu']; ?>" class="form-control" placeholder="Nombre" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Apellido</label>
					<div class="col-sm-4">
						<input type="text" name="apellido_usu" class="form-control" value="<?php echo $row['apellido_usu']; ?>" placeholder="Apellido" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Correo</label>
					<div class="col-sm-4">
						<input name="correo_usu" class="form-control" value="<?php echo $row['correo_usu']; ?>" placeholder="Correo">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Contraseña</label>
					<div class="col-sm-4">
						<input name="contrasena_usu" class="form-control" value="<?php echo $row['contrasena_usu']; ?>" placeholder="Contraseña">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Rol</label>
					<div class="col-sm-4">

						<select name="id_rol_usu" name="id_rol_usu" id="id_rol_usu" class="form-control" required>
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

				<br>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn  btn-primary" value="Guardar datos">
						<input type="submit" class="btn  btn-danger" onclick="window.location='./usuarios.php';" value="Cancelar" />
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