<?php
include 'conexao.php';
header('Content-Type: application/json');

// VISÃO GERAL
$sqlTotalProdutos = "SELECT COUNT(*) AS total FROM produtos";
$sqlTotalItens = "SELECT SUM(quantidade_inicial) AS total FROM produtos";
$sqlValorEstoque = "SELECT SUM(quantidade_inicial * custo) AS total FROM produtos";
$sqlValorCusto = "SELECT SUM(custo * quantidade_inicial) AS total FROM produtos";
$sqlValorVenda = "SELECT SUM(valor_venda * quantidade_inicial) AS total FROM produtos";
$sqlEstoqueBaixo = "SELECT COUNT(*) AS total FROM produtos WHERE quantidade_inicial < quantidade_minima";

$resTotalProdutos = $conn->query($sqlTotalProdutos)->fetch_assoc()['total'] ?? 0;
$resTotalItens = $conn->query($sqlTotalItens)->fetch_assoc()['total'] ?? 0;
$resValorEstoque = $conn->query($sqlValorEstoque)->fetch_assoc()['total'] ?? 0;
$resValorCusto = $conn->query($sqlValorCusto)->fetch_assoc()['total'] ?? 0;
$resValorVenda = $conn->query($sqlValorVenda)->fetch_assoc()['total'] ?? 0;
$resEstoqueBaixo = $conn->query($sqlEstoqueBaixo)->fetch_assoc()['total'] ?? 0;

$lucroPotencial = $resValorVenda - $resValorCusto;
$margemMedia = $resValorCusto > 0 ? (($lucroPotencial / $resValorCusto) * 100) : 0;

$visaoGeral = [
  "totalProdutos" => (int)$resTotalProdutos,
  "totalItens" => (int)$resTotalItens,
  "valorEstoque" => (float)$resValorEstoque,
  "valorCusto" => (float)$resValorCusto,
  "valorVenda" => (float)$resValorVenda,
  "lucroPotencial" => (float)$lucroPotencial,
  "margemMedia" => (float)$margemMedia,
  "estoqueBaixo" => (int)$resEstoqueBaixo
];

// DETALHES POR CATEGORIA
$sqlCategorias = "
  SELECT 
    c.nome,
    COUNT(p.id) AS totalProdutos,
    SUM(p.quantidade_inicial) AS quantidadeTotal,
    SUM(p.quantidade_inicial * p.valor_venda) AS valorTotal,
    SUM(p.quantidade_inicial * (p.valor_venda - p.custo)) AS lucroPotencial
  FROM categorias c
  LEFT JOIN produtos p ON p.categoria_id = c.categoria_id
  GROUP BY c.nome
";

$detalhesCategorias = [];
$graficoCategorias = [
  "categorias" => [],
  "produtosPorCategoria" => [],
  "valorPorCategoria" => [],
  "margemPorCategoria" => [],
  "estoquePorCategoria" => []
];

$resCategorias = $conn->query($sqlCategorias);
while ($row = $resCategorias->fetch_assoc()) {
  $detalhesCategorias[] = $row;

  $custoTotal = $conn->query("
    SELECT SUM(p.custo * p.quantidade_inicial) AS totalCusto
    FROM produtos p
    JOIN categorias c ON p.categoria_id = c.categoria_id
    WHERE c.nome = '{$row['nome']}'
  ")->fetch_assoc()['totalCusto'] ?? 0;

  $lucro = (float)$row['lucroPotencial'];
  $margem = $custoTotal > 0 ? ($lucro / $custoTotal) * 100 : 0;

  $graficoCategorias['categorias'][] = $row['nome'];
  $graficoCategorias['produtosPorCategoria'][] = (int)$row['totalProdutos'];
  $graficoCategorias['valorPorCategoria'][] = (float)$row['valorTotal'];
  $graficoCategorias['margemPorCategoria'][] = round($margem, 1);
  $graficoCategorias['estoquePorCategoria'][] = (int)$row['quantidadeTotal'];
}

// PRODUTOS MAIS LUCRATIVOS
$sqlLucrativos = "
  SELECT 
    p.nome,
    c.nome AS categoria,
    p.custo,
    p.valor_venda,
    ((p.valor_venda - p.custo) / p.custo) * 100 AS margem,
    (p.valor_venda - p.custo) AS lucroUnidade
  FROM produtos p
  JOIN categorias c ON c.categoria_id = p.categoria_id
  ORDER BY lucroUnidade DESC
  LIMIT 10
";

$produtosLucrativos = [];
$resLucrativos = $conn->query($sqlLucrativos);
while ($row = $resLucrativos->fetch_assoc()) {
  $produtosLucrativos[] = $row;
}

// ESTOQUE BAIXO
$sqlEstoqueBaixoProdutos = "
  SELECT 
    p.nome,
    c.nome AS categoria,
    p.quantidade_inicial AS estoque,
    p.quantidade_minima AS minimo
  FROM produtos p
  JOIN categorias c ON c.categoria_id = p.categoria_id
  WHERE p.quantidade_inicial < p.quantidade_minima
";

$estoqueBaixo = [];
$resEstoqueBaixo = $conn->query($sqlEstoqueBaixoProdutos);
while ($row = $resEstoqueBaixo->fetch_assoc()) {
  $estoqueBaixo[] = $row;
}

// RESPOSTA FINAL
echo json_encode([
  "visaoGeral" => $visaoGeral,
  "detalhesCategorias" => $detalhesCategorias,
  "produtosLucrativos" => $produtosLucrativos,
  "estoqueBaixo" => $estoqueBaixo,
  "graficos" => $graficoCategorias
]);
