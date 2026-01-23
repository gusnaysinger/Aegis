<?php
mysqli_report(MYSQLI_REPORT_OFF);
include('connection.php');

$username = mysqli_real_escape_string($conn, $_POST['username']);
$cpf = preg_replace('/\D/', '', $_POST['cpf']);
$password = $_POST['password'];
$level = 0;

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (nome, cpf, senha, lvl)
          VALUES ('$username', '$cpf', '$hashedPassword', '$level')";

if (mysqli_query($conn, $query)) {
    header('Location: ../../templates/index.html?registered=1');
    exit;
}

if (mysqli_errno($conn) == 1062) {
    header('Location: ../../templates/userRegister.php?error=duplicate');
    exit;
}

// erro genérico
header('Location: ../../templates/userRegister.php?error=server');
exit;
