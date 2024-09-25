<?php
// Iniciar sessão
session_start();

// Verificação
if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\User;

// Validando id do cliente
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: usuarios.php?status=error');
    exit;
}

$obUserId = User::getUser($_GET['id']);

// Validar se o usuário existe no banco
if (!$obUserId instanceof User) {
    header('location: usuarios.php?status=error');
    exit;
}

// Verifica se o formulário foi submetido e atualiza os dados
if (isset($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['nascimento'])) {
    // Atualizar o objeto usuário com os novos dados
    $obUserId->nome = $_POST['nome'];
    $obUserId->email = $_POST['email'];
    $obUserId->cpf = $_POST['cpf'];
    $obUserId->nascimento = $_POST['nascimento'];

    // Salva as alterações no banco de dados
    $obUserId->Editar();
    header('location: usuarios.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuário</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<body>
    <?php require_once 'includes/header.php' ?>
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
                            <input type="text" class="nome-input" name="nome" value='<?php echo $obUserId->nome; ?>'>
                        </div>
                        <div>
                            <label class="input-label">E-mail</label>
                            <input type="text" class="email-input" name="email" value='<?php echo $obUserId->email; ?>'>
                        </div>
                        <div>
                            <label class="input-label">CPF</label>
                            <input type="text" class="cpf-input" name="cpf" value='<?php echo $obUserId->cpf; ?>'>
                        </div>
                        <div>
                            <label class="input-label">Nascimento</label>
                            <input type="date" class="telefone-input" name="nascimento"
                                value='<?php echo $obUserId->nascimento; ?>'>
                        </div>
                    </div>
                    <button type="submit" class="button-default">Salvar Alterações</button>
                    <a class="button-default"
                        style="margin-left: 44px; background-color:red; text-decoration: none;color:white; padding: 12px;"
                        href="alterar-senha.php">Alterar Senha</a>
                </form>
            </div>
        </div>
    </section>
</body>

</html>