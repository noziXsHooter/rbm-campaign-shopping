-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 10-Fev-2023 às 20:08
-- Versão do servidor: 10.5.16-MariaDB
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id20276416_shoppingcampaign`
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
(52, 1, 10256, '11111111111', 250, 'Loja 1', '2023-02-08 16:26:00', 0),
(53, 2, 10406, '22222222222', 500, 'Loja 4', '2023-02-08 16:27:41', 0),
(54, 1, 10605, '11111111111', 500, 'Loja 1', '2023-02-08 16:31:00', 0),
(55, 1, 10706, '11111111111', 80, 'Loja2', '2023-02-08 16:32:00', 1),
(56, 2, 19320, '22222222222', 600, 'Loja 3', '2023-02-08 16:34:00', 0),
(57, 7, 19203, '3333333333', 100, 'Loja 1', '2023-02-08 16:37:00', 0),
(58, 7, 10293, '3333333333', 250, 'Loja 2', '2023-02-08 16:37:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `luck_numbers`
--

CREATE TABLE `luck_numbers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `luck_numbers`
--

INSERT INTO `luck_numbers` (`id`, `user_id`, `hash`) VALUES
(21, 1, '2e0fde4e-6f2d-44f7-a882-f525c6425348'),
(22, 1, '0d33ac86-6558-4bde-84b6-14adb0ba1c4e'),
(23, 2, 'f61c7874-2789-41f3-9e81-45bb67943ff0'),
(24, 2, '6f180cef-89da-4419-9d04-5fec3176b686'),
(25, 2, 'e4880f97-7ccf-4f72-bcc5-7f7f686c2232'),
(26, 7, 'c2ac2d89-f128-4bb8-9954-f89e8ebf7f3c');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sweepstake_status`
--

CREATE TABLE `sweepstake_status` (
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 5, '11111111111', 'John Doe', 'Masculino', '2023-06-30', '12345'),
(2, 1, '22222222222', 'Jane Doe', 'Feminino', '2023-05-30', '12345'),
(7, 1, '33333333333', 'Jao Maria', 'Masculino', '2023-02-07', '12345');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `luck_numbers`
--
ALTER TABLE `luck_numbers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
