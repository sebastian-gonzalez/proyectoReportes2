<?php

$_SESSION['id_lista_ficha'] = $id_ficha;

eliminarAR("pdf/$id_ficha");

function eliminarAR($carpeta)
{
    foreach (glob($carpeta . "/*") as $archivo_carpeta) {
        if (is_dir($archivo_carpeta)) {
            eliminarAR($archivo_carpeta);
        } else {
            unlink($archivo_carpeta);
        }
    }
    rmdir($carpeta);
}