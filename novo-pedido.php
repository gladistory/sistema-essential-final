<?php
// Iniciar sessão

use App\Entity\Produtos;

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
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/assets/js/scripts.js" defer></script>
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
            <form method="post" action="cadastar_pedido.php">
                <div class="maxW340">
                    <label class="input-label">Cliente</label>
                    <input id="cliente" type="text" class="input" name="cliente" placeholder="Digite o nome do cliente">
                    <input type="hidden" id="cliente_id" name="cliente_id">
                </div>
                <div class="shadow-table">
                    <table id="minhaTabela">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor parcial</th>
                                <th>Valor Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="campo">
                                <td><input id="produto" type="text" class="input buscarProduto" name="produto[]"
                                        placeholder="Digite o nome do produto"></td>
                                <td><input id="quantidade" type="number" class="input quantidadeProduto"
                                        name="quantidade[]" value="0">
                                </td>
                                <td><input type="text" class="input valorUnitario" name="valorUnitario" readonly></td>
                                <td><input id="valorParcial" type="text" class="input valorParcial"
                                        name="valorParcial[]" readonly></td>
                                <td><img class="deleteLinha" src="assets/images/remover.svg" alt="" /></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col">
                                            <a onclick="adicionarLinha()" class="bt-add-produto">
                                                <span>Adicionar produto</span>
                                                <img src="assets/images/adicionar.svg" alt="" />
                                            </a>
                                        </div>
                                        <div class="blc-subtotal d-flex">
                                            <div class="d-flex align-items-center">
                                                <span>Total</span>
                                                <input name="totalGeral" type="text" class="input" id="totalGeral"
                                                    disabled value="0,00" />
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                        </tfoot>
                    </table>
                </div>
                <button name="envio" type="submit" class="button-default">Salvar</button>
            </form>
        </div>
        </div>
    </section>
    <script>
    $(document).ready(function() {
        $("#cliente").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "search_cliente.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        nome: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro: " + error);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                // Quando o cliente é selecionado, você pega o ID e coloca no campo hidden
                $("#cliente_id").val(ui.item.id);
            }
        });
    });

    $(document).ready(function() {
        // Função para adicionar autocomplete a todos os campos de produto
        function aplicarAutocompleteProduto() {
            $(".buscarProduto").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "search_produto.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            nome: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    var produtoId = ui.item.id;
                    var $linha = $(this).closest('tr');

                    $.ajax({
                        url: "get_produto_detalhes.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id_produto: produtoId
                        },
                        success: function(data) {
                            // Definindo o valor unitário do produto
                            $linha.find(".valorUnitario").val(data.valor.replace('.',
                                ','));
                            calcularTotalLinha($linha); // Recalcular o total da linha
                            calcularTotalGeral(); // Atualizar o total geral
                        },
                        error: function(xhr, status, error) {
                            console.error("Erro ao buscar detalhes do produto: " +
                                error);
                        }
                    });
                }
            });
        }

        // Aplicar autocomplete inicial
        aplicarAutocompleteProduto();

        // Função para calcular o total da linha (quantidade * valor unitário)
        function calcularTotalLinha($linha) {
            var quantidade = parseFloat($linha.find(".quantidadeProduto").val());
            var valorUnitario = parseFloat($linha.find(".valorUnitario").val().replace(',', '.'));

            if (!isNaN(quantidade) && !isNaN(valorUnitario)) {
                var total = quantidade * valorUnitario;
                $linha.find(".valorParcial").val(total.toFixed(2).replace('.',
                    ',')); // Atualiza o valor parcial
            }
        }

        // Função para calcular o total geral de todos os produtos
        function calcularTotalGeral() {
            var totalGeral = 0;

            $("#minhaTabela tbody tr").each(function() {
                var valorParcial = parseFloat($(this).find(".valorParcial").val().replace(',', '.'));
                if (!isNaN(valorParcial)) {
                    totalGeral += valorParcial;
                }
            });

            $("#totalGeral").val(totalGeral.toFixed(2).replace('.', ',')); // Exibir o total geral
        }

        // Atualiza o total quando a quantidade muda
        $(document).on('input', '.quantidadeProduto', function() {
            var $linha = $(this).closest('tr');
            calcularTotalLinha($linha); // Recalcular o total da linha
            calcularTotalGeral(); // Atualizar o total geral
        });

        var controleCampo = 1;

        function adicionarLinha() {
            controleCampo++; // Incrementa o controle para gerar um novo ID único

            document.getElementById('minhaTabela').insertAdjacentHTML("beforeend",
                '<tr id="campo' + controleCampo + '">' +
                '<td><input id="produto" type="text" class="input buscarProduto" name="produto[]" placeholder="Digite o nome do produto"></td>' +
                '<td><input id="quantidade" type="number" class="input quantidadeProduto"name="quantidade[]" value="0"></td>' +
                '<td><input type="text" class="input valorUnitario" name="valorUnitario" readonly></td>' +
                '<td><input id="valorParcial" type="text" class="input valorParcial"name="valorParcial[]" readonly></td>' +
                '<td><img class="deleteLinha" src="assets/images/remover.svg" alt="" /></td>' +
                '</tr>'
            );
            aplicarAutocompleteProduto(); // Aplicar autocomplete na nova linha
        }

        // Função para adicionar uma nova linha ao clicar no botão "Adicionar produto"
        $('.bt-add-produto').on('click', function(e) {
            e.preventDefault();
            adicionarLinha();
        });

        // Função para remover linha ao clicar no ícone de remover
        $(document).on('click', '.deleteLinha', function() {
            $(this).closest('tr').remove(); // Remove a linha
            calcularTotalGeral(); // Atualiza o total geral
        });
    });
    </script>
</body>

</html>