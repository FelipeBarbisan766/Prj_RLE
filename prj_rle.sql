-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/05/2024 às 04:43
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
-- Banco de dados: `prj_rle`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `adm_cod` int(11) NOT NULL,
  `adm_nome` varchar(40) NOT NULL,
  `adm_senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cronograma`
--

CREATE TABLE `cronograma` (
  `cro_cod` int(11) NOT NULL,
  `cro_desc` varchar(200) DEFAULT NULL,
  `cro_aula` int(11) NOT NULL,
  `cro_data` date NOT NULL,
  `cro_isActive` bit(1) NOT NULL,
  `adm_cod` int(11) NOT NULL,
  `lab_cod` int(11) NOT NULL
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
  `prof_senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`prof_cod`, `prof_nome`, `prof_senha`) VALUES
(1, 'FELIPE', '123');

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
  `prof_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reserva`
--

INSERT INTO `reserva` (`res_cod`, `res_desc`, `res_aula`, `res_data`, `res_dataRes`, `res_isActive`, `lab_cod`, `prof_cod`) VALUES
(1, 'AULA DE ADMINISTRAçãO', 1, '2024-05-28', '2024-05-26 00:26:21', b'1', 1, 1),
(2, 'PW 2', 4, '2024-05-28', '0000-00-00 00:00:00', b'1', 1, 1),
(3, 'PW 2', 5, '2024-05-28', '0000-00-00 00:00:00', b'1', 1, 1),
(4, 'DS 1', 3, '2024-05-28', '2024-05-26 13:39:26', b'1', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`adm_cod`);

--
-- Índices de tabela `cronograma`
--
ALTER TABLE `cronograma`
  ADD PRIMARY KEY (`cro_cod`),
  ADD KEY `adm_cod` (`adm_cod`),
  ADD KEY `lab_cod` (`lab_cod`);

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
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `adm_cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cronograma`
--
ALTER TABLE `cronograma`
  MODIFY `cro_cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `lab_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `prof_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `res_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cronograma`
--
ALTER TABLE `cronograma`
  ADD CONSTRAINT `cronograma_ibfk_1` FOREIGN KEY (`adm_cod`) REFERENCES `administrador` (`adm_cod`),
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
