-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Fev-2023 às 05:17
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `shopping_campaign`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code` int(10) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `valor` double NOT NULL,
  `store` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `coupons`
--

INSERT INTO `coupons` (`id`, `user_id`, `code`, `cpf`, `valor`, `store`, `date_time`, `status`) VALUES
(57, 1, 23454, '11111111111', 350, 'Loja 1', '2023-02-08 10:10:00', 0),
(58, 1, 54683, '11111111111', 470, 'Loja 2', '2023-02-08 10:10:00', 0),
(59, 1, 73654, '11111111111', 150, 'Loja 3', '2023-02-08 10:10:00', 0),
(60, 2, 54345, '2222222222', 670, 'Loja 3', '2023-02-08 10:10:00', 0),
(61, 2, 5643, '2222222222', 150, 'Loja 2', '2023-02-08 10:10:00', 1),
(62, 7, 63697, '33333333333', 250, 'Loja 4', '2023-02-08 10:10:00', 0),
(63, 7, 95443, '33333333333', 700, 'Loja 2', '2023-02-08 10:10:00', 0),
(64, 1, 87452, '11111111111', 700, 'Loja teste', '2023-02-13 10:10:00', 0),
(65, 1, 87745, '11111111111', 10, 'Loja teste', '2023-02-15 10:10:00', 0),
(66, 1, 9652, '11111111111', 10, 'gf', '2023-02-15 10:10:00', 0),
(67, 1, 6987, '11111111111', 5, '1fgf', '2023-02-15 10:10:00', 0),
(68, 1, 7488, '11111111111', 1000, 'Loja 3', '2023-02-16 10:10:00', 0),
(69, 1, 74178, '11111111111', 200, 'gfgf', '2023-02-15 10:10:00', 0),
(70, 1, 74521, '11111111111', 10, 'yhf', '2023-02-08 10:10:00', 0),
(71, 1, 7421, '11111111111', 10, '10', '2023-02-16 10:10:00', 0),
(72, 1, 74125, '11111111111', 10, '10', '2023-02-01 10:10:00', 0),
(73, 1, 96231, '11111111111', 5000, 'Loja teste', '2023-02-15 10:10:00', 0),
(74, 1, 8563, '11111111111', 10, '10', '2023-02-15 10:10:00', 0),
(75, 1, 9632, '11111111111', 10, 'Loja 3', '2023-02-15 10:10:00', 0),
(76, 1, 7147, '11111111111', 10, '10', '2023-02-15 10:10:00', 0),
(77, 1, 14788, '11111111111', 10, 'test', '2023-02-16 10:10:00', 0),
(78, 1, 14785, '11111111111', 500, '1', '2023-02-16 10:10:00', 0),
(79, 1, 7485, '11111111111', 1100, '10', '2023-02-16 10:10:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `luck_numbers`
--

CREATE TABLE `luck_numbers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sweepstake_status`
--

CREATE TABLE `sweepstake_status` (
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sweepstake_status`
--

INSERT INTO `sweepstake_status` (`status`) VALUES
(0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `autho` int(1) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `born_in` date NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `autho`, `cpf`, `name`, `sex`, `born_in`, `password`) VALUES
(1, 5, '11111111111', 'John Doe', 'Masculino', '2023-06-30', '$2y$10$N8CKLqFyEc1edZNyQtzawOBdHA7P9iyajZdC2exmU7VYznQJmOhJu'),
(2, 1, '22222222222', 'Jane Doe', 'Feminino', '2023-05-30', '$2y$10$N8CKLqFyEc1edZNyQtzawOBdHA7P9iyajZdC2exmU7VYznQJmOhJu'),
(7, 1, '33333333333', 'Jao Maria', 'Masculino', '2023-02-07', '$2y$10$N8CKLqFyEc1edZNyQtzawOBdHA7P9iyajZdC2exmU7VYznQJmOhJu');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_coupon` (`user_id`) USING BTREE;

--
-- Índices para tabela `luck_numbers`
--
ALTER TABLE `luck_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_num` (`user_id`);

--
-- Índices para tabela `sweepstake_status`
--
ALTER TABLE `sweepstake_status`
  ADD KEY `status` (`status`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `luck_numbers`
--
ALTER TABLE `luck_numbers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `luck_numbers`
--
ALTER TABLE `luck_numbers`
  ADD CONSTRAINT `fk_user_num` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
