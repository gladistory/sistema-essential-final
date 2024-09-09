<?php

// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\User;

define('TITLE', 'Excluir Usuário');

// Mostrar clientes
$obUser = new User();
$users = $obUser->getUsers();

//$_SESSION['num_clientes'] = count($clientes);

$resultados = '';

foreach ($users as $user) {

    $resultados .= '<tr>
                            <td> ' . $user->id . '</td>
                            <td>' . $user->nome . '</td>
                            <td>' . $user->cpf . '</td>
                            <td>' . $user->email . '</td>
                            <td>' . $user->nascimento . '</td>
                             <td>
                            <a href="editar_user.php?id=' . $user->id . '">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </td>
                        <td>
                        <a href="excluir_user.php?id=' . $user->id . '">
                        <button type="button" class="btn btn-danger">Excluir</button>
                        </td>
                    </tr>';
};

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
                    <span>Gerenciamento de usuários</span>
                </a>
                <a href="cadastro-usuario.php" class="button-default bt-add">Adicionar novo usuário</a>
            </div>
            <div class="shadow-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Nascimento</th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>