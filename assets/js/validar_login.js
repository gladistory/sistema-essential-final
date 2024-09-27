document.getElementById('form-input-login').addEventListener('submit', function(event) {
    var email = document.getElementById('data-login').value;
    var senha = document.getElementById('data-password').value;
    var erro = '';

    if (email === '') {
        erro += 'O campo e-mail é obrigatório.\n';
    }

    if (senha === '') {
        erro += 'O campo senha é obrigatório.\n';
    }

    if (erro !== '') {
        event.preventDefault();
        alert(erro);
    }
});