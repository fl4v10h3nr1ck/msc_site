<?php

if(!isset($_SESSION))
session_start();



chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Chamados{

	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."chamados/chamados.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."chamados/chamados.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	
	
	
	final function getHomeChamados(){

	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select ch.id, ch.descricao, ch.data_cadastro, ch.assunto, ch.status, ch.nome_doc_anexo, cl.nome_razao from chamados as ch inner join clientes as cl on cl.id = fk_cliente");

	$resultado  = "
	<div id='chamados_principal'>
		<table border= '4'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='5%'></th>
			<th width='14%'>CLIENTE</th>
			<th width='30%'>ASSUNTO</th>
			<th width='30%'>DESCRIÇÃO</th>
			<th width='8%'>STATUS</th>
			<th width='8%'>DATA</th>
			<th width='5%'>ANEXO</th>
			</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value){
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='location.href=\"chamados.php?id_chamado=".$value['id']."\"' class='botao_atualizar' title='Alterar informações deste chamado'></button>
				<button onClick='javascript:deletaChamado(".$value['id'].");' class='botao_excluir' title='Excluir este chamado'></button>
				</td>
			<td align='left'>".strtoupper($value['nome_razao'])."</td>
			<td align='left'>".$value['assunto']."</td>
			<td align='left'>".$value['descricao']."</td>
			<td align='center' style='color:";
			
			if(strcmp($value['status'], "PENDENTE")==0)
			$resultado  .= "red";
			elseif(strcmp($value['status'], "EM ATENDIMENTO")==0)
			$resultado  .= "orange";
			elseif(strcmp($value['status'], "TERMINADO")==0)
			$resultado  .= "green";
			else
			$resultado  .= "black";
			
			$resultado  .= "'>".$value['status']."</td>
			<td align='center'>".$value['data_cadastro']."</td>";
			
			if($value['nome_doc_anexo']!=null && strlen($value['nome_doc_anexo'])>0)
			$resultado  .= "<td align='center' style='color:green'>SIM</td>";
			else
			$resultado  .= "<td align='center' style='color:black'>NAO</td>";
			
			$resultado  .= "</tr>";
			}
		}
		
		
		
	echo $resultado."</table></div>";	
	}


	
	
	

	


	
	public function salvaChamado(){
	
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;

	$campos = array();
	$valores = array();
	
	$campos[] = "assunto";
	$campos[] = "status";
	$campos[] = "descricao";
	$campos[] = "solucao";
	$campos[] = "obs";

			
	$valores[] = $_POST['assunto'];
	$valores[] = $_POST['status'];
	$valores[] = $_POST['descricao'];
	$valores[] = $_POST['solucao'];
	$valores[] = $_POST['obs'];
	
		
	if(!$BD->atualiza("chamados", "id", $_POST['id'], $campos, $valores))		
	echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
	else
	echo '{"resultado":"OK"}';

	}
	
	
	
	
	
	
	
	
	
	public function getDados($id_chamado, &$valores){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
		
	$reg = $BD->get("select * from chamados where id=".$id_chamado);
	
	
		if( count($reg) > 0){
	
		$valores['descricao'] 			= $reg[0]['descricao'];
		$valores['data_cadastro'] 		= $reg[0]['data_cadastro'];
		$valores['assunto'] 			= $reg[0]['assunto'];
		$valores['solucao'] 			= $reg[0]['solucao'];
		$valores['nome_doc_anexo'] 		= $reg[0]['nome_doc_anexo'];
		$valores['status'] 				= $reg[0]['status'];
		$valores['obs'] 				= $reg[0]['obs'];
		}	
	}
	
	
	
	
	
	
	
	
	
	public function getAssentamentos($id_chamado){
	
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get("select * from assentamentos where fk_chamado=".$id_chamado." order by id DESC");

	$form = "";
	
	
		if( count($reg) > 0){
		
		$form .= "
				<table class='table' border= '1' cellspacing ='0' style='color:#000;width:100%;margin:20px 0px 20px 0px'>
					<tr>
					<th width='5%' align='center'></th>
					<th width='70%' align='center'>Assentamento</th>
					<th width='11%' align='center'>Autor</th>
					<th width='14%' align='center'>Data</th>
					</tr>";
		
		foreach($reg as $i=>$linha)
		$form .= "
					<tr>
					<td align = 'center'><button onClick='javascript:deletaAssetamento(".$linha['id'].");' class='botao_excluir' title='Excluir este assentamento'></button></td>
					<td align = 'left'>".$linha['assentamento']."</td>
					<td align = 'center'>".$linha['autor']."</td>
					<td align = 'center'>".$linha['data_cadastro']."</td>
					</tr>";
			
		$form .= "</table>";

		}	
		else
		$form .= "<div style='width:100%;line-height:200px;color:#000' align='center'>&laquo;Nenhum Assentamento&raquo;</div>";

		
	$form .= "	
			</div>
		</td></tr>
	</table>";	
		
	
	echo $form;
	}
	
	
	
	
	
	
	
	
	
	
	public function salvaAssetamento(){
	
		if(strlen($_POST['assentamento']) == 0){
		echo '{"resultado":"ERRO", "erro":"Informe um assentamento."}';
		return;
		}
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;

	$campos = array();
	$valores = array();
	
	$campos[] = "assentamento";
	$campos[] = "data_cadastro";
	$campos[] = "autor";
	$campos[] = "fk_chamado";			
			
	$valores[] = $_POST['assentamento'];
	$valores[] = date("d/m/Y H:m");
	$valores[] = "OPERADOR";
	$valores[] = $_POST['id'];
		
		
	if(!$BD->aDD("assentamentos", $campos, $valores))
	echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
	else
	echo '{"resultado":"OK"}';
	}
	
	
	
	
	
	
	
	
	
	
	public function deletaAssetamento(){
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->deleta("assentamentos", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}				
		}
			
	echo '{"resultado":"ERRO"}';
	}
	




	
	
	
	
	public function deletaChamado(){
		
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

		$BD->deletaPerson("assentamentos", "fk_chamado=".$_POST['id']);
			
		
			if($BD->deleta("chamados", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}
			
		}
			
	echo '{"resultado":"ERRO"}';
	}
	





}
	
?>