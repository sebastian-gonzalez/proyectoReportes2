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

$id_usuario=$_SESSION['id_usuario'];
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
	<title>Perfil Administrador</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/mainTable.css">
    <link rel="stylesheet" href="../css/perfil.css">
	<link rel="icon" href="images/favicon.ico" type="image/gif" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>




</head>

<body>
	<?php include('nav.html'); ?>

	<div class="container">
		<div class="content">
			<br></br>
			<br></br>
            <div  class="titulo">
			<h1 > <i class="fa fa-user-circle-o  order-md-2"></i>Perfil UNIAJC</h1>
            </div>
            <br/>
			<hr />
            <hr />

            <?php
			$sql = "SELECT*FROM usuarios WHERE id_usuario=$id_usuario";
							$resultset = mysqli_query($con, $sql) or die("database error:" . mysqli_error($con));

							while($record = mysqli_fetch_assoc($resultset)) {

                            
							?>

<div class="row featurette">
  <div class="col-md-7 order-md-2 ">

  <div class="campo col-md-12">
    <h3 >Nombre:</h3>
   
    <h4><?php echo $record['nombre_usu']; ?></h4>
    <hr />

    </div>

    <div class="campo col-md-12">
    <h3 >Apellido:</h3>
   
    <h4><?php echo $record['apellido_usu']; ?></h4>
    <hr />

    </div>

    <div class="campo col-md-12">
    <h3 >Cedula:</h3>
   
    <h4><?php echo $record['cedula_usu']; ?></h4>
    <hr />

    </div>

    <div class="campo col-md-12">
    <h3 >Correo:</h3>
   
    <h4><?php echo $record['correo_usu']; ?></h4>
    <hr />

    </div>


  </div>
  <div class="col-md-5 order-md-1">

  <img src="../images/uniajc.png" width="100%">
  
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>

  
<center>  <button id="btneditarusuarios" type="button" class="btn btn-info editarusuario" data-toggle="modal" tooltip-dir="top" ><i class="material-icons">Editar usuario </i></button> </center>
 

  </div>

</div>




<div class="modal fade" id="modalCRUD1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="edit_profile.php">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="" class="col-form-label">Cedula:</label>
									<input type="number" class="form-control" value="<?php echo  $_SESSION['cedula_usu']; ?>" name="cedula_usu" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="" class="col-form-label">Nombre</label>
									<input type="text" class="form-control"value="<?php echo $record['nombre_usu']; ?>" name="nombre_usu" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group" >
									<label for="" class="col-form-label">Apellido</label>
									<input type="text" class="form-control" value="<?php echo $record['apellido_usu']; ?>" name="apellido_usu" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="" class="col-form-label">Correo</label>
									<input type="text" class="form-control"value="<?php echo $record['correo_usu']; ?>" name="correo_usu"required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-9">
								<div class="form-group">
									<label for="" class="col-form-label">Contraseña</label>
									<input type="password" class="form-control" name="contrasena_usu">
								</div>
							</div>
						</div>



					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
						<button type="submit"  name="edit_profile" class="btn btn-dark">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <?php



} ?>

	<!-- jQuery, Popper.js, Bootstrap JS -->
	<script src="../assets/jquery/jquery-3.3.1.min.js"></script>
	<script src="../assets/popper/popper.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

	<!-- datatables JS -->
	<script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>

	<script type="text/javascript" src="../include/admin/js/usuarios.js"></script>

</body>

</html>