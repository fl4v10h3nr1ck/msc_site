<?php
if(!isset($_SESSION))
session_start();

header('Content-type: text/html; charset=UTF-8');


include_once '../../Estrutura.class.php';
include_once 'AreaDoCliente.class.php';

$estrutura = new Estrutura();
$login = new AreaDoCliente();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="área, cliente, restrito, acesso, parceiros">
	<meta name="description" content="Empresa que presta serviços em T.I. focados no desenvolvimento, gerenciamento, manutenção, adequação e atualização de softwares. Também ajudamos nossos clientes com toda a infraestrutura necessário à operação dos sistemas desenvolvidos.">
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("MSC - Área do Cliente") ?>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<?php $estrutura->getDependencias() ?>
	
	<link rel='stylesheet' href='../../css/area_do_cliente.css' type='text/css' media='all'>
	<script type='text/javascript' src='../../js/area_do_cliente.js'></script>
	</head>
	<body>

	<?php $estrutura->getMenuPrincipal() ?>
	
		<div class='area_total' align='center'>
			<div class='container' align='center' id='div_area_do_cliente'>
	
	<?php $login->login() ?>
	
			</div>		
		</div>
		
		
	<?php $estrutura->getRodape() ?>
	
	
	</body>
</html>