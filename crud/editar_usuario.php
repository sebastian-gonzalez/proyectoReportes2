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
	<title>Datos de empleados</title>

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
				$Nombre = mysqli_real_escape_string($con, (strip_tags($_POST['nombre'], ENT_QUOTES))); //Escanpando caracteres 		                                    
				$Apellido = mysqli_real_escape_string($con, (strip_tags($_POST["apellido"], ENT_QUOTES))); //Escanpando caracteres 
				$Correo	= mysqli_real_escape_string($con, (strip_tags($_POST["correo"], ENT_QUOTES))); //Escanpando caracteres 
				$Contrasena	= mysqli_real_escape_string($con, (strip_tags($_POST["contrasena"], ENT_QUOTES))); //Escanpando caracteres 

				$Rol_id	= mysqli_real_escape_string($con, (strip_tags($_POST["rol_id"], ENT_QUOTES))); //Escanpando caracteres 





				$update = mysqli_query($con, "UPDATE usuarios  SET nombre='$Nombre', apellido='$Apellido', correo='$Correo', contrasena='$Contrasena', rol_id='$Rol_id' WHERE id_usuario='$nik'") or die(mysqli_error($con));
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
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control" placeholder="nombre" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Apellido</label>
					<div class="col-sm-4">
						<input type="text" name="apellido" class="form-control" value="<?php echo $row['apellido']; ?>" placeholder="apellido" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Correo</label>
					<div class="col-sm-3">
						<input name="correo" class="form-control" value="<?php echo $row['correo']; ?>" placeholder="correo">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Contraseña</label>
					<div class="col-sm-3">
						<input name="contrasena" class="form-control" value="<?php echo $row['contrasena']; ?>" placeholder="contrasena">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Rol</label>
					<select name="rol_id" required name="rol_id" id="rol_id" value="<?php echo $row['rol_id']; ?>" class="form-control>
			<option value=">--Selecciona--</option>
						<option value="1">Administrador</option>
						<option value="2">Docente</option>
						<option value="3">Coordinador</option>
						<option value="4">Estudiante</option>
					</select>
				</div>

				<br>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn  btn-primary " value="Guardar datos">
						<a href="./usuarios.php" class="btn btn-danger">Cancelar</a>
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