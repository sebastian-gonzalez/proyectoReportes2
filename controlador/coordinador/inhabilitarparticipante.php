<?php
	include('../../controlador/conexion.php');

     $participante = mysqli_real_escape_string($con, (strip_tags($_POST["id_lista_usuario"], ENT_QUOTES)));
  
     $delete = mysqli_query($con, "UPDATE lista_ficha SET activo='N' WHERE id_lista='$participante'");

?>
