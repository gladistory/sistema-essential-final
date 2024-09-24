<?php

// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\User;

$obUserId = User::getUser($_SESSION["id_user"]);

$acerto = "";
$erro = "";

if (isset($_POST['btn-continuar'])) {
    if ($_POST['newSenha'] === $_POST['newSenha2']) {
        $obUserId->senha = password_hash($_POST['newSenha'], PASSWORD_BCRYPT);
        $obUserId->Editar();
        $acerto = "<div class='alert alert-success text-center' role='alert'>Senha alterada com sucesso!</div>";
    } else {
        $erro = "<div class='alert alert-danger text-center' role='alert'>A senhas informadas devem ser iguais</div>";
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <?php echo $acerto ?>
            <?php echo $erro ?>
            <div class="container-small">
                <form method="post" id="form-cadastro-usuario">
                    <div>
                        <div style="width: 180px;">
                            <label class="input-label">Nova senha</label>
                            <input type="password" class="email-input" name="newSenha" style="width: 336px;">
                        </div>
                        <div style="width: 180px;">
                            <label class="input-label">Repetir senha</label>
                            <input type="password" class="cpf-input" name="newSenha2" style="width: 336px;">
                        </div>
                    </div>
                    <button type="submit" class="button-default" name="btn-continuar">Salvar nova senha</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>