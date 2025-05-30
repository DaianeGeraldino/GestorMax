<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GESTORMAX - Estatísticas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/estatisticas.css">
  <link rel="stylesheet" href="./css/sidebar.css">
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
                <a class="nav-link text-white" href="vendas.php">
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
                <a class="nav-link active text-white" href="estatisticas.php">
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
          <h1 class="h2">Estatísticas</h1>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4" id="estatisticasTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="visao-geral-tab" data-bs-toggle="tab" data-bs-target="#visao-geral" type="button" role="tab">
              Visão Geral
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="categorias-tab" data-bs-toggle="tab" data-bs-target="#categorias" type="button" role="tab">
              Categorias
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="financeiro-tab" data-bs-toggle="tab" data-bs-target="#financeiro" type="button" role="tab">
              Financeiro
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="estoque-tab" data-bs-toggle="tab" data-bs-target="#estoque" type="button" role="tab">
              Estoque
            </button>
          </li>
        </ul>

        <div class="tab-content" id="estatisticasTabContent">
          <!-- Visão Geral -->
          <div class="tab-pane fade show active" id="visao-geral" role="tabpanel">
            <div class="row mb-4">
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Total de Produtos</h3>
                    <div class="stat-value" id="total-produtos">0</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Itens em Estoque</h3>
                    <div class="stat-value" id="total-itens">0</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Valor do Estoque</h3>
                    <div class="stat-value" id="valor-estoque">R$ 0,00</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Estoque Baixo</h3>
                    <div class="stat-value" id="estoque-baixo">0</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <h2 class="h5 card-title text-center">Produtos por Categoria</h2>
                    <div class="chart-wrapper">
                      <canvas id="chart-categorias"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <h2 class="h5 card-title text-center">Distribuição de Valor por Categoria</h2>
                    <div class="chart-wrapper">
                      <canvas id="chart-valor-categorias"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Categorias -->
          <div class="tab-pane fade" id="categorias" role="tabpanel">
            <div class="card mb-4">
              <div class="card-body">
                <h2 class="h5 card-title text-center">Distribuição por Categoria</h2>
                <div class="chart-wrapper">
                  <canvas id="chart-categorias-detalhado"></canvas>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h2 class="h5 card-title">Detalhes por Categoria</h2>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="table-light">
                      <tr>
                        <th>Categoria</th>
                        <th>Produtos</th>
                        <th>Qtd. Total</th>
                        <th>Valor Total</th>
                        <th>Lucro Potencial</th>
                      </tr>
                    </thead>
                    <tbody id="tabela-categorias">
                      <tr>
                        <td colspan="5" class="text-center py-4">Carregando dados...</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Financeiro -->
          <div class="tab-pane fade" id="financeiro" role="tabpanel">
            <div class="row mb-4">
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Valor de Custo</h3>
                    <div class="stat-value" id="valor-custo">R$ 0,00</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Valor de Venda</h3>
                    <div class="stat-value" id="valor-venda">R$ 0,00</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Lucro Potencial</h3>
                    <div class="stat-value" id="lucro-potencial">R$ 0,00</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 mb-3">
                <div class="card stat-card h-100">
                  <div class="card-body text-center">
                    <h3 class="h6 text-muted">Margem Média</h3>
                    <div class="stat-value" id="margem-media">0%</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-4">
              <div class="card-body">
                <h2 class="h5 card-title text-center">Margem de Lucro por Categoria</h2>
                <div class="chart-wrapper">
                  <canvas id="chart-margem-lucro"></canvas>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h2 class="h5 card-title">Produtos Mais Lucrativos</h2>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="table-light">
                      <tr>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Custo</th>
                        <th>Venda</th>
                        <th>Margem</th>
                        <th>Lucro por Unidade</th>
                      </tr>
                    </thead>
                    <tbody id="tabela-lucrativos">
                      <tr>
                        <td colspan="6" class="text-center py-4">Carregando dados...</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Estoque -->
          <div class="tab-pane fade" id="estoque" role="tabpanel">
            <div class="card mb-4">
              <div class="card-body">
                <h2 class="h5 card-title text-center">Distribuição de Estoque</h2>
                <div class="chart-wrapper">
                  <canvas id="chart-estoque"></canvas>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h2 class="h5 card-title">Produtos com Estoque Baixo</h2>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="table-light">
                      <tr>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Estoque Atual</th>
                        <th>Estoque Mínimo</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody id="tabela-estoque-baixo">
                      <tr>
                        <td colspan="5" class="text-center py-4">Carregando dados...</td>
                      </tr>
                    </tbody>
                  </table>
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
