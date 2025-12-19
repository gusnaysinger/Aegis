<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['lvl'] != 1) {
    header('Location: ../../templates/index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../static/css/styles.css">
    <title>Aegis - Sistema Privado de Compartilhamento de Arquivos</title>
</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card w-80 w-sm-75 w-md-50 w-lg-25 text-center">
            <div class="card-header">
                <h2>Aegis</h2>
                <br>
                <!-- <p>Sistema Privado de Compartilhamento de Arquivos</p> -->
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-50">
                                <a class="nav-link active" href="admin.php">Usuarios</a>
                            </li>
                            <li class="nav-item w-50">
                                <a class="nav-link" aria-current="page" href="./register.php">Registrar</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="card-body">


            </div>
            <div class="card-footer border-0">
                <span>Sistema desenvolvido por Sd Naysinger - 2025</span>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../static/js/script.js"></script>
</body>
</html>