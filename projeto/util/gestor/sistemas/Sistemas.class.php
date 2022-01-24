<?php

if(!isset($_SESSION))
session_start();



chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Sistemas{

	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."sistemas/sistemas.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."sistemas/sistemas.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	
	

	
	final function getHomeSistemas(){
		
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get("select id, nome, descricao, codigo from solucoes where status='ATIVO'");

	$resultado  = "
	<div id='sistemas_principal'>
		<table border= '5'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='8%'><button onClick='javascript:location.href=\"sistemas.php\"' class='botao_novo' title='Cadastrar novo sistema'></button></th>
			<th width='38%'>SOLUÇÃO</th>
			<th width='48%'>DESCRIÇÃO</th>
			<th width='8%'>CÓDIGO</th>
			</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value)
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='location.href=\"sistemas.php?id_sistema=".$value['id']."\"' class='botao_atualizar' title='Alterar informações deste sistema'></button>
				<button onClick='javascript:deletarSistema(".$value['id'].");' class='botao_excluir' title='Excluir este sistema'></button></td>
			<td align='left'>".strtoupper($value['nome'])."</td>
			<td align='left'>".$value['descricao']."</td>
			<td align='center'>".$value['codigo']."</td>
			</tr>";
	
		}
		
			
	$resultado  .= "</table></div>";	
	
	echo $resultado;
	}
	
	
	
	
	

	
	final function geraCodSolucao(){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$cod = "";
		for($i = 0; $i< 10; $i++){
	
		$cod = str_pad(rand(1, 9999), 4, "0", STR_PAD_LEFT);
		
			if(count($BD->get("select id from solucoes where codigo='".$cod."'")) == 0){
			
			echo '{"resultado":"OK", "codigo":"'.$cod.'"}';
			return;
			}
		}
		
	echo '{"resultado":"ERRO"}';
	}
	
	
	
	

	
	

	
	public function salvaSistema(){
	
	$erros = $this->validaSistema($_POST['id']==0?true:false);
	
		if(strlen($erros) == 0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
	
		$campos[] = "nome";
		$campos[] = "descricao";
		$campos[] = "codigo";
		
		$valores[] = $_POST['nome'];
		$valores[] = $_POST['descricao'];
		$valores[] = $_POST['codigo'];

		
		
			if($_POST['id']==0){
			
			$campos[] = "status";
		
			$valores[] = "ATIVO";


				if(!$BD->aDD("solucoes", $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}
				
			echo '{"resultado":"OK", "limpa":"SIM"}';	
			}
			else{
				
				if(!$BD->atualiza("solucoes", "id", $_POST['id'], $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}	
			
			echo '{"resultado":"OK", "limpa":"NAO"}';
			}
		
		return;
		}
		
	echo '{"resultado":"ERRO", "erro":"'.$erros.'"}';	
	}
	
	
	
	
	
	
	
	
	public function validaSistema($valida_senha = false){
	
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	
	$biblioteca = new Biblioteca();


	if(strlen($_POST['nome']) == 0)
	return "informe um nome da solução.";
	
	if(strlen($_POST['codigo']) == 0)
	return "Gere o código da solução.";
		
	return "";
	}


	
	
	
	
	
	public function getDados($id_sistema, &$valores){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$BD = new Opcoes_BD_Gerais;
		
	$reg = $BD->get("select * from solucoes where id=".$id_sistema);
	
		if( count($reg) > 0){
	
		$valores['nome'] 				= $reg[0]['nome'];
		$valores['descricao'] 			= $reg[0]['descricao'];
		$valores['codigo'] 				= $reg[0]['codigo'];
		}	
	}
	
	
	
	
	
	
	public function deletarSistema(){
		
		
		if($_POST['id']>0){
			
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->atualiza("solucoes", "id", $_POST['id'], array('status'), array("INATIVO"))){	
			echo '{"resultado":"OK"}';
			return;
			}
		}
		
	echo '{"resultado":"ERRO"}';	
	}
	










	
}
	
?>