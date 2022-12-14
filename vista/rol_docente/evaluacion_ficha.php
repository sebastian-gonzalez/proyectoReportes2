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
                                PLANTEAMIENTO: Se describe claramente la situaci??n actual (an??lisis causa-efecto) y la situaci??n deseada
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
                                FORMULACI??N: Se formula claramente una macropregunta que sintetice el planteamiento realizado
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
                                SISTEMATIZACI??N: Se formulan claramente algunas micropreguntas que jerarquizan la formulaci??n previa
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="comentario de problema de investigacion" name="comentario_problema_investigacion" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                                Es claro, preciso y est?? bien planteado (redactado)
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
                                Guarda relaci??n con el t??tulo
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
                                Es coherente con la formulaci??n del problema
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
                                Son claros, precisos y est??n bien planteados (redactados)
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
                                Son coherentes con la sistematizaci??n del problema
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de objetivos" aria-label="Recipient's username" name="comentario_objetivo" aria-describedby="basic-addon2">
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
                                Especifica claramente resultados tangibles al finalizar el proyecto (prototipo, documento monogr??fico y articulo cient??fico)
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
                                Son coherentes con los objetivos espec??ficos del proyecto y evidencian la soluci??n al problema
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
                                Se define claramente el impacto social y/o econ??mico del proyecto
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
                                Se define claramente el impacto educativo, ingenieril y/o tecnol??gico
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de resultados" aria-label="Recipient's username" name="comentario_resultado" aria-describedby="basic-addon2">
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
                                INTERES: El Proyecto refleja el inter??s de los autores y puede ser de inter??s para alguna organizaci??n
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
                                IMPORTANCIA: La tem??tica es importante para la disciplina de estudio, el instituto, una empresa; suple una necesidad
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
                                UTILIDAD: El proyecto es ??til o aplicable en alg??n contexto (instituci??n educativa, empresa)
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
                                FACTIBILIDAD: Existe posibilidad por factor tiempo, recurso humano, t??cnico y cognitivo de llevarlo a cabo
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
                                PERTINENCIA: Tiene relaci??n directa o indirecta con la carrera que esta cursando
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de justificacion" aria-label="Recipient's username" name="comentario_justificacion" aria-describedby="basic-addon2">
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
                        <h5>HIST??RICO</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                La propuesta se??ala referentes institucionales realizados previamente
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
                                Se??ala estudios previos realizados en otras instituciones
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
                                Se??ala los aportes de estos trabajos al proyecto a desarrollar
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
                        <h5>TE??RICO</h5>
                    </section>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                Se desarrollan los elementos te??ricos y tecnol??gicos del proyecto
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
                                Realizan la citaci??n bibliogr??fica adecuada para la estructuraci??n te??rica
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
                                Refleja construcci??n propia y/o an??lisis te??rico
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
                                Define la terminolog??a espec??fica del proyecto
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de marco teorico" aria-label="Recipient's username" name="comentario_marco" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>METODOLOG??A</h4>
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
                                Se plantean las t??cnicas y fuentes de recolecci??n de informaci??n
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
                                Se definen claramente las etapas del proceso de investigaci??n
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de metodologia" aria-label="Recipient's username" name="comentario_metodologia" aria-describedby="basic-addon2">
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
                                Las etapas de la investigaci??n siguen un proceso l??gico
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
                                La tabla o gr??fico utilizado es de f??cil interpretaci??n
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de cronograma" aria-label="Recipient's username" name="comentario_cronograma" aria-describedby="basic-addon2">
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
                                El recurso humano es suficiente y adecuado para el tema de investigaci??n
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
                                Se utilizan diferentes recursos institucionales (bibliotecas, universidades, empresas???)
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
                                Especifica los recursos t??cnicos que se utilizar??n en el proyecto
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
                                Se presenta correctamente el an??lisis presupuestal
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de recurso" aria-label="Recipient's username" name="comentario_recurso" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Comentario</span>
                                </div>


                            </div>
                        </div>
                    </div>
                    <hr />

                    <section>
                        <h4>REFERENCIAS BIBLIOGRAF??CAS</h4>
                    </section>
                    <hr />

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                                El proyecto tiene diversas fuentes bibliogr??ficas y refleja una exhaustiva revisi??n de la tem??tica
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
                                Utiliza fuentes bibliogr??ficas cl??sicas y vigentes dentro del campo de acci??n del proyecto
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
                                Utiliza fuentes bibliogr??ficas actualizadas, confiables y con relaci??n directa con el proyecto
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario de bibliografia" aria-label="Recipient's username" name="comentario_referencias" aria-describedby="basic-addon2">
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
                                T??TULO: Refleja claramente el tema tratado
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
                                FACTIBILIDAD: Posibilidades de realizaci??n (tiempo, conocimiento, recurso humano, t??cnico y econ??mico)
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
                                Aplicaci??n de Normas ICONTEC
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
                                Redacci??n y Ortograf??a
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
                                Presentaci??n general
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
                                    <input type="text" class="form-control derechaubicacion" placeholder="Comentario general" aria-label="Recipient's username" name="concepto_genera" aria-describedby="basic-addon2">
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
                                    <option value="5">Rechazado</option>


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