<?php

if(!isset($_SESSION))
session_start();




chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Pagamentos{

	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."pagamentos/pagamentos.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."pagamentos/pagamentos.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	
	

	
	final function getHomePagamentos(){
		
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get("select id, status, codigo, solucao  from solicitacoes WHERE fk_id_cliente= ".$_SESSION["id_cliente"]);

	$resultado  = "
	<div id='pagamentos_principal' align='center'>
		<select width='100%' id='solicitacao' onChange='javascript:geraPagamentos()'>
		<option value='0'>SELECIONE A SOLICITACAO</option>";
		
		if( count($reg) > 0){
	
		foreach($reg as $value)
		$resultado  .= "<option value='".$value['id']."'>".$value['solucao']." - ".$value['status']." - ".$value['codigo']."</option>";
		
		}
			
	$resultado  .= "
		</select>
		<hr width='100%' style='margin:10px 0px 10px 0px'>
		<div id='resultado'></div>
	</div>";	

	echo $resultado;
	}
	
	
	
	
	
	
	
	
	function geraPagamentos(){
		
		
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	
	$resultado  = 
	"<table border= '5'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='16%'><button onClick='javascript:location.href=\"pagamentos.php?id_solicitacao=".$_POST['id']."\"' class='botao_novo' title='Cadastrar novo pagamento'></button></th>
			<th width='12%'>DATA</th>
			<th width='12%'>TIPO</th>
			<th width='12%'>QTDe</th>
			<th width='12%'>VALOR TOTAL</th>
			<th width='12%'>STATUS LICEN.</th>
			<th width='12%'>NUM. DIAS</th>
			<th width='12%'>STATUS PAG.</th>
			</tr>";
	
	$reg = $BD->get("select * from pagamentos where fk_solicitacao= ".$_POST['id']." ORDER BY id DESC");
	
	
		if( count($reg) > 0){
	
			foreach($reg as $value)
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='location.href=\"pagamentos.php?id_solicitacao=".$_POST['id']."&id_pagamento=".$value['id']."\"' class='botao_atualizar' title='Alterar informações deste pagamento'></button>
				<button onClick='javascript:deletarPagamento(".$value['id'].");' class='botao_excluir' title='Excluir este pagamento'></button>
				</td>
			<td align='center'>".str_pad($value['mes'], 2, "0", STR_PAD_LEFT)."/".$value['ano']."</td>
			<td align='center'>".$value['tipo']."</td>
			<td align='center'>".$value['num_licencas']."</td>
			<td align='center'>".$value['valor']."</td>
			<td align='center'>".$value['status']."</td>
			<td align='center'>".$value['num_de_dias']."</td>
			<td align='center'>".$value['status_pagamento']."</td>
			</tr>";
	
		}
		
		
		
	$resultado  .= "</table>";	
	
	echo '{"resultado":"OK", "dados":"'.$biblioteca->preparaHTMLParaJson($resultado).'"}';	
	}
	
	
	

	
	
	
	

	
	final function geraCodPagamento(){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
		for($i = 0; $i< 10; $i++){
	
		$cod = date("dmY") . str_pad(rand(1, 99999999), 8, "0", STR_PAD_LEFT);
		
			if(count($BD->get("select id from pagamentos where codigo='".$cod."'")) == 0){
			
			echo '{"resultado":"OK", "codigo":"'.$cod.'"}';
			return;
			}
		}
		
	echo '{"resultado":"ERRO"}';
	}
	
	
	
	
	
	
	
	final function salvaPagamento(){
	
	$erros = $this->valida();
	
		if(strlen($erros) == 0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
	
		$campos[] = "mes";
		$campos[] = "ano";
		$campos[] = "tipo";
		$campos[] = "num_licencas";
		$campos[] = "valor";
		$campos[] = "fk_solicitacao";
		$campos[] = "codigo";
		$campos[] = "fk_solucao";
		$campos[] = "num_de_dias";
		$campos[] = "status_pagamento";
		$campos[] = "a_partir_de";
		
		$valores[] = $_POST['mes'];
		$valores[] = $_POST['ano'];
		$valores[] = $_POST['tipo'];
		$valores[] = $_POST['num_licencas'];
		$valores[] = $_POST['valor'];	
		$valores[] = $_POST['id_solicitacao'];
		$valores[] = $_POST['codigo'];
		$valores[] = $_POST['id_solucao'];
		$valores[] = $_POST['num_de_dias'];
		$valores[] = $_POST['status_pagamento'];
		$valores[] = substr ($_POST['a_partir_de'], 6, 4)."-".substr ($_POST['a_partir_de'], 3, 2)."-".substr ($_POST['a_partir_de'], 0, 2);
		
		
			if($_POST['id']==0){
			
			$campos[] = "status";
			
			$valores[] = "ABERTO";		
			
				if(!$BD->aDD("pagamentos", $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}
				
			echo '{"resultado":"OK", "limpa":"SIM"}';	
			}
			else{
				
				if(!$BD->atualiza("pagamentos", "id", $_POST['id'], $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}	
			
			echo '{"resultado":"OK", "limpa":"NAO"}';
			}
		
		return;
		}
		
	echo '{"resultado":"ERRO", "erro":"'.$erros.'"}';	
	}
	


	
	
	
	
	public function valida(){
	

	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/Biblioteca.class.php');

	$biblioteca = new Biblioteca();


	if(strlen($_POST['valor']) == 0)
	return "informe o valor do pagamento.";
	
		if(strcmp($_POST['tipo'], "LICENCA") ==0 ){
	
		if(strlen($_POST['num_licencas']) == 0 || $_POST['num_licencas']== 0)
		return "Informe o número de licenças.";
			
		}
	
		if(array_key_exists("ano", $_POST)){
		
		if(strlen($_POST['ano']) != 4)
		return "Informe um ano válido.";
		}
		
		
		if(array_key_exists("cod", $_POST)){
		if(strlen($_POST['cod']) ==0)
		return "Gere um codigo de pagamento.";
		}
		
		
		if(array_key_exists("a_partir_de", $_POST)){
		if(strlen($_POST['a_partir_de']) !=10)
		return "A data informa para permissão de licença é inválida.";
		}
		
	return "";
	}

	
	
	
	
	
	
	
	public function getDados($id_pagamento, &$valores){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$BD = new Opcoes_BD_Gerais;
		
	$reg = $BD->get("select * from pagamentos where id=".$id_pagamento);
	
		if( count($reg) > 0){
	
		$valores['mes'] 				= $reg[0]['mes'];
		$valores['ano'] 				= $reg[0]['ano'];
		$valores['tipo'] 				= $reg[0]['tipo'];
		$valores['num_licencas'] 		= $reg[0]['num_licencas'];
		$valores['valor'] 				= $reg[0]['valor'];
		$valores['codigo'] 				= $reg[0]['codigo'];
		$valores['fk_solucao'] 			= $reg[0]['fk_solucao'];
		$valores['num_de_dias'] 		= $reg[0]['num_de_dias'];
		$valores['status_pagamento'] 	= $reg[0]['status_pagamento'];
		$valores['a_partir_de'] 		= $reg[0]['a_partir_de'];
		}	
	}
	
	


	
	
	
	
	
	
	public function deletarPagamento(){
		
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;
		
		
		$BD->deletaPerson("sistemas_ativados", "fk_pagamento=".$_POST['id']);
					
	
			if($BD->deleta("pagamentos", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}				
		}
		
	echo '{"resultado":"ERRO"}';	
	}
	




	
}
	
?>