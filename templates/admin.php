<?php
include('../static/php/connection.php');

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['lvl'] != 1) {
    header('Location: /Aegis/templates/index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
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
                <img src="../static/image/Icon2.png" alt="Aegis" id="icon">
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
                            <li class="nav-item w-15">
                                <button class="btn btn-sm btn-outline-danger mt-2"onclick="logout()">
                                    <i class='fas fa-sign-out-alt'></i>
                                </button>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM users ORDER BY lvl ASC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                                echo "<tr>";
                                echo "<th scope='row'>{$row['id']}</th>";
                                echo "<td>{$row['nome']}</td>";

                                // Tipo de usuário
                                if ($row['lvl'] == 1) {
                                    echo "<td><span class='badge bg-danger'>Admin</span></td>";
                                } else {
                                    echo "<td><span class='badge bg-secondary'>Usuário</span></td>";
                                }

                                // Ações
                                // <button class='btn btn-sm btn-warning'
                                // onclick='getUser({$row['id']})'>
                                // <i class='fas fa-pen'></i>
                                // </button>
                                echo "<td>
                                    <button class='btn btn-sm btn-danger'
                                            onclick='deletUser({$row['id']})'>
                                        <i class='fas fa-trash-can'></i>
                                    </button>
                                </td>";

                                echo "</tr>";
                            }

                        } else {
                            echo "<tr><td colspan='4'>Nenhum usuário encontrado</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="card-footer border-0">
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/0635eb955e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../static/js/script.js"></script>
</body>
</html>