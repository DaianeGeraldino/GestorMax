<?php

session_start();

$host = 'localhost';
$usuario = 'root';
$senha = 'serra';
$banco = 'gestorMax';
$port = '3306';

$conn = new mysqli($host, $usuario, $senha, $banco,$port);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>
