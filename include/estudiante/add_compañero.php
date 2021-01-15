<?php

$db = new Database();
$id_s = $_SESSION['id_usuario'];


	$query_ficha = $db->connect()->prepare("SELECT *FROM lista_ficha WHERE id_lista_usuario =$id_s");
	$query_ficha->execute();
	$row_ficha = $query_ficha->fetch(PDO::FETCH_NUM);
	

	if ($row_ficha == true) {
		$id_lis = $row_ficha[0];
		$_SESSION['id_lista'] = $id_lis;

		$id_lis_u = $row_ficha[1];
		$_SESSION['id_lista_usuario'] = $id_lis_u ;

		$id_lis_fi = $row_ficha[2];
		$_SESSION['id_lista_ficha'] = $id_lis_fi;

		$id_rol_fi = $row_ficha[3];
		$_SESSION['id_rol_ficha'] = $id_rol_fi;

	}
?>




<?php
if (isset($_POST['add_participante'])) {


    //asignar companero
    $id_lista_usuario = (isset($_POST['id_lista_usuario'])) ? $_POST['id_lista_usuario'] : '';
    $id_lista_ficha = $_SESSION['id_lista_ficha'];
    $id_rol_ficha = 1;


    $consulta_participante = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
         VALUES('$id_lista_usuario','$id_lista_ficha', '$id_rol_ficha') ";

    $resultado_participante = $conexion->prepare($consulta_participante);
    $resultado_participante->execute();

    //asignar director

    $id_lista_usuario2 = (isset($_POST['id_lista_usuario_director'])) ? $_POST['id_lista_usuario_director'] : '';
    $id_lista_ficha = $_SESSION['id_lista_ficha'];
    $id_rol_ficha = 2;


    $consulta_participante = "INSERT INTO lista_ficha (id_lista_usuario,id_lista_ficha,id_rol_ficha)
         VALUES('$id_lista_usuario2','$id_lista_ficha', '$id_rol_ficha') ";

    $resultado_participante = $conexion->prepare($consulta_participante);
    $resultado_participante->execute();


}
