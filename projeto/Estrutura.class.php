<?php
header('Content-type: text/html; charset=UTF-8');

define("RAIZ", "/");





final class Estrutura{





	public function getDependencias(){
	
	echo "
	<link rel='stylesheet' href='".RAIZ."css/estrutura.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ."libs/jquery_min.js'></script>
	
	<script type='text/javascript' src='".RAIZ."js/estrutura.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	public function getTitulo($title){
	
	echo "<title>".$title."</title>";
	}

	
	
	
	
	
	public function getMenuPrincipal(){
	
	echo "
	<div class='area_total' id='topo' align='center'>	
		<div id='menu_horizontal_topo' align='center'>
			<table width='100%'>
				<tr><td width='15%' align='center'>
				<a href='".RAIZ."'><img src='".RAIZ."imgs/logo.png' id='img_logo'></a>
				</td><td width='70%' align='center'>
					<table id='lista_de_menu'>
						<tr><td class='item_menu_horizontal_topo' align='center'>
						<a href='".RAIZ."'>Home</a>
						</td><td class='item_menu_horizontal_topo' align='center'>
						<a href='".RAIZ."institucional.php'>Quem Somos</a>
						</td><td class='item_menu_horizontal_topo' align='center'>
						<a href='".RAIZ."servicos.php'>Serviços</a>
						</td><td class='item_menu_horizontal_topo' align='center'>
						<a href='".RAIZ."util/solicitacao/'>Solicitação</a>
						</td><td class='item_menu_horizontal_topo' align='center' id='item_menu_horizontal_topo_area_cliente'>
						<a href='".RAIZ."util/area_do_cliente/'>Área do Cliente</a>
						</td><td class='item_menu_horizontal_topo' align='center' id='item_menu_horizontal_topo_dialab'>
						<a href='".RAIZ."util/portfolios/dialab/'>DiaLab</a>
						</td><td class='item_menu_horizontal_topo' align='center' id='item_menu_horizontal_topo_contato'>
						<a href='".RAIZ."util/contato/'>Contato</a>
						</td></tr>
					</table>
				</td><td width='15%' align='right'>
				
				<a href='https://twitter.com/mscsolucoes'><img src='".RAIZ."imgs/icon_twitter.png' class='icon_topo_direito'></a>
				<a href='https://www.facebook.com/mscsolucoes'><img src='".RAIZ."imgs/icon_facebook.png' class='icon_topo_direito'></a>
				
				</td></tr>
			</table>
		</div>
	</div>	";
	
	}
	
	
	
	
	
	
	public function getRodape(){
	
	$rodape = "
	<div class='area_total' align='center' id='rodape'>
		<div class='container'>
			<div class='div_rodape' align='left' id='div_rodape_links'>
			<img src='".RAIZ."imgs/icon_menu.png' height='25px'>
			<hr style='color:back;width:100%'>
				<ul>
				<li><a href='".RAIZ."'>Página Principal</a></li>
				<li><a href='".RAIZ."institucional.php'>Quem Somos</a></li>
				<li><a href='".RAIZ."util/solicitacao/'>Solicitação</a></li>
				<li><a href='".RAIZ."util/portfolios/'>Portfólio</a></li>
				<li><a href='".RAIZ."util/portfolios/dialab'>DiaLab</a></li>
				</ul>
			<br>	
			<img src='".RAIZ."imgs/icon_links.png' height='20px'>	
			<hr style='color:back;width:100%'>
				<ul>
				<li><a href='".RAIZ."servicos.php?id=WEB'>Desenvolvimento WEB</a></li>
				<li><a href='".RAIZ."servicos.php?id=SOFT'>Fábrica de Softwares</a></li>
				<li><a href='".RAIZ."servicos.php?id=INFRA'>Infraestrutura em T.I.</a></li>
				<li><a href='".RAIZ."servicos.php?id=TREINA'>Treinamentos</a></li>
				</ul>
			</div>
			<div class='div_rodape' align='left' id='div_rodape_contatos'>
			<img src='".RAIZ."imgs/icon_email.png' height='26px'>
			<hr style='color:back;width:100%'>
			<p align='center'>
			E-mail:<br>
			contato@mscsolucoes.com.br<br><br>
			Fones:<br>
			<img src='".RAIZ."imgs/icon_tel.png' style='vertical-align:middle;height:30px;margin-right:10px'>(91) 3298-4564<br><br>
			<img src='".RAIZ."imgs/icon_whatsapp.png' style='vertical-align:middle;height:30px;margin-right:10px'>(91) 98238-4798<br><br>
			Escritório Administrativo:<br>
			Rua Treze, 92, Val-de-Cans  | Belém - PA - Brasil<br><br>
			Já é cliente? Acesse:<br>
			<a href='".RAIZ."util/area_do_cliente/'>Área do Cliente</a>
			
			</p>
			</div>
			<div class='div_rodape' align='left' id='div_rodape_form'>
			<img src='".RAIZ."imgs/icon_contato.png' height='25px'>
			<hr style='color:back;width:100%'>
			<p style='font-size:14px'>Deixe seus contatos, nós ligamos pra você!</p>
				<div id='rodape_form_contato'>
					<p align='left'>
					Nome/Empresa:<br>
					<input type='text' value='' style='width:96%' id='cad_tel_nome' maxlength='40' ><br><br>
					Fone:<br>
					<input type='text' value='DDD' maxlength='2' style='width:15%' id='cad_tel_ddd' onchange='javascript:mascara(this, formatarSomenteNum);'>
					<input type='text' value='XXXX-XXXX' maxlength='10' style='width:30%' id='cad_tel_num' onchange='javascript:mascara(this, formatarTEL);'>
					<input type='text' value='RAMAL' maxlength='4' style='width:25%' id='cad_tel_ramal' onchange='javascript:mascara(this, formatarSomenteNum);'><br><br>
					E-mail:<br>
					<input type='text' value='' style='width:96%' id='cad_tel_email'>
					</p>
					<p align='center'><br><button style='height:25px;width:32%' id='bt_cad_tel'>Cadastrar</button></p>
				</div>	
			</div>
			<div style='clear:both'></div>
		</div>
	<p id='copyright'>Copyright ".date("Y")." <span style='color:#F3FF77'>MSC Solucções</span>. Todos os Direitos Reservados.</p>
	</div>";
	
	
	echo $rodape;
	}

	
	
	
}
?>