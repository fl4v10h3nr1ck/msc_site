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
-- Estrutura da tabela `solucoes`
--

CREATE TABLE IF NOT EXISTS `solucoes` (
`id` int(11) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solucoes`
--

INSERT INTO `solucoes` (`id`, `nome`, `descricao`, `codigo`) VALUES
(3, 'sisERPWEB 1.0', 'sistema ERP web de gestao financeiro-admnistrativa de empresas', '8722'),
(4, 'sisERPDepilSoft 1.0', 'sistema ERP de gestao financeiro-admnistrativa do empresa Depil Soft', '5123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `solucoes`
--
ALTER TABLE `solucoes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `solucoes`
--
ALTER TABLE `solucoes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
