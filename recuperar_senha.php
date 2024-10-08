<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\User;

$erro = "";
$sucesso = "";


if (isset($_POST['btn-continuar'])) {
    $email = $_POST['email'];
    $obUser = new User();
    $obUser->RecuperarSenha($email);
    $sucesso = $obUser->sucesso;
    $erro = $obUser->erro;
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuário</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">
                <img src="assets/images/ho.svg" alt="" />
            </a>
        </div>
    </header>
    <section class="page-cadastro-usuario paddingBottom50">
        <div class="container">
            <div>
                <a href="dashboard.php" class="link-voltar">
                    <img src="assets/images/arrow.svg" alt="">
                    <span>Recuperar senha</span>
                </a>
            </div>
            <div class="container-small">
                <?php echo $sucesso ?>
                <?php echo $erro ?>
                <form method="post" id="form-cadastro-usuario">
                    <div>
                        <div style="width: 180px;">
                            <label class="input-label">Email</label>
                            <input type="email" class="email-input" name="email" style="width: 340px;"
                                placeholder="Digite seu email">
                        </div>
                    </div>
                    <button type="submit" class="button-default" name="btn-continuar">Recuperar senha</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>