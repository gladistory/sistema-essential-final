<?php
require 'vendor/autoload.php';

use App\DB\Database;

$sucesso = "";
$erro = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $obsDatabase = new Database('usuarios');

    // Verifica se o token é válido
    $user = $obsDatabase->selectOne('reset_token = :token', ['token' => $token]);

    if ($user) {
        if (isset($_POST['nova_senha'])) {
            // Atualiza a nova senha
            $nova_senha = password_hash($_POST['nova_senha'], PASSWORD_BCRYPT);
            $update = $obsDatabase->update('id = ' . $user['id'], [
                'senha' => $nova_senha,
                'reset_token' => null // Remove o token após a redefinição de senha
            ]);

            $sucesso = "<div class='alert alert-success text-center' role='alert'>Senha alterada com sucesso! <a href='http://localhost/sistema-essential-final/'>Fazer Login</a></div>";
        }
    } else {
        $erro = "<div class='alert alert-danger text-center' role='alert'>Token expirado ou inválido</div>";
    }
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
                <form method="post" id="form-cadastro-usuario">
                    <?php echo $erro ?>
                    <?php echo $sucesso ?>
                    <div>
                        <div style="width: 180px;">
                            <label class="input-label">Digite sua nova senha</label>
                            <input type="password" name="nova_senha" id="nova_senha" style="width: 340px;"
                                placeholder="Digite sua nova senha" required>
                        </div>
                    </div>
                    <button type="submit" class="button-default">Redefinir Senha</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>