<?php
include_once 'database.php';
//Inicializar la sesión
session_start();




if (isset($_GET['cerrar_sesion'])) {
    session_unset();

    // destroy the session 
    session_destroy();
}

    $db = new Database();

    $query_compa = $db->connect()->prepare('SELECT compa_id FROM fichas');
    $row_compa = $query_compa->fetch(PDO::FETCH_NUM);

    if (is_array($row_compa)) {
        if ($row_compa == true) {
            $compa = $row_compa[7];
        }
    }


    $query = $db->connect()->prepare('SELECT *FROM usuarios WHERE correo = :correo AND contrasena = :contrasena');
    $query->execute(['correo' => $correo, 'contrasena' => $contrasena]);

    $row = $query->fetch(PDO::FETCH_NUM);
    if (is_array($row)) {

        if (($row) == true) {
            $id_s = $row[0];
            $_SESSION['id_usuario'] = $id_s;

            $nombre = $row[2];
            $_SESSION['nombre'] = $nombre;

            $facultad = $row[7];
            $_SESSION['facultad_idd'] = $facultad;

            $_SESSION['compa_id'] = $compa;

            $rol = $row[6];
            $_SESSION['rol'] = $rol;

           
    }
}
