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
$nombre_usu = $_SESSION['nombre_usu'];


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
  <link rel="stylesheet" href="../css/css/nav/adminlte.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
  <link rel="icon" href="../images/favicon.ico" type="image/gif" />



</head>

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
          <a class="nav-link"  href="../logout.php" >
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
        <img src="../images/admin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Inicio</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../images/user.jpg" class="img-circle elevation-2" alt="User Image">
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
        <br></br>
        <h2>Administrador</h2>

        <section>
          <h1>Bienvenido(a) <?php echo $_SESSION['nombre_usu']; ?></h1>
        </section>
        <hr />

        <center>
          <img src="../images/uniajc.png" width="50%">
        </center>
                          
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../assets/jquery/jquery-3.3.1.min.js"></script>

  <script src="../assets/js/nav/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
</body>



</html>