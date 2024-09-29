<header>
    <div class="container">
        <a href="dashboard.php" class="logo">
            <img src="assets/images/ho.svg" alt="" />
        </a>
        <div class="blc-user">
            <img style="width: 45px;" src='<?php echo $_SESSION['foto_perfil'] ?>' />
            <span>
                Olá, <br />
                <?php echo $_SESSION['name'] ?>
            </span>
            <img src="assets/images/arrow-down.svg" alt="" />
            <div class="menu-drop">
                <a href="clientes.php">Gerenciar clientes</a>
                <a href="usuarios.php">Gerenciar Usuários</a>
                <a href="produtos.php">Gerenciar produtos</a>
                <a href="estoque.php">Consulta de Estoque</a>
                <a href="pedidos.php">Relatório de Vendas</a>
                <a href="cadastro-cliente.php">Cadastrar cliente</a>
                <a href="cadastro-usuario.php">Cadastrar usuário</a>
                <a href="cadastro-produto.php">Cadastrar produto</a>
                <a href="novo-pedido.php">Novo pedido</a>
                <a href="perfil_user.php">Perfil do Usuário</a>
                <a href="logout.php">Sair da conta</a>
            </div>
        </div>

    </div>
</header>