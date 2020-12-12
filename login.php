<?php
include_once 'database.php';

session_start();

if (isset($_GET['cerrar_sesion'])) {
    session_unset();

    // destroy the session 
    session_destroy();
}

if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
            //administrador
        case 1:
            header('location: crud/usuarios.php');
            break;
            //docente
        case 2:
            header('location: docente/inicio_docente.php');
            break;
            //coordinador
        case 3:
            header('location: coordinador/inicio_coordinador.php');
            break;
            //estudiante
        case 4:
            header('location: estudiante/inicio_estudiante.php');
            break;

        default:
    }
}

if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
    $correo = $_POST['correo'];
    $contrasena = htmlentities(addslashes($_POST['contrasena']));

    $db = new Database();
    $query = $db->connect()->prepare('SELECT *FROM usuarios WHERE correo = :correo AND contrasena = :contrasena');

    $query->execute(['correo' => $correo, 'contrasena' => $contrasena]);


    $row = $query->fetch(PDO::FETCH_NUM);
    if (is_array($row)) {


        if ($row == true) {
            $rol = $row[5];
            $_SESSION['rol'] = $rol;
            switch ($rol) {

                    //administrador
                case 1:
                    header('location: crud/usuarios.php');
                    echo $row['contrasena'];
                    break;
                    //docente
                case 2:
                    header('location: docente/inicio_docente.php');
                    break;
                    //coordinador
                case 3:
                    header('location: coordinador/inicio_coordinador.php');
                    break;
                    //estudiante
                case 4:
                    header('location: estudiante/inicio_estudiante.php');
                    break;

                default:
            }
        } else {
            // no existe el usuario

            $errorLogin = "Nombre de usuario y/o password incorrecto";
        }
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.ico" type="image/gif" />
    <title>Login</title>

    <link rel="stylesheet" href="css/login.css">
</head>
<?php include('nav.php'); ?>

<body background="images/Fondo.jpg">

    <br>
    <br>
    <br>
    <form action="" method="POST">
        <?php
        if (isset($errorLogin)) {
            echo $errorLogin;
        }
        ?>
        <center>
            <img src="images/home.png"></img>
            <br>
            <br>
            <br>
            <h2 style="color:white;">Iniciar sesión</h2>

        </center>
        <p style="color:white;">Correo: <br>
            <input style="color:black" type="email" name="correo"></p>

        <p style="color:white;">Contraseña: <br>
            <input style="color:black" type="password" name="contrasena"></p>
        <p class="center"><input type="submit" value="Iniciar Sesión"></p>


    </form>
</body>

</html>