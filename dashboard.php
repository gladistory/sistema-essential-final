<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Clientes;
use App\Entity\Produtos;
use App\Entity\novoPedido;

$obProdutos = new Produtos();

$produtos = $obProdutos->getProdutos();

$_SESSION['num_produtos'] = count($produtos);

$obCliente = new Clientes();
$clientes = $obCliente->getClientes();

$_SESSION['num_clientes'] = count($clientes);

$obPedidos = new novoPedido();

$pedidos = $obPedidos->getPedidos();

$_SESSION['num_pedidos'] = count($pedidos);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<body>
    <?php require_once 'includes/header.php' ?>
    <section class="page-index">
        <div class="container">
            <div class="dash-index">
                <div class="blc">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h2>Clientes</h2>
                            <span><?php echo $_SESSION['num_clientes'] ?></span>
                        </div>
                        <img src="assets/images/icon-users.svg" alt="">
                    </div>
                    <a href="clientes.php" class="bt-index">Gerenciar clientes</a>
                </div>
                <div class="blc">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h2>Produtos</h2>
                            <span><?php echo $_SESSION['num_produtos'] ?></span>
                        </div>
                        <img src="assets/images/icon-product.svg" style="max-width: 76px;" alt="">
                    </div>
                    <a href="produtos.php" class="bt-index">Gerenciar produto</a>
                </div>
                <div class="blc">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h2>Pedidos</h2>
                            <span><?php echo $_SESSION['num_pedidos'] ?></span>
                        </div>
                        <img src="assets/images/icon-pedido.svg" alt="">
                    </div>
                    <a href="novo-pedido.php" class="bt-index">Novo pedido</a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>