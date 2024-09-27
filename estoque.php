<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\itensPedido;
use App\Entity\Produtos;

$obItens = new itensPedido();

$itens = $obItens->getItens();

$obProdutos = new Produtos();

$produtos = $obProdutos->getProdutos();


$quantidades = []; // Array para acumular as quantidades

$resultado = '';

foreach ($produtos as $produto) {
    $quantidadeTotal = 0;

    foreach ($itens as $item) {
        if ($produto->id_produto == $item->produto_id) {
            $quantidadeTotal += $item->quantidade;
        }
    }
    $quantidades[$produto->id_produto] = $quantidadeTotal;
}
$obProduto = new Produtos();


foreach ($quantidades as $id_produto => $quantidade) {
    $resultado .= '<tr>
    <td>' . '<img src=' . $obProduto->getProduto($id_produto)->imagem . ' class="img-produto">'  . '</td>
    <td>' .   $obProduto->getProduto($id_produto)->nome . '</td>
    <td class="text-center"> ' .   $quantidade . '</td>
    <td class="text-center">' . $obProduto->getProduto($id_produto)->quantidade  - $quantidade . '</td>
</tr>';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de pedidos</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'includes/header.php' ?>
    <section class="page-gerenciamento-produto paddingBottom50">
        <div class="container">
            <div class="d-flex justify-content-between">
                <a href="pedidos.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Consulta de Estoque</span>
                </a>
            </div>
            <div class="table-shadow">
                <table>
                    <thead>
                        <tr>
                            <th>ID Produto</th>
                            <th>Produto</th>
                            <th class="text-center">Quantidade Vendida</th>
                            <th class="text-center">Quantidade Atual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $resultado ?>
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