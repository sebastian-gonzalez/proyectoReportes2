<!--SweetAlert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

<?php
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();
include('../conexion.php');




echo'<body>';

if (isset($_POST['evaluar'])) {




    if (isset($_GET['aktrl']) == 'add') {

        $id_ficha_ante = mysqli_real_escape_string($con, (strip_tags($_GET["nikfi"], ENT_QUOTES)));



        $planteamiento = mysqli_real_escape_string($con, (strip_tags($_POST["planteamiento"], ENT_QUOTES)));
        $formulacion = mysqli_real_escape_string($con, (strip_tags($_POST["formulacion"], ENT_QUOTES)));
        $sistematizacion = mysqli_real_escape_string($con, (strip_tags($_POST["sistematizacion"], ENT_QUOTES)));
        $comentario_problema_investigacion = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_problema_investigacion"], ENT_QUOTES)));

        $objetivo_general_a = mysqli_real_escape_string($con, (strip_tags($_POST["objetivo_general_a"], ENT_QUOTES)));
        $objetivo_general_b = mysqli_real_escape_string($con, (strip_tags($_POST["objetivo_general_b"], ENT_QUOTES)));
        $objetivo_general_c = mysqli_real_escape_string($con, (strip_tags($_POST["objetivo_general_c"], ENT_QUOTES)));
        $objetivo_especifico_a = mysqli_real_escape_string($con, (strip_tags($_POST["objetivo_especifico_a"], ENT_QUOTES)));
        $objetivo_especifico_b = mysqli_real_escape_string($con, (strip_tags($_POST["objetivo_especifico_b"], ENT_QUOTES)));
        $objetivo_especifico_c = mysqli_real_escape_string($con, (strip_tags($_POST["objetivo_especifico_c"], ENT_QUOTES)));
        $comentario_objetivo = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_objetivo"], ENT_QUOTES)));

        $resultado_a = mysqli_real_escape_string($con, (strip_tags($_POST["resultado_a"], ENT_QUOTES)));
        $resultado_b = mysqli_real_escape_string($con, (strip_tags($_POST["resultado_b"], ENT_QUOTES)));
        $impacto_a = mysqli_real_escape_string($con, (strip_tags($_POST["impacto_a"], ENT_QUOTES)));
        $impacto_b = mysqli_real_escape_string($con, (strip_tags($_POST["impacto_b"], ENT_QUOTES)));
        $comentario_resultado = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_resultado"], ENT_QUOTES)));

        $interes = mysqli_real_escape_string($con, (strip_tags($_POST["interes"], ENT_QUOTES)));
        $importancia = mysqli_real_escape_string($con, (strip_tags($_POST["importancia"], ENT_QUOTES)));
        $utilidad = mysqli_real_escape_string($con, (strip_tags($_POST["utilidad"], ENT_QUOTES)));
        $factibilidad_gen = mysqli_real_escape_string($con, (strip_tags($_POST["factibilidad_gen"], ENT_QUOTES)));
        $pertinencia = mysqli_real_escape_string($con, (strip_tags($_POST["pertinencia"], ENT_QUOTES)));
        $comentario_justificacion = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_justificacion"], ENT_QUOTES)));

        $historico_a = mysqli_real_escape_string($con, (strip_tags($_POST["historico_a"], ENT_QUOTES)));
        $historico_b = mysqli_real_escape_string($con, (strip_tags($_POST["historico_b"], ENT_QUOTES)));
        $historico_c = mysqli_real_escape_string($con, (strip_tags($_POST["historico_c"], ENT_QUOTES)));
        $contextual = mysqli_real_escape_string($con, (strip_tags($_POST["contextual"], ENT_QUOTES)));
        $teorico_a = mysqli_real_escape_string($con, (strip_tags($_POST["teorico_a"], ENT_QUOTES)));
        $teorico_b = mysqli_real_escape_string($con, (strip_tags($_POST["teorico_b"], ENT_QUOTES)));
        $teorico_c = mysqli_real_escape_string($con, (strip_tags($_POST["teorico_c"], ENT_QUOTES)));
        $conceptual = mysqli_real_escape_string($con, (strip_tags($_POST["conceptual"], ENT_QUOTES)));
        $legal = mysqli_real_escape_string($con, (strip_tags($_POST["legal"], ENT_QUOTES)));
        $comentario_marco = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_marco"], ENT_QUOTES)));

        $metodologia_a = mysqli_real_escape_string($con, (strip_tags($_POST["metodologia_a"], ENT_QUOTES)));
        $metodologia_b = mysqli_real_escape_string($con, (strip_tags($_POST["metodologia_b"], ENT_QUOTES)));
        $metodologia_c = mysqli_real_escape_string($con, (strip_tags($_POST["metodologia_c"], ENT_QUOTES)));
        $metodologia_d = mysqli_real_escape_string($con, (strip_tags($_POST["metodologia_d"], ENT_QUOTES)));
        $comentario_metodologia = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_metodologia"], ENT_QUOTES)));

        $cronograma_a = mysqli_real_escape_string($con, (strip_tags($_POST["cronograma_a"], ENT_QUOTES)));
        $cronograma_b = mysqli_real_escape_string($con, (strip_tags($_POST["cronograma_b"], ENT_QUOTES)));
        $cronograma_c = mysqli_real_escape_string($con, (strip_tags($_POST["cronograma_c"], ENT_QUOTES)));
        $comentario_cronograma = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_cronograma"], ENT_QUOTES)));

        $recurso_a = mysqli_real_escape_string($con, (strip_tags($_POST["recurso_a"], ENT_QUOTES)));
        $recurso_b = mysqli_real_escape_string($con, (strip_tags($_POST["recurso_b"], ENT_QUOTES)));
        $recurso_c = mysqli_real_escape_string($con, (strip_tags($_POST["recurso_c"], ENT_QUOTES)));
        $recurso_d = mysqli_real_escape_string($con, (strip_tags($_POST["recurso_d"], ENT_QUOTES)));
        $comentario_recurso = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_recurso"], ENT_QUOTES)));

        $referencias_a = mysqli_real_escape_string($con, (strip_tags($_POST["referencias_a"], ENT_QUOTES)));
        $referencias_b = mysqli_real_escape_string($con, (strip_tags($_POST["referencias_b"], ENT_QUOTES)));
        $referencias_c = mysqli_real_escape_string($con, (strip_tags($_POST["referencias_c"], ENT_QUOTES)));
        $comentario_referencias = mysqli_real_escape_string($con, (strip_tags($_POST["comentario_referencias"], ENT_QUOTES)));


        $titulo = mysqli_real_escape_string($con, (strip_tags($_POST["titulo"], ENT_QUOTES)));
        $nivel_investigativo = mysqli_real_escape_string($con, (strip_tags($_POST["nivel_investigativo"], ENT_QUOTES)));
        $factibilidad     = mysqli_real_escape_string($con, (strip_tags($_POST["factibilidad"], ENT_QUOTES)));
        $documento_a = mysqli_real_escape_string($con, (strip_tags($_POST["documento_a"], ENT_QUOTES)));
        $documento_b = mysqli_real_escape_string($con, (strip_tags($_POST["documento_b"], ENT_QUOTES)));
        $documento_c = mysqli_real_escape_string($con, (strip_tags($_POST["documento_c"], ENT_QUOTES)));
        $concepto_genera = mysqli_real_escape_string($con, (strip_tags($_POST["concepto_genera"], ENT_QUOTES)));

        $evaluacion = mysqli_real_escape_string($con, (strip_tags($_POST["evaluacion"], ENT_QUOTES)));






        $consulta_validacion = "SELECT id_lista_ficha_ante FROM evaluacion_anteproyecto WHERE id_lista_ficha_ante =$id_ficha_ante AND  evaluacion_anteproyecto.activo IS null";
        $resultado_vali = $conexion->prepare($consulta_validacion);
        $data_vali = $resultado_vali->execute();

        if ($resultado_vali->fetchColumn() > 0) {
            $consulta = "UPDATE evaluacion_anteproyecto  SET evaluacion_anteproyecto.activo='N'   WHERE id_lista_ficha_ante='$id_ficha_ante'";
            $resultado = $conexion->prepare($consulta);
            $validacion_id = $resultado->execute();

            $eva_anteproyecto = "INSERT INTO evaluacion_anteproyecto (planteamiento,formulacion,sistematizacion,comentario_problema_investigacion,objetivo_general_a,objetivo_general_b,objetivo_general_c,objetivo_especifico_a,objetivo_especifico_b,objetivo_especifico_c,comentario_objetivo,resultado_a,resultado_b,impacto_a,impacto_b,comentario_resultado,interes,importancia,utilidad,factibilidad_gen,pertinencia,comentario_justificacion,historico_a,historico_b,historico_c,contextual,teorico_a,teorico_b,teorico_c,conceptual,legal,comentario_marco,metodologia_a,metodologia_b,metodologia_c,metodologia_d,comentario_metodologia,cronograma_a,cronograma_b,cronograma_c,comentario_cronograma,recurso_a,recurso_b,recurso_c,recurso_d,comentario_recurso,referencias_a,referencias_b,referencias_c,comentario_referencias,titulo,nivel_investigativo,factibilidad,documento_a,documento_b,documento_c,concepto_genera,estado,id_lista_ficha_ante)
            VALUES('$planteamiento','$formulacion','$sistematizacion','$comentario_problema_investigacion', '$objetivo_general_a', '$objetivo_general_b', '$objetivo_general_c', '$objetivo_especifico_a', '$objetivo_especifico_b', '$objetivo_especifico_c', '$comentario_objetivo', '$resultado_a', '$resultado_b', '$impacto_a', '$impacto_b', '$comentario_resultado', '$interes', '$importancia', '$utilidad', '$factibilidad_gen', '$pertinencia', '$comentario_justificacion', '$historico_a', '$historico_b', '$historico_c' , '$contextual', '$teorico_a', '$teorico_b', '$teorico_c', '$conceptual', '$legal', '$comentario_marco', '$metodologia_a', '$metodologia_b', '$metodologia_c', '$metodologia_d', '$comentario_metodologia', '$cronograma_a', '$cronograma_b', '$cronograma_c', '$comentario_cronograma', '$recurso_a', '$recurso_b', '$recurso_c', '$recurso_d', '$comentario_recurso', '$referencias_a', '$referencias_b', '$referencias_c', '$comentario_referencias', '$titulo', '$nivel_investigativo', '$factibilidad', '$documento_a', '$documento_b', '$documento_c', '$concepto_genera', '$evaluacion','$id_ficha_ante') ";
            $eva_anteproyecto = $conexion->prepare($eva_anteproyecto);
            $eva_anteproyecto->execute();


            $consulta = "UPDATE ficha  SET id_estado_ficha='$evaluacion', evaluacion_ficha='$concepto_genera'  WHERE id_ficha='$id_ficha_ante'";

            $resultado = $conexion->prepare($consulta);
            $validacion_id = $resultado->execute();


            echo
            "<script> swal({
            allowOutsideClick: false,
            title: '¡Exito!',
            text: 'Ficha de anteproyecto evaluada correctamente',
            type: 'success',
          }).then(function(){ 
            location.href='../../vista/rol_docente/fichas_asignadas_evaluador.php';
            }
         );
         ;</script>";
        } else {

            $eva_anteproyecto = "INSERT INTO evaluacion_anteproyecto (planteamiento,formulacion,sistematizacion,comentario_problema_investigacion,objetivo_general_a,objetivo_general_b,objetivo_general_c,objetivo_especifico_a,objetivo_especifico_b,objetivo_especifico_c,comentario_objetivo,resultado_a,resultado_b,impacto_a,impacto_b,comentario_resultado,interes,importancia,utilidad,factibilidad_gen,pertinencia,comentario_justificacion,historico_a,historico_b,historico_c,contextual,teorico_a,teorico_b,teorico_c,conceptual,legal,comentario_marco,metodologia_a,metodologia_b,metodologia_c,metodologia_d,comentario_metodologia,cronograma_a,cronograma_b,cronograma_c,comentario_cronograma,recurso_a,recurso_b,recurso_c,recurso_d,comentario_recurso,referencias_a,referencias_b,referencias_c,comentario_referencias,titulo,nivel_investigativo,factibilidad,documento_a,documento_b,documento_c,concepto_genera,estado,id_lista_ficha_ante)
            VALUES('$planteamiento','$formulacion','$sistematizacion','$comentario_problema_investigacion', '$objetivo_general_a', '$objetivo_general_b', '$objetivo_general_c', '$objetivo_especifico_a', '$objetivo_especifico_b', '$objetivo_especifico_c', '$comentario_objetivo', '$resultado_a', '$resultado_b', '$impacto_a', '$impacto_b', '$comentario_resultado', '$interes', '$importancia', '$utilidad', '$factibilidad_gen', '$pertinencia', '$comentario_justificacion', '$historico_a', '$historico_b', '$historico_c' , '$contextual', '$teorico_a', '$teorico_b', '$teorico_c', '$conceptual', '$legal', '$comentario_marco', '$metodologia_a', '$metodologia_b', '$metodologia_c', '$metodologia_d', '$comentario_metodologia', '$cronograma_a', '$cronograma_b', '$cronograma_c', '$comentario_cronograma', '$recurso_a', '$recurso_b', '$recurso_c', '$recurso_d', '$comentario_recurso', '$referencias_a', '$referencias_b', '$referencias_c', '$comentario_referencias', '$titulo', '$nivel_investigativo', '$factibilidad', '$documento_a', '$documento_b', '$documento_c', '$concepto_genera', '$evaluacion','$id_ficha_ante') ";
            $eva_anteproyecto = $conexion->prepare($eva_anteproyecto);
            $eva_anteproyecto->execute();


            $consulta = "UPDATE ficha  SET id_estado_ficha='$evaluacion', evaluacion_ficha='$concepto_genera'  WHERE id_ficha='$id_ficha_ante'";

            $resultado = $conexion->prepare($consulta);
            $validacion_id = $resultado->execute();
            echo
            "<script> swal({
                allowOutsideClick: false,
                title: '¡Exito!',
                text: 'Ficha de anteproyecto evaluada correctamente',
                type: 'success',
          }).then(function(){ 
            location.href='../../vista/rol_docente/fichas_asignadas_evaluador.php';
            }
         );
         ;</script>";
        }
    }
}
echo'</body>';
