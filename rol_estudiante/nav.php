<?php
include_once '../include/database.php';

$db = new Database();
$id_s = $_SESSION['id_usuario'];


$query_ficha = $db->connect()->prepare("SELECT *FROM lista_ficha WHERE id_lista_usuario =$id_s");
$query_ficha->execute();
$row_ficha = $query_ficha->fetch(PDO::FETCH_NUM);


if ($row_ficha == true) {
	$id_lis = $row_ficha[0];
	$_SESSION['id_lista'] = $id_lis;

	$id_lis_u = $row_ficha[1];
	$_SESSION['id_lista_usuario'] = $id_lis_u;

	$id_lis_fi = $row_ficha[2];
	$_SESSION['id_lista_ficha'] = $id_lis_fi;

	$id_rol_fi = $row_ficha[3];
	$_SESSION['id_rol_ficha'] = $id_rol_fi;
}
?>


<!DOCTYPE html>



<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="../assets/navegador/style_nav.css">

	 
</head>


<body>
	<?php

	if (!isset($_SESSION['id_lista_ficha'])) {


		echo ' 
			<!-- MODAL CREAR FICHA -->
	<nav class="sidebar-navigation">
			<ul>
				<a href="inicio_estudiante.php">
					<li>
						<i class="fa fa-home"></i>
						<span class="tooltip tooltip_letra">Inicio</span>
					</li>
				</a>
				<a href="primer_ingreso.php">
					<li>
						<i class="fa fa-plus-square-o"></i>
						<span class="tooltip tooltip_letra">Crear Ficha</span>
					</li>
				</a>
				
				<a href="../logout.php">
					<li>
						<i class="fa fa-power-off" aria-hidden="true"></i>
						<span class="tooltip tooltip_letra">Cerrar Sesion</span>
					</li>
				</a>
			</ul>
		</nav> 
		';
	} else {

		echo ' 
			<!-- MODAL GESTION FICHA -->
			<nav class="sidebar-navigation">
				<ul>
					<a href="inicio_estudiante.php">
						<li>
							<i class="fa fa-home"></i>
							<span class="tooltip tooltip_letra">Inicio</span>
						</li>
					</a>
					<a href="fichas.php">
						<li>
							<i class="fa fa-book"></i>
							<span class="tooltip tooltip_letra">Gestion Ficha</span>
						</li>
					</a>
					<a href="documento.php">
						<li>
							<i class="fa fa-file-pdf-o"></i>
							<span class="tooltip tooltip_letra">Ver documento</span>
						</li>
					</a>
					<a href="../logout.php">
						<li>
							<i class="fa fa-power-off" aria-hidden="true"></i>
							<span class="tooltip tooltip_letra">Cerrar Sesion</span>
						</li>
					</a>
				</ul>
			</nav> 
			';
	}
	?>




	<!-- partial -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="../assets/navegador/script_nav.js"></script>
	<script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>
	

</body>

</html>