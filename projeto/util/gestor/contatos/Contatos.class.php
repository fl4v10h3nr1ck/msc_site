<?php

if(!isset($_SESSION))
session_start();


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Contatos{

	
	
	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."contatos/contatos.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."contatos/contatos.js'></script>";
	}


	
	
	
	
	
	
	final function getHomeContatos(){

	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select id, nome, empresa, email, msg, data from contatos");

	$resultado  = "
	<div id='contatos_principal'>
		<table border= '4'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='4%'></th>
			<th width='20%'>NOME</th>
			<th width='15%'>EMPRESA</th>
			<th width='15%'>EMAIL</th>
			<th width='28%'>MENSAGEM</th>
			<th width='8%'>DATA</th>
			</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value){
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='javascript:deletaContato(".$value['id'].");' class='botao_excluir' title='Excluir este contato'></button>
				</td>
			<td align='left'>".$value['nome']."</td>
			<td align='left'>".$value['empresa']."</td>
			<td align='left'>".$value['email']."</td>
			<td align='left'>".$value['msg']."</td>
			<td align='center'>".$value['data']."</td>
			</tr>";
			}
		}
			
	echo $resultado."</table></div>";	
	}


	
	
	
	
	
	

	
	
	public function deletaContato(){
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->deleta("contatos", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}				
		}
			
	echo '{"resultado":"ERRO"}';
	}
	




	
	



}
	
?>