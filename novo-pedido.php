<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo pedido</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/novo_pedido.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./assets/js/scripts.js" defer></script>
</head>

<body>
    <?php require_once 'includes/header.php' ?>
    <section class="page-novo-pedido paddingBottom50">

        <div class="container">
            <div>
                <a href="dashboard.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Novo pedido</span>
                </a>
            </div>
            <div class="maxW340">
                <label class="input-label">Cliente</label>
                <input id="buscar" type="text" class="input" name="cliente" placeholder="Digite o nome do cliente">
            </div>
            <div class="shadow-table">
                <table id="minhaTabela">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor parcial</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input id="buscarProduto" type="text" class="input" name="buscarProduto"
                                    placeholder="Digite o nome do produto"></td>
                            <td><input id="quantidadeProduto" type="number" class="input" name="quantidade" value="1">
                            </td>
                            <td><input id="valorProduto" type="text" class="input" name="valorProduto" readonly></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <a onclick="adicionarLinha()" class="bt-add-produto">
                                            <span>Adicionar produto no pedido</span>
                                            <img src="assets/images/adicionar.svg" alt="" />
                                        </a>
                                    </div>
                                    <div class="blc-subtotal d-flex">
                                        <div class="d-flex align-items-center">
                                            <span>Total</span>
                                            <input name="valorTotal" id="total" type="text" class="input" disabled
                                                value="0,00" />
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>
    <script>
    $(document).ready(function() {
        $("#buscar").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "search_cliente.php",
                    type: "POST",
                    dataType: "json", // Especifica que o retorno é JSON
                    data: {
                        nome: request.term // Envia o termo de busca
                    },
                    success: function(data) {
                        response(data); // Passa o array de nomes para o autocomplete
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro: " + error);
                    }
                });
            },
            minLength: 1 // Inicia o autocomplete após digitar 2 caracteres
        });
    });

    $(document).ready(function() {
        $("#buscarProduto").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "search_produto.php", // Arquivo PHP que retorna os produtos
                    type: "POST",
                    dataType: "json",
                    data: {
                        nome: request.term // Envia o termo de busca
                    },
                    success: function(data) {
                        response(data); // Passa os dados para o autocomplete
                    }
                });
            },
            minLength: 1, // Inicia o autocomplete após digitar 2 caracteres
            select: function(event, ui) {
                // Quando um produto é selecionado, o ID estará em ui.item.id
                var produtoId = ui.item.id;

                // Faz a requisição AJAX para buscar o valor do produto
                $.ajax({
                    url: "get_produto_detalhes.php", // Arquivo PHP que busca detalhes do produto
                    type: "POST",
                    dataType: "json",
                    data: {
                        id_produto: produtoId
                    }, // Envia o ID do produto para o servidor
                    success: function(data) {
                        // Preenche os campos do formulário com os dados do produto
                        $("#valorProduto").val(data
                            .valor); // Exemplo: preencher o campo valor
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro ao buscar detalhes do produto: " + error);
                    }
                });
            }
        });
        // Atualiza o total quando a quantidade muda
        $('#quantidadeProduto').on('input', function() {
            calcularTotal();
        });
    });

    function calcularTotal() {
        var quantidade = parseFloat($("#quantidadeProduto").val());
        var valor = parseFloat($("#valorProduto").val());
        if (!isNaN(quantidade) && !isNaN(valor)) {
            var total = quantidade * valor;
            $("#total").val(total.toFixed(2)); // Formata o total com 2 casas decimais
        }
    }
    </script>
</body>

</html>