

<?php

include('../../controlador/conexion.php');

			if (isset($_GET['aksi']) == 'delete') {
				// escaping, additionally removing everything that could be (html/javascript-) code

				$nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista='$nik'");
				if (mysqli_num_rows($cek) == 0) {
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				} else {
					$delete = mysqli_query($con, "DELETE FROM lista_ficha  WHERE id_lista='$nik'");
					if ($delete) {
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';


                        echo '<script language="javascript">alert("Registro con exito");
                        location.href="../../rol_coordinador/inicio_coordinador.php";</script>';
                        
					} else {
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>