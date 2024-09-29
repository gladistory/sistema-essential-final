<?php

// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Clientes;

if (isset($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['telefone'])) {
    $obAdmin = new Clientes();

    $obAdmin->nome = $_POST['nome'];
    $obAdmin->email = $_POST['email'];
    $obAdmin->cpf = $_POST['cpf'];
    $obAdmin->telefone = $_POST['telefone'];
    $obAdmin->Cadastrar();
    header('location: clientes.php');
};

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cliente</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<body>
    <?php require_once "includes/header.php" ?>
    <section class="page-cadastro-cliente paddingBottom50">
        <div class="container">
            <div>
                <a href="clientes.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Cadastro de cliente</span>
                </a>
            </div>
            <div class="container-small">
                <form method="post" id="form-cadastro-cliente">
                    <div class="bloco-inputs">
                        <div>
                            <label class="input-label">Nome</label>
                            <input type="text" class="nome-input" name="nome">
                            <div style="margin-bottom: 30px;" class="error-message" id="error-nome"></div>
                        </div>
                        <div>
                            <label class="input-label">E-mail</label>
                            <input type="text" class="email-input" name="email">
                            <div class="error-message" id="error-email"></div>
                        </div>
                        <div>
                            <label class="input-label">CPF</label>
                            <input type="text" class="cpf-input" name="cpf">
                            <div class="error-message" id="error-cpf"></div>
                        </div>
                        <div>
                            <label class="input-label">Telefone</label>
                            <input type="tel" class="telefone-input" name="telefone">
                            <div class="error-message" id="error-telefone"></div>
                        </div>

                    </div>
                    <button type="submit" class="button-default">Salvar novo cliente</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script src="./assets/js/valida_cliente.js"></script>

</html>