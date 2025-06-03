<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GESTORMAX - Lista de Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="styles/usuarios.css">
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
                <a class="nav-link text-white" href="vendas.php">
                  <i class="bi bi-cart me-2"></i>
                  Vendas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-white" href="usuarios-lista.php">
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
          <h1 class="h2">Lista de Usuários</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <a href="criar-usuario.php" class="btn btn-primary">
              <i class="bi bi-plus-circle me-1"></i> Novo Usuário
            </a>
          </div>
        </div>

        <div id="mensagem-container"></div>

        <div class="card shadow-sm">
          <div class="card-body">
            <div class="input-group mb-3">
              <input type="text" id="busca-usuario" class="form-control" placeholder="Buscar usuário...">
              <button class="btn btn-outline-secondary" type="button" id="btn-buscar-usuario">
                <i class="bi bi-search"></i>
              </button>
            </div>
            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody id="lista-usuarios">
                  <tr>
                    <td>João Silva</td>
                    <td>joao.silva</td>
                    <td>joao@empresa.com</td>
                    <td><span class="badge bg-primary">Administrador</span></td>
                    <td><span class="badge bg-success">Ativo</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary" title="Editar" onclick="location.href='editar-usuario.php'">
                        <i class="bi bi-pencil" ></i>
                      </button>
                      <button class="btn btn-sm btn-outline-danger" title="Desativar">
                        <i class="bi bi-person-x"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>Maria Souza</td>
                    <td>maria.souza</td>
                    <td>maria@empresa.com</td>
                    <td><span class="badge bg-info text-dark">Vendedor</span></td>
                    <td><span class="badge bg-success">Ativo</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary" title="Editar" onclick="location.href='editar-usuario.php'">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-danger" title="Desativar">
                        <i class="bi bi-person-x"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>Carlos Oliveira</td>
                    <td>carlos.oliveira</td>
                    <td>carlos@empresa.com</td>
                    <td><span class="badge bg-info text-dark">Vendedor</span></td>
                    <td><span class="badge bg-secondary">Inativo</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary" title="Editar" onclick="location.href='editar-usuario.php'">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-success" title="Ativar">
                        <i class="bi bi-person-check"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <nav aria-label="Navegação de páginas">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Anterior</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Próxima</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </main>
    </div>
  </div>

  <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalTitle">Confirmar ação</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="confirmModalBody">
          Tem certeza que deseja realizar esta ação?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="btn-confirm-action">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
