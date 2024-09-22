<?php
// Iniciar sessão

use App\Entity\novoPedido;

session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

$obPedidos = new novoPedido();

$pedidos = $obPedidos->getPedidos();

$_SESSION['num_pedidos'] = count($pedidos);

$resultados = '';

foreach ($pedidos as $pedido) {

    $resultados .= '<tr>
                            <td>' . $pedido->id . '</td>
                            <td>' . $pedido->cliente_id . '</td>
                            <td>' .  date('d/m/Y', strtotime($pedido->data_pedido)) . '</td>
                            <td>' . 'R$ ' . $pedido->valor_total . ',00' . '</td>
                            <td>
                                <a href="itens_pedido.php?id=' . $pedido->id . '">
                                <button type="button" class="btn btn-primary">Detalhes</button>
                             </td>
                    </tr>';
};

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
                <a href="dashboard.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Gerenciamento de pedidos</span>
                </a>
                <a href="novo-pedido.php" class="bt-add">Adicionar novo pedido</a>
            </div>
            <div class="shadow-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID pedido</th>
                            <th>Cliente ID</th>
                            <th>Data do pedido</th>
                            <th>Valor</th>
                            <th>Itens pedido</th>
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