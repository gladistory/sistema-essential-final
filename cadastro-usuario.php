<?php
require __DIR__ . '/vendor/autoload.php';

use App\Entity\User;

if (isset($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['nascimento'], $_POST['senha'])) {
    $obAdmin = new User();

    $obAdmin->nome = $_POST['nome'];
    $obAdmin->email = $_POST['email'];
    $obAdmin->cpf = $_POST['cpf'];
    $obAdmin->nascimento = $_POST['nascimento'];
    $obAdmin->senha = $_POST['senha'];
    $obAdmin->Cadastrar();
    header('location: usuarios.php');
};

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuário</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">
                <img src="assets/images/ho.svg" alt="" />
            </a>
        </div>
    </header>
    <section class="page-cadastro-usuario paddingBottom50">
        <div class="container">
            <div>
                <a href="dashboard.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Cadastro de usuário</span>
                </a>
            </div>
            <div class="container-small">
                <form method="post" id="form-cadastro-usuario">
                    <div class="bloco-inputs">
                        <div>
                            <label class="input-label">Nome</label>
                            <input type="text" class="nome-input" name="nome">
                        </div>
                        <div>
                            <label class="input-label">E-mail</label>
                            <input type="text" class="email-input" name="email">
                        </div>
                        <div>
                            <label class="input-label">CPF</label>
                            <input type="text" class="cpf-input" name="cpf">
                        </div>
                        <div>
                            <label class="input-label">Nascimento</label>
                            <input type="date" class="telefone-input" name="nascimento">
                        </div>
                        <div>
                            <label class="input-label">Senha</label>
                            <input type="password" class="senha-input" name="senha">
                        </div>
                    </div>
                    <button type="submit" class="button-default">Salvar novo usuário</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>