<?php
include('connection.php');

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];
$level = mysqli_real_escape_string($conn, $_POST['level']);


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (nome, senha, lvl) 
          VALUES ('$username', '$hashedPassword', '$level')";

mysqli_query($conn, $query);

header('Location: ../../templates/admin.php');
?>