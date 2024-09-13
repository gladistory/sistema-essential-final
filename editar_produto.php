<?php
// Iniciar sessão
session_start();

// Verificação
if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Produtos;

// Validando id do produto
// Validando id do produto
if (!isset($_GET['id_produto']) or !is_numeric($_GET['id_produto'])) {
    header('location: produtos.php?status=error');
    exit;
}

$obProdutoID = Produtos::getProduto($_GET['id_produto']);

// Validar se o produto existe no banco
if (!$obProdutoID instanceof Produtos) {
    header('location: produtos.php?status=error');
    exit;
}

if (isset($_POST['nome'], $_POST['quantidade'], $_POST['valor'], $_POST['descricao'])) {

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Caminho da nova imagem
        $imagem = "./product_img/" . $_FILES["imagem"]["name"];
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
    } else {
        // Caso não tenha sido enviada, mantém a imagem existente do banco de dados
        $imagem = $obProdutoID->imagem;
    }

    // Atualizando o produto
    $obProdutoID->nome = $_POST["nome"];
    $obProdutoID->quantidade = $_POST["quantidade"];
    $obProdutoID->valor = $_POST["valor"];
    $obProdutoID->descricao = $_POST["descricao"];
    $obProdutoID->imagem = $imagem; // Mantém ou atualiza a imagem

    $obProdutoID->Editar();
    header('location: produtos.php');
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
                <a href="produtos.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Cadastro de produto</span>
                </a>
            </div>
            <div class="container-small">
                <form method="post" id="form-cadastro-produto" enctype="multipart/form-data">
                    <div class="bloco-inputs">
                        <div>
                            <label class="input-label">Nome</label>
                            <input type="text" class="nome-input" name="nome" value='<?php echo $obProdutoID->nome ?>'>
                        </div>
                        <div>
                            <label class="input-label">Descrição</label>
                            <textarea class="textarea" name="descricao"><?php echo $obProdutoID->descricao ?></textarea>
                        </div>
                        <div class="flex-2">
                            <div>
                                <label class="input-label">Quantidade</label>
                                <input type="number" class="sku-input" name="quantidade"
                                    value='<?php echo $obProdutoID->quantidade ?>'>
                            </div>
                            <div>
                                <label class="input-label">Valor</label>
                                <input type="text" class="valor-input" name="valor"
                                    value='<?php echo $obProdutoID->valor ?>'>
                            </div>
                        </div>
                        <div>
                            <label class="bt-arquivo" for="bt-arquivo">Adicionar imagem</label>
                            <input id="bt-arquivo" type="file" accept="image/*" name="imagem">
                        </div>
                    </div>
                    <button type="submit" class="button-default">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>