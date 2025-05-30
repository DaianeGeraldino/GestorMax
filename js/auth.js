document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const usuario = document.getElementById('usuario').value;
    const senha = document.getElementById('senha').value;

    const usuarios = {
        'admin': 'admin',
        'teste': 'teste123'
    };

    if (usuarios[usuario] === senha) {
        alert('Login bem-sucedido!');
        window.location.href = 'pagina_de_destino.html';
    } else {
        alert('Usuário ou senha incorretos!');
    }
});
