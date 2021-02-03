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


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Importacion de usuarios</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/mainTable.css">
  <link rel="icon" href="images/favicon.ico" type="image/gif" />

</head>

<body>
  <?php include('nav.html'); 
  include('../include/conexion.php');
  ?>
  <div class="container">
    <div class="content">
      <br />
      <br />
      <br />
      <br />
      <br />
      <h2 align="center">Importar Usuarios mediante archivo Excel</h2>
      <br />
      <br />
      <div class="panel panel-default">
        <section>
          <div class="panel-heading" style="color: red;">Importante: Solo se admiten archivos con extension 'xls', 'csv', 'xlsx'</div>
          <div class="panel-body">
            <div class="table-responsive">
              <span id="message"></span>
              <form method="post" id="import_excel_form" enctype="multipart/form-data">
                <table class="table">

                <div class="row">
							<div class="col-lg-5">
								<div class="form-group">
									<label for="" class="col-form-label">Tipo rol a importar</label>

									<select name="id_rol_usu" name="id_rol_usu" id="id_rol_usu" class="form-control" required>
										<option disabled selected value="">Seleccione el rol</option>
										<option value="1">Administrador</option>
										<option value="2">Docente</option>
										<option value="3">Coordinador</option>
										<option value="4">Estudiante</option>
									</select>
								</div>

							</div>
						</div>



						<div class="row">
							<div class="col-lg-7">
								<div class="form-group">
									<label for="" class="col-form-label">Programa de usuarios a importar</label>

									<select name="id_programa_usu" name="id_programa_usu" id="id_programa_usu" class="form-control" required>

										<?php
										$sql = mysqli_query($con, "SELECT * FROM programa  ");
										echo '	<option disabled selected value="">Seleccione el programa</option>';

										while ($valores = mysqli_fetch_array($sql)) {

											echo '<option value="' . $valores["id_programa"] . '">' . $valores["nombre_pro"] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>

                  <tr>
                    
                    <td width="50%"><input type="file" name="import_excel" /></td>
                    <td width="25%"><input type="submit" name="import" id="import" class="btn btn-primary" value="Importar" /></td>
                  </tr>
                </table>
              </form>
              <br />

            </div>
          </div>
        </section>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    </div>
  </div>
</body>

</html>
<script>
  $(document).ready(function() {
    $('#import_excel_form').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: "import.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          $('#import').attr('disabled', 'disabled');
          $('#import').val('Importing...');
     
        },
        success: function(data) {
          $('#message').html(data);
          $('#import_excel_form')[0].reset();
          $('#import').attr('disabled', false);
          $('#import').val('Import');

          id_rol_usu = $.trim($("#id_rol_usu").val());
    id_programa_usu = $.trim($("#id_programa_usu").val());
        }
      })
    });
  });
</script>