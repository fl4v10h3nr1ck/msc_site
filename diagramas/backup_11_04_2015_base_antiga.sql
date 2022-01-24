-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 11/04/2015 às 11:17
-- Versão do servidor: 5.5.42-cll
-- Versão do PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `mscsoluc_geral`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `assentamentos`
--

CREATE TABLE IF NOT EXISTS `assentamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assentamento` longtext COLLATE latin1_general_ci,
  `data_cadastro` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `autor` enum('CLIENTE','OPERADOR') COLLATE latin1_general_ci DEFAULT NULL,
  `fk_chamado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chamado_idx` (`fk_chamado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamados`
--

CREATE TABLE IF NOT EXISTS `chamados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` longtext COLLATE latin1_general_ci,
  `data_cadastro` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `assunto` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('PENDENTE','EM ATENDIMENTO','TERMINADO') COLLATE latin1_general_ci DEFAULT NULL,
  `solucao` longtext COLLATE latin1_general_ci,
  `obs` longtext COLLATE latin1_general_ci,
  `fk_cliente` int(11) DEFAULT NULL,
  `nome_doc_anexo` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_idx` (`fk_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_razao` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `tel_1` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `tel_2` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `cpf_cnpj` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `rg_ie` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_contato` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `descricao_empresa` longtext COLLATE latin1_general_ci,
  `outras_info_empresa` longtext COLLATE latin1_general_ci,
  `cidade` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `uf` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `logradouro` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `num_residencia` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `cep` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `obs` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `tipo` enum('PF','PJ') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome_razao`, `email`, `tel_1`, `tel_2`, `cpf_cnpj`, `rg_ie`, `nome_contato`, `descricao_empresa`, `outras_info_empresa`, `cidade`, `uf`, `logradouro`, `num_residencia`, `cep`, `obs`, `password`, `tipo`) VALUES
(1, 'MSC Soluções', 'contato@mscsolucoes.com.br', '(91)98238-4798', NULL, '21.614.991/0001-72', NULL, 'Flavio sousa', NULL, NULL, 'Belém', '', NULL, NULL, '66110-003', NULL, 'c18abbf20293b1423021770923c4dd99', 'PJ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE IF NOT EXISTS `contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `empresa` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `msg` longtext COLLATE latin1_general_ci NOT NULL,
  `data` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `empresa`, `email`, `msg`, `data`) VALUES
(2, 'dfgdfgdf', 'sfgfdgfdgdgfd', 'flaviohenrique_2@yahoo.com.br', 'fdsfdffsfds', '02/01/2015 23:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ligue_para_mim`
--

CREATE TABLE IF NOT EXISTS `ligue_para_mim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `telefone` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(250) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `ligue_para_mim`
--

INSERT INTO `ligue_para_mim` (`id`, `nome`, `telefone`, `email`) VALUES
(2, 'fgfgdfgdf', '(91) 21121-1111 Ramal: ', 'flaviohenrique_2@yahoo.com.br');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `tipo` enum('LICENCA','PARCELA','MENSALIDADE','INTEGRAL') COLLATE latin1_general_ci NOT NULL,
  `num_licencas` int(11) DEFAULT NULL,
  `valor` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `status` enum('ABERTO','FECHADO') COLLATE latin1_general_ci NOT NULL,
  `fk_solicitacao` int(11) NOT NULL,
  `codigo` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `fk_solucao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_solicitacao_idx` (`fk_solicitacao`),
  KEY `fk_solucao_idx` (`fk_solucao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitante` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `empresa` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `descricao_empresa` longtext COLLATE latin1_general_ci,
  `outras_info_empresa` longtext COLLATE latin1_general_ci,
  `telefone` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `cidade` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `uf` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `descricao_projeto` longtext COLLATE latin1_general_ci NOT NULL,
  `info_complementares` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `solucoes` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `data_pedido` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `solicitante`, `empresa`, `descricao_empresa`, `outras_info_empresa`, `telefone`, `email`, `cidade`, `uf`, `descricao_projeto`, `info_complementares`, `solucoes`, `data_pedido`) VALUES
(3, 'Thayse Silva', 'Up comunicação', 'Trabalhamos com comunicação. Marketing e assessoria em eventos.', 'Empresas em geral.', '(91) 8101-8248', 'thayse_cgs@yahoo.com.br', 'Belém', 'PA', 'Preciso de um web site para vender os serviços, com uma página inicial de notícias de eventos que vão acontecer e um mural de fotos dos eventos que já aconteceram. É uma parte para empresas entrar em contato conosco. \nAguardo contato', '', 'WEB.', '07/01/2015 12:59'),
(4, 'fghgfh', 'ghgfh', 'fghfgh', 'hfgh', '(91) 32111-1111', 'flaviohenrique_2@yahoo.com.br', 'belem', 'PA', 'ghjgjhghkh', '', 'WEB.', '10/01/2015 10:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacoes`
--

CREATE TABLE IF NOT EXISTS `solicitacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solucao` enum('WEBDEV','SISTEMAS','INFRA','TREINA') COLLATE latin1_general_ci NOT NULL,
  `detalhes` longtext COLLATE latin1_general_ci,
  `data_solicitacao` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `status` enum('EM PROPOSTA','EM ANDAMENTO','CANCELADO','TERMINADO') COLLATE latin1_general_ci DEFAULT NULL,
  `cod_contrato` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_proposta` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `fk_id_cliente` int(11) NOT NULL,
  `ciclo_pagamento` enum('INTEGRAL','2 PARCELAS','MENSAL','TRIMESTRAL','SEMESTRAL','ANUAL') COLLATE latin1_general_ci NOT NULL,
  `codigo` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_cliente` (`fk_id_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `solucoes`
--

CREATE TABLE IF NOT EXISTS `solucoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `descricao` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `codigo` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
