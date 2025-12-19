<?php
include('connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE nome = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['senha'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nome'];
            $_SESSION['lvl'] = $user['lvl'];

            $_SESSION['last_activity'] = time();
            $_SESSION['expire_time'] = 600;

            if ($user['lvl'] == 1) {
                header('Location: ../../templates/admin.php');
            } else {
                header('Location: ../../templates/user.php');
            }
            exit();

        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='../../templates/index.html';</script>";
        }

    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='../../templates/index.html';</script>";
    }
}
?>
