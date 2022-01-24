<?php

if(!isset($_SESSION))
session_start();


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Solicitacoes{

	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."solicitacoes/solicitacoes.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."solicitacoes/solicitacoes.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	
	

	
	final function getHomeSolicitacoes(){
		
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get("select id, data_solicitacao, status, codigo, solucao, ciclo_pagamento, detalhes  from solicitacoes WHERE fk_id_cliente= ".$_SESSION["id_cliente"]);

	$resultado  = "
	<div id='solicitacoes_principal'>
		<table border= '5'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='8%'><button onClick='javascript:location.href=\"solicitacoes.php\"' class='botao_novo' title='Cadastrar nova solicitação'></button></th>
			<th width='12%'>SOLUÇÃO</th>
			<th width='12%'>STATUS</th>
			<th width='12%'>CICLO DE PAG.</th>
			<th width='12%'>SOLICITADO EM</th>
			<th width='12%'>CÓDIGO</th>
			<th width='32%'>DETALHES</th>
			</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value)
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='location.href=\"solicitacoes.php?id_solicitacao=".$value['id']."\"' class='botao_atualizar' title='Alterar informações desta solicitação'></button>
				<button onClick='javascript:deletarSolicitacao(".$value['id'].");' class='botao_excluir' title='Excluir esta solicitação'></button>
				</td>
				<td align='center'>".$value['solucao']."</td>
				<td align='center'>".$value['status']."</td>
				<td align='center'>".$value['ciclo_pagamento']."</td>
				<td align='center'>".$value['data_solicitacao']."</td>
				<td align='center'>".$value['codigo']."</td>
				<td align='left'>".$value['detalhes']."</td>
			</tr>";
	
		}
		
			
	$resultado  .= "</table></div>";	
	
	echo $resultado;
	}
	
	
	
	
	

	
	final function geraCodSolicitacao(){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$cod = "";
		for($i = 0; $i< 10; $i++){
	
		$cod = str_pad(rand(1, 99999999), 8, "0", STR_PAD_LEFT);
		
			if(count($BD->get("select id from solicitacoes where codigo='".$cod."'")) == 0){
			
			echo '{"resultado":"OK", "codigo":"'.$cod.'"}';
			return;
			}
		}
		
	echo '{"resultado":"ERRO"}';
	}
	
	
	
	

	
	

	
	public function salvaSolicitacao(){
	
	$erros = $this->validaSistema($_POST['id']==0?true:false);
	
		if(strlen($erros) == 0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
	
		$campos[] = "data_solicitacao";
		$campos[] = "status";
		$campos[] = "fk_id_cliente";
		$campos[] = "codigo";
		$campos[] = "solucao";
		$campos[] = "ciclo_pagamento";
		$campos[] = "detalhes";
		
		$valores[] = date("d/m/Y");
		$valores[] = $_POST['status'];
		$valores[] = $_POST['id_cliente'];
		$valores[] = $_POST['codigo'];
		$valores[] = $_POST['solucao'];	
		$valores[] = $_POST['ciclo'];		
		$valores[] = $_POST['detalhes'];
		
		
			if($_POST['id']==0){
			
				if(!$BD->aDD("solicitacoes", $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}
				
			echo '{"resultado":"OK", "limpa":"SIM"}';	
			}
			else{
				
				if(!$BD->atualiza("solicitacoes", "id", $_POST['id'], $campos, $valores)){
				
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
	

	if(strlen($_POST['codigo']) == 0)
	return "Gere o código da solicitação.";
		
	return "";
	}


	
	
	
	
	
	public function getDados($id_solicitacao, &$valores){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$BD = new Opcoes_BD_Gerais;
		
	$reg = $BD->get("select * from solicitacoes where id=".$id_solicitacao);
	
		if( count($reg) > 0){
	
		$valores['status'] 				= $reg[0]['status'];
		$valores['solucao'] 			= $reg[0]['solucao'];
		$valores['ciclo_pagamento	'] 	= $reg[0]['ciclo_pagamento'];
		$valores['detalhes'] 			= $reg[0]['detalhes'];
		$valores['codigo'] 				= $reg[0]['codigo'];
		
		}	
	}
	
	
	
	
	
	
	public function deletarSolicitacao(){
		
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;
		
		
		$pags = $BD->get("select id from pagamentos where fk_solicitacao = ".$_POST['id']);
				
			if( count($pags) > 0){
			
			foreach($pags as $pagamento)
			$BD->deletaPerson("sistemas_ativados", "fk_pagamento=".$pagamento['id']);
					
			}
		
		$BD->deletaPerson("pagamentos", "fk_solicitacao=".$_POST['id']);
		
			
			if($BD->deleta("solicitacoes", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}				
		}
		
	echo '{"resultado":"ERRO"}';	
	}
	










	
}
	
?>