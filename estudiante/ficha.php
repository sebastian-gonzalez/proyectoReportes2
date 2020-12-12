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


				$Titulo = mysqli_real_escape_string($con, (strip_tags($_POST['titulo'], ENT_QUOTES))); //Escanpando caracteres 		                                    
				$Planteamiento = mysqli_real_escape_string($con, (strip_tags($_POST["planteamiento"], ENT_QUOTES))); //Escanpando caracteres 
				$Formulacion = mysqli_real_escape_string($con, (strip_tags($_POST["formulacion"], ENT_QUOTES))); //Escanpando caracteres 
				$Programa_id = mysqli_real_escape_string($con, (strip_tags($_POST["programa_id"], ENT_QUOTES))); //Escanpando caracteres 
                $Sistematizacion	= mysqli_real_escape_string($con, (strip_tags($_POST["sistematizacion"], ENT_QUOTES))); //Escanpando caracteres 
                $Objetivo_general	= mysqli_real_escape_string($con, (strip_tags($_POST["objetivo_general"], ENT_QUOTES))); //Escanpando caracteres 
                $Objetivo_especifico	= mysqli_real_escape_string($con, (strip_tags($_POST["objetivos_especificos"], ENT_QUOTES))); //Escanpando caracteres 
                $Impacto_proyecto	= mysqli_real_escape_string($con, (strip_tags($_POST["impacto_proyecto"], ENT_QUOTES))); //Escanpando caracteres 
                $Marco_contextual	= mysqli_real_escape_string($con, (strip_tags($_POST["marco_contextual"], ENT_QUOTES))); //Escanpando caracteres 
                $Marco_legal	= mysqli_real_escape_string($con, (strip_tags($_POST["marco_legal"], ENT_QUOTES))); //Escanpando caracteres 
                $Marco_otro	= mysqli_real_escape_string($con, (strip_tags($_POST["marco_otro"], ENT_QUOTES))); //Escanpando caracteres 
                $Jurado	= mysqli_real_escape_string($con, (strip_tags($_POST["jurado"], ENT_QUOTES))); //Escanpando caracteres 
                $Evaluador	= mysqli_real_escape_string($con, (strip_tags($_POST["evaluador"], ENT_QUOTES))); //Escanpando caracteres 
                $Metodologia	= mysqli_real_escape_string($con, (strip_tags($_POST["metodologia"], ENT_QUOTES))); //Escanpando caracteres 
                $Alcance	= mysqli_real_escape_string($con, (strip_tags($_POST["alcance"], ENT_QUOTES))); //Escanpando caracteres 
                $Documento	= mysqli_real_escape_string($con, (strip_tags($_POST["documento"], ENT_QUOTES))); //Escanpando caracteres 
                $Observacion_general	= mysqli_real_escape_string($con, (strip_tags($_POST["observacion_general"], ENT_QUOTES))); //Escanpando caracteres 
                $Director_id	= mysqli_real_escape_string($con, (strip_tags($_POST["director_id"], ENT_QUOTES))); //Escanpando caracteres 
                $User_id	= mysqli_real_escape_string($con, (strip_tags($_POST["usuario_id"], ENT_QUOTES))); //Escanpando caracteres 
                $Estado_id	= mysqli_real_escape_string($con, (strip_tags($_POST["estado_id"], ENT_QUOTES))); //Escanpando caracteres 
                $Cronograma	= mysqli_real_escape_string($con, (strip_tags($_POST["cronograma"], ENT_QUOTES))); //Escanpando caracteres 
             

				$insert = mysqli_query($con, "INSERT INTO fichas (titulo,planteamiento,formulacion,programa_id,sistematizacion,objetivo_general,objetivos_especificos,impacto_proyecto,marco_contextual,
                marco_legal,marco_otro,jurado,jurado,metodologia,alcance,documento,observacion_general,director_id,usuario_id,estado_id,cronograma )
				VALUES('$Titulo', '$Planteamiento','$Formulacion','$Programa_id', '$Sistematizacion','$Objetivo_general', '$Objetivo_especifico','$Impacto_proyecto',
                '$Marco_contextual', '$Marco_legal', '$Marco_otro', '$Jurado', '$Evaluador', '$Metodologia', '$Alcance, '$Documento', '$Observacion_general', '$Director_id', '$User_id', '$Estado_id', '$Cronograma')") or die(mysqli_error($con));

				if ($insert) {
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">

				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo de la Ficha</label>
					<div class="col-sm-4">
						<input type="text" name="titulo" class="form-control" placeholder="titulo" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Planteamiento</label>
					<div class="col-sm-4">
						<input type="text" name="planteamiento" class="form-control" placeholder="planteamiento" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Formulacion</label>
					<div class="col-sm-4">
						<input type="text" name="formulacion" class="form-control" placeholder="formulacion" required>
					</div>
				</div>
///////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Id Programa</label>
					<div class="col-sm-4">
						<input type="text" name="contrasena" class="form-control" placeholder="contrasena" required>
					</div>
				</div>
////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Sistematizacion</label>
					<div class="col-sm-4">
						<input type="text" name="sistematizacion" class="form-control" placeholder="sistematizacion" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Objetivo General</label>
					<div class="col-sm-4">
						<input type="text" name="contrasena" class="form-control" placeholder="contrasena" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Objetivos Especificos</label>
					<div class="col-sm-4">
						<input type="text" name="objetivos_especificos" class="form-control" placeholder="objetivos_especificos" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Impacto del proyecto</label>
					<div class="col-sm-4">
						<input type="text" name="impacto_proyecto" class="form-control" placeholder="impacto_proyecto" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Marco Contextual</label>
					<div class="col-sm-4">
						<input type="text" name="marco_contextual" class="form-control" placeholder="marco_contextual" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Marco Legal</label>
					<div class="col-sm-4">
						<input type="text" name="marco_legal" class="form-control" placeholder="marco_legal" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Marco Otro</label>
					<div class="col-sm-4">
						<input type="text" name="marco_otro" class="form-control" placeholder="marco_otro" required>
					</div>

				</div>
///////////////////////////////////////////////////////////////////////
                  <div class="form-group">
					<label class="col-sm-3 control-label">Jurado</label>
					<div class="col-sm-4">
						<input type="text" name="jurado" class="form-control" placeholder="jurado" required>
					</div>
				</div>
////////////////////////////////////////////////////
////////////////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Evaluador</label>
					<div class="col-sm-4">
						<input type="text" name="evaluador" class="form-control" placeholder="evaluador" required>
					</div>
				</div>
////////////////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Metodologia</label>
					<div class="col-sm-4">
						<input type="text" name="metodologia" class="form-control" placeholder="metodologia" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Alcance</label>
					<div class="col-sm-4">
						<input type="text" name="alcance" class="form-control" placeholder="alcance" required>
					</div>
				</div>
///////////////////////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Documento</label>
					<div class="col-sm-4">
						<input type="text" name="contrasena" class="form-control" placeholder="contrasena" required>
					</div>
				</div>
///////////////////////////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Observacion General</label>
					<div class="col-sm-4">
						<input type="text" name="observacion_general" class="form-control" placeholder="observacion_general" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Director</label>
					<div class="col-sm-4">
						<input type="text" name="director_id" class="form-control" placeholder="director_id" required>
					</div>
				</div>
////////////////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Usuario id</label>
					<div class="col-sm-4">
						<input type="text" name="usuario_id" class="form-control" placeholder="usuario_id" required>
					</div>
				</div>
///////////////////////////////////////////////////
                <div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-4">
						<input type="text" name="estado_id" class="form-control" placeholder="estado_id" required>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">Cronograma</label>
					<div class="col-sm-4">
						<input type="text" name="cronograma" class="form-control" placeholder="cronograma" required>
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