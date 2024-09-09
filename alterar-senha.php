<?php

// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\User;

if (isset($_POST['btn-continuar'])) {
    $senha =  sha1($_POST['senha']);
    $obUser = new User();
    $obUser->novaSenha($email, $senha);
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
    <?php require_once 'includes/header.php' ?>
    <section class="page-cadastro-usuario paddingBottom50">
        <div class="container">
            <div>
                <a href="dashboard.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Alterar Senha</span>
                </a>
            </div>
            <div class="container-small">
                <form method="post" id="form-cadastro-usuario">
                    <div>
                        <div style="width: 180px;">
                            <label class="input-label" style="width: 180px;">Senha atual</label>
                            <input type="text" class="nome-input" name="senha" style="width: 336px;">
                        </div>
                        <div style="width: 180px;">
                            <label class="input-label">Nova senha</label>
                            <input type="text" class="email-input" name="newSenha" style="width: 336px;">
                        </div>
                        <div style="width: 180px;">
                            <label class="input-label">Repetir senha</label>
                            <input type="text" class="cpf-input" name="newSenha2" style="width: 336px;">
                        </div>
                    </div>
                    <button type="submit" class="button-default" name="btn-continuar">Salvar nova senha</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>