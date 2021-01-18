<?php
include('../include/estudiante/add_ficha.php')
?>





<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />
    <title>Primer Ficha</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../assets/mainTable.css">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/gif" />

</head>

<body>
    <?php include('nav.php');

    include("../include/estudiante/add_director.php");
    ?>


    <header>

    </header>
    <br></br>
    <br></br>

    <br>

    <div class="container ">

        <div class="content">
        
			
			
			<section>
				<h2>Crea tu primer ficha para continuar con el proceso</h2>
			</section>
			<hr />
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">Titulo de la ficha</label>
                                <input type="text" class="form-control" name="titulo_ficha" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" enctype="multipart/form-data">
                        <label for="" class="col-form-label">Documento</label>
                        <div class="col-lg-6">
                            <input type="file" name="archivo" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button input type="submit" name="add" id="btnGuardar" class="btn btn-primary">Guardar</button>
                </div>
        </div>
        </form>
    </div>
    </div>


    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- datatables JS -->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../include/estudiante/js/ficha.js"></script>
</body>

</html>