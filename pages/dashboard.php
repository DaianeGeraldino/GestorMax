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
      <?php include '../INCLUDE/sidebar.php'; ?>

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
