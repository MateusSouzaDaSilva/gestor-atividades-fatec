-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/11/2023 às 22:06
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestor-atividades`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `data_conclusao` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(10) DEFAULT 'aberto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atividades`
--

INSERT INTO `atividades` (`id`, `data_criacao`, `titulo`, `descricao`, `data_conclusao`, `user_id`, `status`) VALUES
(32, '2023-10-31 21:42:10', 'okatat', 'testaa', '0000-00-00 00:00:00', 4, 'fechado'),
(33, '2023-11-04 21:37:50', 'fUNFA??', 'gagadagag', '0000-00-00 00:00:00', 4, 'aberto'),
(39, '2023-11-06 01:37:58', 'testezaratrsasf', 'asdasdasfd', '0000-00-00 00:00:00', 3, 'aberto'),
(40, '2023-11-06 01:38:44', 'aasdasdf', 'adfadagfgd', '2023-11-10 03:00:00', 3, 'aberto'),
(42, '2023-11-06 21:09:20', 'teste closed', 'teste closedteste closed', '2023-11-10 03:00:00', 3, 'fechado'),
(44, '2023-11-06 21:27:47', 'teste6', 'asdasd', '2023-11-01 03:00:00', 3, 'aberto'),
(45, '2023-11-07 18:54:41', 'teste4', 'teste5', '2023-11-30 03:00:00', 3, 'aberto'),
(46, '2023-11-07 18:54:57', 'teste5', 'teste5', '2023-11-16 03:00:00', 3, 'aberto'),
(47, '2023-11-07 18:56:53', 'teste', 'teste', '2023-11-24 03:00:00', 4, 'aberto'),
(48, '2023-11-07 18:57:34', 'aaaaaa', 'aaaaaa', '2023-11-01 03:00:00', 4, 'aberto'),
(49, '2023-11-07 19:32:14', 'testeadd', 'testeadd', '2023-11-24 03:00:00', 3, 'aberto'),
(50, '2023-11-07 19:33:11', 'rrt', 'ararara', '2023-11-02 03:00:00', 3, 'aberto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `sobrenome`, `data_nascimento`, `login`, `senha`) VALUES
(2, 'Cremilda', 'Fonseca', '1980-11-30', 'cremi', 'asd123'),
(3, 'joao', 'galvao', '1986-10-30', 'jota', '$2y$10$XXUZmy3X/.Lm9QQQ.h.Lze/eXrBNk7QzytHhcsVZdai76gyg2Vp1y'),
(4, 'Mateus', 'Silva', '0000-00-00', 'mateus', '$2y$10$WI2zhtJZnHdWuP.yrvDeyeYSBb/pfa1SM6sbDgrZDv8xMU9y1.39q');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividades`
--
ALTER TABLE `atividades`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
