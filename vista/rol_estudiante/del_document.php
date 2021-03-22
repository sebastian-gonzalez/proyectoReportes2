<?php
$url = $_POST['url'];
$name = $_POST['name'];
$idficha = $_POST['idficha'];

$path = "../../controlador/estudiante/inactivo/".$idficha."/".$name;
$pathidficha = "../../controlador/estudiante/inactivo/".$idficha;


if (is_file($url)){
if (file_exists($pathidficha)) {

    rename($url, $path); 

    print json_encode(array('success' => 1));

    
}else{

    mkdir($pathidficha, 0700);

    rename($url, $path);
    print json_encode(array('success' => 1));
       
    }

    
}

