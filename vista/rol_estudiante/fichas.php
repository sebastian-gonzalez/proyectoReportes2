<?php
include('../../controlador/estudiante/add_ficha.php')
?>
<?php


if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 4) {
        header('location: ../../login.php');
    }
}

$nombre_usu = $_SESSION['nombre_usu'];

$id_s = $_SESSION['id_usuario'];
include("../../controlador/conexion.php");


include_once '../../controlador/database.php';

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

$consultaacamposficha = "SELECT fi.id_ficha
FROM lista_ficha lista, ficha fi 
WHERE lista.id_lista_usuario=$id_s
AND fi.id_estado_ficha=6
";
$resultset = mysqli_query($con, $consultaacamposficha) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

	$fichaaprobada = $record['id_ficha'];
}




$consultaacamposfichageneral = "SELECT fi.id_ficha
	FROM lista_ficha lista, ficha fi 
	WHERE fi.id_ficha=lista.id_lista_ficha
	AND lista.id_lista_usuario=$id_s
	AND fi.id_estado_ficha in (1,2,3,4,5)
	
";
$resultset = mysqli_query($con, $consultaacamposfichageneral) or die("database error:" . mysqli_error($con));

while ($record = mysqli_fetch_assoc($resultset)) {

	$fichaenanteproyecto = $record['id_ficha'];
}
?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />
    <title>Fichas</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../../assets/mainTable.css">


    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="icon" href="../../assets/images/favicon.ico" type="image/gif" />

    <!--Select2-->
    <link rel="stylesheet" type="text/css" href="../../assets/select2/select2.min.css" />



</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <?php

    include("../../controlador/estudiante/add_director.php");
    include("../../controlador/estudiante/update_ficha.php");
    include("../../controlador/conexion.php");

    //id ficha
    $id_de_ficha = (isset($_POST['id_de_ficha'])) ? $_POST['id_de_ficha'] : '';
    $_SESSION['id_de_ficha'] = $id_de_ficha;
    ?>



    <!-- Site wrapper -->
    <div class="wrapper">
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

		<?php

		if (!isset($id_lis_fi)) {
			echo " 
		<!-- Main Sidebar Container -->
		<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
			<!-- Brand Logo -->
			<a href='inicio_estudiante.php' class='brand-link'>
				<img src='../../assets/images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
				<span class='brand-text font-weight-light'>Inicio</span>
			</a>

			<!-- Sidebar -->
			<div class='sidebar'>
				<!-- Sidebar user (optional) -->
				<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
					<div class='image'>
						<img src='../../assets/images/user.jpg' class='img-circle elevation-2' alt='User Image'>
					</div>
					<div class='info'>
						<a href='perfil.php' class='d-block'>  $nombre_usu </a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class='mt-2'>
					<ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class='nav-item menu-open'>

							<ul class='nav nav-treeview'>
								<li class='nav-item'>
									<a href='primer_ingreso.php' class='nav-link'>
										<i class='fa fa-plus-square-o nav-icon'></i>
										<p>Crear Ficha</p>
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
		";
		} else if (isset($id_lis_fi) && isset($fichaenanteproyecto)) {
			echo  " 
		<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
			<!-- Brand Logo -->
			<a href='inicio_estudiante.php' class='brand-link'>
				<img src='../../assets/images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
				<span class='brand-text font-weight-light'>Inicio</span>
			</a>

			<!-- Sidebar -->
			<div class='sidebar'>
				<!-- Sidebar user (optional) -->
				<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
					<div class='image'>
						<img src='../../assets/images/user.jpg' class='img-circle elevation-2' alt='User Image'>
					</div>
					<div class='info'>
						<a href='perfil.php' class='d-block'>  $nombre_usu </a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class='mt-2'>
					<ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class='nav-item menu-open'>

							<ul class='nav nav-treeview'>
								<li class='nav-item'>
									<a href='fichas.php' class='nav-link'>
										<i class='fa fa-book nav-icon'></i>
										<p>Gestion Ficha</p>
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

		";
		} else if (isset($id_lis_fi) && isset($fichaaprobada)) {
			echo  " 
			<aside class='main-sidebar sidebar-dark-primary elevation-4 navcolor'>
				<!-- Brand Logo -->
				<a href='inicio_estudiante.php' class='brand-link'>
					<img src='../../assets/images/admin.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
					<span class='brand-text font-weight-light'>Inicio</span>
				</a>
	
				<!-- Sidebar -->
				<div class='sidebar'>
					<!-- Sidebar user (optional) -->
					<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
						<div class='image'>
							<img src='../../assets/images/user.jpg' class='img-circle elevation-2' alt='User Image'>
						</div>
						<div class='info'>
							<a href='perfil.php' class='d-block'>  $nombre_usu </a>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class='mt-2'>
						<ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
							<!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library -->
							<li class='nav-item menu-open'>
	
								<ul class='nav nav-treeview'>
									<li class='nav-item'>
										<a href='fichas.php' class='nav-link'>
											<i class='fa fa-book nav-icon'></i>
											<p>Gestion Ficha</p>
										</a>
									</li>
									<li class='nav-item'>
									<a href='fichas.php' class='nav-link'>
										<i class='fa fa-book nav-icon'></i>
										<p>Gestion Ficha</p>
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
	
			";
		}
		?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <br />
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class='btn-group'>





                            <?php
                            $usuario = $_SESSION['id_usuario'];
                            $consulta_validacion = "SELECT COUNT(*) FROM ficha INNER JOIN lista_ficha ON ficha.id_ficha = lista_ficha.id_lista_ficha AND id_lista_usuario = $usuario ";

                            $resultado_vali = $conexion->prepare($consulta_validacion);
                            $data_vali = $resultado_vali->execute();
                            if ($resultado_vali->fetchColumn() > 0) {
                                echo ' <button id="btnParticipantes" type="button" class="btn btn-primary" data-toggle="modal" tooltip-dir="top" title="Agregar Participantes"><i class="material-icons" >group_add</i></button>';

                                echo ' <button id="btnDirector" type="button" class="btn btn-primary" data-toggle="modal" tooltip-dir="top" title="Agregar Director"><i class="material-icons" >school</i></button>';

                                echo ' <button id="btnMostrar_P" type="button" class="btn btn-primary" data-toggle="modal"tooltip-dir="top" title="Mostrar Participantes"><i class="material-icons">groups</i></button>';
                            } else {
                                echo ' ';
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>  <!-- Content Header (Page header) -->



            <div class="container caja">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tablaFichas" class=" table table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th>id_ficha</th>
                                        <th>Titulo</th>
                                        <th>Descripcion</th>
                                        <th>Programa</th>
                                        <th>Estado</th>
                                        <th>Evaluacion</th>
                                        <th>Creacion</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>





            
            <div class="modal fade" id="modalCRUD1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Titulo</label>
                                            <input type="text" class="form-control" name="titulo_ficha" required>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group" enctype="multipart/form-data">
                                    <label for="" class="col-form-label">Documento</label>
                                    <div class="col-lg-6">
                                        <input type="file" name="archivo" required>


                                    </div>
                                </div>





                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                                <button input type="submit" name="add" id="btnGuardar" class="btn btn-dark">Guardar</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>


            <?php
            include("../../controlador/conexion.php");
            include("../../controlador/estudiante/add_compañero.php");
            ?>
            <div class="modal fade" id="modalParticipantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Compañero </label>

                                            <select id="id_lista_usuario" name="id_lista_usuario" class="form-control" required>
                                                <?php

                                                $programa = $_SESSION['id_programa_usu'];
                                                $user = $_SESSION['id_usuario'];
                                                $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_programa_usu = $programa AND id_rol_usu =4 AND id_usuario != $user");
                                                echo '	<option disabled selected value="">Seleccione su Compañero</option>';

                                                while ($valores = mysqli_fetch_array($sql)) {

                                                    echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_usu"] . " " . $valores["apellido_usu"] . '</option>';
                                                    '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                                <button input type="submit" name="add_participante" class="btn btn-dark">Guardar</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>


            <div class="modal fade" id="modalDirector" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Director</label>

                                            <select class="custom-select form-control-border"name="id_lista_usuario_director"  required>
                                                <?php
                                                $programa = $_SESSION['id_programa_usu'];

                                                $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE id_programa_usu = $programa AND id_rol_usu =2 ");
                                                echo '	<option disabled selected value="">Seleccione su director</option>';

                                                while ($valores = mysqli_fetch_array($sql)) {

                                                    echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_usu"] . " " . $valores["apellido_usu"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                                <button input type="submit" name="add_director" class="btn btn-dark">Guardar</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>



            <div class="modal fade" id="modal_Mostrar_P" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row table_modal">
                                    <div>
                                        <table class="table">
                                            <thead>

                                                <tr>
                                                    <th scope="col">Nombre </th>
                                                    <th scope="col"> Apellido </th>
                                                    <th scope="col"> Rol </th>
                                                </tr>
                                            </thead>


                                            <br></br>

                                            <?php

                                            $id_lis_fi = $_SESSION['id_lista_ficha'];

                                            $sql = mysqli_query($con, "SELECT * FROM usuarios INNER JOIN lista_ficha INNER JOIN rol_lista ON usuarios.id_usuario = lista_ficha.id_lista_usuario AND rol_lista.id_rol_lista = lista_ficha.id_rol_ficha AND lista_ficha.id_lista_ficha = $id_lis_fi  ORDER BY id_rol_ficha");
                                            if (mysqli_num_rows($sql) == 0) {
                                                echo 'no hay datos';
                                            } else {

                                                while ($valores = mysqli_fetch_assoc($sql)) {
                                                    echo '
                                            <tbody>
                                    <tr>    
                                    <td>' . $valores['nombre_usu'] . '</td>
                                    <td>' . $valores['apellido_usu'] . '</td>
                                    <td>' . $valores['nombre_rol_ficha'] . '</td>
                                    </tr>';
                                                }
                                            }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Regresar</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../../assets/js/jquery-3.5.1.js"></script>
    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- datatables JS -->
    <script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../../controlador/estudiante/js/ficha.js"></script>


    <!-- Select2 -->

    <script src="../../assets/select2/select2.min.js"></script>

    <script src="../../assets/js/nav/adminlte.js"></script>
</body>

</html>