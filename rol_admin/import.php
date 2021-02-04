

<?php

//import.php

include '../vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=db_proyecto", "root", "");

$Programa_id    = (isset($_POST['id_programa_usu'])) ? $_POST['id_programa_usu'] : '';
$Rol_id    = (isset($_POST['id_rol_usu'])) ? $_POST['id_rol_usu'] : '';

if ($_FILES["import_excel"]["name"] != '') {
    $allowed_extension = array('xls', 'csv', 'xlsx');
    $file_array = explode(".", $_FILES["import_excel"]["name"]);
    $file_extension = end($file_array);

    if (in_array($file_extension, $allowed_extension)) {
        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($file_name);

        unlink($file_name);

        $data = $spreadsheet->getActiveSheet()->toArray();



        foreach ($data as $row) {
            $insert_data = array(
                ':cedula'  => $row[0],
                ':nombre'  => $row[1],
                ':apellido'  => $row[2],
                ':correo'  => $row[3],
                ':contrasena'  => $row[4],

            );


            $query = "
   INSERT INTO usuarios
   (cedula_usu, nombre_usu, apellido_usu, correo_usu,contrasena_usu,id_rol_usu,id_programa_usu) 
   VALUES (:cedula, :nombre, :apellido, :correo,:contrasena, $Rol_id , $Programa_id)
   ";

            $statement = $connect->prepare($query);
            $statement->execute($insert_data);
        }
        $message = '<div class="alert alert-success">Datos importados correctamente</div>';
    } else {
        $message = '<div class="alert alert-danger">Solo archivos .xls .csv o .xlsx </div>';
    }
} else {
    $message = '<div class="alert alert-danger">Por favor selecciona un archivo</div>';
}

echo $message;
