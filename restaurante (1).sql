-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/11/2024 às 14:56
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `restaurante`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `valor_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_comprados`
--

CREATE TABLE `itens_comprados` (
  `id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_produto`, `quantidade`, `preco`, `total`, `data_pedido`) VALUES
(19, 2, 1, 80.00, 80.00, '2024-11-25 13:46:50'),
(20, 16, 1, 95.00, 95.00, '2024-11-25 13:46:50'),
(21, 15, 1, 28.00, 28.00, '2024-11-25 13:46:50'),
(22, 7, 2, 49.90, 99.80, '2024-11-25 13:49:55'),
(23, 20, 2, 10.00, 20.00, '2024-11-25 13:49:55'),
(24, 14, 2, 15.00, 30.00, '2024-11-25 13:49:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `imagem`) VALUES
(1, 'Spaguete Carbonara', 65.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3xmBLnEEZiONfdpuyDNCZadCZbi3qmGZSAQ&s'),
(2, 'Lasagna á bolonhesa', 80.00, 'https://assets.unileversolutions.com/recipes-v2/229470.jpg'),
(3, 'Fettuccine Alfredo', 70.00, 'https://www.receiteria.com.br/wp-content/uploads/fettuccine-alfredo-rotated.jpeg'),
(4, 'Ravioli de ricota e espinafre', 75.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-6CRHNhsDWbLituPJxkkNj9hLSIg134n5Yw&s'),
(5, 'Tagliatelle ao pesto', 72.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvyRC6twCVm3TPTyk8bQTePGP5dIvDbytN0Q&s'),
(6, 'Picanha', 79.90, 'https://lirp.cdn-website.com/33406c6e/dms3rep/multi/opt/picanha-aa0c51c6-1920w.jpg'),
(7, 'Bife á parmegiana ', 49.90, 'https://p2.trrsf.com/image/fget/cf/1200/900/middle/images.terra.com/2022/10/01/414797907-bife-parmegiana-mix-de-queijos.jpg'),
(8, 'Frango grelhado', 45.00, 'https://catracalivre.com.br/wp-content/uploads/2023/10/peito-frango-grelhado.jpg'),
(9, 'Tomahawk steak', 85.00, 'https://irp.cdn-website.com/33406c6e/dms3rep/multi/Tomahawk-1f3b6f14.jpg'),
(10, 'Tiramisu', 25.00, 'https://static.itdg.com.br/images/1200-675/4667c6b17f2c045e601de0d092c2d318/339498-original-1-.jpg'),
(11, 'Panna cotta', 22.00, 'https://s2-receitas.glbimg.com/fkbAb7fTTu_emkmGWgPWj8I-6lA=/0x0:677x452/924x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_e84042ef78cb4708aeebdf1c68c6cbd6/internal_photos/bs/2021/l/N/bkmTJyQtm6f9qlqqpj0Q/panna.jpg'),
(12, 'Profiteteroles', 30.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIXLzIMBiV2Ajc5Z6p698tuG3Nw6okNASqIw&s'),
(13, 'Pavê de chocolate', 28.00, 'https://cdnm.westwing.com.br/glossary/uploads/br/2021/08/20174609/Fatia-de-pav%C3%AA-de-chocolate-Pinterest-p-a0069.jpg'),
(14, 'Gelato', 15.00, 'https://fsp.usp.br/eccco/wp-content/uploads/2022/09/texto-01-Gelato_10-07_to_22_808-1200x800.jpg'),
(15, 'Cheesecake de frutas vermelhas', 28.00, 'https://i.ytimg.com/vi/a8cBTbtlvR8/maxresdefault.jpg'),
(16, 'Vinho tinto', 95.00, 'https://www.divinho.com.br/blog/wp-content/uploads/2020/08/Vinho-Tinto.jpg'),
(17, 'Cerveja artesanal', 25.00, 'https://png.pngtree.com/png-vector/20230830/ourlarge/pngtree-glass-of-white-wine-png-image_9202249.png'),
(18, 'Vinho branco', 90.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4J_F4r-t5Gun77QQbEQCmXiofz3xTlWI2Ng&s'),
(19, 'Àgua mineral', 10.00, 'https://www.reservatoriodeaguamineral.com.br/wp-content/uploads/2019/09/A-%C3%A1gua-mineral..jpg'),
(20, 'Àgua gaseificada', 10.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSu7fXXZ0fiT3O1KFUZCucrS7f8xQ_K0CCCBQ&s'),
(21, 'Refrigerante', 10.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSntIERd_j_VOZyzTpQ9u_kICZzeSCKTSGlLA&s');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `datadia` date NOT NULL,
  `hora` time NOT NULL,
  `assentos` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reserva`
--

INSERT INTO `reserva` (`id`, `nome`, `datadia`, `hora`, `assentos`, `email`, `telefone`) VALUES
(7, 'severino ', '2024-11-25', '20:00:00', 4, 'teste@gmail.com', '43988065398');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `itens_comprados`
--
ALTER TABLE `itens_comprados`
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
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_comprados`
--
ALTER TABLE `itens_comprados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
