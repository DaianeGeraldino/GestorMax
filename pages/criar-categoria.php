<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTORMAX - Criar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/usuarios.css">
    <link rel="stylesheet" href="styles/sidebar.css">


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include '../INCLUDE/sidebar.php'; ?>    

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
            
                
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/categoria.js"></script> 
</body>
