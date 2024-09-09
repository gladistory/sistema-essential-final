<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Clientes;

// Validando id do cliente
if (!isset($_GET['id_cliente']) or !is_numeric($_GET['id_cliente'])) {
    header('location: clientes.php?status=error');
    exit;
}

$obClienteId = Clientes::getCliente($_GET['id_cliente']);




//Validar se a vaga existe no banco

if (!$obClienteId instanceof Clientes) {
    header('location: clientes.php?status=error');
    exit;
}


if (isset($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['telefone'])) {
    $obClienteId->nome = $_POST['nome'];
    $obClienteId->email = $_POST['email'];
    $obClienteId->cpf = $_POST['cpf'];
    $obClienteId->telefone = $_POST['telefone'];
    $obClienteId->Editar();
    header('location: clientes.php');
};

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
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
                            <input type="text" class="nome-input" name="nome" value='<?php echo $obClienteId->nome; ?>'>
                        </div>
                        <div>
                            <label class="input-label">E-mail</label>
                            <input type="text" class="email-input" name="email"
                                value='<?php echo $obClienteId->email; ?>'>
                        </div>
                        <div>
                            <label class="input-label">CPF</label>
                            <input type="text" class="cpf-input" name="cpf" value='<?php echo $obClienteId->cpf; ?>'>
                        </div>
                        <div>
                            <label class="input-label">Telefone</label>
                            <input type="tel" class="telefone-input" name="telefone"
                                value='<?php echo $obClienteId->telefone; ?>'>
                        </div>
                    </div>
                    <button type="submit" class="button-default">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>