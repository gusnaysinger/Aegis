<?php
include('connection.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário excluido com sucesso!";
    } else {
        echo "Erro ao excluir usuário.";
    }
}
?>