<?php
session_start();

if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 2) {
        header('location: ../../login.php');
    }
}
$nombre_usu = $_SESSION['nombre_usu'];


?>




<?php
include("../../controlador/conexion.php");
$ficha1 = mysqli_real_escape_string($con, (strip_tags($_GET["ficha"], ENT_QUOTES)));

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil Docente</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/perfil.css">
    <link rel="stylesheet" href="../../assets/css/css/nav/adminlte.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="icon" href="../../assets/images/favicon.ico" type="image/gif" />





</head>

<body class="hold-transition sidebar-mini sidebar-collapse">



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


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 navcolor">
            <!-- Brand Logo -->
            <a href="inicio_docente.php" class="brand-link">
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
                                    <a href="fichas_asignadas_director.php" class="nav-link">
                                        <i class="fa fa-user nav-icon"></i>
                                        <p>Fichas directores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="fichas_asignadas_evaluador.php" class="nav-link">
                                        <i class="fa fa-files-o nav-icon"></i>
                                        <p>Fichas Evaluador</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="fichas_asignadas_jurado.php" class="nav-link">
                                        <i class="fa fa-book nav-icon"></i>
                                        <p>Fichas Jurado</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="fichas_aprobadas.php" class="nav-link">
                                        <i class="fa fa-check-square-o nav-icon"></i>
                                        <p>Fichas Asignadas</p>
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

                <section>
                    <h1>EVALUACION SUSTENTACIÓN
                        PROYECTO DE GRADO</h1>
                </section>

                <hr/>


                <section>
                    <h4>A. TRABAJO ESCRITO (VALORACION 20%):</h4>
                </section>
                <hr/>


                <form method="post" <?php echo 'action="../../controlador/docente/evaluar_ficha_jurado.php?aktrl=addp&nikfi=' . $ficha1 . '"'; ?>>

                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                            A.1 Presentación general del documento (incluye aplicación de normas)
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="a1" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                            A.2 Calidad en la redacción y pertinencia de la información (incluye referencias utilizadas)
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="a2" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        A3. El producto de divulgación desarrollado cumple con estándares para la publicación (Obligatorio Profesional Universitario y Opcional Tecnologías)
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="a3" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <hr/>

                <section>
                    <h4>B. PROCESO DE DESARROLLO DEL PROYECTO (VALORACION 25%):</h4>
                </section>
                <hr/>

                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        B.1 Existe coherencia entre la formulación de problema y el desarrollo de la solución
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="1" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="b1" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        B.2  Se cumplen los objetivos propuestos
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="b2" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        B.3 El marco referencial fue suficiente y apropiado para aplicar al proyecto
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="b3" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        B.4 La Metodología establecida se evidenció en el desarrollo del proyecto				

                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="b4" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        B.5  La implementación del proyecto fue completa y de calidad				

                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="b5" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        B.6  Los Resultados del proyecto corresponden a los resultados esperados				

                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="b6" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        B.7  Las Conclusiones son relevantes  y dan razón de lo logrado en proyecto				

                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="b7" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <hr/>

                <section>
                    <h4>C. SUSTENTACION DEL PROYECTO (VALORACION 15%):</h4>
                </section>
                <hr/>

                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        C.1 Se muestran dominio del del proceso de desarrollo del proyecto
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="c1" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        C.2  Realizan un adecuado manejo del tiempo
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="c2" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        C.3  Utilizan una adecuada expresión oral y corporal
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="c3" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        C.4  El Vocabulario técnico es apropiado
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="c4" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        C.5  Da respuestas claras y coherentes a las inquitudes de los jurados
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="c5" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        C.6  Utilización de forma correcta las ayudas audiovisuales disponibles
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="c6" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        C.7  Presentan una buena presentación personal
                            <div class="input-group mb-3">
                                <input type="number" name="number" min="0" max="5" class="form-control derechaubicacion" placeholder="Evaluacion" name="c7" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Evaluacion</span>
                            </div>


                        </div>
                    </div>
                    <button input type="submit" name="evaluarp" class="btn btn-info derechaubicacion">Evaluar</button>

                </div>
                <hr/>


                <br/>
                
                </form>
                

             

            </div>
        </div>







        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="../../assets/js/jquery-3.5.1.js"></script>

        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- datatables JS -->

        <script type="text/javascript" src="../../controlador/docente/js/doc_ficha_asignada_jurado.js"></script>
        <script src="../../assets/js/nav/adminlte.js"></script>



</body>


</html>