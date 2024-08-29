-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/08/2024 às 17:13
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
  `cro_sem` int(11) NOT NULL,
  `cro_isActive` bit(1) NOT NULL,
  `lab_cod` int(11) NOT NULL,
  `prof_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cronograma`
--

INSERT INTO `cronograma` (`cro_cod`, `cro_desc`, `cro_aula`, `cro_sem`, `cro_isActive`, `lab_cod`, `prof_cod`) VALUES
(5, 'PW - RO - TURMA B - 3ºAMS', 1, 1, b'1', 1, 1),
(6, 'PW - RO - TURMA A - 3ºAMS', 2, 1, b'1', 1, 1),
(7, 'BD - CARLA - TURMA A - 2ºAMS', 5, 1, b'1', 1, 1),
(8, 'IC - JOSE - 1ºRH', 2, 2, b'1', 1, 1),
(9, 'PR - JAO - 3ºADM', 6, 2, b'1', 1, 1),
(10, 'BD -  CARLA - 2ª INFO', 1, 4, b'1', 1, 1),
(11, 'TCC - LUCIANA - 3º AMS', 1, 3, b'1', 1, 1),
(12, 'DESIGN DIGITAL - DEL VECCHIO - 1º AMS', 3, 3, b'1', 1, 1),
(13, 'PW III - CARLOS - 3º AMS ', 1, 5, b'1', 1, 1),
(14, 'PW III - DOUGLAS - 2º AMS', 2, 5, b'1', 1, 1),
(15, 'TCC - DUNHA - 3º AMS', 3, 1, b'1', 1, 1),
(16, 'SE - NEI - 2º AMS', 2, 4, b'1', 1, 1),
(17, 'TCC - LUCIANA - 3º AMS', 4, 1, b'1', 1, 1);

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
(1, 'Lab 01', 'Laboratorio 1', b'1'),
(2, 'Lab 02', 'Laboratório 2', b'1'),
(3, 'Lab 03', 'Laboratório 3', b'1'),
(4, 'Lab 04', 'Laboratório 4', b'1'),
(5, 'Lab 05', 'Laboratório 5', b'1'),
(6, 'Lab 06', 'Laboratório 6', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `prof_cod` int(11) NOT NULL,
  `prof_nome` varchar(40) NOT NULL,
  `prof_senha` varchar(20) NOT NULL,
  `prof_cargo` varchar(10) NOT NULL,
  `prof_isActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`prof_cod`, `prof_nome`, `prof_senha`, `prof_cargo`, `prof_isActive`) VALUES
(1, 'TESTE', '124', 'adm', b'1'),
(2, 'FELIPE', '123', 'prof', b'1'),
(3, 'EDUARDO', '123', 'prof', b'1'),
(4, 'CARLA GALASSI', '123', 'prof', b'1'),
(5, 'ROSANA', '123', 'prof', b'0'),
(6, 'JOAO', '123', 'prof', b'0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `res_cod` int(11) NOT NULL,
  `res_desc` varchar(200) DEFAULT NULL,
  `res_aula` int(11) NOT NULL,
  `res_data` date NOT NULL,
  `res_dataRes` datetime NOT NULL,
  `res_isActive` bit(1) NOT NULL,
  `lab_cod` int(11) NOT NULL,
  `prof_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reserva`
--

INSERT INTO `reserva` (`res_cod`, `res_desc`, `res_aula`, `res_data`, `res_dataRes`, `res_isActive`, `lab_cod`, `prof_cod`) VALUES
(11, 'TESTE RESERVA', 4, '2024-08-23', '2024-08-23 09:44:00', b'1', 2, 1),
(12, 'TESTE', 6, '2024-08-23', '2024-08-23 09:45:00', b'1', 1, 1),
(14, 'BANCO DE DADOS ', 2, '2024-08-28', '2024-08-23 11:37:00', b'1', 1, 4),
(15, 'TCC 3º AMS - TURMA B', 3, '2024-08-23', '2024-08-23 11:56:00', b'1', 1, 5);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cronograma`
--
ALTER TABLE `cronograma`
  ADD PRIMARY KEY (`cro_cod`),
  ADD KEY `lab_cod` (`lab_cod`),
  ADD KEY `prof_cod` (`prof_cod`) USING BTREE;

--
-- Índices de tabela `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`lab_cod`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`prof_cod`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`res_cod`),
  ADD KEY `lab_cod` (`lab_cod`),
  ADD KEY `prof_cod` (`prof_cod`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cronograma`
--
ALTER TABLE `cronograma`
  MODIFY `cro_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `lab_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `prof_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `res_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
