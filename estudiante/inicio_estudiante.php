<?php

session_start();

if (!isset($_SESSION['rol'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['rol'] != 4) {
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
	<title>Estudiante</title>

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

			<h2>Info estudiante</h2>

			<section>
				<h1>Bienvenido <?php echo $_SESSION['nombre']; ?></h1>
			</section>
			<hr />
			<center>
				<p>&copy; Sistemas Web <?php echo date("Y"); ?></p </center> <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
				</script>
				<script src="../js/bootstrap.min.js"></script>
</body>

</html>