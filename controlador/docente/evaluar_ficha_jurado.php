


<?php
include_once '../../controlador/database.php';
$objeto = new Database();
$conexion = $objeto->connect();
include('../conexion.php');






if (isset($_POST['evaluarp'])) {




    if (isset($_GET['aktrl']) == 'addp') {

        $id_ficha_pro = mysqli_real_escape_string($con, (strip_tags($_GET["nikfi"], ENT_QUOTES)));



        $a1 = mysqli_real_escape_string($con, (strip_tags($_POST["a1"], ENT_QUOTES)));
        $a2 = mysqli_real_escape_string($con, (strip_tags($_POST["a2"], ENT_QUOTES)));
        $a3 = mysqli_real_escape_string($con, (strip_tags($_POST["a3"], ENT_QUOTES)));
        $a = (($a1 + $a2 + $a3) / 3) * 0.2;
        $afin = round($a, 2);


        $b1 = mysqli_real_escape_string($con, (strip_tags($_POST["b1"], ENT_QUOTES)));
        $b2 = mysqli_real_escape_string($con, (strip_tags($_POST["b2"], ENT_QUOTES)));
        $b3 = mysqli_real_escape_string($con, (strip_tags($_POST["b3"], ENT_QUOTES)));
        $b4 = mysqli_real_escape_string($con, (strip_tags($_POST["b4"], ENT_QUOTES)));
        $b5 = mysqli_real_escape_string($con, (strip_tags($_POST["b5"], ENT_QUOTES)));
        $b6 = mysqli_real_escape_string($con, (strip_tags($_POST["b6"], ENT_QUOTES)));
        $b7 = mysqli_real_escape_string($con, (strip_tags($_POST["b7"], ENT_QUOTES)));
        $b = (($b1 + $b2 + $b3 + $b4 + $b5 + $b6 + $b7) / 7) * 0.25;
        $bfin = round($b, 2);

        $c1 = mysqli_real_escape_string($con, (strip_tags($_POST["c1"], ENT_QUOTES)));
        $c2 = mysqli_real_escape_string($con, (strip_tags($_POST["c2"], ENT_QUOTES)));
        $c3 = mysqli_real_escape_string($con, (strip_tags($_POST["c3"], ENT_QUOTES)));
        $c4 = mysqli_real_escape_string($con, (strip_tags($_POST["c4"], ENT_QUOTES)));
        $c5 = mysqli_real_escape_string($con, (strip_tags($_POST["c5"], ENT_QUOTES)));
        $c6 = mysqli_real_escape_string($con, (strip_tags($_POST["c6"], ENT_QUOTES)));
        $c7 = mysqli_real_escape_string($con, (strip_tags($_POST["c7"], ENT_QUOTES)));
        $c = (($c1 + $c2 + $c3 + $c4 + $c5 + $c6 + $c7) / 7) * 0.15;
        $cfin = round($c, 2);

        $eva_jurado_fi = $afin + $bfin + $cfin;






        $consulta_validacion_pro = "SELECT  d,eva_jurado FROM evaluacion_proyecto WHERE id_lista_ficha_eva  =$id_ficha_pro AND  evaluacion_proyecto.activo IS null";
        $resultado_vali = $conexion->prepare($consulta_validacion_pro);
        $data_vali = $resultado_vali->execute();

        foreach ($resultado_vali as $data) {

            $eva_jurado_final = $data['eva_jurado'];
            $eva_director_final = $data['d'];
        }




        if (isset($eva_jurado_final) or isset($eva_director_final)) {

            $consulta = "UPDATE evaluacion_proyecto  SET a1='$a1',a2='$a2',a3='$a3',a='$afin',b1='$b1',b2='$b2',b3='$b3',b4='$b4',b5='$b5',b6='$b6',b7='$b7',b='$bfin',c1='$c1',c2='$c2',c3='$c3' ,c4='$c4',c5='$c5',c6='$c6',c7='$c7',c='$cfin',eva_jurado='$eva_jurado_fi'  WHERE id_lista_ficha_eva='$id_ficha_pro' AND evaluacion_proyecto.activo is null";
            $resultado = $conexion->prepare($consulta);
            $validacion_id = $resultado->execute();



            $consulta_validacion_final = "SELECT COUNT(*) FROM evaluacion_proyecto WHERE id_lista_ficha_eva  =$id_ficha_pro AND  evaluacion_proyecto.activo IS null  AND evaluacion_proyecto.d is not null AND evaluacion_proyecto.eva_jurado is not null ";
            $resultado_vali_final = $conexion->prepare($consulta_validacion_final);
            $data_vali1 = $resultado_vali_final->execute();

            if ($resultado_vali_final->fetchColumn() > 0) {

                $totalnota =  $eva_jurado_fi + $eva_director_final;
                $nota = round($totalnota, 1);

                if ($nota < 2.5) {
                    $estado_proyecto = 'Reprobado';
                    $estadofi = 5;
                } else if ($nota >= 2.5 && $totalnota < 3.5) {
                    $estado_proyecto = 'Reprobado';
                    $estadofi = 5;
                } else if ($nota >= 3.5 && $totalnota < 4.5) {
                    $estado_proyecto = 'Aprobado';
                    $estadofi = 4;
                } else if ($nota >= 4.5 && $totalnota <= 4.8) {
                    $estado_proyecto = 'Meritorio';
                    $estadofi = 4;
                } else if ($nota > 4.8 && $totalnota < 5) {
                    $estado_proyecto = 'Laureado';
                    $estadofi = 4;
                }

                $consulta_evaluacionfinal = "UPDATE ficha SET id_estado_ficha='$estadofi' WHERE id_ficha  =$id_ficha_pro AND  ficha.activo IS null ";
                $resultado_vali_final = $conexion->prepare($consulta_validacion_final);
                $data_vali1 = $resultado_vali_final->execute();


                $consulta = "UPDATE evaluacion_proyecto  SET nota_final='$nota',estado_eva_pro='$estado_proyecto' WHERE id_lista_ficha_eva='$id_ficha_pro' AND  evaluacion_proyecto.activo is null  ";
                $resultado = $conexion->prepare($consulta);
                $validacion_id = $resultado->execute();
            } else {
            }



            echo '<script language="javascript">
            location.href="../../vista/rol_docente/fichas_asignadas_jurado.php";</script>';
        } else {


            $eva_proyecto = "INSERT INTO evaluacion_proyecto (a1,a2,a3,a,b1,b2,b3,b4,b5,b6,b7,b,c1,c2,c3,c4,c5,c6,c7,c,eva_jurado,id_lista_ficha_eva)
            VALUES('$a1','$a2','$a3','$afin', '$b1', '$b2', '$b3', '$b4', '$b5', '$b6', '$b7', '$bfin', '$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$c7', '$cfin', '$eva_jurado_fi', '$id_ficha_pro' ) ";
            $eva_proyecto = $conexion->prepare($eva_proyecto);
            $eva_proyecto->execute();

            echo '<script language="javascript">
            location.href="../../vista/rol_docente/fichas_asignadas_jurado.php";</script>';
        }
    }



    if (isset($_GET['evadi']) == 'adddi') {

        $id_ficha_pro = mysqli_real_escape_string($con, (strip_tags($_GET["nikfi"], ENT_QUOTES)));



        $d1 = mysqli_real_escape_string($con, (strip_tags($_POST["d1"], ENT_QUOTES)));
        $d2 = mysqli_real_escape_string($con, (strip_tags($_POST["d2"], ENT_QUOTES)));
        $d3 = mysqli_real_escape_string($con, (strip_tags($_POST["d3"], ENT_QUOTES)));
        $d = (($d1 + $d2 + $d3) / 3) * 0.4;
        $dfinal = round($d, 2);







        $consulta_validacion_pro = "SELECT  d,eva_jurado FROM evaluacion_proyecto WHERE id_lista_ficha_eva  =$id_ficha_pro AND  evaluacion_proyecto.activo IS null";
        $resultado_vali = $conexion->prepare($consulta_validacion_pro);
        $data_vali = $resultado_vali->execute();

        foreach ($resultado_vali as $data) {

            $eva_jurado_final = $data['eva_jurado'];
            $eva_director_final = $data['d'];
        }




        if (isset($eva_jurado_final) or isset($eva_director_final)) {

            $consulta = "UPDATE evaluacion_proyecto  SET d1='$d1',d2='$d2',d3='$d3',d='$dfinal' WHERE id_lista_ficha_eva='$id_ficha_pro' AND evaluacion_proyecto.activo is null";
            $resultado = $conexion->prepare($consulta);
            $validacion_id = $resultado->execute();



            $consulta_validacion_final = "SELECT COUNT(*) FROM evaluacion_proyecto WHERE id_lista_ficha_eva  =$id_ficha_pro AND  evaluacion_proyecto.activo IS null  AND evaluacion_proyecto.d is not null AND evaluacion_proyecto.eva_jurado is not null ";
            $resultado_vali_final = $conexion->prepare($consulta_validacion_final);
            $data_vali1 = $resultado_vali_final->execute();

            if ($resultado_vali_final->fetchColumn() > 0) {

                $totalnota =  $eva_jurado_final + $dfinal;
                $nota = round($totalnota, 1);

                if ($nota < 2.5) {
                    $estado_proyecto = 'Reprobado';
                    $estadofi =5;
                } else if ($nota >= 2.5 && $totalnota < 3.5) {
                    $estado_proyecto = 'Reprobado';
                    $estadofi =5;
                } else if ($nota >= 3.5 && $totalnota < 4.5) {
                    $estado_proyecto = 'Aprobado';
                    $estadofi =4;
                } else if ($nota >= 4.5 && $totalnota <= 4.8) {
                    $estado_proyecto = 'Meritorio';
                    $estadofi =4;
                } else if ($nota > 4.8 && $totalnota < 5) {
                    $estado_proyecto = 'Laureado';
                    $estadofi =4;
                }
                

          

                $consulta_evaluacionfinal = "UPDATE ficha SET id_estado_ficha=$estadofi WHERE id_ficha=$id_ficha_pro AND  ficha.activo IS null ";
                $resultado_vali_final = $conexion->prepare($consulta_evaluacionfinal);
                $data_vali1 = $resultado_vali_final->execute();


                $consulta = "UPDATE evaluacion_proyecto  SET nota_final='$nota',estado_eva_pro='$estado_proyecto' WHERE id_lista_ficha_eva='$id_ficha_pro' AND  evaluacion_proyecto.activo is null  ";
                $resultado = $conexion->prepare($consulta);
                $validacion_id = $resultado->execute();
                echo '<script language="javascript">
                location.href="../../vista/rol_docente/fichas_asignadas_director.php";</script>';

            } else {
            }


            echo '<script language="javascript">
            location.href="../../vista/rol_docente/fichas_asignadas_director.php";</script>';
        } else {


            $eva_proyecto = "INSERT INTO evaluacion_proyecto (d1,d2,d3,d,id_lista_ficha_eva)
            VALUES('$d1','$d2','$d3','$dfinal','$id_ficha_pro' ) ";
            $eva_proyecto = $conexion->prepare($eva_proyecto);
            $eva_proyecto->execute();

          
            echo '<script language="javascript">
            location.href="../../vista/rol_docente/fichas_asignadas_director.php";</script>';
        }
    }
}
