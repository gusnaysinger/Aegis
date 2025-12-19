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
                                <a class="nav-link" href="admin.php">Usuarios</a>
                            </li>
                            <li class="nav-item w-50">
                                <a class="nav-link active" aria-current="page" href="./register.php">Registrar</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="card-body">

                <form method="POST" action="../static/php/register.php">
                    <div class="rows">
                        <div class="row justify-content-center">
                            <div class="col-10 h-10">
                                <input type="text" id="username" name="username" class="form-control" placeholder="User" aria-label="User" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <div class="input-group mb-3">
                                    <input type="Password" id="password" name="password" class="form-control" placeholder="Senha" aria-label="Senha" aria-describedby="showPassword">
                                    <button class="btn btn-outline-secondary" type="button" id="showPassword"><i class='fas fa-eye'></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <select class="form-select" id="userLevel" name="level">
                                    <option selected value="0">Usuario</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <button id="login-button" type="submit" class="btn btn-outline-primary">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-footer border-0">
                <span>Sistema desenvolvido por Sd Naysinger - 2025</span>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/0635eb955e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../static/js/script.js"></script>
</body>
</html>