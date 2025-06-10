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
     <?php include '../INCLUDE/sidebar.php'; ?>

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
