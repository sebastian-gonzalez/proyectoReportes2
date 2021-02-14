<div class="modal fade" id="edit_<?php echo $record['id_campo'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hnameden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">


                <h4 class="modal-title" id="myModalLabel"> Editar <?php echo $record['descripcion_campo'] ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hnameden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluname">
                    <form method="post" <?php echo 'action="../../controlador/estudiante/editar_campos_ficha.php?aksi=edit&nik=' . $record['id_campo'] . '"'; ?>>
                        <div class="modal-body">


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="" class="col-form-label"> <?php echo $record['descripcion_campo'] ?> </label>
                                        <input type="text" class="form-control largocampo" name="valor_campo" required value='<?php echo $record['valor_campo'] ?>'>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button input type="submit" name="editcampo" class="btn btn-dark">Guardar</button>
                        </div>

                </div>


                </form>
            </div>

        </div>
    </div>
</div>		

