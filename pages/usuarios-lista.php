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
      <?php
        include 'conexao.php';

        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        ?>
        
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
                <?php 
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>".htmlspecialchars($row['name'])."</td>";
                      echo "<td>".htmlspecialchars($row['nickname'])."</td>";
                      echo "<td>".htmlspecialchars($row['email'])."</td>";
                      echo "<td>";
                      if ($row['typePerfil'] == 'admin') {
                        echo "<span class='badge bg-primary'>Administrador</span>";
                      } else {
                        echo "<span class='badge bg-info text-dark'>Vendedor</span>";
                      }
                      echo "</td>";

                      echo "<td>";
                      if (strtolower($row['status']) == 'ativo') {
                        echo "<span class='badge bg-success'>Ativo</span>";
                      } else {
                        echo "<span class='badge bg-secondary'>Inativo</span>";
                      }
                      echo "</td>";

                      echo "<td>
                        <button class='btn btn-sm btn-outline-primary' title='Editar' onclick=\"location.href='editar-usuario.php?id=".$row['idname']."'\"> 
                          <i class='bi bi-pencil'></i> 
                        </button>";
                      if (strtolower($row['status']) == 'ativo') {
                        echo "<button class='btn btn-sm btn-outline-danger' title='Desativar'> 
                          <i class='bi bi-person-x'></i> 
                        </button>";
                      } else {
                        echo "<button class='btn btn-sm btn-outline-success' title='Ativar'> 
                          <i class='bi bi-person-check'></i> 
                        </button>";
                      }
                      echo "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='6' class='text-center'>Nenhum usuário encontrado.</td></tr>";
                  }
                ?>
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
