<?php
include('../static/php/connection.php');

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['lvl'] != 0) {
    header('Location: /Aegis/templates/index.html');
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
                                <a class="nav-link" href="user.php">Enviar Arquivo</a>
                            </li>
                            <li class="nav-item w-50">
                                <a class="nav-link active" aria-current="page" href="./arquivos.php">Arquivos Recebidos</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="card-body">

                <?php
                $userId = $_SESSION['user_id'];

                $sql = "
                    SELECT 
                        f.id,
                        f.original_name,
                        f.created_at,
                        u.nome AS sender_name
                    FROM files f
                    INNER JOIN users u ON u.id = f.sender_id
                    WHERE f.recipient_id = ?
                    ORDER BY f.created_at DESC
                ";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Arquivo</th>
                                <th>Enviado por</th>
                                <th>Data</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if ($result->num_rows === 0): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Nenhum arquivo recebido
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['original_name']) ?></td>

                                        <td><?= htmlspecialchars($row['sender_name']) ?></td>

                                        <td>
                                            <?= date('d/m/Y H:i', strtotime($row['created_at'])) ?>
                                        </td>

                                        <td class="text-center">
                                            <a 
                                                href="/Aegis/static/php/download.php?id=<?= (int)$row['id'] ?>"
                                                class="btn btn-success btn-sm"
                                                title="Download"
                                            >
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>

                        </tbody>
                    </table>

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