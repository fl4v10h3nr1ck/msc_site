-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Abr-2015 às 17:18
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mscsoluc_geral`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes`
--

CREATE TABLE IF NOT EXISTS `solicitacoes` (
`id` int(11) NOT NULL,
  `data_solicitacao` varchar(45) DEFAULT NULL,
  `status` enum('ABERTO','EM DEV','FECHADO') DEFAULT NULL,
  `fk_id_cliente` int(11) DEFAULT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  `solucao` enum('WEBDEV','SISTEMAS','INFRA','TREINA') DEFAULT NULL,
  `ciclo_pagamento` enum('INTEGRAL','2 PARCELAS','MENSAL','TRIMESTRAL','SEMESTRAL','ANUAL') DEFAULT NULL,
  `detalhes` varchar(200) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `data_solicitacao`, `status`, `fk_id_cliente`, `codigo`, `solucao`, `ciclo_pagamento`, `detalhes`) VALUES
(1, '11/04/2015', 'FECHADO', 2, '64566242 ', 'WEBDEV', 'MENSAL', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_id_cliente_idx` (`fk_id_cliente`), ADD KEY `fk_id_cliente` (`fk_id_cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
