<?php
include 'conexao.php';

$venda_id = isset($_GET['venda_id']) ? intval($_GET['venda_id']) : 0;
if ($venda_id <= 0) {
    die('ID da venda inválido.');
}

// Buscar dados da venda
$stmt = $conn->prepare("
    SELECT data_venda, total
    FROM vendas
    WHERE venda_id = ?
");

$stmt->bind_param("i", $venda_id);
$stmt->execute();
$venda = $stmt->get_result()->fetch_assoc();

if (!$venda) {
    die('Venda não encontrada.');
}

// Buscar itens
$stmt = $conn->prepare("
    SELECT p.nome, iv.quantidade, iv.valor_unitario
    FROM itens_venda iv
    INNER JOIN produtos p ON iv.produto_id = p.id
    WHERE iv.venda_id = ?
");
$stmt->bind_param("i", $venda_id);
$stmt->execute();
$result = $stmt->get_result();

$itens = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $subtotal = $row['quantidade'] * $row['valor_unitario'];
    $total += $subtotal;

    $itens[] = [
        'nome' => $row['nome'],
        'quantidade' => $row['quantidade'],
        'valor_unitario' => $row['valor_unitario'],
        'subtotal' => $subtotal
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<title>Venda Finalizada</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light p-5">
  <div class="container">
    <div class="card shadow">
      <div class="card-header bg-success text-white">
        <h4>Venda Finalizada com Sucesso!</h4>
      </div>
      <div class="card-body">
        <p><strong>ID da Venda:</strong> <?= $venda_id ?></p>
        <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($venda['data_venda'])) ?></p>
        <p><strong>Cliente:</strong> <?= htmlspecialchars($venda['cliente'] ?: 'Não informado') ?></p>

        <h5 class="mt-4">Itens da Venda:</h5>
        <table class="table table-bordered mt-2">
          <thead>
            <tr><th>Produto</th><th>Qtd</th><th>Valor Unitário</th><th>Subtotal</th></tr>
          </thead>
          <tbody>
            <?php foreach ($itens as $item): ?>
              <tr>
                <td><?= htmlspecialchars($item['nome']) ?></td>
                <td><?= $item['quantidade'] ?></td>
                <td>R$ <?= number_format($item['valor_unitario'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($itens)): ?>
              <tr><td colspan="4" class="text-center">Nenhum item registrado para esta venda.</td></tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr><th colspan="3" class="text-end">Total</th><th>R$ <?= number_format($total, 2, ',', '.') ?></th></tr>
          </tfoot>
        </table>

        <a href="vendas.php" class="btn btn-primary mt-3">Nova Venda</a>
      </div>
    </div>
  </div>
</body>
</html>
