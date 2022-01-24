<?php


header('Content-type: text/html; charset=UTF-8');

include_once 'Gestor.class.php';

$gestor = new Gestor();

	if(array_key_exists("key",$_GET) && strcmp($_GET["key"], "l50fd03vfym4g4a4vean7a843f8d7xvzv43g3") == 0){
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<title>MSC Soluções - Gestão</title>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<script type='text/javascript' src='/libs/jquery_min.js'></script>
	
	<link rel='stylesheet' href='style.css' type='text/css' media='all'>
	<script type='text/javascript' src='js_script.js'></script>
	
	<script type='text/javascript' src='/libs/macaras_de_textfield.js'></script>
	</head>
	<body>
		<div id='geral'>
			<?php $gestor->barraDePesquisa(); ?>
			<div id='div_clientes' class='divs_principais'>
			<?php $gestor->nadaEncontrado(); ?>
			</div>
			<div id='div_area_de_dados' class='divs_principais'>
			</div>
			<div id='div_area_de_pagamento' class='divs_principais'>
			</div>
			<div id='div_area_de_solucoes' class='divs_principais'>
			<?php $gestor->mostrarSolucoes(); ?>
			</div>
			<div id='div_chamados_notificacoes' class='divs_principais'>
			<?php $gestor->getNotificacoesDeChamados(); ?>
			</div>
		</div>
		<br>
	</body>
</html>

<?php } ?>
	