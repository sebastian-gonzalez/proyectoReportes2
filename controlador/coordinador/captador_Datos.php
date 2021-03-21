<?php

include("../conexion.php");



?>
<div class="row table_modal">
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Cedula </th>
                    <th scope="col">Nombre </th>
                    <th scope="col"> Apellido </th>
                    <th scope="col"> Rol </th>
                    <th scope="col"> Opciones </th>

                </tr>
            </thead>
            <br></br>
            <?php
            $id_ficha_compa = (isset($_POST['id_fichas'])) ? $_POST['id_fichas'] : '';
            $query = "SELECT * FROM usuarios INNER JOIN lista_ficha INNER JOIN rol_lista ON usuarios.id_usuario = lista_ficha.id_lista_usuario AND rol_lista.id_rol_lista = lista_ficha.id_rol_ficha  AND usuarios.activo is null  AND lista_ficha.activo is null  AND lista_ficha.id_lista_ficha = '" . $id_ficha_compa . "' ORDER BY id_rol_ficha";
            $sql = mysqli_query($con, $query);
            if (mysqli_num_rows($sql) == 0) {
                echo 'no hay datos';
            } else {
                while ($valores = mysqli_fetch_assoc($sql)) {
                    echo '
                                            <tbody>
                                    <tr> 
                                    <td>' . $valores['cedula_usu'] . '</td>   
                                    <td>' . $valores['nombre_usu'] . '</td>
                                    <td>' . $valores['apellido_usu'] . '</td>
                                    <td>' . $valores['nombre_rol_ficha'] . '</td>
                                    <td><a href="Eliminar_Participante.php?aksi=delete&nik=' . $valores['id_lista'] . '" title="Eliminar"  class="btn btn-danger btn-sm fa fa-trash-o"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>    </td>

                                    </tr>
                                    
                                    </tbody>';
                }
            }
            ?>

        </table>
    </div>
</div>