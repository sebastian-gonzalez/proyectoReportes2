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
	<title>Datos de Programas academicos</title>

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
			<h2>Datos del Programa &raquo; Editar Programa</h2>
			<hr />

			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM programa WHERE id_programa='$nik'");


			if (mysqli_num_rows($sql) == 0) {
				header("Location: ./programas.php");
			} else {
				$row = mysqli_fetch_assoc($sql);
			}
			if (isset($_POST['add'])) {
				$Nombre = mysqli_real_escape_string($con, (strip_tags($_POST['nombre_pro'], ENT_QUOTES))); //Escanpando caracteres 
				$Titulo = mysqli_real_escape_string($con, (strip_tags($_POST['titulo_pro'], ENT_QUOTES))); //Escanpando caracteres 
				$Facu_id = mysqli_real_escape_string($con, (strip_tags($_POST['id_facultad_pro'], ENT_QUOTES))); //Escanpando caracteres 		                                    

				$update = mysqli_query($con, "UPDATE programa SET nombre_pro='$Nombre', 
				
				titulo_pro='$Titulo',id_facultad_pro='$Facu_id' WHERE id_programa='$nik'") or die(mysqli_error($con));



				if ($update) {
					header("Location: ./programas.php?nik=" . $nik . "&pesan=sukses");
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
					<label class="col-sm-3 control-label">Nombre Programa</label>
					<div class="col-sm-4">
						<input type="text" name="nombre_pro" value="<?php echo $row['nombre_pro']; ?>" class="form-control" placeholder="Nombre Prograna" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo Otorgado</label>
					<div class="col-sm-4">
						<input type="text" name="titulo_pro" value="<?php echo $row['titulo_pro']; ?>" class="form-control" placeholder="Titulo Programa" required>
					</div>
				</div>



				<div class="form-group">
					<label class="col-sm-3 control-label">Facultad perteneciente</label>
					<div class="col-sm-4">
						<select name="id_facultad_pro" name="id_facultad_pro" id="id_facultad_pro" class="form-control" required>
							<?php
							$sql = mysqli_query($con, "SELECT * FROM facultad  ");
							echo '	<option value="" disabled selected>Seleccione la facultad</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_facultad"] . '">' . $valores["nombre_facultad"] . '</option>';
							}
							?>
						</select>
					</div>
				</div>




				<br>
				<div class=" form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn  btn-primary " value="Guardar datos">
						<input type="submit" class="btn  btn-danger" onclick="window.location='./programas.php';" value="Cancelar" />
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