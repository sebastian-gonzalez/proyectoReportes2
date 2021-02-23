<?php

$id_fichapdf = (isset($_POST['id_fichas'])) ? $_POST['id_fichas'] : '';

?>

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"></h5>
    <button type="button" class="close" data-dismiss="modal" post aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
</div>
<form <?php echo 'action="../../controlador/docente/evaluar_ficha_jurado.php?ficha=' . $id_fichapdf . '"' ?> enctype="multipart/form-data" method="post">
    <div class="modal-body">


        <div class="row">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="" class="col-form-label">Estado de la ficha</label>

                    <select name="id_estado_ficha" id="id_estado_ficha" class="form-control" required>
                        <option disabled selected value="">Seleccione el estado de ficha</option>
                        <option value="4">Finalizado</option>
                        <option value="5">Rechazado</option>
                    </select>
                </div>

            </div>
        </div>
        <div class="form-group" enctype="multipart/form-data">
            <label for="" class="col-form-label">Documento</label>
            <div class="col-lg-6">

                <?php



                $path = "../../controlador/estudiante/eva_proyecto_final/" . $id_fichapdf;


                if (is_dir($path)) {

                    $verifi = @scandir($path);

                    if (count($verifi) >  2) {
                        if (file_exists($path)) {
                            $directorio = opendir($path);
                            while ($archivo = readdir($directorio)) {
                                if (!is_dir($archivo)) {
                                    echo "<div data='" . $path . "/" . $archivo . "'>
                                      <a href = '" . $path . "/" . $archivo . "'
                                      title = 'Ver Archivo Adjunto'>
                                      <span class='fa fa-file-pdf-o' aria-hidden='true'></span></a>";

                                    echo "$archivo <a href ='fichas_asignadas_evaluador.php 'id = 'deleteante'
                                      title = 'Eliminar Archivo Adjunto'>
                                      
                                      <span class='fa fa-trash' aria-hidden='true'></span></a></div>";

                                    echo "<iframe src='../../controlador/estudiante/eva_proyecto_final/$id_fichapdf/$archivo' width='400'> </iframe>";
                                }
                            }
                        }
                    } else {

                        echo '<input type="file" name="eva_proyecto_final">';
                    }
                } else {
                    mkdir($path, 0777, true);

                    if (is_dir($path)) {

                        $verifi = @scandir($path);
                    }
                    if (count($verifi) >  2) {
                        if (file_exists($path)) {
                            $directorio = opendir($path);
                            while ($archivo = readdir($directorio)) {
                                if (!is_dir($archivo)) {
                                    echo "<div data='" . $path . "/" . $archivo . "'>
                                      <a href = '" . $path . "/" . $archivo . "'
                                      title = 'Ver Archivo Adjunto'>
                                      <span class='fa fa-file-pdf-o' aria-hidden='true'></span></a>";

                                    echo "$archivo <a href ='fichas_asignadas_evaluador.php' id = 'deleteante'
                                      title = 'Eliminar Archivo Adjunto'>
                                      
                                      <span class='fa fa-trash' aria-hidden='true'></span></a></div>";



                                    echo "<iframe src='../../controlador/estudiante/eva_proyecto_final/$id_fichapdf/$archivo' width='400'> </iframe>";
                                }
                            }
                        }
                    } else {

                        echo '<input type="file" name="eva_proyecto_final">';
                    }
                }
                ?>

            </div>
        </div>

    </div>
    <div class="modal-footer">

        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="guardarjura" class="btn btn-dark">Guardar</button>
    </div>
</form>


<script>
    $('#deleteante').click(function() {
        alert('eliminar anteproyecto');

        var parent = $(this).parent().attr('id');
        var service = $(this).parent().attr('data');
        var dataString = 'id=' + service;
        $.ajax({
            type: "POST",
            url: "del_document.php",
            data: dataString,

            succes: function() {

            }
        });

    });
</script>