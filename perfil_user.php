<?php

// Iniciar sessão
session_start();

//Verificação

if (!isset($_SESSION['logado'])) :
    header('Location: index.php');
endif;

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\User;

$obUserId = User::getUser($_SESSION["id_user"]);

if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"])) {

    $imagem = "./foto_perfil/" . $_FILES["imagem"]["name"];
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
    $obUserId = User::getUser($_SESSION["id_user"]);
    $obUserId->nome;
    $obUserId->email;
    $obUserId->cpf;
    $obUserId->nascimento;
    $obUserId->imagem = $imagem;
    $obUserId->FotoPerfil();
    header('location: perfil_user.php');
};

//$foto_perfil = $obUserId->imagem;
$sem_foto = "./assets/images/icon-feather-user.svg";

$foto_perfil = $obUserId->imagem;
if ($foto_perfil == NULL) {
    $foto_perfil = $sem_foto;
    $_SESSION['foto_perfil'] = $foto_perfil;
}
$_SESSION['foto_perfil'] = $foto_perfil;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Usuário</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/cadastro_produto.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="./assets/js/validar_login.js" defer></script>
</head>

<body>
    <?php require_once "includes/header.php" ?>
    <section class="page-login">
        <div class="container-login">
            <div class="login container-small">
                <form method="post" id="form-input-login" enctype="multipart/form-data">
                    <div class="input-login">
                        <div class="text-center">
                            <img style="width: 100px;" src='<?php echo $foto_perfil ?>' class="rounded" alt="...">
                        </div>
                        <div>
                            <input type="text" class="email-input" readonly value='<?php echo $obUserId->nome ?>'>
                        </div>
                        <div>
                            <label class="bt-arquivo" for="bt-arquivo">Adicionar imagem</label>
                            <input id="bt-arquivo" type="file" accept="image/*" name="imagem">
                        </div>
                    </div>
            </div>
            <button type="submit" class="button-default" name="btn-continuar">Salvar imagem</button>
            <a class="button-default text-center align-center" href="alterar-senha.php"
                style="text-decoration: none; background-color:crimson; padding-top: 10px;">Alterar Senha</a>
            </form>
        </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>