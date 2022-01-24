<?php

if(!isset($_SESSION))
session_start();





final class Clientes{

	
	
	
	final function getDependencias(){
		
	return "
	
	<link rel='stylesheet' href='".RAIZ_GESTOR."clientes/clientes.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".RAIZ_GESTOR."clientes/clientes.js'></script>
	
	<script type='text/javascript' src='".RAIZ."libs/macaras_de_textfield.js'></script>";
	}


	
	
	
	
	
	
	final function getHomeClientes(){

	$opcoes = "
	
	<div id='clientes_principal'>
		<table width='100%'>
		
			<tr>
				<td width='80%' align='left'>
				<input type='text' name='termos' id='termos'  value='' maxlength='200' style='width:98%;margin:0px 0px 0px 0px'/>
				</td><td width='10%' align='left'>
				<button onClick='javascript:pesquisar();' style='width:120px;height:25px'>Pesquisar</button>
				</td><td width='10%' align='right'>
				<button onClick='javascript:location.href=\"cliente.php\"' class='botao_novo' title='Cadastrar novo cliente'></button>
				</td></tr>
			<tr>
				<td colspan='3'>
				<hr width='100%' style='margin:5px 0px 2px 0px'>
					<div id='local_resultados_de_pesquisa'></div>
				</td>
			</tr>
		</table>
	</div>";
	
	echo $opcoes;
	}


	
	
	

	
	final function pesquisar(){
		
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	
	$_POST['termos'] = $biblioteca->anti_injection($_POST['termos']);
	
	
	
	$query = "select id, nome_razao, email, tel_1, status from clientes ".$biblioteca->getQueryTermos($_POST['termos'], array('nome_razao'));
		
	$reg = $BD->get($query);

	$resultado  = "
		<table border= '5'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
			<tr>
			<th width='12%'></th>
			<th width='32%'>CLIENTE</th>
			<th width='30%'>E-MAIL</th>
			<th width='18%'>TEL</th>
			<th width='8%'>STATUS</th>
			</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value)
			
			$resultado  .= "
			<tr>
				<td align='center'>
				<button onClick='javascript:selecionarCliente(".$value['id'].", \"".$value['nome_razao']."\");' class='botao_selecao' title='Selecionar este cliente'></button>
				<button onClick='location.href=\"cliente.php?id_cliente=".$value['id']."\"' class='botao_atualizar' title='Alterar informações deste cliente'></button>
				<button onClick='javascript:desativarCliente(".$value['id'].", \"".$value['status']."\");' class='botao_desativar' title='Ativar/desativar este cliente'></button>
				<button onClick='javascript:deletarCliente(".$value['id'].");' class='botao_excluir' title='Excluir este cliente'></button>
				</td>
			<td align='left'>".strtoupper($value['nome_razao'])."</td>
			<td align='left'>".$value['email']."</td>
			<td align='center'>".$value['tel_1']."</td>
			<td align='center' style='color:".(strcmp($value['status'], "ATIVO")==0?"green":"red")."'>".$value['status']."</td>
			</tr>";
	
		}
		
		
		
	$resultado  .= "</table>";	
	
	echo '{"resultado":"OK", "dados":"'.$biblioteca->preparaHTMLParaJson($resultado).'"}';
	}
	
	
	
	
	
	
	final public function geraSenha(){
	
	echo rand( 100000,1000000000);
	}
	
	
	
	
	
	


	
	public function salvaCliente(){
	
	$erros = $this->validaCliente($_POST['id']==0?true:false);
	
		if(strlen($erros) == 0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
	
		$campos[] = "tipo";
		$campos[] = "nome_razao";
		$campos[] = "cpf_cnpj";
		$campos[] = "rg_ie";
		$campos[] = "email";
		$campos[] = "nome_contato";
		$campos[] = "tel_1";
		$campos[] = "tel_2";
		$campos[] = "cidade";
		$campos[] = "uf";
		$campos[] = "logradouro";
		$campos[] = "num_residencia";
		$campos[] = "cep";
		$campos[] = "obs";
		$campos[] = "descricao_empresa";
		$campos[] = "outras_info_empresa";
		$campos[] = "nome_usuario";
		
		
		
		$valores[] = $_POST['tipo'];
		$valores[] = $_POST['nome'];
		$valores[] = $_POST['cpf_cnpj'];
		$valores[] = $_POST['rg_ie'];
		$valores[] = $_POST['email'];
		$valores[] = $_POST['nome_contato'];
		$valores[] = "(".$_POST['ddd_1'].") ".$_POST['num_1']." ".$_POST['ramal_1'];
		$valores[] = strlen($_POST['ddd_2'])> 0 ?"(".$_POST['ddd_2'].") ".$_POST['num_2']." ".$_POST['ramal_2']:"";
		$valores[] = $_POST['cidade'];
		$valores[] = $_POST['uf'];
		$valores[] = $_POST['logradouro'];
		$valores[] = $_POST['num'];
		$valores[] = $_POST['cep'];
		$valores[] = $_POST['obs'];
		$valores[] = $_POST['descricao_empresa'];
		$valores[] = $_POST['outras_info'];
		$valores[] = $_POST['nome_user'];
		
		
		
			if($_POST['id']==0){
			
			$campos[] = "password";			
			$campos[] = "status";
			
			$valores[] = md5($_POST['senha']);
			$valores[] = "ATIVO";	
				
				if(!$BD->aDD("clientes", $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}
				
			echo '{"resultado":"OK", "limpa":"SIM"}';	
			}
			else{
				
				if(!$BD->atualiza("clientes", "id", $_POST['id'], $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}	
			
			echo '{"resultado":"OK", "limpa":"NAO"}';
			}
		
		return;
		}
		
	echo '{"resultado":"ERRO", "erro":"'.$erros.'"}';	
	}
	
	
	
	
	
	
	
	
	public function validaCliente($valida_senha = false){
	
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	
	$biblioteca = new Biblioteca();


	if(strlen($_POST['nome']) == 0)
	return "informe uma razão social.";
	
	
		if(strcmp($_POST['tipo'], "PF") ==0 ){
	
			if(strlen($_POST['cpf_cnpj']) > 0){
		
			if(!$biblioteca->validaCPF($_POST['cpf_cnpj']))
			return "Informe um CPF válido.";
			}	
	
			if(strlen($_POST['rg_ie']) > 0){
			
			if(strlen($_POST['rg_ie']) < 6)
			return "Informe um RG válido.";
			}
		}
		else{
		
			if(strlen($_POST['cpf_cnpj']) > 0){
				
			if(!$biblioteca->validaCNPJ($_POST['cpf_cnpj']))
			return "Informe um CNPJ válido.";
			}
		}
	
		if(strlen($_POST['email']) > 0){
		
		if(!$biblioteca->validaEmail($_POST['email']))
		return "informe um endereço de E-mail válido.";
		
		}
	
		
	if( !$biblioteca->validaTEL($_POST['ddd_1'], $_POST['num_1'], $_POST['ramal_1']))
	return "informe um TEL principal válido.";
		
		
	if( !$biblioteca->validaTEL($_POST['ddd_2'], $_POST['num_2'], $_POST['ramal_2'], true))
	return "informe um TEL secundário válido.";
		
		if($valida_senha){
			
		if( strlen($_POST['senha']) < 6)
		return "Nenhuma senha gerada.";
		}
		
	return "";
	}


	
	
	
	
	
	public function getDados($id_cliente, &$valores){
		
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
		
	$reg = $BD->get("select * from clientes where id=".$id_cliente);
	
		if( count($reg) > 0){
	
		$valores['tipo'] 				= $reg[0]['tipo'];
		$valores['nome'] 				= $reg[0]['nome_razao'];
		$valores['cpf_cnpj'] 			= $reg[0]['cpf_cnpj'];
		$valores['rg_ie'] 				= $reg[0]['rg_ie'];
		$valores['email'] 				= $reg[0]['email'];
		$valores['nome_contato'] 		= $reg[0]['nome_contato'];
		
		$dados = $biblioteca->extraiNumTEL($reg[0]['tel_1']);
		
		$valores['ddd_1'] = $dados['ddd'];
		$valores['num_1'] = $dados['num'];
		$valores['ramal_1'] = $dados['ramal'];
		
		$dados = $biblioteca->extraiNumTEL($reg[0]['tel_2']);
		
		$valores['ddd_2'] = $dados['ddd'];
		$valores['num_2'] = $dados['num'];
		$valores['ramal_2'] = $dados['ramal'];
		
		$valores['cidade'] 				= $reg[0]['cidade'];
		$valores['uf'] 					= $reg[0]['uf'];
		$valores['logradouro'] 			= $reg[0]['logradouro'];
		$valores['num'] 				= $reg[0]['num_residencia'];
		$valores['cep'] 				= $reg[0]['cep'];
		$valores['obs'] 				= $reg[0]['obs'];
		$valores['descricao_empresa'] 	= $reg[0]['descricao_empresa'];
		$valores['outras_info'] 		= $reg[0]['outras_info_empresa'];
		$valores['nome_user']			= $reg[0]['nome_usuario'];
		}
		
	}
	
	
	
	
	
	
	
	public function selecionarCliente(){
		
		
		if($_POST['id']>0 && strlen($_POST['nome'])>0){
		
		$_SESSION['id_cliente'] = $_POST['id'];
		$_SESSION['nome_cliente'] = $_POST['nome']."(ID ".str_pad($_POST['id'], 10, "0", STR_PAD_LEFT).")";
		
		echo '{"resultado":"OK", "dados":"'.$_SESSION['nome_cliente'].'"}';
		}
		else
		echo '{"resultado":"ERRO"}';
			
	}
	
	
	
	
	
	
	
	public function deletarCliente(){
		
		
		if($_POST['id']>0){
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

		$reg = $BD->get("select id from chamados where fk_cliente = ".$_POST['id']);

			if( count($reg) > 0){

			foreach($reg as $value)
			$BD->deletaPerson("assentamentos", "fk_chamado=".$value['id']);
			}
			
		$BD->deletaPerson("chamados", "fk_cliente=".$_POST['id']);
		
		
		$reg = $BD->get("select id from solicitacoes where fk_id_cliente = ".$_POST['id']);
		
			if( count($reg) > 0){
			
				foreach($reg as $solicitacao){
				
				$pags = $BD->get("select id from pagamentos where fk_solicitacao = ".$solicitacao['id']);
				
					if( count($pags) > 0){
			
					foreach($pags as $pagamento)
					$BD->deletaPerson("sistemas_ativados", "fk_pagamento=".$pagamento['id']);
					
					}
					
				$BD->deletaPerson("pagamentos", "fk_solicitacao=".$solicitacao['id']);
				}
			}
			
		$BD->deletaPerson("solicitacoes", "fk_id_cliente=".$_POST['id']);	
			
		
			if($BD->deleta("clientes", "id", $_POST['id'])){
				
			echo '{"resultado":"OK"}';
			return;
			}				
		}
			
	echo '{"resultado":"ERRO"}';
	}
	





	public function desativarCliente(){
		
		
		if($_POST['id']>0 && strlen($_POST['status'])>0){
			
		
		include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->atualiza("clientes", "id", $_POST['id'], array('status'), array(strcmp($_POST['status'], "ATIVO")==0?"INATIVO":"ATIVO"))){	
			echo '{"resultado":"OK"}';
			return;
			}
		}
		
	echo '{"resultado":"ERRO"}';	
	}











	
}
	
?>