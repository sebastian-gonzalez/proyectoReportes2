<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#" />
	<title>Facultad</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<!-- CSS personalizado -->
	<link rel="stylesheet" href="../../assets/mainTable.css">


	<!--datables CSS básico-->
	<link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css" />
	<!--datables estilo bootstrap 4 CSS-->
	<script src="../../assets/js/jquery-3.5.1.js"></script>
	<link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
	<link rel="icon" href="../../assets/images/favicon.ico" type="image/gif" />


</head>

<body>

	<?php

	include('../../controlador/conexion.php');


	if (isset($_GET['aksi']) == 'delete') {
		// escaping, additionally removing everything that could be (html/javascript-) code

		$nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
		$cek = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista='$nik' ");
		echo '<input type="hidden" class="clas_inabi_yaca"  value ="' . $nik . '"> ';

		if (mysqli_num_rows($cek) > 0) {
			echo "<script>   

	
	
				var inhabilitar=$('.clas_inabi_yaca').val();
			Swal.fire({
				title: 'Inactivar Participante',
				text: 'deseas Inactivar esta Participante?!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'si , inactivar'
			}).then((result) => {
				if (result.isConfirmed) {
			
				
					$.ajax({
					
						url: '../../controlador/coordinador/inhabilitarparticipante.php',
						type: 'POST',
						datatype: 'json',
						data: {id_lista_usuario: inhabilitar },
						success: function () {

							location.href='../../vista/rol_coordinador/revision_fichas_director.php'
						},
					  });
	
	
				}else{
					location.href='../../vista/rol_coordinador/revision_fichas_director.php'
				}
	
			}) 
	
			</script>";
		}
	}
	?>
</body>

<!-- jQuery, Popper.js, Bootstrap JS -->

<script src="../../assets/popper/popper.min.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>


<!-- jQuery -->

<script src="../../assets/js/nav/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->