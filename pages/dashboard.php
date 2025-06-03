<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GESTORMAX - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="styles/dashboard.css">
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
                <a class="nav-link active text-white" href="dashboard.php">
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
                <a class="nav-link text-white" href="estatisticas.php">
                  <i class="bi bi-bar-chart-line me-2"></i>
                  Estatísticas
                </a>
              </li>
            </ul>
          </nav>
          
          <div class="sidebar-footer mt-auto p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
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
          <h1 class="h2">Painel de Controle</h1>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
          <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h3 class="h6 text-muted mb-0">Total de Produtos</h3>
                  <i class="bi bi-box text-primary fs-4"></i>
                </div>
                <div class="stat-value" id="total-produtos">0</div>
                <p class="text-muted mb-0 small">produtos cadastrados</p>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h3 class="h6 text-muted mb-0">Valor do Estoque</h3>
                  <i class="bi bi-currency-dollar text-success fs-4"></i>
                </div>
                <div class="stat-value" id="valor-estoque">R$ 0,00</div>
                <p class="text-muted mb-0 small">em produtos</p>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h3 class="h6 text-muted mb-0">Lucro Potencial</h3>
                  <i class="bi bi-gem text-warning fs-4"></i>
                </div>
                <div class="stat-value" id="lucro-potencial">R$ 0,00</div>
                <p class="text-muted mb-0 small">estimado</p>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h3 class="h6 text-muted mb-0">Estoque Baixo</h3>
                  <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                </div>
                <div class="stat-value" id="estoque-baixo">0</div>
                <p class="text-muted mb-0 small">produtos</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Info Cards -->
        <div class="row">
          <div class="col-lg-6 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <h2 class="h5 card-title mb-1">Produtos Mais Lucrativos</h2>
                <p class="text-muted small mb-0">Top 5 produtos com maior margem de lucro</p>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush" id="produtos-lucrativos">
                  <li class="list-group-item text-muted fst-italic">Nenhum produto cadastrado</li>
                </ul>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <h2 class="h5 card-title mb-1">Estoque Crítico</h2>
                <p class="text-muted small mb-0">Produtos com estoque abaixo do mínimo</p>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush" id="produtos-criticos">
                  <li class="list-group-item text-muted fst-italic">Nenhum produto com estoque crítico</li>
                </ul>
              </div>
              <div class="card-footer bg-transparent">
                <a href="produtos-lista.php" class="btn btn-primary float-end">Gerenciar Estoque</a>
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
