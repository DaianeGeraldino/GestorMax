-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10-Jun-2025 às 21:56
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
CREATE DATABASE IF NOT EXISTS `gestormax` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `gestormax`;

-- --------------------------------------------------------
-- Tabela `usuarios`
-- --------------------------------------------------------
CREATE TABLE `usuarios` (
  `idname`           INT(11)      NOT NULL,
  `name`             VARCHAR(255) NOT NULL,
  `nickname`         VARCHAR(255) NOT NULL,
  `email`            VARCHAR(255) NOT NULL,
  `typePerfil`       VARCHAR(255) NOT NULL,
  `status`           VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idname`),
  ADD UNIQUE KEY `email`    (`email`),
  ADD UNIQUE KEY `nickname` (`nickname`);

ALTER TABLE `usuarios`
  MODIFY `idname` INT(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Tabela `categorias`
-- --------------------------------------------------------
CREATE TABLE `categorias` (
  `id`   INT(11)       NOT NULL,
  `nome` VARCHAR(100)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

ALTER TABLE `categorias`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Tabela `produtos`
-- --------------------------------------------------------
CREATE TABLE `produtos` (
  `id`                 INT(11)       NOT NULL,
  `nome`               VARCHAR(100)  NOT NULL,
  `categoria_id`       INT(11)       DEFAULT NULL,
  `quantidade_inicial` INT(11)       NOT NULL,
  `quantidade_minima`  INT(11)       NOT NULL,
  `custo`              DECIMAL(10,2) NOT NULL,
  `valor_venda`        DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

ALTER TABLE `produtos`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

-- Chave estrangeira ligando produtos → categorias
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `categorias` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
 /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
