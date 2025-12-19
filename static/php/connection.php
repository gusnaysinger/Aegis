<?php 
$server = "localhost";
$user = "root";
$password = "";
$dbname = "aegis";

//criar conexao
$conn = mysqli_connect($server, $user, $password, $dbname);
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
?>