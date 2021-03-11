<?php
session_start();
//Finalizacion de la session transcurridos 10 minutos
$minutosparafinalizar = 10;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutosparafinalizar * 60))) {

  session_unset();     // unset $_SESSION   
  session_destroy();   // destroy session data  
  echo '<script language="javascript">alert("Tiempo de la session expirado");</script>';
  header('location: ../../login.php');
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

if (!isset($_SESSION['id_rol_usu'])) {
  header('location: ../../login.php');
} else {
  if ($_SESSION['id_rol_usu'] != 1) {
    header('location: ../../login.php');
  }
}
$nombre_usu = $_SESSION['nombre_usu'];

?>
<?php
include("../../controlador/conexion.php");
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>import excel</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/mainTable.css">
  <link rel="stylesheet" href="../../assets/css/perfil.css">
  <link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
  <link rel="icon" href="../../assets/images/favicon.ico" type="image/gif" />



</head>

<body>




  <body class="hold-transition sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->

          <li class="nav-item">
            <a class="nav-link" href="../../logout.php">
              <i class="fa fa-power-off"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      </ul>
      </nav>
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4 navcolor">
        <!-- Brand Logo -->
        <a href="inicio_admin.php" class="brand-link">
          <img src="../../assets/images/admin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Inicio</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="../../assets/images/user.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="perfil.php" class="d-block"> <?php echo $nombre_usu ?></a>
            </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item menu-open">

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="usuarios.php" class="nav-link">
                      <i class="fa fa-users nav-icon"></i>
                      <p>Usuarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="programas.php" class="nav-link">
                      <i class="fa fa-graduation-cap nav-icon"></i>
                      <p>Programas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="facultad.php" class="nav-link">
                      <i class="fa fa-cubes nav-icon"></i>
                      <p>Facultad</p>
                    </a>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="container">
          <div class="content">

            <br /> 
            <h2 align="center">Importar Usuarios mediante archivo Excel</h2>
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
                                $sql = mysqli_query($con, "SELECT * FROM programa ");
                                echo '<option disabled selected value="">Seleccione el programa</option>';

                                while ($valores = mysqli_fetch_array($sql)) {
                                $aiuda=$valores['id_programa'];
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
      </div>
    </div>



    <script src="../../assets/js/jquery-3.5.1.js"></script>

    <script src="../../assets/js/nav/adminlte.js"></script>

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