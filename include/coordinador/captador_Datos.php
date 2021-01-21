<?php 
include ("../../include/conexion.php");
$id_ficha_compa = (isset($_POST['id_fichas'])) ? $_POST['id_fichas'] : ''; 
?>
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
                        
                                    $id_ficha_compa = (isset($_POST['id_fichas'])) ? $_POST['id_fichas'] : '';
                                


                                $sql = mysqli_query($con, "SELECT * FROM usuarios INNER JOIN lista_ficha INNER JOIN rol_lista ON usuarios.id_usuario = lista_ficha.id_lista_usuario AND rol_lista.id_rol_lista = lista_ficha.id_rol_ficha AND lista_ficha.id_lista_ficha = $id_ficha_compa ORDER BY id_rol_ficha");
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