<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>GESTORMAX - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="styles/login.css">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg">
              <div class="card-header bg-primary text-white text-center py-4">
                <h1 class="h3 mb-1 fw-bold">GESTORMAX</h1>
                <p class="mb-0 opacity-75">Sistema de Controle de Estoque</p>
              </div>
              <div class="card-body p-4 p-md-5">
                <form id="loginForm">
                  <div class="mb-4">
                    <label for="username" class="form-label">Usuário</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                      <input type="text" class="form-control form-control-lg" id="username" placeholder="Digite seu usuário" required>
                    </div>
                  </div>
                  
                  <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                      <input type="password" class="form-control form-control-lg" id="password" placeholder="Digite sua senha" required>
                    </div>
                  </div>
                  
                  <div id="login-error" class="alert alert-danger d-none"></div>
                  
                  <button type="button" class="btn btn-primary btn-lg w-100 py-2 mb-3" onclick="location.href='dashboard.php'">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                  </button>
                  
                  <button type="button" class="btn btn-secondary btn-lg w-100 py-2 mb-3" onclick="location.href='index.php'">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                  </button>

                </form>
              </div>
              <div class="card-footer text-center py-3 bg-light">
                <p class="mb-0 text-muted small">© 2025 GESTORMAX - Todos os direitos reservados</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
  
    <script>

        document.getElementById('loginForm').addEventListener('submit', function(event) {
          event.preventDefault();
    
          const usuario = document.getElementById('username').value.trim();
          const senha = document.getElementById('password').value.trim();
          const errorDiv = document.getElementById('login-error');
    
          const usuarios = {
            'admin': 'admin',
            'teste': 'teste123'
          };
    
          if (usuarios.hasOwnProperty(usuario)) {
            if (usuarios[usuario] === senha) {
              // Sucesso no login
              alert('Login bem-sucedido! Redirecionando...');
              window.location.href = 'dashboard.php'; // ou qualquer URL de destino
            } else {
              // Senha incorreta
              errorDiv.textContent = 'Senha incorreta!';
              errorDiv.classList.remove('d-none');
            }
          } else {
            // Usuário não encontrado
            errorDiv.textContent = 'Usuário não encontrado!';
            errorDiv.classList.remove('d-none');
          }
        });
        
      </script>

</body>
</html>