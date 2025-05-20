<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GESTORMAX - Nova Venda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/vendas.css">
  <link rel="stylesheet" href="css/sidebar.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
        <div class="position-sticky pt-3 vh-100 d-flex flex-column">
          <div class="sidebar-header text-center mb-4 px-3">
            <h1 class="h4 text-white">GESTORMAX</h1>
          </div>
          
          <nav class="flex-grow-1">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link text-white" href="dashboard.php">
                  <i class="bi bi-house-door me-2"></i>
                  Início
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="produtos-lista.php">
                  <i class="bi bi-box-seam me-2"></i>
                  Produtos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="produtos-cadastro.php">
                  <i class="bi bi-plus-circle me-2"></i>
                  Cadastrar produto
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-white" href="vendas.php">
                  <i class="bi bi-cart me-2"></i>
                  Vendas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="usuarios-lista.php">
                  <i class="bi bi-people me-2"></i>
                  Usuários
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="estatisticas.php">
                  <i class="bi bi-bar-chart-line me-2"></i>
                  Estatísticas
                </a>
              </li>
            </ul>
          </nav>
          
          <div class="sidebar-footer mt-auto p-3">
            <div class="d-flex justify-content-between align-items-center mb-3" >
              <span class="text-white" id="user-name">Administrador</span>
            </div>
            <button id="logout-btn" class="btn btn-outline-light w-100" onclick="location.href='login.php'">
              <i class="bi bi-box-arrow-right me-2"></i>
              Sair
            </button>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Nova Venda</h1>
        </div>

        <div id="mensagem-container"></div>

        <div class="row">
          <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
              <div class="card-header bg-light">
                <h2 class="h5 card-title mb-1">Adicionar Produtos</h2>
              </div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <input type="text" id="busca-produto-venda" class="form-control" placeholder="Buscar produto...">
                  <button class="btn btn-outline-secondary" type="button" id="btn-buscar-produto">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
                
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Produto</th>
                        <th>Estoque</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody id="lista-produtos-venda">
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
                  <input type="text" class="form-control" id="cliente" placeholder="Nome do cliente (opcional)">
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
                     <!--itens de venda vai ser adicionado aq-->
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="2">Total</th>
                        <th id="total-venda">R$ 0,00</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                
                <div class="d-grid gap-2">
                  <button id="btn-finalizar-venda" class="btn btn-success btn-lg">
                    <i class="bi bi-check-circle me-2"></i>Finalizar Venda
                  </button>
                  <button id="btn-cancelar-venda" class="btn btn-outline-danger">
                    <i class="bi bi-x-circle me-2"></i>Cancelar Venda
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
