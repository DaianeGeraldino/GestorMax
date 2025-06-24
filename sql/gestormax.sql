-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24/06/2025 às 00:50
-- Versão do servidor: 5.7.36
-- Versão do PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestormax`
--
CREATE DATABASE IF NOT EXISTS `gestormax` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestormax`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nome`) VALUES
(2, 'Açougue'),
(5, 'Bebidas'),
(7, 'Higiene Pessoal'),
(1, 'hortifruti'),
(3, 'Laticínios'),
(6, 'Limpeza'),
(8, 'Mercearia'),
(9, 'NÃ£o perecÃ­veis'),
(4, 'Padaria');

-- --------------------------------------------------------

--
-- Estrutura para tabela `entradas`
--

CREATE TABLE `entradas` (
  `entrada_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_entrada` date NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `item_id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `quantidade_inicial` int(11) NOT NULL,
  `quantidade_minima` int(11) NOT NULL,
  `custo` decimal(10,2) NOT NULL,
  `valor_venda` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria_id`, `quantidade_inicial`, `quantidade_minima`, `custo`, `valor_venda`) VALUES
(5, 'melancia', 1, 50, 10, '6.50', '6.50'),
(6, 'abacate', 1, 5, 12, '6.50', '9.00'),
(7, 'Leite Integral', 3, 30, 10, '3.50', '4.80'),
(8, 'Queijo Mussarela', 3, 15, 5, '12.00', '18.50'),
(9, 'Pão Francês', 4, 50, 20, '0.50', '0.80'),
(10, 'Bolo de Chocolate', 4, 10, 5, '8.00', '12.00'),
(11, 'Refrigerante Cola', 5, 40, 15, '4.00', '6.50'),
(12, 'Água Mineral', 5, 60, 20, '1.20', '2.50'),
(13, 'Detergente Líquido', 6, 25, 10, '2.30', '3.80'),
(14, 'Sabão em Pó', 6, 18, 8, '8.50', '12.00'),
(15, 'Shampoo', 7, 22, 10, '7.80', '12.50'),
(16, 'Sabonete', 7, 35, 15, '1.20', '2.00'),
(17, 'Arroz', 8, 40, 15, '12.00', '18.00'),
(18, 'Feijão', 8, 35, 12, '6.50', '9.80'),
(19, 'Açúcar', 8, 25, 10, '3.20', '4.50'),
(20, 'Óleo de Soja', 8, 30, 10, '4.80', '6.50'),
(21, 'Filet Mignon', 2, 15, 5, '45.00', '65.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idname` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `typePerfil` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idname`, `name`, `nickname`, `email`, `typePerfil`, `status`, `senha`) VALUES
(1, 'Gabriel', 'gabriel.buffon', 'ga@gmail.com', '1', '1', 'senha123'),
(3, 'Daiane Geraldino Guerra', 'daiane.guerra', 'daianegeraldino@gmail.com', '1', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(4, 'Carlos Silva', 'carlos.silva', 'carlos@email.com', '2', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(5, 'Ana Paula', 'ana.paula', 'ana@email.com', '1', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(6, 'Roberto Almeida', 'roberto.almeida', 'roberto@email.com', '2', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(7, 'Juliana Costa', 'juliana.costa', 'juliana@email.com', '1', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(8, 'Marcos Oliveira', 'marcos.oliveira', 'marcos@email.com', '2', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(9, 'Fernanda Lima', 'fernanda.lima', 'fernanda@email.com', '1', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(10, 'Ricardo Santos', 'ricardo.santos', 'ricardo@email.com', '2', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(11, 'Patrícia Gomes', 'patricia.gomes', 'patricia@email.com', '1', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(12, 'Lucas Mendes', 'lucas.mendes', 'lucas@email.com', '2', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.'),
(13, 'Camila Rocha', 'camila.rocha', 'camila@email.com', '1', '1', '$2y$10$768HAL6lbTEgMjoUbvmyDeMo/g3tZidkCUMxkZwyTl85zBnr1Jcw.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `venda_id` int(11) NOT NULL,
  `data_venda` date NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`entrada_id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `venda_id` (`venda_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idname`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`venda_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `entrada_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idname` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `venda_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`idname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD CONSTRAINT `itens_venda_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`venda_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itens_venda_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`idname`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
