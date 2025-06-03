<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTORMAX - Criar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/usuarios.css">
    <link rel="stylesheet" href="css/sidebar.css">

    <script>

        function limparCampo() {
            document.getElementById("nome").value = "";
        }

        function cadastrarCategoria(event) {
            if (event) event.preventDefault();
            const modal = document.getElementById("modalSucesso");

            // Define o conteúdo somente na hora do clique
            modal.textContent = "Categoria cadastrada com sucesso!";

            // Exibe o modal
            modal.classList.add("ativo");

            // Esconde após 3 segundos
            setTimeout(() => {
                modal.classList.remove("ativo");
                modal.textContent = ""; // Limpa o texto depois que some
            }, 3000);
            document.getElementById("nome").value = ""
        }
    </script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky pt-3 vh-100 d-flex flex-column">
                    <div class="sidebar-header text-center mb-4 px-3">
                        <h1 class="h4 text-white">GESTOR-MAX</h1>
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
                                <a class="nav-link text-white" href="criar-categoria.php">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Cadastrar categoria
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

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Cadastrar Nova Categoria</h1>
                </div>

                <div id="mensagem-container"></div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h2 class="h5 card-title mb-1">Informações da Categoria</h2>
                        <p class="text-muted small mb-0">Preencha os dados da nova categoria</p>
                    </div>
                    <div class="card-body">
                        <form id="form-produto">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome da Categoria</label>
                                    <input type="text" class="form-control" id="nome" required>
                                </div>

                                <!-- <div class="col-md-6">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-select" id="categoria" required>
                              <option value="Escolha">Escolha a categoria</option>
                              <option value="PetShop">PetShop</option>
                              <option value="HortiFruti">HortiFruti</option>
                              <option value="Cabelo">Cabelo</option>
                              <option value="Unhas">Unhas</option>
                              <option value="Perfumaria">Perfumaria</option>
                            </select>
                          </div>                         -->


                            </div>

                            <div class="d-flex justify-content-end mt-4 gap-2">
                                <button type="button" id="btn-limpar" class="btn btn-outline-secondary"
                                    onclick="limparCampo()">Limpar</button>
                                <button type="submit" class="btn btn-primary" onclick="cadastrarCategoria(event)">Cadastrar
                                    Categoria
                                </button>                            
                            </div>
                            <div id="modalSucesso"></div>
                        </form>


                    </div>

                </div>

            </main>
