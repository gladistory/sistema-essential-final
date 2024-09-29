document.getElementById('form-cadastro-cliente').addEventListener('submit', function(event) {
    event.preventDefault();

    // Limpa as mensagens de erro e classes de erro
    document.querySelectorAll('.error-message').forEach(function(element) {
        element.textContent = '';
    });
    document.querySelectorAll('.input-error').forEach(function(element) {
        element.classList.remove('input-error');
    });

    var hasError = false; // Controla se houve algum erro

    var nome = document.querySelector('.nome-input').value;
    var email = document.querySelector('.email-input').value;
    var cpf = document.querySelector('.cpf-input').value;
    var telefone = document.querySelector('.telefone-input').value;
    // var senha = document.querySelector('.senha-input').value; // Caso você tenha um campo de senha

    // Validação do nome
    if (nome === '') {
        document.querySelector('.nome-input').classList.add('input-error');
        document.getElementById('error-nome').textContent = 'O campo Nome é obrigatório.';
        hasError = true;
    }

    // Validação do e-mail
    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '' || !regexEmail.test(email)) {
        document.querySelector('.email-input').classList.add('input-error');
        document.getElementById('error-email').textContent = 'Por favor, insira um e-mail válido.';
        hasError = true;
    }

    // Validação do CPF (somente números e 11 dígitos)
    var regexCPF = /^\d{11}$/;
    if (cpf === '' || !regexCPF.test(cpf)) {
        document.querySelector('.cpf-input').classList.add('input-error');
        document.getElementById('error-cpf').textContent = 'Por favor, insira um CPF válido (11 dígitos).';
        hasError = true;
    }

    // Validação do telefone
    var telefoneRegex = /^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/;
    if (!telefoneRegex.test(telefone)) {
        document.querySelector('.telefone-input').classList.add('input-error');
        document.getElementById('error-telefone').textContent = 'Por favor, insira um telefone válido. Exemplo: (11) 91234-5678';
        hasError = true;
    }

    if (!hasError) {
        this.submit();
    }
});
