<?php
include 'conexao.php';  // Conexão com o banco

$termo = $_GET['termo'] ?? '';

$sql = "SELECT id, nome, quantidade_inicial, valor_venda FROM produtos WHERE nome LIKE ?";
$stmt = $conn->prepare($sql);
$busca = '%' . $termo . '%';
$stmt->bind_param('s', $busca);
$stmt->execute();

$result = $stmt->get_result();
$produtos = [];

while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($produtos);
