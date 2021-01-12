<?php

session_start();


if (!isset($_SESSION['id_rol_usu'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['id_rol_usu'] != 4) {
        header('location: ../login.php');
    }
}


?>

<?php
include("../include/conexion.php");
?>

<?php include("nav.html"); ?>


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />
    <title>Fichas</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../assets/mainTable.css">


    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../assets/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/gif" />

</head>

<div class="container">
    <div class="content">
        <br></br>
        <h2>PDF</h2>
        <hr />

        <?php
        $nik = $_SESSION['id_usuario'];
        $sql = mysqli_query($con, "SELECT * FROM lista_ficha  WHERE id_lista_usuario=$nik");
        while ($record = mysqli_fetch_assoc($sql)) {
            $id = $record['id_lista_ficha']


        ?>

            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="card-body info">
                    <div class="title">
                    </div>
                    <h3>
                        <?php

                        $path = "../include/estudiante/pdf/" . $id;
                        if (file_exists($path)) {
                            $directorio = opendir($path);
                            while ($archivo = readdir($directorio)) {
                                if (!is_dir($archivo)) {
                                    echo "<iframe src='../include/estudiante/pdf/$id/$archivo' height='820' width='100%' />";
                                }
                            }
                        }
                        ?>



                </div>
            <?php } ?>
            </div>