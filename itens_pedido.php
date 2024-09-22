<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\itensPedido;
use App\Entity\Clientes;
use App\Entity\novoPedido;
use App\Entity\Produtos;

// Validando id do produto
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: pedidos.php?status=error');
    exit;
}

// Pegar itens do pedido selecionado

$IdItensPedido = itensPedido::getItemPedido($_GET['id']);

$IdPedido = $IdItensPedido->pedido_id;

$obItens = new itensPedido();

$itens = $obItens->getItens();

$resultados = '';


//Pegar nome do cliente do pedido
$obPedido = new novoPedido();
$pedido = $obPedido->getPedido($IdPedido);
$cliente_id = $pedido->cliente_id;

$obCliente = new Clientes();
$clientes = $obCliente->getClientes();

$resultados = '';

// Pega o nome do cliente relacionado ao pedido
foreach ($clientes as $cliente) {
    if ($cliente_id == $cliente->id_cliente) {
        $nomeClientePedido = $cliente->nome;
    }
}
// Monta a tabela com os itens do pedido
foreach ($itens as $item) {
    if ($item->pedido_id == $IdPedido) {

        $obProdutos = new Produtos();

        $produtos = $obProdutos->getProdutos();
        foreach ($produtos as $produto) {
            if ($item->produto_id == $produto->id_produto) {
                $result_prod = $produto->nome;
            };
        };

        $resultados .= '<tr>
                            <td>' . $item->pedido_id . '</td>
                            <td>' .  $result_prod . '</td>
                            <td>' . $item->quantidade . '</td>
                            <td>' . 'R$ ' . $item->valor . '</td>
                        </tr>';
    }
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
                <a href="pedidos.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Detalhes do pedido</span>
                </a>
                <a href="novo-pedido.php" class="bt-add">Adicionar novo pedido</a>
            </div>
            <div class="maxW340">
                <label class="input-label">Cliente</label>
                <input type="text" class="input" value=' <?php echo $nomeClientePedido ?>' readonly>
            </div>
            <div class="shadow-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID pedido</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
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