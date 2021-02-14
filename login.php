<?php
include_once 'controlador/database.php';
//Inicializar la sesión
session_start();




if (isset($_GET['cerrar_sesion'])) {
	session_unset();

	// destroy the session 
	session_destroy();
}

if (isset($_SESSION['id_rol_usu'])) {
	switch ($_SESSION['id_rol_usu']) {
			//administrador
		case 1:
			header('location: vista/rol_admin/inicio_admin.php');
			break;
			//docente
		case 2:
			header('location: vista/rol_docente/inicio_docente.php');
			break;
			//coordinador
		case 3:
			header('location: vista/rol_coordinador/inicio_coordinador.php');
			break;
			//estudiante
		case 4:
			header('location: vista/rol_estudiante/inicio_estudiante.php');
			break;

		default:
	}
}

if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
	$correo = $_POST['correo'];
	$contrasenas = htmlentities(addslashes($_POST['contrasena']));
	$db = new Database();

	$query = $db->connect()->prepare('SELECT *FROM usuarios WHERE correo_usu = :correo');
	$query->execute(['correo' => $correo]);
	$user = $query->fetch();

	$validar_hash=password_verify($contrasenas , $user['contrasena_usu']);

	if ($validar_hash) {

		$id_s = $user['id_usuario'];
		$_SESSION['id_usuario'] = $id_s;

		$nombre = $user['cedula_usu'];
		$_SESSION['cedula_usu'] = $nombre;

		$nombre = $user['nombre_usu'];
		$_SESSION['nombre_usu'] = $nombre;

		$nombre = $user['apellido_usu'];
		$_SESSION['apellido_usu'] = $nombre;

		$nombre = $user['correo_usu'];
		$_SESSION['correo_usu'] = $nombre;

		$rol = $user['id_rol_usu'];
		$_SESSION['id_rol_usu'] = $rol;

		$programa = $user['id_programa_usu'];
		$_SESSION['id_programa_usu'] = $programa;
	

		switch ($rol) {

				//administrador
			case 1:
				header('location: vista/rol_admin/inicio_admin.php');

				break;
				//docente
			case 2:
				header('location: vista/rol_docente/inicio_docente.php');
				break;
				//coordinador
			case 3:
				header('location: vista/rol_coordinador/inicio_coordinador.php');
				break;
				//estudiante
			case 4:
				
				header('location: vista/rol_estudiante/inicio_estudiante.php');
				break;

			default:
		}
	} else{

		// no existe el usuario

	header("location: login.php?fallo=true");
	}
}




?>



<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="assets/css/loginn.css">
	<link rel="icon" href="assets/images/favicon.ico" type="image/gif" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<img class="wave" src="assets/images/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="assets/images/login/bg.svg">
		</div>
		<div class="login-content">
			<form action="" method="POST">
				<?php
				if (isset($_GET["fallo"]) && $_GET["fallo"] == 'true') {
					echo "<div style='color:red'>Usuario o contraseña incorrecta </div>";
				}
				?>
				<img src="assets/images/login/avatar.svg">
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
	<script type="text/javascript" src="assets/js/login.js"></script>
</body>

</html>


