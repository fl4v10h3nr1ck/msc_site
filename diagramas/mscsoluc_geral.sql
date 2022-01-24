-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Abr-2015 às 14:10
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
-- Estrutura da tabela `assentamentos`
--

CREATE TABLE IF NOT EXISTS `assentamentos` (
`id` int(11) NOT NULL,
  `assentamento` longtext,
  `data_cadastro` varchar(20) DEFAULT NULL,
  `autor` enum('CLIENTE','OPERADOR') DEFAULT NULL,
  `fk_chamado` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--

CREATE TABLE IF NOT EXISTS `chamados` (
`id` int(11) NOT NULL,
  `descricao` longtext,
  `data_cadastro` varchar(20) DEFAULT NULL,
  `assunto` varchar(200) DEFAULT NULL,
  `status` enum('PENDENTE','EM ATENDIMENTO','TERMINADO') DEFAULT NULL,
  `solucao` longtext,
  `obs` longtext,
  `fk_cliente` int(11) DEFAULT NULL,
  `nome_doc_anexo` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` int(11) NOT NULL,
  `nome_razao` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `tel_1` varchar(45) NOT NULL,
  `tel_2` varchar(45) DEFAULT NULL,
  `cpf_cnpj` varchar(45) DEFAULT NULL,
  `rg_ie` varchar(45) DEFAULT NULL,
  `nome_contato` varchar(250) DEFAULT NULL,
  `descricao_empresa` longtext,
  `outras_info_empresa` longtext,
  `cidade` varchar(150) NOT NULL,
  `uf` varchar(45) NOT NULL,
  `logradouro` varchar(150) DEFAULT NULL,
  `num_residencia` varchar(45) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `obs` varchar(250) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `tipo` enum('PF','PJ') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



--
-- Estrutura da tabela `contatos`
--

CREATE TABLE IF NOT EXISTS `contatos` (
`id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `empresa` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `msg` longtext NOT NULL,
  `data` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ligue_para_mim`
--

CREATE TABLE IF NOT EXISTS `ligue_para_mim` (
`id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `telefone` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE IF NOT EXISTS `pagamentos` (
`id` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `tipo` enum('LICENCA','PARCELA','MENSALIDADE','INTEGRAL') NOT NULL,
  `num_licencas` int(11) DEFAULT NULL,
  `valor` varchar(45) NOT NULL,
  `status` enum('ABERTO','FECHADO') NOT NULL,
  `fk_solicitacao` int(11) NOT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  `fk_solucao` int(11) DEFAULT NULL,
  `num_de_dias` int(11) DEFAULT NULL,
  `status_pagamento` enum('AGUARDANDO','CONFIRMADO') DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
`id` int(11) NOT NULL,
  `solicitante` varchar(250) NOT NULL,
  `empresa` varchar(250) DEFAULT NULL,
  `descricao_empresa` longtext,
  `outras_info_empresa` longtext,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(250) NOT NULL,
  `cidade` varchar(250) NOT NULL,
  `uf` varchar(45) NOT NULL,
  `descricao_projeto` longtext NOT NULL,
  `info_complementares` varchar(250) DEFAULT NULL,
  `solucoes` varchar(45) NOT NULL,
  `data_pedido` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistemas_ativados`
--

CREATE TABLE IF NOT EXISTS `sistemas_ativados` (
`id` int(11) NOT NULL,
  `id_soft` varchar(45) DEFAULT NULL,
  `data` varchar(45) DEFAULT NULL,
  `fk_pagamento` int(11) DEFAULT NULL,
  `chave` longtext
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sistemas_ativados`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes`
--

CREATE TABLE IF NOT EXISTS `solicitacoes` (
`id` int(11) NOT NULL,
  `solucao` enum('WEBDEV','SISTEMAS','INFRA','TREINA') NOT NULL,
  `detalhes` longtext,
  `data_solicitacao` varchar(45) NOT NULL,
  `status` enum('EM PROPOSTA','EM ANDAMENTO','CANCELADO','TERMINADO') DEFAULT NULL,
  `cod_contrato` varchar(45) DEFAULT NULL,
  `cod_proposta` varchar(45) DEFAULT NULL,
  `fk_id_cliente` int(11) NOT NULL,
  `ciclo_pagamento` enum('INTEGRAL','2 PARCELAS','MENSAL','TRIMESTRAL','SEMESTRAL','ANUAL') NOT NULL,
  `codigo` varchar(45) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacoes`
--
-- --------------------------------------------------------

--
-- Estrutura da tabela `solucoes`
--

CREATE TABLE IF NOT EXISTS `solucoes` (
`id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `codigo` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solucoes`
--

-- Indexes for dumped tables
--

--
-- Indexes for table `assentamentos`
--
ALTER TABLE `assentamentos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_chamado_idx` (`fk_chamado`);

--
-- Indexes for table `chamados`
--
ALTER TABLE `chamados`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cliente_idx` (`fk_cliente`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contatos`
--
ALTER TABLE `contatos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ligue_para_mim`
--
ALTER TABLE `ligue_para_mim`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagamentos`
--
ALTER TABLE `pagamentos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_solicitacao_idx` (`fk_solicitacao`), ADD KEY `fk_solucao_idx` (`fk_solucao`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistemas_ativados`
--
ALTER TABLE `sistemas_ativados`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_pagamento_idx` (`fk_pagamento`);

--
-- Indexes for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_id_cliente` (`fk_id_cliente`);

--
-- Indexes for table `solucoes`
--
ALTER TABLE `solucoes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assentamentos`
--
ALTER TABLE `assentamentos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chamados`
--
ALTER TABLE `chamados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contatos`
--
ALTER TABLE `contatos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ligue_para_mim`
--
ALTER TABLE `ligue_para_mim`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagamentos`
--
ALTER TABLE `pagamentos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sistemas_ativados`
--
ALTER TABLE `sistemas_ativados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `solucoes`
--
ALTER TABLE `solucoes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
