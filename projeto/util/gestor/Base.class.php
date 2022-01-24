<?php

if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');




include_once "define.php";



final class Base{





	public function getHead( $outras_dependencias = ""){
		
	
	echo 
	'<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="Flavio Henrique P Sousa">
		
		<title>MSC Soluções - Gestão</title>
		
		<link rel="icon" href="/imgs/favicon.png">
		
		';
			
	$this->getDependencias();
	
	echo $outras_dependencias;

	
	echo '	
	
		</head>
		<body>';
	}



	
	

	public function getDependencias(){
		
	echo 
	
	"
	<link rel='stylesheet' href='".RAIZ_GESTOR."base.css' type='text/css' media='all'>
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."login/login.css' type='text/css' media='all'>

	<script type='text/javascript' src='".RAIZ."libs/jquery_min.js'></script>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."base.js'></script>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."login/login.js'></script>";
	
	}








	public function getTopo($path_retorno =""){
	
	
	$topo = "
	<div id='base_topo_geral' align='left'>	
		<table width='100%'>
			<tr>
				<td align='left' width='90%'>
				<img src='/imgs/logo.png' id='img_logo'>	
				</td>
				<td align='right' width='10%'>
				<button class='botao_home' onClick='javascript:location.href=\"".RAIZ_GESTOR."\"' style='margin-right:10px' title='Área principal'></button>
				";
				
				if(strlen($path_retorno)>0)
				$topo .= "<button class='botao_voltar' onClick='javascript:location.href=\"".$path_retorno."\"' style='margin-right:10px' title='Voltar'></button>";
			
			
				if(array_key_exists("status", $_SESSION) && array_key_exists("usuario", $_SESSION) && $_SESSION["status"]===true && strlen($_SESSION["usuario"])>0)
				$topo .= "<button class='botao_sair' onClick='javascript:sair();' style='margin-right:10px' title='Sair do sistema'></button>";

			
			
	$topo .= "	
				</td>
			</tr>
		</table>
	</div>
	<div id='cliente_atual'>
		<table width='100%'>
			<tr><td align='left' width='90%' id='nome_cliente_selecionado'>
			<b>Cliente Selecionado:</b> ";
	
	if(array_key_exists("id_cliente", $_SESSION) && array_key_exists("nome_cliente", $_SESSION) && $_SESSION["id_cliente"]>0)
	$topo .= "".$_SESSION["nome_cliente"];
	
	$topo .= "
			</td><td align='right' width='10%'>
			<button onClick='javascript:location.href=\"".RAIZ_GESTOR."clientes/\"' style='margin-right:10px'>Selecionar</button>
			</td></tr>
		</table>
	</div>";
	
	echo $topo;
	}


	



	
	public function getRodape(){
	
	echo "
	
			<div class='rodape' align='center' id='rodape'>
			<p><b>Copyright ".date("Y")." MSC Solucções. Todos os Direitos Reservados.</b></p>
			</div>
		</body>
	</html>";

	}

	
	
	
	
	
	
	public function getLogin(){
	
	include_once RAIZ_GESTOR_ABSOLUTA.'login/Login.class.php';

	$login = new Login();

	$login->getForm();	
	}
	
	

	
	
	
	
	public function permitido(){
	


	if(array_key_exists("status",$_SESSION) && 
		array_key_exists("usuario",$_SESSION) && 
		$_SESSION['status']===true &&		
		strlen($_SESSION['usuario'])>0)
	return true;
	
	
	return false;
	}
	
	
	
	
	
	
	public function semClienteSelecionado(){
		
		
	echo 
	"<div id='sem_cliente_selecionado' align='center'>
	<b>&laquo;Nenhum Cliente Selecionado&raquo;</b><br><br><br><br><br><br>
	<button class='botao_home' onClick='javascript:location.href=\"".RAIZ_GESTOR."\"' style='margin-right:10px' title='Área principal'></button>
	</div>";	
	}
	

}
?>