<?php
session_start();
//Finalizacion de la session transcurridos 10 minutos
$minutosparafinalizar = 10;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutosparafinalizar * 60))) {
	session_unset();     // unset $_SESSION   
	session_destroy();   // destroy session data  
	echo '<script language="javascript">alert("Tiempo de la session expirado");</script>';
	header('location: ../login.php');
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

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
	<title>Información Administrador</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/mainTable.css">
	<link rel="icon" href="images/favicon.ico" type="image/gif" />



</head>

<body>
	<?php include('nav.html'); ?>

	<div class="container">
		<div class="content">
			<br></br>
			<br></br>
			<h2>Administrador</h2>

			<section>
				<h1>Bienvenido(a) <?php echo $_SESSION['nombre_usu']; ?></h1>
			</section>
			<hr />

			<center>
				<img src="../images/uniajc.png" width="50%">
			</center>

</body>

</html>