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

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de ficha</title>

	<!-- Bootstrap -->

	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/bootstrap1.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

	<script type="text/javascript" src="../assets/js/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.delete').click(function() {

				var parent = $(this).parent().attr('id');
				var service = $(this).parent().attr('data');
				var dataString = 'id=' + service;
				$.ajax({
					type: "POST",
					url: "del_documento.php",
					data: dataString,
					succes: function() {
						window.location.reload(true);

						un
					}
				});

			});

		});
	</script>
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
			<h2>Datos de Ficha &raquo; Editar datos</h2>
			<hr />

			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = $_SESSION['id_usuario'];
			$sql = mysqli_query($con, "SELECT * FROM fichas WHERE usuario_id='$nik'");


			if (mysqli_num_rows($sql) == 0) {
				header("Location: ./fichas.php");
			} else {
				$row = mysqli_fetch_assoc($sql);
			}
			if (isset($_POST['add'])) {
				$Usuario_id = $_SESSION['id_usuario'];
				$Titulo = mysqli_real_escape_string($con, (strip_tags($_POST["titulo"], ENT_QUOTES))); //Escanpando caracteres 
				$Facultad_id = $_SESSION['facultad_idd'];
				$Jurado	= 1;
				$Evaluador	= 1;
				$Estado_id	= 1;
				$Compa_id = mysqli_real_escape_string($con, (strip_tags($_POST["compa_id"], ENT_QUOTES))); //Escanpando caracteres 
				$Director_id = mysqli_real_escape_string($con, (strip_tags($_POST["director_id"], ENT_QUOTES))); //Escanpando caracteres 





				$update = mysqli_query($con, "UPDATE fichas  SET titulo='$Titulo', programa_id='$Facultad_id', jurado='$Jurado', evaluador='$Evaluador', estado_id='$Estado_id', compa_id='$Compa_id', director_id='$Director_id' WHERE usuario_id='$nik'") or die(mysqli_error($con));
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



				if ($update) {
					header("Location: ./fichas.php?nik=" . $nik . "&pesan=sukses");
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}

			if (isset($_GET['pesan']) == 'sukses') {
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">


				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo</label>
					<div class="col-sm-4">
						<input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" class="form-control" placeholder="Titulo" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Director</label>
					<div class="col-sm-4">
						<select name="director_id" id="director_id" value="<?php echo $row['director_id']; ?>" class="form-control custom-select" required>

							<?php
							$sql = mysqli_query($con, "SELECT * FROM usuarios  WHERE rol_id = 2 AND facultad_idd = 1");
							echo '	<option disabled selected value="">Seleccione su director</option>';

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
						<select name="compa_id" id="compa_id" value="<?php echo $row['compa_id']; ?>" class="form-control custom-select" required>

							<?php
							$Usuario_id = $_SESSION['id_usuario'];
							$sql = mysqli_query($con, "SELECT * FROM usuarios  WHERE rol_id = 4 AND id_usuario != $Usuario_id");
							echo '	<option disabled selected value="">Seleccione su compañero</option>';

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
						<?php
						$id = $nik;
						$path = "../pdf/" . $id;
						if (file_exists($path)) {
							$directorio = opendir($path);
							while ($archivo = readdir($directorio)) {
								if (!is_dir($archivo)) {
									echo "<div data='" . $path . "/" . $archivo . "'>
									<a href = '" . $path . "/" . $archivo . "'
									title = 'Ver Archivo Adjunto'>
									<span class='glyphicon glyphicon-folder-close'></span></a>";
									echo "$archivo <a href= 'editar_ficha.php' class= 'delete'
									title = 'Eliminar Archivo Adjunto'>
									<span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></div>";
									echo "<iframe src='../pdf/$id/$archivo' width='300'> </iframe>";
								}
							}
						}

						?>
					</div>
				</div>





				<br>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="./fichas.php" class="btn btn-danger">Cancelar</a>
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