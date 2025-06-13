<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GESTORMAX - Lista de Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="styles/produtos.css">
  <link rel="stylesheet" href="css/sidebar.css">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <?php include '../INCLUDE/sidebar.php'; ?>

    <!-- Conteúdo principal -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
      <?php
        include 'conexao.php';

        $sql = "SELECT p.*, c.nome AS categoria_nome 
                FROM produto p
                LEFT JOIN categoria c ON p.categoria_id = c.id";
        $result = $conn->query($sql);
      ?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Produtos</h1>
        <a href="criar-produto.php" class="btn btn-primary">
          <i class="bi bi-plus-circle me-1"></i> Novo Produto
        </a>
      </div>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="input-group mb-3">
            <input type="text" id="busca-produto" class="form-control" placeholder="Buscar produto...">
            <button class="btn btn-outline-secondary" type="button" id="btn-buscar-produto">
              <i class="bi bi-search"></i>
            </button>
          </div>

          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="table-light">
                <tr>
                  <th>Nome</th>
                  <th>Categoria</th>
                  <th>Qtd Inicial</th>
                  <th>Qtd Mínima</th>
                  <th>Custo</th>
                  <th>Valor de Venda</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['categoria_nome'] ?? 'Não definida') . "</td>";
                      echo "<td>" . intval($row['quantidade_inicial']) . "</td>";
                      echo "<td>" . intval($row['quantidade_minima']) . "</td>";
                      echo "<td>R$ " . number_format($row['custo'], 2, ',', '.') . "</td>";
                      echo "<td>R$ " . number_format($row['valor_venda'], 2, ',', '.') . "</td>";
                      echo "<td>
                              <a href='editar-produto.php?id=" . $row['id'] . "' class='btn btn-sm btn-outline-primary' title='Editar'>
                                <i class='bi bi-pencil'></i>
                              </a>
                              <button class='btn btn-sm btn-outline-danger' data-id='" . $row['id'] . "' title='Excluir'>
                                <i class='bi bi-trash'></i>
                              </button>
                            </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhum produto encontrado.</td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </main>
  </div>
</div>

<!-- Modal de confirmação (opcional) -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Ação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este produto?
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-danger" id="btn-confirm-delete">Excluir</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
