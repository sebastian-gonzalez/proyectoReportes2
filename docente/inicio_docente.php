<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 2) {
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
	<title>Docente</title>

	<!-- Bootstrap -->
	<link href="../css/bootstrap1.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">

	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>

<body>

	<?php include('nav.php'); ?>

	<div class="container">
		<div class="content">

			<h2>Info Docente </h2>

			<hr />

			<?php
			if (isset($_GET['aksi']) == 'delete') {
				// escaping, additionally removing everything that could be (html/javascript-) code

				$nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM usuarios  WHERE id='$nik'");
				if (mysqli_num_rows($cek) == 0) {
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				} else {

					$delete = mysqli_query($con, "DELETE FROM usuarios  WHERE id='$nik'");
					if ($delete) {
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					} else {
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="get">

				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filtrar por rol</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if ($filter == '1') {
												echo 'selected';
											} ?>>Administrador</option>
						<option value="2" <?php if ($filter == '2') {
												echo 'selected';
											} ?>>Docente</option>
						<option value="3" <?php if ($filter == '3') {
												echo 'selected';
											} ?>>Coordinador</option>
						<option value="4" <?php if ($filter == '4') {
												echo 'selected';
											} ?>>Estudiante</option>

					</select>

				</div>

			</form>

			<br />
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>

						<th>Código</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Correo</th>
						<th>Contraseña</th>
						<th>Rol</th>
						<th>Tipo_Rol</th>

					</tr>
					<?php
					if ($filter) {
						$sql = mysqli_query($con, "SELECT * FROM usuarios WHERE rol_id='$filter' ORDER BY id ASC");
					} else {
						$sql = mysqli_query($con, "SELECT * FROM usuarios ORDER BY id ASC");
					}
					if (mysqli_num_rows($sql) == 0) {
						echo '<tr><td colspan="8">No hay datos.</td></tr>';
					} else {
						$no = 1;
						while ($row = mysqli_fetch_assoc($sql)) {
							echo '
						<tr>
						
							<td>' . $row['id'] . '</td>
							<td>' . $row['nombre'] . '</td>
                            <td>' . $row['apellido'] . '</td>
							<td>' . $row['correo'] . '</td>
							<td>' . $row['contrasena'] . '</td>
							<td>' . $row['rol_id'] . '</td>
							<td>';
							if ($row['rol_id'] == '1') {
								echo '<span class="label label-success">Administrador </span>';
							} else if ($row['rol_id'] == '2') {
								echo '<span class="label label-info">Docente</span>';
							} else if ($row['rol_id'] == '3') {
								echo '<span class="label label-info">Coordinador</span>';
							} else if ($row['rol_id'] == '4') {
								echo '<span class="label label-info">Estudiante</span>';
							}
							echo '
							</td>
							<td>

								<a href="editar_usuario.php?nik=' . $row['id'] . '" title="Editar datos" class="	"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="usuarios.php?aksi=delete&nik=' . $row['id'] . '" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos del usuario ' . $row['nombre'] . '?\')" class=" "><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
							$no++;
						}
					}
					?>
				</table>
			</div>
		</div>
	</div>
	<center>
		<p>&copy; Sistemas Web <?php echo date("Y"); ?></p </center>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
		</script>
		<script src="../js/bootstrap.min.js"></script>
</body>

</html>