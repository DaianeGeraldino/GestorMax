<?php
include 'conexao.php';

$busca = isset($_GET['busca']) ? $conn->real_escape_string($_GET['busca']) : '';

$where = '';
if (!empty($busca)) {
  $where = "WHERE p.nome LIKE '%$busca%'";
}

// Buscando produtos com filtro
$sql = "SELECT p.*, c.nome AS cat_nome FROM produtos p 
        LEFT JOIN categorias c ON p.categoria_id = c.categoria_id
        $where";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>GESTORMAX - Nova Venda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../styles/vendas.css" />
  <link rel="stylesheet" href="../styles/sidebar.css" />
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <?php include '../INCLUDE/sidebar.php'; ?>

      <!-- Main content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Nova Venda</h1>
        </div>

        <div id="mensagem-container"></div>

        <!-- Form de busca -->
        <form method="GET" class="input-group mb-3" action="">
          <input
            type="text"
            id="busca-produto-venda"
            name="busca"
            class="form-control"
            placeholder="Buscar produto..."
            value="<?= htmlspecialchars($busca) ?>"
            autocomplete="off"
          />
          <button class="btn btn-outline-secondary" type="submit" id="btn-buscar-produto">
            <i class="bi bi-search"></i>
          </button>
        </form>

        <form method="POST" action="processar_venda.php">
          <div class="row">
            <div class="col-lg-8">
              <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                  <h2 class="h5 card-title mb-1">Adicionar Produtos</h2>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Produto</th>
                          <th>Categoria</th>
                          <th>Estoque</th>
                          <th>Quantidade</th>
                          <th>Preço</th>
                          <th>Selecionar</th>
                        </tr>
                      </thead>
                      <tbody id="lista-produtos-venda">
                        <?php
                        if ($result && $result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            $produto_id = intval($row['id']);
                            $estoque = intval($row['quantidade_inicial']);
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['cat_nome'] ?? 'Sem categoria') . "</td>";
                            echo "<td>" . $estoque . "</td>";
                            echo "<td><input type='number' name='quantidade[$produto_id]' min='0' max='$estoque' value='0' class='form-control' style='width:80px;' /></td>";
                            echo "<td>R$ " . number_format($row['valor_venda'], 2, ',', '.') . "</td>";
                            echo "<td><input type='checkbox' name='selecionados[]' value='$produto_id'></td>";
                            echo "</tr>";
                          }
                        } else {
                          echo "<tr><td colspan='6' class='text-center'>Nenhum produto encontrado.</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card shadow-sm">
                <div class="card-header bg-light">
                  <h2 class="h5 card-title mb-1">Resumo da Venda</h2>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label for="cliente" class="form-label">Cliente</label>
                    <input
                      type="text"
                      class="form-control"
                      id="cliente"
                      name="cliente"
                      placeholder="Nome do cliente (opcional)"
                    />
                  </div>

                  <div class="table-responsive mb-3">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Produto</th>
                          <th>Qtd</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody id="resumo-venda">
                        <!-- Preenchido por JS se desejar -->
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">Total</th>
                          <th id="total-venda">R$ 00,00</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">
                      <i class="bi bi-check-circle me-2"></i>Finalizar Venda
                    </button>
                    <button type="reset" class="btn btn-outline-danger">
                      <i class="bi bi-x-circle me-2"></i>Cancelar Venda
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/venda.js"></script>
</body>
</html>
