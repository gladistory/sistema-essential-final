<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Produtos;

$obProdutos = new Produtos();

$produtos = $obProdutos->getProdutos();

$_SESSION['num_produtos'] = count($produtos);

$resultados = '';

foreach ($produtos as $produto) {

    $resultados .= '<tr>
                            <td class="text-center"> ' . $produto->id_produto . '</td>
                            <td>' .
        '<img src=' . $produto->imagem . ' class="img-produto">' . '</td>
                            <td class="text-center">' . $produto->nome . '</td>
                            <td class="text-center">' . $produto->quantidade . '</td>
                            <td>' . $produto->descricao . '</td>
                            <td class="p-1">' . 'R$ ' . $produto->valor . '</td>
                             <td>
                                <a href="editar_produto.php?id_produto=' . $produto->id_produto . '">
                                <button type="button" class="btn btn-primary">Editar</button>
                             </td>
                             <td>
                                <a href="excluir_produto.php?id_produto=' . $produto->id_produto . '">
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
    <title>Gerenciamento de produto</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/gerenciamento_produto.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'includes/header.php' ?>
    <section class="page-gerenciamento-produto paddingBottom50">
        <div class="container">
            <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Gerenciamento de produto</span>
                </a>
                <a href="cadastro-produto.php" class="bt-add">Adicionar novo produto</a>
            </div>
            <div class="table-responsive rounded-2">
                <table class="table table-dark table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th class="text-center">Nome</th>
                            <th>Quantidade</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Editar</th>
                            <th>Exluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $resultados ?>
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