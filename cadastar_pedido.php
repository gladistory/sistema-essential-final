<?php

use App\Entity\itensPedido;
use App\Entity\novoPedido;

session_start();

// Verificação de login
if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
    exit;
}

require __DIR__ . '/vendor/autoload.php';

// Captura os dados do POST
$itens_pedido = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($itens_pedido["envio"])) {
    $valorTotal = 0;
    foreach ($itens_pedido["produto"] as $id => $produto) {
        $valor = floatval($itens_pedido["valorParcial"][$id]);
        $valorTotal += $valor;
    }

    // Cadastra o pedido
    $obPedido = new novoPedido();
    $obPedido->valorTotal = $valorTotal;
    $obPedido->cliente_id = intval($itens_pedido["cliente_id"]);
    $pedido_id = $obPedido->cadastrarPedido();  // Aqui deve retornar o ID do pedido cadastrado

    // Verifica se o pedido foi cadastrado corretamente
    if ($pedido_id) {
        // Cadastra os itens do pedido
        foreach ($itens_pedido["produto"] as $id => $produto) {
            $obItens = new itensPedido();

            // Passa o ID do pedido para cada item
            $obItens->pedido_id = $pedido_id;
            $obItens->produto_id = $itens_pedido["produto_id"][$id];
            $obItens->quantidade = $itens_pedido["quantidade"][$id];
            $obItens->valor = floatval($itens_pedido["valorParcial"][$id]);
            $obItens->cadastrarItens();
        }

        // Redireciona para o dashboard após sucesso
        header('location: pedidos.php');
        exit;
    } else {
        die('Erro ao cadastrar o pedido.');
    }
}