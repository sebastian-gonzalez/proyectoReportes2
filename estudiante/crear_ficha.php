<?php

session_start();

$_SESSION['id_usuario'];

if (!isset($_SESSION['rol'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['rol'] != 4) {
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
	<!--
Project      : Datos de empleados con PHP, MySQLi y Bootstrap CRUD  (Create, read, Update, Delete) 
Author		 : Obed Alvarado
Website		 : http://www.obedalvarado.pw
Blog         : http://obedalvarado.pw/blog/
Email	 	 : info@obedalvarado.pw
-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ficha</title>

	<!-- Bootstrap -->

	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/bootstrap1.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

	<?php include("nav.php"); ?>

	<div class="container">
		<div class="content">
			<h2>Formulario&raquo; Agregar Ficha</h2>
			<hr />

			<?php
			if (isset($_POST['add'])) {
				$Usuario_id = $_SESSION['id_usuario'];
				$Titulo = mysqli_real_escape_string($con, (strip_tags($_POST["titulo"], ENT_QUOTES))); //Escanpando caracteres 
				$Programa_id = mysqli_real_escape_string($con, (strip_tags($_POST["programa_id"], ENT_QUOTES))); //Escanpando caracteres 
				$Jurado	= mysqli_real_escape_string($con, (strip_tags($_POST["jurado"], ENT_QUOTES))); //Escanpando caracteres 
				$Evaluador	= mysqli_real_escape_string($con, (strip_tags($_POST["evaluador"], ENT_QUOTES))); //Escanpando caracteres 
				$Estado_id	= mysqli_real_escape_string($con, (strip_tags($_POST["estado_id"], ENT_QUOTES))); //Escanpando caracteres 
				$Compa_id = mysqli_real_escape_string($con, (strip_tags($_POST["compa_id"], ENT_QUOTES))); //Escanpando caracteres 
				$Director_id = mysqli_real_escape_string($con, (strip_tags($_POST["director_id"], ENT_QUOTES))); //Escanpando caracteres 


				$insert = mysqli_query($con, "INSERT INTO fichas (usuario_id,titulo,programa_id, jurado, evaluador,estado_id,compa_id,director_id)

				VALUES('$Usuario_id','$Titulo','$Programa_id', '$Jurado', '$Evaluador', '$Estado_id', '$Compa_id', '$Director_id')") or die(mysqli_error($con));



				$id_insert = $Usuario_id;

				if ($_FILES["archivo"]["error"] > 0) {
					echo "Error al cargar archvio";
				} else {
					$permitidos = array('application/pdf');
					$limite_kb = 200000000;
					if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024) {
						$ruta = "../pdf/$id_insert/";



						$archivo = $ruta . $_FILES["archivo"]["name"];

						if (!file_exists($ruta)) {
							mkdir($ruta);
						}
						if (!file_exists($archivo)) {
							$resultado = @move_uploaded_file(
								$_FILES["archivo"]["tmp_name"],
								$archivo
							);
						}

						if ($resultado) {
							echo "archivo guardado";
						} else {
							echo " archivo no guardado";
						}
					} else {

						echo "el archivo no esta permitido o excede el tamaño maximo";
					}
				}







				if ($insert) {
					echo '<script type="text/javascript">
					alert("Tarea Guardada");
					window.location.href="inicio_estudiante.php";
					</script>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">


				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo</label>
					<div class="col-sm-4">
						<input type="text" name="titulo" class="form-control" placeholder="Titulo" required>
					</div>
				</div>



				<div class="form-group">
					<label class="col-sm-3 control-label">Programa Perteneciente</label>
					<div class="col-sm-4">
						<select name="programa_id" required name="programa_id" id="programa_id" required class="form-control">
							<option value=""></option>
							<?php
							$sql = mysqli_query($con, "SELECT * FROM programas  ");
							echo '	<option value="" disabled selected>Seleccione el programa</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_p"] . '">' . $valores["nombre_prog"] . '</option>';
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Jurado</label>
					<div class="col-sm-4">
						<select name="jurado" required name="jurado" id="jurado" required class="form-control">
							<option value=""></option>
							<?php
							$sql = mysqli_query($con, "SELECT * FROM usuarios  WHERE rol_id = 2 ");
							echo '	<option value="" disabled selected>Seleccione su jurado</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre"] . ' ' . $valores["apellido"] . '</option>';
							}
							?>
						</select>
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-3 control-label">Evaluador</label>
					<div class="col-sm-4">
						<select name="evaluador" required name="evaluador" id="evaluador" required class="form-control">
							<option value=""></option>
							<?php
							$sql = mysqli_query($con, "SELECT * FROM usuarios  WHERE rol_id = 2 ");
							echo '	<option value="" disabled selected>Seleccione su evaluador</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre"] . ' ' . $valores["apellido"] . '</option>';
							}
							?>
						</select>
					</div>
				</div>





				<div class="form-group">
					<label class="col-sm-3 control-label">Director</label>
					<div class="col-sm-4">
						<select name="director_id" required name="director_id" id="director_id" required class="form-control">
							<option value=""></option>
							<?php
							$sql = mysqli_query($con, "SELECT * FROM usuarios  WHERE rol_id = 2 ");
							echo '	<option value="" disabled selected>Seleccione su director</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre"] . ' ' . $valores["apellido"] . '</option>';
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Compañero</label>
					<div class="col-sm-4">
						<select name="compa_id" required name="compa_id" id="compa_id" required class="form-control">
							<option value=""></option>
							<?php
							$sql = mysqli_query($con, "SELECT * FROM usuarios  WHERE rol_id = 4 ");
							echo '	<option value="" disabled selected>Seleccione su compañero</option>';

							while ($valores = mysqli_fetch_array($sql)) {

								echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre"] . ' ' . $valores["apellido"] . '</option>';
							}
							?>
						</select>
					</div>
				</div>





				<div class="form-group">
					<label class="col-sm-3 control-label">Documento</label>
					<div class="col-sm-4">
						<input type="file" name="archivo" required>

					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-4">
						<select name="estado_id" required name="estado_id" id="estado_id" class="form-control>
			            <option value=">--Selecciona--</option>
							<option value="1">En revision</option>
							<option value="2">En correccion</option>
							<option value="3">Pendiente a evaluacion</option>
							<option value="4">Aprobado</option>
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