<?php

header('Content-type: text/html; charset=UTF-8');

include_once '../../Estrutura.class.php';

$estrutura = new Estrutura();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="contato, email, mensagem, telefone, solicitação, servicos, ti, tecnologia">
	<meta name="description" content="Empresa que presta serviços em T.I. focados no desenvolvimento, gerenciamento, manutenção, adequação e atualização de softwares. Também ajudamos nossos clientes com toda a infraestrutura necessário à operação dos sistemas desenvolvidos.">
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("MSC - Contato") ?>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<?php $estrutura->getDependencias() ?>
	
	<link rel='stylesheet' href='../../css/contato.css' type='text/css' media='all'>
	<script type='text/javascript' src='../../js/contato.js'></script>
	</head>
	<body>

	<?php $estrutura->getMenuPrincipal() ?>
		
		<div class='area_total' align='center'>
			<div class='container' align='left' id='div_contato' align='center'>
				<table id='tb_contato'>
					<tr><td width='50%' align='left'>
					<div align='center' style='margin:5px 0px 5px 0px'><b>Deixe-nos uma mensagem:</b></div>
					Nome:<span class='requerido'>*</span><br>
					<input type='text' id='nome' style='width:98%' maxlength='150' >
					Empresa:
					<input type='text' id='empresa' style='width:98%' maxlength='150' >
					E-mail:<span class='requerido'>*</span><br>
					<input type='text' id='email' style='width:98%' maxlength='150' >
					Mensagem:<span class='requerido'>*</span><br>
					<textarea id='msg' style='width:98%;height:200px' maxlength='450' ></textarea>
					<div style='width:98%;margin-top:5px' align='right'><button id='bt_enviar' style='width:120px;height:30px'>Enviar</button></div>
					</td><td width='50%' align='center' valign='top'>
					<br><br><br>
					<p><img src='../../imgs/icon_email_black.png' class='icon_mark' style='vertical-align:middle'>contato@mscsolucoes.com.br</p>
					<p>
					<img src='../../imgs/icon_tel.png' style='vertical-align:middle;height:30px;margin-right:10px'>(91) 3298-4564<br><br>
					<img src='../../imgs/icon_whatsapp.png' style='vertical-align:middle;height:30px;margin-right:10px'>(91) 98238-4798<br>
					</p>
					
					</td></tr>
				</table>
			</div>
		</div>
	<?php $estrutura->getRodape() ?>
	
	
	</body>
</html>