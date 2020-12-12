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
			<h2>Formulario&raquo; Agregar Nuevo Programa</h2>
			<hr />

			<?php
			if (isset($_POST['add'])) {


				$Nombre = mysqli_real_escape_string($con, (strip_tags($_POST['nombre_prog'], ENT_QUOTES))); //Escanpando caracteres 		                                    
				$Titulo = mysqli_real_escape_string($con, (strip_tags($_POST["titulo"], ENT_QUOTES))); //Escanpando caracteres 
				$Facultad_id	= mysqli_real_escape_string($con, (strip_tags($_POST["facultad_id"], ENT_QUOTES))); //Escanpando caracteres 


				$insert = mysqli_query($con, "INSERT INTO programas (nombre_prog,titulo,facultad_id)
															VALUES('$Nombre', '$Titulo','$Facultad_id')") or die(mysqli_error($con));

				if ($insert) {
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">

				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre del Programa</label>
					<div class="col-sm-4">
						<input type="text" name="nombre_prog" class="form-control" placeholder="nombre_prog" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo adquirido</label>
					<div class="col-sm-4">
						<input type="text" name="titulo" class="form-control" placeholder="titulo" required>
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-3 control-label">Facultad perteneciente</label>
					<div class="col-sm-4">
						<select name="facultad_id" required name="facultad_id" id="facultad_id" required class="form-control">
							<option value=""></option>
							<?php
							$sql = mysqli_query($con, "SELECT * FROM facultades  ");
							echo '	<option value="" disabled selected>Seleccione la facultad</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_f"] . '">' . $valores["nombre_facu"] . '</option>';
							}
							?>
						</select>
					</div>
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