<?php

header('Content-type: text/html; charset=UTF-8');

include_once 'Estrutura.class.php';
include_once 'Home.class.php';


$estrutura = new Estrutura();
$home = new Home();



?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="msc, soluções, empresa, tecnologia, ti, programação, sistemas, softwares, site, loja virtual, redes, fábrica, programas, desenvolvimento, infraestrutura, serviços, orçamento, tecnologia da informação, computação, sistema web, intranet">
	<meta name="description" content="Empresa que presta serviços em T.I. focados no desenvolvimento, gerenciamento, manutenção, adequação e atualização de softwares. Também ajudamos nossos clientes com toda a infraestrutura necessário à operação dos sistemas desenvolvidos.">
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("MSC Soluções") ?>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<?php $estrutura->getDependencias() ?>
	
	<?php $home->getDependencias() ?>
	
	</head>
	<body>
	
	<?php $estrutura->getMenuPrincipal() ?>
	
	
	<?php $home->getAreaApresentacao() ?>
	
	
	<?php $home->getAreaFront() ?>
	
	
	<?php $home->getAreaPortifolio() ?>
	
	
	<?php $home->getClientes() ?>
	
	
	<?php $home->getAreaTech() ?>
	
	
	<?php $estrutura->getRodape() ?>
	
	
	</body>
</html>