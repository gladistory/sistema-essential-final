-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/09/2024 às 18:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemalogin`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `email`, `cpf`, `telefone`) VALUES
(7, 'Pedro', 'cliente2.@email.com', '12374156855', '4830663041'),
(8, 'Paulo', 'cliente3@email.com', '55888555222', '4830663041'),
(10, 'João', 'cliente13@email.com', '1237415555', '4830663041'),
(11, 'Vinicius de Souza Santos', 'desouza850@gmail.com', '11962652912', '4830663041'),
(16, 'Marcelo Alves', 'Marcelo@gmail.com', '12234566565', '4830663041');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id`, `pedido_id`, `produto_id`, `quantidade`, `valor`) VALUES
(14, 7, 5, 1, 340.00),
(15, 7, 6, 2, 500.00),
(16, 8, 5, 2, 680.00),
(17, 9, 2, 2, 348.00),
(18, 9, 1, 1, 160.00),
(19, 10, 7, 1, 250.00),
(20, 10, 8, 2, 560.00),
(21, 10, 2, 1, 174.00),
(22, 10, 1, 1, 160.00),
(23, 11, 5, 1, 340.00),
(24, 11, 7, 1, 250.00),
(25, 12, 1, 3, 480.00),
(26, 13, 9, 10, 960.00),
(27, 13, 5, 2, 680.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valor_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `data_pedido`, `valor_total`) VALUES
(7, 8, '2024-09-22 23:17:44', 840),
(9, 7, '2024-09-23 02:14:19', 508),
(10, 10, '2024-09-23 02:09:06', 1144),
(11, 11, '2024-09-23 04:09:02', 590),
(12, 7, '2024-09-28 02:09:22', 480),
(13, 11, '2024-09-29 20:09:22', 1640);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `quantidade` int(255) NOT NULL,
  `valor` varchar(120) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `descricao` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `quantidade`, `valor`, `imagem`, `descricao`) VALUES
(1, 'Happy Theanine', 100, '160', './product_img/happy_theanine.jpg', 'Contêm cerca de 30mg de L-teanina por xícara, uma cápsula de Happy Theanine fornece 250mg com elevado grau de pureza.'),
(2, 'Super Omega-3 TG', 100, ' 174', './product_img/super_omega3tg_90caps_pote.jpg', 'Apresenta alta concentração de EPA e DHA e na forma TG proporciona uma absorção otimizada.'),
(5, 'Crealift', 150, '340', './product_img/crealift_lata_pequena_01.jpg', 'Composto exclusivamente por Creapure®, a creatina mono-hidratada e micronizada altamente purificada e reconhecida internacionalmente por sua qualidade superior.'),
(6, 'Cacao Whey 15 Doses', 100, '250', './product_img/cacao_whey_lata_media_1308x1636px_1.jpg', 'Whey protein hidrolisado e isolado, com colágeno hidrolisado em peptídeos, puro cacau e adoçantes naturais.'),
(7, 'Beta Action', 50, '250', './product_img/beta_action_jabuticaba_lata.jpg', 'Beta Action é um pré-treino sem cafeína desenvolvido para impulsionar a performance esportiva, a resistência física e a recuperação muscular.'),
(9, 'NAC + Glycine + Taurine', 100, '96', './product_img/nac_pote.jpg', 'Uma fórmula estrategicamente desenvolvida para oferecer os aminoácidos cisteína, por meio da N-acetil L-cisteína (NAC), e glicina de forma altamente eficaz e em perfeita harmonia com a taurina.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nascimento` date NOT NULL,
  `senha` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `nascimento`, `senha`, `reset_token`, `imagem`) VALUES
(20, 'Vinicius de Souza Santos', 'desouza850@gmail.com', '1223456656', '1999-10-15', '$2y$10$phXvGlne2dNGjOOTVim/XuiXvx/rkrEjwOKbm4.F4pAV6OqzXdKja', '', './foto_perfil/Foto Rede Social (4).png');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD UNIQUE KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
