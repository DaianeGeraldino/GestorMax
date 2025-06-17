<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GESTORMAX - Editar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="styles/usuarios.css">
  <link rel="stylesheet" href="../styles/sidebar.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <?php include '../INCLUDE/sidebar.php'; ?>

      <!-- Main content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Editar Usuário</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <button id="btn-voltar" class="btn btn-outline-secondary me-2" onclick="location.href='usuarios-lista.php'">
              <i class="bi bi-arrow-left me-1"></i>Voltar
            </button>
          </div>
        </div>

        <div id="mensagem-container"></div>

        <div class="card shadow-sm">
          <div class="card-header bg-light">
            <h2 class="h5 card-title mb-1">Informações do Usuário</h2>
            <p class="text-muted small mb-0">Edite os dados do usuário</p>
          </div>
          <div class="card-body">
            <form id="form-editar-usuario">
              <input type="hidden" id="usuario-id">
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="editar-nome" class="form-label">Nome Completo</label>
                  <input type="text" class="form-control" id="editar-nome" required>
                </div>
                
                <div class="col-md-6">
                  <label for="editar-email" class="form-label">E-mail</label>
                  <input type="email" class="form-control" id="editar-email" required>
                </div>
                
                <div class="col-md-6">
                  <label for="editar-usuario" class="form-label">Nome de Usuário</label>
                  <input type="text" class="form-control" id="editar-usuario" required>
                </div>
                
                <div class="col-md-6">
                  <label for="editar-perfil" class="form-label">Perfil</label>
                  <select class="form-select" id="editar-perfil" required>
                    <option value="admin">Administrador</option>
                    <option value="vendedor">Vendedor</option>
                  </select>
                </div>
                
                <div class="col-md-6">
                  <label for="editar-senha" class="form-label">Nova Senha</label>
                  <input type="password" class="form-control" id="editar-senha" placeholder="Deixe em branco para manter a atual">
                </div>
                
                <div class="col-md-6">
                  <label for="editar-confirmar-senha" class="form-label">Confirmar Nova Senha</label>
                  <input type="password" class="form-control" id="editar-confirmar-senha">
                </div>
                
                <div class="col-12">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="editar-status" checked>
                    <label class="form-check-label" for="editar-status">Usuário ativo</label>
                  </div>
                </div>
              </div>
              
              <div class="d-flex justify-content-end mt-4 gap-2">
                <button type="button" id="btn-cancelar-edicao" class="btn btn-outline-secondary" onclick="location.href='usuarios-lista.php'">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
