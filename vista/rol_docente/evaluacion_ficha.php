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
                                        <p>Fichas Aprobadas</p>
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
                    <h1>EVALUACION FICHA ANTEPROYECTO</h1>
                </section>

                <form method="post" <?php echo 'action="../../controlador/docente/evaluar_ficha_evaluador.php?aktrl=add&nikfi=' . $ficha1 . '"'; ?>>

                    <section>
                        <h6>Califique de acuerdo a la siguiente escala: E (Excelente=5.0), B (Bueno=4.0), A (Aceptable=3.0), D (Deficiente=2), I (Insuficiente=1)</h6>
                    </section>

                    <hr />

                    <section>
                        <h4>EL PROBLEMA DE INVESTIGACION</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                PLANTEAMIENTO: Se describe claramente la situación actual (análisis causa-efecto) y la situación deseada
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="planteamiento" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>


                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                FORMULACIÓN: Se formula claramente una macropregunta que sintetice el planteamiento realizado
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="formulacion" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>



                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                SISTEMATIZACIÓN: Se formulan claramente algunas micropreguntas que jerarquizan la formulación previa
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="sistematizacion" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_problema_investigacion" name="comentario_problema_investigacion" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>OBJETIVOS</h4>
                    </section>
                    <hr />

                    <section>
                        <h5>General</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Es claro, preciso y está bien planteado (redactado)
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="objetivo_general_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Guarda relación con el título
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="objetivo_general_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Es coherente con la formulación del problema
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="objetivo_general_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <section>
                        <h5>Especificos</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Son claros, precisos y están bien planteados (redactados)
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="objetivo_especifico_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Son coherentes con la sistematización del problema
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="objetivo_especifico_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Son coherentes con el Objetivo General
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="objetivo_especifico_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario" aria-label="Recipient's username" name="comentario_objetivo" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>RESULTADOS E IMPACTO ESPERADO</h4>
                    </section>
                    <hr />

                    <section>
                        <h5>RESULTADOS</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Especifica claramente resultados tangibles al finalizar el proyecto (prototipo, documento monográfico y articulo científico)
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="resultado_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Son coherentes con los objetivos específicos del proyecto y evidencian la solución al problema
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="resultado_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <section>
                        <h5>IMPACTOS</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se define claramente el impacto social y/o económico del proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="impacto_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se define claramente el impacto educativo, ingenieril y/o tecnológico
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="impacto_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_resultado" aria-label="Recipient's username" name="comentario_resultado" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>JUSTIFICACION</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                INTERES: El Proyecto refleja el interés de los autores y puede ser de interés para alguna organización
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="interes" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>


                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                IMPORTANCIA: La temática es importante para la disciplina de estudio, el instituto, una empresa; suple una necesidad
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="importancia" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                UTILIDAD: El proyecto es útil o aplicable en algún contexto (institución educativa, empresa)
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="utilidad" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>


                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                FACTIBILIDAD: Existe posibilidad por factor tiempo, recurso humano, técnico y cognitivo de llevarlo a cabo
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="factibilidad_gen" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>


                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                PERTINENCIA: Tiene relación directa o indirecta con la carrera que esta cursando
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="pertinencia" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>


                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_justificacion" aria-label="Recipient's username" name="comentario_justificacion" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />


                    <section>
                        <h4>MARCO DE REFERENCIA</h4>
                    </section>
                    <hr />

                    <section>
                        <h5>HISTÓRICO</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                La propuesta señala referentes institucionales realizados previamente
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="historico_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Señala estudios previos realizados en otras instituciones
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="historico_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Señala los aportes de estos trabajos al proyecto a desarrollar
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="historico_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <section>
                        <h5>CONTEXTUAL</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Describe el Contexto en el cual piensa desarrollar el proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="contextual" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <section>
                        <h5>TEÓRICO</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se desarrollan los elementos teóricos y tecnológicos del proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="teorico_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Realizan la citación bibliográfica adecuada para la estructuración teórica
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="teorico_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Refleja construcción propia y/o análisis teórico
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="teorico_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <section>
                        <h5>CONCEPTUAL</h5>
                    </section>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Define la terminología específica del proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="conceptual" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <section>
                        <h5>LEGAL</h5>
                    </section>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Especifica aspectos legales que tienen impacto dentro del proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="legal" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>


                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_marco" aria-label="Recipient's username" name="comentario_marco" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>METODOLOGÍA</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se formula el tipo de estudio de manera clara y precisa
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="metodologia_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se plantean las técnicas y fuentes de recolección de información
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="metodologia_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se exponen los argumentos para las elecciones anteriores
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="metodologia_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se definen claramente las etapas del proceso de investigación
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="metodologia_d" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_metodologia" aria-label="Recipient's username" name="comentario_metodologia" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>CRONOGRAMA DE ACTIVIDADES</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Las etapas de la investigación siguen un proceso lógico
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="cronograma_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                El tiempo asignado para cada etapa es el apropiado
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="cronograma_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                La tabla o gráfico utilizado es de fácil interpretación
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="cronograma_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_cronograma" aria-label="Recipient's username" name="comentario_cronograma" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>RECURSOS Y PRESUPUESTO</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                El recurso humano es suficiente y adecuado para el tema de investigación
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="recurso_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se utilizan diferentes recursos institucionales (bibliotecas, universidades, empresas…)
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="recurso_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Especifica los recursos técnicos que se utilizarán en el proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="recurso_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se presenta correctamente el análisis presupuestal
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="recurso_d" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_recurso" aria-label="Recipient's username" name="comentario_recurso" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>REFERENCIAS BIBLIOGRAFÍCAS</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                El proyecto tiene diversas fuentes bibliográficas y refleja una exhaustiva revisión de la temática
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="referencias_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Utiliza fuentes bibliográficas clásicas y vigentes dentro del campo de acción del proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="referencias_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Utiliza fuentes bibliográficas actualizadas, confiables y con relación directa con el proyecto
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="referencias_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario_referencias" aria-label="Recipient's username" name="comentario_referencias" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>ANALISIS GENERAL</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                TÍTULO: Refleja claramente el tema tratado
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="titulo" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                NIVEL INVESTIGATIVO: La complejidad del trabajo amerita el desarrollo de un Proyecto de Grado
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="nivel_investigativo" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                FACTIBILIDAD: Posibilidades de realización (tiempo, conocimiento, recurso humano, técnico y económico)
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="factibilidad" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <section>
                        <h5>DOCUMENTO</h5>
                    </section>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Aplicación de Normas ICONTEC
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="documento_a" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Redacción y Ortografía
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="documento_b" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Presentación general
                                <select class="form-select derechaubicacion" aria-label="Default select example " name="documento_c" required>
                                    <option disabled selected value=""> Calificacion </option>

                                    <option value="5">E</option>
                                    <option value="4">B</option>
                                    <option value="3">A</option>
                                    <option value="2">D</option>
                                    <option value="1">I</option>
                                </select>



                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control derechaubicacion" placeholder="concepto_genera" aria-label="Recipient's username" name="concepto_genera" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>


                    </div>
                    <br />
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Evaluacion de la ficha de anteproyecto <select class="form-select derechaubicacion" aria-label="Default select example " name="evaluacion" required>
                                    <option disabled selected value=""> Evaluacion </option>

                                    <option value="3">Aprobado</option>
                                    <option value="2">En correccion</option>

                                </select>


                            </div>
                        </div>
                        <button input type="submit" name="evaluar" class="btn btn-info derechaubicacion">Evaluar</button>

                    </div>

                </form>


            </div>
        </div>







        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="../../assets/js/jquery-3.5.1.js"></script>

        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- datatables JS -->

        <script src="../../assets/js/nav/adminlte.js"></script>



</body>


</html>