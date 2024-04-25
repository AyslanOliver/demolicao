-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/04/2024 às 15:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `demolicao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cad_cliente`
--

CREATE TABLE `cad_cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(29) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cep` varchar(9) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `nascimento` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cad_empresa`
--

CREATE TABLE `cad_empresa` (
  `id` int(1) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `data_abertura` date DEFAULT current_timestamp(),
  `ddd_telefone_1` varchar(14) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `cad_empresa`
--

INSERT INTO `cad_empresa` (`id`, `cnpj`, `razao_social`, `nome_fantasia`, `data_abertura`, `ddd_telefone_1`, `email`, `cep`, `logradouro`, `numero`, `bairro`, `municipio`, `uf`) VALUES
(28, '24.577.620/0001-56', 'ROGER VINICIUS MARQUES DE SOUSA 36924728898', 'L&R MODA INTIMA', '0000-00-00', '(11) 8637-4125', 'lrmoda@gmail.com', '09973-250', 'JEQUITIBAS', '170', 'ELDORADO', 'DIADEMA', 'SP'),
(27, '13.883.008/0001-95', 'GEROLINO COSTA MOREIRA 83354492600', 'GEROLINO COSTA MOREIRA', '0000-00-00', '(31) 9198-6214', 'GEROLINOCOSTA@hotmail.com', '31565-400', 'MARTINICA', '530', 'SANTA BRANCA', 'BELO HORIZONTE', 'MG');

-- --------------------------------------------------------

--
-- Estrutura para tabela `register_user`
--

CREATE TABLE `register_user` (
  `UserID` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `repetirsenha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `register_user`
--

INSERT INTO `register_user` (`UserID`, `nome`, `sobrenome`, `email`, `senha`, `repetirsenha`) VALUES
(8, 'José Carlos Costa Neto', 'batis', 'ays@23', '1234', '1234'),
(9, 'José Carlos Costa Neto', 'batis', 'ays@23', '1234', '1234'),
(10, 'Lemos', 'Brito ', '1231@ff', '9987', '9987'),
(11, 'Elton', 'Brito ', 'ayslanoo37@yahoo.com', '632579', '632579'),
(12, 'Ayslan', 'Oliveira', 'ayslano37@gmail.com', '9987', '9987');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cad_cliente`
--
ALTER TABLE `cad_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- Índices de tabela `cad_empresa`
--
ALTER TABLE `cad_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`UserID`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cad_cliente`
--
ALTER TABLE `cad_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cad_empresa`
--
ALTER TABLE `cad_empresa`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `register_user`
--
ALTER TABLE `register_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
