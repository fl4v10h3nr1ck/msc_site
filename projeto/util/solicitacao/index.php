<?php

header('Content-type: text/html; charset=UTF-8');

include_once '../../Estrutura.class.php';

$estrutura = new Estrutura();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="solicitação, pedido, orçamento, serviços, tecnologia, suporte, ti, desenvolvimento, programação, web, site, fábrica, softwares, sistemas, loja virtual, e-commerce, cliente, lojas, vendas">
	<meta name="description" content="Empresa que presta serviços em T.I. focados no desenvolvimento, gerenciamento, manutenção, adequação e atualização de softwares. Também ajudamos nossos clientes com toda a infraestrutura necessário à operação dos sistemas desenvolvidos.">
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("MSC - Solicitação") ?>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<?php $estrutura->getDependencias() ?>
	
	<link rel='stylesheet' href='../../css/solicitacao.css' type='text/css' media='all'>
	<script type='text/javascript' src='../../js/solicitacao.js'></script>
	
	</head>
	<body>

	<?php $estrutura->getMenuPrincipal() ?>
		
		<div class='area_total' align='center'>
			<div class='container' align='center' id='div_solicitacao'>
			
			<p style='font-size:18px;padding:20px 0px 20px 0px'><b>Orçamento</b><br><hr style='width:200px'></p>
				<div class='div_area' align='left'>
				<p class='titulo_area'><img src='../../imgs/icon_ok.png' class='mark'>Como podemos ajudá-lo?</p>
				<input type='checkbox' value='WEB' name='solucao'>&nbsp;Websites, sistemas WEB, lojas virtuais, intranets, etc.<br>
				<input type='checkbox' value='SOFTWARES' name='solucao'>&nbsp;Fábrica de softwares (desenvolvimento de sistemas, aplicativos para smartphones, etc.).<br>
				<input type='checkbox' value='INFRAESTRUTURA' name='solucao'>&nbsp;Infraestrutura em T.I. (redes, equipamentos, manutenção de equipamentos, helpdesk, etc.).<br>
				<input type='checkbox' value='TREINAMENTOS' name='solucao'>&nbsp;Treinamentos (cursos de programação/utilização para equipes).<br>
				</div>
				<div class='div_area' align='left'>
				<p class='titulo_area'><img src='../../imgs/icon_ok.png' class='mark'>Fale-nos um pouco sobre você?</p>
				Nome do Solicitante:<span class='requerido'>*</span><br>
				<input type='text' value='' id='solicitante' maxlength='150' style='width:60%'>
				<br>Nome da Empresa:<br>
				<input type='text' value='' id='empresa' maxlength='150' style='width:60%'>
				<br>Faça uma breve descrição da sua empresa:<br>
				<textarea id='descricao_empresa' style='width:60%;height:80px' maxlength='450' ></textarea>
				<br>Qual é seu público alvo, produtos e serviços?<br>
				<textarea id='outras_info_empresa' style='width:60%;height:80px' maxlength='450' ></textarea>
				<br>Telefone:<span class='requerido'>*</span><br>
				<input type='text' value='DDD' maxlength='2' style='width:5%' id='ddd' onchange='javascript:mascara(this, formatarSomenteNum);'>
				<input type='text' value='XXXX-XXXX' maxlength='10' style='width:20%' id='num' onchange='javascript:mascara(this, formatarTEL);'>
				<input type='text' value='RAMAL' maxlength='4' style='width:10%' id='ramal' onchange='javascript:mascara(this, formatarSomenteNum);'><br><br>
				E-mail:<span class='requerido'>*</span><br>
				<input type='text' value='' id='email' maxlength='150' style='width:60%'><br>
					<table width='100%'>
						<tr><td width='width:60%' align='left'>
						Cidade:<span class='requerido'>*</span><br>
						<input type='text' value='' id='cidade' maxlength='150' style='width:98%'>
						</td><td width='width:40%' align='left'>
						Estado (UF):<span class='requerido'>*</span><br>
						<select id='uf' style='width:60%'>
						<?php 
						foreach( array('', 'AC', 'AL', 'AP', 'AM',  'BA', 'CE',  'DF',  'ES',  'GO',  'MA',  'MT',  'MS',  'MG',   'PA', 'PB',  'PR',  'PE',  'RJ',  'RJ',  'RN',  'RS', 'RO',  'RR',  'SC',  'SP',  'SE',  'TO') as $value)
						echo "<option value='".$value."'>".(strcmp($value, "") == 0? "UF":$value)."</option>";
						?>
						</select>
						</td></tr>
					</table>
				</div>
				<div class='div_area' align='left'>
				<p class='titulo_area'><img src='../../imgs/icon_ok.png' class='mark'>Agora sobre o projeto?</p>
				Descreva suas necessidades ou ideias de projeto:<span class='requerido'>*</span><br>
				<textarea id='descricao_projeto' style='width:60%;height:200px' maxlength='450' ></textarea><br>
				Informações complementares:<br>
				<input type='text' value='' id='complementares' maxlength='200' style='width:60%'>
				</div>
				<div class='div_area' align='center'><br>São essas as informações que precisamos neste momento. Em breve lhe enviaremos uma proposta comercial como todos os dados necessários e entraremos em contato para conversarmos sobre os detalhes do projeto.</div>
				<div class='div_area' align='center'><br><button id='bt_enviar' style='width:200px;height:30px'>Enviar Pedido de Orçamento</button></div>
				<div class='div_area' align='center'><br>Estamos anciosos em trabalhar com você!<br><img src='../../imgs/icon_parceria.png'></div>
			</div>
		</div>
	<?php $estrutura->getRodape() ?>
	
	
	</body>
</html>