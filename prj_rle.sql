-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/10/2024 às 22:37
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
-- Banco de dados: `prj_rle`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cronograma`
--

CREATE TABLE `cronograma` (
  `cro_cod` int(11) NOT NULL,
  `cro_desc` varchar(200) DEFAULT NULL,
  `cro_aula` int(11) NOT NULL,
  `cro_turma` varchar(10) NOT NULL,
  `cro_sem` int(11) NOT NULL,
  `cro_isActive` bit(1) NOT NULL,
  `lab_cod` int(11) NOT NULL,
  `prof_cod` int(11) NOT NULL,
  `cur_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `cur_cod` int(11) NOT NULL,
  `cur_nome` varchar(40) NOT NULL,
  `cur_isActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `laboratorio`
--

CREATE TABLE `laboratorio` (
  `lab_cod` int(11) NOT NULL,
  `lab_nome` varchar(40) NOT NULL,
  `lab_desc` varchar(200) DEFAULT NULL,
  `lab_isActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `laboratorio`
--

INSERT INTO `laboratorio` (`lab_cod`, `lab_nome`, `lab_desc`, `lab_isActive`) VALUES
(1, 'Lab 01', 'Laboratorio 1', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `prof_cod` int(11) NOT NULL,
  `prof_nome` varchar(40) NOT NULL,
  `prof_user` varchar(30) NOT NULL,
  `prof_email` varchar(320) NOT NULL,
  `prof_senha` varchar(20) NOT NULL,
  `prof_cargo` varchar(10) NOT NULL,
  `prof_isActive` bit(1) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`prof_cod`, `prof_nome`, `prof_user`, `prof_email`, `prof_senha`, `prof_cargo`, `prof_isActive`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'TESTE', 'teste', 'teste@teste.com', '123', 'adm', b'1', NULL, NULL),
(2, 'FELIPE', 'felipe.barbisan', 'gamerfelipesi766@gmail.com', '123', 'adm', b'1', '9af0e392adfaec9196edd8fc3e61456697a26020df56ee8132e2360fc598921c', '2024-09-24 20:44:11'),
(3, 'EDUARDO', 'eduardo', 'eduardovizicato@gmail.com', '123', 'prof', b'1', '8cc3f1d56cee8259cd344d89b1644d22d59a31ed8a1a76af76238b2eebe08dc6', '2024-09-22 03:39:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `res_cod` int(11) NOT NULL,
  `res_desc` varchar(200) DEFAULT NULL,
  `res_aula` int(11) NOT NULL,
  `res_turma` varchar(10) NOT NULL,
  `res_data` date NOT NULL,
  `res_dataRes` datetime NOT NULL,
  `res_isActive` bit(1) NOT NULL,
  `lab_cod` int(11) NOT NULL,
  `prof_cod` int(11) DEFAULT NULL,
  `cur_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cronograma`
--
ALTER TABLE `cronograma`
  ADD PRIMARY KEY (`cro_cod`),
  ADD KEY `lab_cod` (`lab_cod`),
  ADD KEY `prof_cod` (`prof_cod`) USING BTREE,
  ADD KEY `cur_cod` (`cur_cod`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cur_cod`);

--
-- Índices de tabela `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`lab_cod`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`prof_cod`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`res_cod`),
  ADD KEY `lab_cod` (`lab_cod`),
  ADD KEY `prof_cod` (`prof_cod`),
  ADD KEY `cur_cod` (`cur_cod`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cronograma`
--
ALTER TABLE `cronograma`
  MODIFY `cro_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `cur_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `lab_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `prof_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `res_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cronograma`
--
ALTER TABLE `cronograma`
  ADD CONSTRAINT `cronograma_ibfk_2` FOREIGN KEY (`lab_cod`) REFERENCES `laboratorio` (`lab_cod`);

--
-- Restrições para tabelas `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`lab_cod`) REFERENCES `laboratorio` (`lab_cod`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`prof_cod`) REFERENCES `professor` (`prof_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
