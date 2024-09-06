<?php

// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;


require __DIR__ . '/vendor/autoload.php';

use App\Entity\Clientes;

$obCliente = new Clientes();
$clientes = $obCliente->getClientes();

$_SESSION['num_clientes'] = count($clientes);

$resultados = '';

foreach ($clientes as $cliente) {
    $resultados .= '<tr>
                            <td> ' . $cliente->id_cliente . '</td>
                            <td>' . $cliente->nome . '</td>
                            <td>' . $cliente->cpf . '</td>
                            <td>' . $cliente->email . '</td>
                            <td>' . $cliente->telefone . '</td>
                             <td>
                            <a href="editar.php?id=' . $vaga->id . '">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </td>
                        <td>
                            <a href="excluir.php?id=' . $vaga->id . '">
                            <button type="button" class="btn btn-danger">Excluir</button>
                        </td>
                    </tr>';
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de cliente</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'includes/header.php' ?>
    <section class="page-gerenciamento-cliente paddingBottom50">
        <div class="container">
            <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Gerenciamento de cliente</span>
                </a>
                <a href="cadastro-cliente.php" class="button-default bt-add">Adicionar novo cliente</a>
            </div>
            <div class="shadow-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Editar</th>
                            <th>Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $resultados; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>