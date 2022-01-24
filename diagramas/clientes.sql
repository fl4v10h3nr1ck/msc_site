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
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` int(11) NOT NULL,
  `nome_razao` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `tel_1` varchar(45) DEFAULT NULL,
  `tel_2` varchar(45) DEFAULT NULL,
  `cpf_cnpj` varchar(45) DEFAULT NULL,
  `nome_contato` varchar(250) DEFAULT NULL,
  `descricao_empresa` longtext,
  `outras_info_empresa` longtext,
  `cidade` varchar(150) DEFAULT NULL,
  `uf` varchar(45) DEFAULT NULL,
  `logradouro` varchar(150) DEFAULT NULL,
  `num_residencia` varchar(45) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `obs` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `rg_ie` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome_razao`, `email`, `tel_1`, `tel_2`, `cpf_cnpj`, `nome_contato`, `descricao_empresa`, `outras_info_empresa`, `cidade`, `uf`, `logradouro`, `num_residencia`, `cep`, `obs`, `password`, `tipo`, `rg_ie`) VALUES
(2, 'JORGE VITOR DA COSTA', 'jvitor713@gmail.com', '(91) 8456-4682 ', '', '054.549.983-62', '', '', '', 'Barcarena', 'PA', 'Travessa Domingos Onça', '276', '', 'senha area de cliente:', 'd41d8cd98f00b204e9800998ecf8427e', 'PF', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
