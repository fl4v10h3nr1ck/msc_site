<?php

if(!isset($_SESSION))
session_start();



chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Ligue{

	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."ligue_pra_mim/ligue.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."ligue_pra_mim/ligue.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	
	
	
	final function getHomeLigue(){

	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select id, nome, telefone, email, status, data from ligue_para_mim");

	$resultado  = "
	<div id='ligue_principal'>
		<table border= '4'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='5%'></th>
			<th width='32%'>NOME</th>
			<th width='20%'>TEL</th>
			<th width='25%'>EMAIL</th>
			<th width='10%'>STATUS</th>
			<th width='8%'>data</th>
			</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value){
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='javascript:deletaLigue(".$value['id'].");' class='botao_excluir' title='Excluir este ligue pra mim'></button>
				<button onClick='javascript:desativarLigue(".$value['id'].", \"".$value['status']."\");' class='botao_desativar' title='Fechar este ligue pra mim'></button>
				</td>	
			<td align='left'>".strtoupper($value['nome'])."</td>
			<td align='left'>".$value['telefone']."</td>
			<td align='left'>".$value['email']."</td>
			<td align='center' style='color:";
			
			if(strcmp($value['status'], "RETORNADO")==0)
			$resultado  .= "red";
			else
			$resultado  .= "green";
			
			
			$resultado  .= "'>".$value['status']."</td>
			<td align='center'>".$value['data']."</td>
			</tr>";
			}
		}
		
		
	echo $resultado."</table></div>";	
	}


	
	

	
	
	
	
	
	public function deletaLigue(){
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->deleta("ligue_para_mim", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}				
		}
			
	echo '{"resultado":"ERRO"}';
	}
	




	
	
	
	

	public function desativarLigue(){
		
		
		if($_POST['id']>0 && strlen($_POST['status'])>0){
			
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->atualiza("ligue_para_mim", "id", $_POST['id'], array('status'), array(strcmp($_POST['status'], "PENDENTE")==0?"RETORNADO":"PENDENTE"))){	
			echo '{"resultado":"OK"}';
			return;
			}
		}
		
	echo '{"resultado":"ERRO"}';	
	}



}
	
?>