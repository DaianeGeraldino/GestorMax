<?php
include 'conexao.php';

session_start();

// 1. Ação para ativar/desativar usuários via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'alterar_status') {
    $idname = isset($_POST['idname']) ? intval($_POST['idname']) : 0;
    $novoStatus = isset($_POST['status']) ? intval($_POST['status']) : 0;

    if ($idname > 0) {
        $sql = "UPDATE usuarios SET status = ? WHERE idname = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $novoStatus, $idname);
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Status atualizado com sucesso!";
        } else {
            $_SESSION['msg'] = "Erro ao atualizar status.";
        }
    } else {
        $_SESSION['msg'] = "ID inválido.";
    }
    // Redireciona para evitar reenvio do formulário
    header("Location: " . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] ?? 1));
    exit;
}

// 2. Paginação
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$itemsPerPage = 10;
$offset = ($page - 1) * $itemsPerPage;

// 3. Total de usuários
$sqlCount = "SELECT COUNT(*) as total FROM usuarios";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$totalUsuarios = intval($rowCount['total']);
$totalPages = ceil($totalUsuarios / $itemsPerPage);

// 4. Busca usuários da página atual
$sql = "SELECT * FROM usuarios LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>GESTORMAX - Lista de Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../styles/usuarios.css" />
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
        <h1 class="h2">Lista de Usuários</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <a href="criar-usuario.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Novo Usuário
          </a>
        </div>
      </div>

      <?php
      // Mostrar mensagem se existir
      if (isset($_SESSION['msg'])) {
          echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['msg']) . '</div>';
          unset($_SESSION['msg']);
      }
      ?>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="input-group mb-3">
            <input type="text" id="busca-usuario" class="form-control" placeholder="Buscar usuário..." />
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
              <tbody id="usuarios-lista">
                <?php
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nickname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>";
                    echo ($row['typePerfil'] == '1')
                      ? "<span class='badge bg-primary'>Administrador</span>"
                      : "<span class='badge bg-info text-dark'>Vendedor</span>";
                    echo "</td>";
                    echo "<td>";
                    echo ($row['status'] == '1')
                      ? "<span class='badge bg-success'>Ativo</span>"
                      : "<span class='badge bg-secondary'>Inativo</span>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-sm btn-outline-primary' title='Editar' onclick=\"location.href='editar-usuario.php?idname=" . $row['idname'] . "'\">
                            <i class='bi bi-pencil'></i>
                          </button> ";
                    if ($row['status'] == '1') {
                      echo "<button class='btn btn-sm btn-outline-danger' title='Desativar' onclick='confirmarAlterarStatus(" . $row['idname'] . ", 0)'>
                              <i class='bi bi-person-x'></i>
                            </button>";
                    } else {
                      echo "<button class='btn btn-sm btn-outline-success' title='Ativar' onclick='confirmarAlterarStatus(" . $row['idname'] . ", 1)'>
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

          <?php if ($totalUsuarios > $itemsPerPage): ?>
            <nav aria-label="Navegação de páginas">
              <ul class="pagination justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= max($page - 1, 1) ?>" tabindex="-1">Anterior</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php endfor; ?>

                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= min($page + 1, $totalPages) ?>">Próxima</a>
                </li>
              </ul>
            </nav>
          <?php endif; ?>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Formulário oculto para enviar POST -->
<form id="form-alterar-status" method="POST" style="display:none;">
  <input type="hidden" name="acao" value="alterar_status" />
  <input type="hidden" name="idname" id="idname" value="" />
  <input type="hidden" name="status" id="status" value="" />
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function confirmarAlterarStatus(idname, novoStatus) {
  const acao = novoStatus === 1 ? 'ativar' : 'desativar';
  if (confirm(`Tem certeza que deseja ${acao} este usuário?`)) {
    document.getElementById('idname').value = idname;
    document.getElementById('status').value = novoStatus;
    document.getElementById('form-alterar-status').submit();
  }
}
</script>

</body>
</html>
