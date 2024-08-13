-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06-Maio-2024 às 18:51
-- Versão do servidor: 8.0.27
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_mrmath`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `desempenho`
--

DROP TABLE IF EXISTS `desempenho`;
CREATE TABLE IF NOT EXISTS `desempenho` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aulas_assistidas` int NOT NULL,
  `acertos` int NOT NULL,
  `ex_feitos` int NOT NULL,
  `id_usuarios` int NOT NULL,
  `id_materia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuarios` (`id_usuarios`),
  KEY `id_materia` (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicios`
--

DROP TABLE IF EXISTS `exercicios`;
CREATE TABLE IF NOT EXISTS `exercicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_materia` int NOT NULL,
  `codigo_ex` int NOT NULL,
  `imagem` longblob NOT NULL,
  `enunciado` varchar(1600) COLLATE utf8mb4_general_ci NOT NULL,
  `resposta` varchar(1) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `sobrenome` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pfp` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `pfp`) VALUES
(1, 'daniel', 'rocha', 'danielrocha.etec@gmail.com', 'd360b50fd20de281e365', ''),
(2, 'guilherme', 'rosa', 'rosa@gmail.com', '192309aaddc500140db2', ''),
(3, 'guilherme', 'rosa', 'rosa@gmail.com', '25d55ad283aa400af464', ''),
(4, 'guilherme', 'rosa', 'rosa@gmail.com', '25d55ad283aa400af464', ''),
(5, 'guilherme', 'rosa', 'rosa@gmail.com', '25d55ad283aa400af464c76d713c07ad', ''),
(6, 'guilherme', 'rosa', 'rosa@gmail.com', '25d55ad283aa400af464c76d713c07ad', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_video` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(600) COLLATE utf8mb4_general_ci NOT NULL,
  `id_materia` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `desempenho`
--
ALTER TABLE `desempenho`
  ADD CONSTRAINT `desempenho_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `desempenho_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
