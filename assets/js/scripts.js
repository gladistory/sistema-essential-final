document.getElementById('form-cadastro-usuario').addEventListener('submit', function(event) {
    event.preventDefault();


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
    var nascimento = document.querySelector('.telefone-input').value;
    var senha = document.querySelector('.senha-input').value;

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

    // Validação da data de nascimento
    var dataNascimento = new Date(nascimento);
    var dataAtual = new Date();
    var idade = dataAtual.getFullYear() - dataNascimento.getFullYear();
    var mes = dataAtual.getMonth() - dataNascimento.getMonth();
    if (mes < 0 || (mes === 0 && dataAtual.getDate() < dataNascimento.getDate())) {
        idade--;
    }

    if (isNaN(dataNascimento.getTime()) || idade < 18) {
        document.querySelector('.telefone-input').classList.add('input-error');
        document.getElementById('error-nascimento').textContent =
            'Data inválida ou idade inferior a 18 anos.';
        hasError = true;
    }

    // Validação da senha (mínimo 6 caracteres)
    if (senha === '' || senha.length < 6) {
        document.querySelector('.senha-input').classList.add('input-error');
        document.getElementById('error-senha').textContent = 'A senha deve ter pelo menos 6 caracteres.';
        hasError = true;
    }

    // Se não houver erros, o formulário é enviado
    if (!hasError) {
        this.submit();
    }
});


