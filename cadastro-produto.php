<?php
// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Produtos;

if (isset($_POST['nome'], $_POST['quantidade'], $_POST['valor'], $_POST['descricao'])) {
    if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"])) {

        $imagem = "./product_img/" . $_FILES["imagem"]["name"];
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
        $obProdutos = new Produtos();

        $obProdutos->nome = $_POST["nome"];
        $obProdutos->quantidade = $_POST["quantidade"];
        $obProdutos->valor = $_POST["valor"];
        $obProdutos->descricao = $_POST["descricao"];
        $obProdutos->imagem = $imagem;
        $obProdutos->Cadastrar();
        header('location: produtos.php');
    };
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/cadastro_produto.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<body>
    <?php require_once "includes/header.php" ?>
    <section class="page-cadastro-produto paddingBottom50">
        <div class="container">
            <div>
                <a href="/cadastro-cliente.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Cadastro de produto</span>
                </a>
            </div>
            <div class="container-small">
                <form method="post" id="form-cadastro-produto" enctype="multipart/form-data">
                    <div class="bloco-inputs">
                        <div>
                            <label class="input-label">Nome</label>
                            <input type="text" class="nome-input" name="nome">
                        </div>
                        <div>
                            <label class="input-label">Descrição</label>
                            <textarea class="textarea" name="descricao"></textarea>
                        </div>
                        <div class="flex-2">
                            <div>
                                <label class="input-label">Quantidade</label>
                                <input type="number" class="sku-input" name="quantidade">
                            </div>
                            <div>
                                <label class="input-label">Valor</label>
                                <input type="text" class="valor-input" name="valor">
                            </div>
                        </div>
                        <div>
                            <label class="bt-arquivo" for="bt-arquivo">Adicionar imagem</label>
                            <input id="bt-arquivo" type="file" accept="image/*" name="imagem">
                        </div>
                    </div>
                    <button type="submit" class="button-default">Salvar novo produto</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>