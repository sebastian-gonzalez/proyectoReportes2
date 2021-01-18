<?php

session_start();

if (!isset($_SESSION['id_rol_usu'])) {
	header('location: ../login.php');
} else {
	if ($_SESSION['id_rol_usu'] != 3) {
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
	<title>Coordinador</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/mainTable.css">
	<link rel="icon" href="images/favicon.ico" type="image/gif" />



</head>

<body>
	<?php include('nav.php'); ?>

	<div class="container">
		<div class="content">
			<br></br>
			<br></br>
			<h2>Información Coordinador</h2>

			<section>
				<h1>Bienvenido(a) <?php echo $_SESSION['nombre_usu']; ?></h1>
			</section>
			<hr />

			<center>
				<img src="../images/uniajc.png" width="50%">
			</center>

</body>

</html>