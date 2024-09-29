<?php

require __DIR__ . '/vendor/autoload.php';

use App\Entity\User;

$obUser = new User();

$erro = "";

if (isset($_POST['btn-continuar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $obUser = new User();
    $obUser->Login($email, $senha);
    $erro = $obUser->erro;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="./assets/js/validar_login.js" defer></script>
</head>

<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">
                <img src="assets/images/ho.svg" alt="" />
            </a>
        </div>
    </header>
    <section class="page-login">
        <div class="container-login">
            <div>
                <p class="login-title">
                    Essentia Farm Tec.
                </p>
                <p class="login-text">
                    Caso seja admin, entre com o seu login de usuário da <a href="https://essentia.com.br/"
                        target="_blank">Essentia Pharma Tec.</a>
                </p>
            </div>
            <div class="login container-small">
                <?php echo $erro ?>
                <form method="post" id="form-input-login">
                    <div class="input-login">
                        <div>
                            <label class="input-label-login">E-mail</label>
                            <input type="text" class="email-input" id="data-login" name="email">
                            <div class="error-message" id="error-email"></div>
                            <a class="login-text" href="cadastro-usuario.php">Ainda não sou cadastrado.</a>
                        </div>
                        <div>
                            <label class="input-label-password">Senha</label>
                            <input type="password" class="password-input" id="data-password" name="senha">
                            <div class="error-message" id="error-senha"></div>
                            <a class="login-text" href="recuperar_senha.php">Recuperar senha.</a>
                        </div>
                    </div>
                    <button type="submit" class="button-default" name="btn-continuar">Continuar</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>