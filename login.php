<?php
include_once 'database.php';
//Inicializar la sesión
session_start();




if (isset($_GET['cerrar_sesion'])) {
	session_unset();

	// destroy the session 
	session_destroy();
}

if (isset($_SESSION['rol'])) {
	switch ($_SESSION['rol']) {
			//administrador
		case 1:
			header('location: crud/usuarios.php');
			break;
			//docente
		case 2:
			header('location: docente/inicio_docente.php');
			break;
			//coordinador
		case 3:
			header('location: coordinador/inicio_coordinador.php');
			break;
			//estudiante
		case 4:
			header('location: estudiante/inicio_estudiante.php');
			break;

		default:
	}
}

if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
	$correo = $_POST['correo'];
	$contrasena = htmlentities(addslashes($_POST['contrasena']));
	$db = new Database();

	$query = $db->connect()->prepare('SELECT *FROM usuarios WHERE correo = :correo AND contrasena = :contrasena');
	$query->execute(['correo' => $correo, 'contrasena' => $contrasena]);

	$row = $query->fetch(PDO::FETCH_NUM);

	if ($row == true) {
		$id_s = $row[0];
		$_SESSION['id_usuario'] = $id_s;
		$nombre = $row[2];
		$_SESSION['nombre'] = $nombre;
		$facultad = $row[7];
		$_SESSION['facultad_idd'] = $facultad;
		$rol = $row[6];
		$_SESSION['rol'] = $rol;

		switch ($rol) {

				//administrador
			case 1:
				header('location: crud/usuarios.php');

				break;
				//docente
			case 2:
				header('location: docente/inicio_docente.php');
				break;
				//coordinador
			case 3:
				header('location: coordinador/inicio_coordinador.php');
				break;
				//estudiante
			case 4:
				header('location: estudiante/inicio_estudiante.php');
				break;

			default:
		}
	} else if ($row == false) {

		// no existe el usuario

		header("location: login.php?fallo=true");
	}
}




?>



<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/loginn.css">
	<link rel="icon" href="images/favicon.ico" type="image/gif" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<img class="wave" src="images/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="images/login/bg.svg">
		</div>
		<div class="login-content">
			<form action="" method="POST">
				<?php
				if (isset($_GET["fallo"]) && $_GET["fallo"] == 'true') {
					echo "<div style='color:red'>Usuario o contraseña invalido </div>";
				}
				?>
				<img src="images/login/avatar.svg">
				<h2 class="title">Bienvenido</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Correo</h5>
						<input type="email" name="correo" class="input" required>

					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Contraseña</h5>
						<input type="password" name="contrasena" class="input" required>
					</div>
				</div>

				<input type="submit" class="btn" value="Ingresar">
				<input class="btn" type="button" value="Regresar" onclick="location.href='index.php';">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/login.js"></script>
</body>

</html>