<?php

if(!isset($_SESSION))
session_start();



chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Pedidos{

	
	
	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."pedidos/pedidos.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."pedidos/pedidos.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	
	
	
	final function getHomePedidos(){

	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select id, solicitante, email, solucoes, data_pedido from pedidos");

	$resultado  = "
	<div id='pedidos_principal'>
		<table border= '4'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='8%'></th>
			<th width='30%'>SOLICITANTE</th>
			<th width='24%'>EMAIL</th>
			<th width='30%'>SOLUÇÃO</th>
			<th width='8%'>DATA</th>
			</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value){
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='location.href=\"pedidos.php?id_pedido=".$value['id']."\"' class='botao_atualizar' title='Alterar informações deste pedido'></button>
				<button onClick='javascript:deletaPedido(".$value['id'].");' class='botao_excluir' title='Excluir este pedido'></button>
				</td>
			<td align='left'>".$value['solicitante']."</td>
			<td align='left'>".$value['email']."</td>
			<td align='left'>".$value['solucoes']."</td>
			<td align='center'>".$value['data_pedido']."</td>
			</tr>";
			}
		}
			
	echo $resultado."</table></div>";	
	}


	
	
	
	
	
	
	
	public function getDados($id_pedido, &$valores){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
		
	$reg = $BD->get("select * from pedidos where id=".$id_pedido);
	
	
		if( count($reg) > 0){
	
		$valores['empresa'] 					= $reg[0]['empresa'];
		$valores['descricao_empresa'] 			= $reg[0]['descricao_empresa'];
		$valores['outras_info_empresa'] 		= $reg[0]['outras_info_empresa'];
		$valores['telefone'] 					= $reg[0]['telefone'];
		$valores['email'] 						= $reg[0]['email'];
		$valores['cidade'] 						= $reg[0]['cidade'];
		$valores['uf'] 							= $reg[0]['uf'];
		$valores['descricao_projeto'] 			= $reg[0]['descricao_projeto'];
		$valores['info_complementares'] 		= $reg[0]['info_complementares'];
		$valores['solucoes'] 					= $reg[0]['solucoes'];
		$valores['data_pedido'] 				= $reg[0]['data_pedido'];
		}	
	}
	
	
	
	
	
	

	
	
	public function deletaPedido(){
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->deleta("pedidos", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}				
		}
			
	echo '{"resultado":"ERRO"}';
	}
	




	
	



}
	
?>