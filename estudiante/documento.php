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

<?php include("nav.php"); ?>

<div class="container">
    <div class="content">
        <h2>PDF</h2>
        <hr />

        <?php
        $nik = $_SESSION['id_usuario'];
        $sql = mysqli_query($con, "SELECT * FROM fichas INNER JOIN usuarios WHERE compa_id = id_usuario and  (usuario_id =$nik or compa_id =$nik ) ORDER By id_fi ASC");
        while ($record = mysqli_fetch_assoc($sql)) {
        ?>

            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="card-body info">
                    <div class="title">
                    </div>
                    <h3>
                        <?php
                        $id = $nik;
                        $path = "../pdf/" . $id;
                        if (file_exists($path)) {
                            $directorio = opendir($path);
                            while ($archivo = readdir($directorio)) {
                                if (!is_dir($archivo)) {
                                    echo "<iframe src='../pdf/$id/$archivo' height='100%' width='100%' />";
                                }
                            }
                        }
                        ?>



                </div>
            <?php } ?>
            </div>