-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Ago-2021 às 01:59
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cinif`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `catal`
--

CREATE TABLE `catal` (
  `id` int(11) NOT NULL,
  `img` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `sinopse` varchar(10000) NOT NULL,
  `exib` tinyint(1) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `numvotosf` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle`
--

CREATE TABLE `controle` (
  `mens` varchar(200) NOT NULL,
  `voteg` tinyint(1) NOT NULL,
  `votef` tinyint(1) NOT NULL,
  `vencedorg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `controle`
--

INSERT INTO `controle` (`mens`, `voteg`, `votef`, `vencedorg`) VALUES
('aa', 1, 1, 'Comédia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `nomegenero` varchar(50) NOT NULL,
  `numgenero` int(11) NOT NULL,
  `numvotosg` int(11) NOT NULL,
  `vencedor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`nomegenero`, `numgenero`, `numvotosg`, `vencedor`) VALUES
('Ação', 0, 0, 0),
('Animação', 4, 0, 0),
('Comédia', 3, 0, 0),
('Documentário', 0, 0, 0),
('Drama', 1, 0, 0),
('Ficção', 5, 0, 0),
('Musical', 0, 0, 0),
('Romance', 0, 0, 0),
('Suspense', 0, 0, 0),
('Terror', 3, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verif` tinyint(1) NOT NULL,
  `token` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `numvg` tinyint(1) NOT NULL,
  `numvf` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `catal`
--
ALTER TABLE `catal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `temp_titulo` (`titulo`);

--
-- Índices para tabela `controle`
--
ALTER TABLE `controle`
  ADD PRIMARY KEY (`voteg`);

--
-- Índices para tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`nomegenero`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `catal`
--
ALTER TABLE `catal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
