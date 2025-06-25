<?php
include 'conexao.php';
header('Content-Type: application/json');


// Consulta geral
$visaoGeral = [
  "totalProdutos" => 0,
  "totalItens" => 0,
  "valorEstoque" => 0,
  "valorCusto" => 0,
  "valorVenda" => 0,
  "lucroPotencial" => 0,
  "margemMedia" => 0,
  "estoqueBaixo" => 0
];

// Preenche visão geral
$res = $conn->query("
  SELECT 
    COUNT(*) AS totalProdutos,
    SUM(quantidade_inicial) AS totalItens,
    SUM(quantidade_inicial * custo) AS valorCusto,
    SUM(quantidade_inicial * valor_venda) AS valorVenda,
    SUM(CASE WHEN quantidade_inicial < quantidade_minima THEN 1 ELSE 0 END) AS estoqueBaixo
  FROM produtos
");
$row = $res->fetch_assoc();
$visaoGeral = [
  "totalProdutos" => (int)$row['totalProdutos'],
  "totalItens" => (int)$row['totalItens'],
  "valorEstoque" => (float)$row['valorCusto'],
  "valorCusto" => (float)$row['valorCusto'],
  "valorVenda" => (float)$row['valorVenda'],
  "lucroPotencial" => (float)$row['valorVenda'] - $row['valorCusto'],
  "margemMedia" => $row['valorCusto'] > 0 ? (($row['valorVenda'] - $row['valorCusto']) / $row['valorCusto']) * 100 : 0,
  "estoqueBaixo" => (int)$row['estoqueBaixo']
];

// Gráficos por categoria
$dadosCategorias = [
  "categorias" => [],
  "produtosPorCategoria" => [],
  "valorPorCategoria" => [],
  "margemPorCategoria" => [],
  "estoquePorCategoria" => []
];

$detalhes = [];

$res = $conn->query("
  SELECT 
    c.nome,
    COUNT(p.id) AS totalProdutos,
    SUM(p.quantidade_inicial) AS quantidadeTotal,
    SUM(p.quantidade_inicial * p.valor_venda) AS valorTotal,
    SUM(p.quantidade_inicial * (p.valor_venda - p.custo)) AS lucroPotencial,
    SUM(p.quantidade_inicial * p.custo) AS custoTotal
  FROM categorias c
  LEFT JOIN produtos p ON p.categoria_id = c.categoria_id
  GROUP BY c.nome
");

while ($cat = $res->fetch_assoc()) {
  $margem = $cat['custoTotal'] > 0 ? ($cat['lucroPotencial'] / $cat['custoTotal']) * 100 : 0;

  $dadosCategorias['categorias'][] = $cat['nome'];
  $dadosCategorias['produtosPorCategoria'][] = (int)$cat['totalProdutos'];
  $dadosCategorias['valorPorCategoria'][] = (float)$cat['valorTotal'];
  $dadosCategorias['margemPorCategoria'][] = round($margem, 1);
  $dadosCategorias['estoquePorCategoria'][] = (int)$cat['quantidadeTotal'];

  $detalhes[] = [
    "nome" => $cat['nome'],
    "totalProdutos" => (int)$cat['totalProdutos'],
    "quantidadeTotal" => (int)$cat['quantidadeTotal'],
    "valorTotal" => (float)$cat['valorTotal'],
    "lucroPotencial" => (float)$cat['lucroPotencial']
  ];
}

// Produtos lucrativos
$lucrativos = [];
$res = $conn->query("
  SELECT 
    p.nome,
    c.nome AS categoria,
    p.custo,
    p.valor_venda,
    ROUND(((p.valor_venda - p.custo) / p.custo) * 100, 1) AS margem,
    (p.valor_venda - p.custo) AS lucroUnidade
  FROM produtos p
  JOIN categorias c ON p.categoria_id = c.categoria_id
  ORDER BY lucroUnidade DESC
  LIMIT 10
");
while ($row = $res->fetch_assoc()) {
  $lucrativos[] = $row;
}

// Estoque baixo
$estoqueBaixo = [];
$res = $conn->query("
  SELECT 
    p.nome,
    c.nome AS categoria,
    p.quantidade_inicial AS estoque,
    p.quantidade_minima AS minimo
  FROM produtos p
  JOIN categorias c ON c.categoria_id = p.categoria_id
  WHERE p.quantidade_inicial < p.quantidade_minima
");
while ($row = $res->fetch_assoc()) {
  $estoqueBaixo[] = $row;
}

// Envia tudo
echo json_encode([
  "visaoGeral" => $visaoGeral,
  "detalhesCategorias" => $detalhes,
  "produtosLucrativos" => $lucrativos,
  "estoqueBaixo" => $estoqueBaixo,
  "graficos" => $dadosCategorias
], JSON_UNESCAPED_UNICODE);
