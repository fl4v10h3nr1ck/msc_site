<?php

header('Content-type: text/html; charset=UTF-8');




final class Gestor{


/*********************************************************** pesquisa de clientes *****************************************************************/
	
	
	final function barraDePesquisa(){

	$opcoes = "

	<table width='100%' style='color:#FFF'>
		<tr><td align='left' width='40%' colspan='3'>
		<img src='/imgs/icon_arrow.png' class='marcador'><b>CLIENTES:</b>
		</td></tr><tr><td align='left' width='40%'>
		<b>Nome:</b><br>
		<input type=\"text\" name=\"nome_pesq\" id=\"nome_pesq\"  value=\"\" maxlength=\"200\" style=\"width:98%\"/>
		</td><td align='left' width='10%'><br>
		<button onClick='javascript:pesquisar();' style='width:120px;height:25px'>Pesquisar</button>
		</td><td align='right' width='50%'><br>
		<button onClick='javascript:novoCliente();' style='width:120px;height:25px'>Novo Cliente</button>
		</td></tr>
	</table>";
	
	echo $opcoes;
	}




	public function getClientes(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

	$BD = new Opcoes_BD_Gerais;
	
	
	$query = "select id, nome_razao, cpf_cnpj from clientes ".$this->getQueryTermos()." order by id desc";
	
	$reg = $BD->get($query);

		if( count($reg) > 0){
		
		$tabela = "
			<div id='tabela_clientes' class='div_de_tabelas'>
				<table class='table' border='1' cellspacing ='0' >
					<tr>
					<th width='50%'>Nome/Razão Social</th>
					<th width='20%'>CPF/CNPJ</th>
					<th width='15%'>Solicitações</th>
					<th width='15%'>Chamados</th>
					</tr>";
		
		foreach($reg as $i=>$linha)
		$tabela .= "
					<tr id='cliente_tr_".$linha['id']."'>
					<td align = 'left'><a href=\"javascript:formAlterCliente(".$linha['id'].");\">".$linha['nome_razao']."</a></td>
					<td align = 'center'>".$linha['cpf_cnpj']."</td>
					<td align = 'center'><a href=\"javascript:mostrarSolicitacoes(".$linha['id'].");\">Ver</a></td>
					<td align = 'center'><a href=\"javascript:mostrarChamados(".$linha['id'].");\">Ver</a></td>
					</tr>";
	
		
		echo $tabela."</table></div>";
		}	
		else
		$this->nadaEncontrado();
	
	
	}





	private function getQueryTermos(){
	
	if( strlen( $_POST["termo"] ) == 0) 
	return "";
	
	$tokens_do_termo = explode(' ', $_POST["termo"]);
	
	$query_termo = " where (";
		
		foreach($tokens_do_termo as $j => $value){
		
		$query_termo .= "nome_razao like '%".$value."%'";
		
		if( $j < count($tokens_do_termo) -1)
		$query_termo .= " and ";
		}
		
	return $query_termo.")";	
	}
	
	

	
	
	public function nadaEncontrado(){
	
	echo "<p align='center' style = \"background:#EEE;min-height: 200px;text-align:center;line-height:200px;width:100%;margin: 10px 0px 0px 0px\">&laquo;Nada Encontrado&raquo;</p>";
	}
	
	
	
/*********************************************************** novo cliente *****************************************************************/

	
	public function formNovoCliente(){

	$form = "
	
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>Novo Cliente</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left'>
				Nome/Rarão Social:<span style='color:red'>*</span><br>
				<input type='text' id='nome_razao' value='' style='width:98%' >
				</td><td width='10%' align='left'>		
				Tipo:<span style='color:red'>*</span><br>
					<select id='tipo' style='width:98%' onchange='javascript:mudaTipo();'>
					<option value='PF'>PF</option>
					<option value='PJ'>PJ</option>
					</select>
				</td><td width='15%' align='left'>
				CPF:<span style='color:red'>*</span><br>
				<input type='text' id='cpf' value='' style='width:98%' maxlength='14' onchange='javascript:mascara(this, formatarCPF);' >
				</td><td width='15%' align='left'>
				CNPJ:<span style='color:red'>*</span><br>
				<input type='text' id='cnpj' value='' style='width:98%' maxlength='19' disabled onchange='javascript:mascara(this, formatarCNPJ);' >
				</td><td width='10%' align='left'>		
				RG/IE:<br>
				<input type='text' id='rg_ie' value='' style='width:98%' maxlength='8' >
				</td><td width='20%' align='left'>
				E-mail:<br>
				<input type='text' id='email' value='' style='width:98%' >
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='40%' align='left'>
				Nome Contato:<br>
				<input type='text' id='nome_contato' value='' style='width:98%' >
				</td><td align='left' width='30%'>
					<table width='100%'>
						<tr><td colspan = '3' valign='top'  align='left'>
						Telefone Principal:<span style='color:red'>*</span>
						</td></tr>
						<tr><td align = 'right' width='20%'>
						<input type='text' value='' id='tel_ddd_1' maxlength='2' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td><td align = 'center' width='50%'>
						<input type='text' value='' id='tel_num_1' maxlength='10' onchange='javascript:mascara(this, formatarTEL);' style='width:98%'>
						</td><td align = 'left' width='30%'>
						<input type='text' value='' id='tel_ramal_1' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td></tr>
					</table>
				</td><td align='left' width='30%'>
					<table width='100%'>
						<tr><td colspan = '3' valign='top'  align='left'>
						Telefone Secundário:
						</td></tr>
						<tr><td align = 'center' width='20%'>
						<input type='text' value='' id='tel_ddd_2' maxlength='2' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td><td align = 'center'  width='50%'>
						<input type='text' value='' id='tel_num_2' maxlength='10' onchange='javascript:mascara(this, formatarTEL);' style='width:98%'>
						</td><td align = 'center'  width='30%'>
						<input type='text' value='' id='tel_ramal_2' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td></tr>
					</table>	
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left'>
				Descrição Empresa:<br>
				<input type='text' id='descricao_empresa' value='' style='width:98%'>
				</td><td align='left' width='30%' >
				Informações Complementares:<br>
				<input type='text' id='outras_info' value='' style='width:98%'>
				</td><td align='left' width='40%' >
				OBS:<br>
				<input type='text' id='obs' style='width:99%' value=''>
				</td></tr>
			</table>	
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left' >
				Logradouro:<br>
				<input type='text' id='logradouro' style='width:98%' value=''>
				</td><td width='15%' align='left'>
				Número:<br>
				<input type='text' id='num' style='width:98%' value=''>
				</td><td width='15%' align='left'>
				CEP:<br>
				<input type='text' id='cep' style='width:98%' value='' onchange='javascript:mascara(this, formatarCEP);setCEP();'  maxlength='9'>
				</td><td width='25%' align='left'>
				Cidade:<br>
				<input type='text' id='cidade' style='width:98%' value=''>
				</td><td width='15%' align='left'>
				Estado (UF):<br>
				<select id='uf' style='width:98%'>
				";
				foreach( array('PA', 'AC', 'AL', 'AP', 'AM',  'BA', 'CE',  'DF',  'ES',  'GO',  'MA',  'MT',  'MS',  'MG', 'PB',  'PR',  'PE',  'RJ',  'RJ',  'RN',  'RS', 'RO',  'RR',  'SC',  'SP',  'SE',  'TO') as $value)
				$form .= "<option value='".$value."'>".$value."</option>";

				$form .= "
				</select>
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left' >
				Nome de Usuário:<br>
				<input id='nome_user' type='text' style='width:98%' value=''>	
				</td><td align='left'>
				Senha:<span style='color:red'>*</span><br>
				<input id='senha' type='text' style='width:200px' value='' readonly>	
				<button style='width:150px;height:25px' onclick='javaacript:geraSenha();'>Gerar Senha</button><br>
				</td></tr>
			</table>
		</td></tr><tr><td align='center'><br><br>
		<button style='width:150px;height:25px' onclick='javaacript:salvaCliente();'>Salvar</button><br><br>
		</td></tr>
	</table>";	

	echo $form;
	}



	
	public function validaCliente($valida_senha = false){
	
	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/Biblioteca.class.php');

	$biblioteca = new Biblioteca();


	if(strlen($_POST['nome']) == 0)
	return "informe um nome/razão social.";
	
	
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




	
	public function salvaCliente(){
	
	$erros = $this->validaCliente(true);
	
		if(strlen($erros) == 0){
		
		include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

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
		$campos[] = "password";
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
		$valores[] = md5($_POST['senha']);
		$valores[] = $_POST['descricao_empresa'];
		$valores[] = $_POST['outras_info'];
		$valores[] = $_POST['nome_user'];
		
			if(!$BD->aDD("clientes", $campos, $valores)){
			
			echo "Falha na gravação, por favor, tente novamente.";	
			return;
			}
		
		echo "SUCESSO_NA_GRAVACAO";
		}
		
	echo $erros;	
	}
	
	
	
	
	public function geraSenha(){
	
	echo rand( 100000,1000000000);
	}
	
	
	
	
/*********************************************************** altera cliente *****************************************************************/
	
	

	public function formAlterCliente(){

	if( !array_key_exists("id", $_POST))
	return;
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	include_once '../../libs/Biblioteca.class.php';

	$bib = new Biblioteca;
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select * from clientes where id=".$_POST['id']." order by id desc");

	if( count($reg) == 0)
	return;
	
	$value = $reg[0];
	
	$tel_1 = $bib->getTEL($value['tel_1']);
	$tel_2 = $bib->getTEL($value['tel_2']);
	
	
	$form = "
			
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>Novo Cliente</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left'>
				Nome/Rarão Social:<span style='color:red'>*</span><br>
				<input type='text' id='nome_razao' value='".$value['nome_razao']."' style='width:98%' >
				</td><td width='10%' align='left'>		
				Tipo:<span style='color:red'>*</span><br>
					<select id='tipo' style='width:98%' onchange='javascript:mudaTipo();'>
					<option value='PF' ".(strcmp($value['tipo'], "PF") ==0?"selected":"").">PF</option>
					<option value='PJ' ".(strcmp($value['tipo'], "PJ") ==0?"selected":"").">PJ</option>
					</select>
				</td><td width='15%' align='left'>
				CPF:<span style='color:red'>*</span><br>
				<input type='text' id='cpf' value='".(strcmp($value['tipo'], "PF") ==0?$value['cpf_cnpj']:"")."' style='width:98%' maxlength='14' ".(strcmp($value['tipo'], "PJ") ==0?"disabled":"")." onchange='javascript:mascara(this, formatarCPF);' >
				</td><td width='15%' align='left'>
				CNPJ:<span style='color:red'>*</span><br>
				<input type='text' id='cnpj' value='".(strcmp($value['tipo'], "PJ") ==0?$value['cpf_cnpj']:"")."' style='width:98%' maxlength='19' ".(strcmp($value['tipo'], "PF") ==0?"disabled":"")." onchange='javascript:mascara(this, formatarCNPJ);' >
				</td><td width='10%' align='left'>		
				RG/IE:<br>
				<input type='text' id='rg_ie' value='".$value['rg_ie']."' style='width:98%' maxlength='8' >
				</td><td width='20%' align='left'>
				E-mail:<br>
				<input type='text' id='email' value='".$value['email']."' style='width:98%' >
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='40%' align='left'>
				Nome Contato:<br>
				<input type='text' id='nome_contato' value='".$value['nome_contato']."' style='width:98%' >
				</td><td align='left' width='30%'>
					<table width='100%'>
						<tr><td colspan = '3' valign='top'  align='left'>
						Telefone Principal:<span style='color:red'>*</span>
						</td></tr>
						<tr><td align = 'right' width='20%'>
						<input type='text' value='".$tel_1["ddd"]."' id='tel_ddd_1' maxlength='2' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td><td align = 'center' width='50%'>
						<input type='text' value='".$tel_1["num"]."' id='tel_num_1' maxlength='10' onchange='javascript:mascara(this, formatarTEL);' style='width:98%'>
						</td><td align = 'left' width='30%'>
						<input type='text' value='".$tel_1["ramal"]."' id='tel_ramal_1' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td></tr>
					</table>
				</td><td align='left' width='30%'>
					<table width='100%'>
						<tr><td colspan = '3' valign='top'  align='left'>
						Telefone Secundário:
						</td></tr>
						<tr><td align = 'center' width='20%'>
						<input type='text' value='".$tel_2["ddd"]."' id='tel_ddd_2' maxlength='2' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td><td align = 'center'  width='50%'>
						<input type='text' value='".$tel_2["num"]."' id='tel_num_2' maxlength='10' onchange='javascript:mascara(this, formatarTEL);' style='width:98%'>
						</td><td align = 'center'  width='30%'>
						<input type='text' value='".$tel_2["ramal"]."' id='tel_ramal_2' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
						</td></tr>
					</table>	
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left'>
				Descrição Empresa:<br>
				<input type='text' id='descricao_empresa' value='".$value['descricao_empresa']."' style='width:98%'>
				</td><td align='left' width='30%' >
				Informações Complementares:<br>
				<input type='text' id='outras_info' value='".$value['outras_info_empresa']."' style='width:98%'>
				</td><td align='left' width='40%' >
				OBS:<br>
				<input type='text' id='obs' style='width:99%' value='".$value['obs']."'>
				</td></tr>
			</table>	
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left' >
				Logradouro:<br>
				<input type='text' id='logradouro' style='width:98%' value='".$value['logradouro']."'>
				</td><td width='15%' align='left'>
				Número:<br>
				<input type='text' id='num' style='width:98%' value='".$value['num_residencia']."'>
				</td><td width='15%' align='left'>
				CEP:<br>
				<input type='text' id='cep' style='width:98%' value='".$value['cep']."' onchange='javascript:mascara(this, formatarCEP);setCEP();'  maxlength='9'>
				</td><td width='25%' align='left'>
				Cidade:<br>
				<input type='text' id='cidade' style='width:98%' value='".$value['cidade']."'>
				</td><td width='15%' align='left'>
				Estado (UF):<br>
				<select id='uf' style='width:98%'>
				";
				foreach( array('PA', 'AC', 'AL', 'AP', 'AM',  'BA', 'CE',  'DF',  'ES',  'GO',  'MA',  'MT',  'MS',  'MG', 'PB',  'PR',  'PE',  'RJ',  'RJ',  'RN',  'RS', 'RO',  'RR',  'SC',  'SP',  'SE',  'TO') as $aux)
				$form .= "<option value='".$aux."' ".(strcmp($value['uf'], $aux)==0?"selected":"").">".$aux."</option>";

				$form .= "
				</select>
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='30%' align='left' >
				Nome de Usuário:<br>
				<input id='nome_user' type='text' style='width:98%' value='".$value['nome_usuario']."'>	
				</td><td align='left'>
				Senha:<span style='color:red'>*</span><br>
				<input id='senha' type='text' style='width:200px' value='' readonly>	
				<button style='width:150px;height:25px' onclick='javaacript:geraSenha();'>Gerar Senha</button>
				</td></tr>
			</table>
		</td></tr><tr><td align='center'><br><br>
		<button style='width:150px;height:25px' onclick='javascript:alterarCliente(".$_POST['id'].");'>Salvar</button><br><br>
		</td></tr>
	</table>";	

	echo $form;
	}


	
	
	
	
	public function alteraCliente(){
	
	$erros = $this->validaCliente();
	
		if(strlen($erros) == 0){
		
		include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

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
		
		if(strlen($_POST['senha'])> 0)
		$campos[] = "password";
		
		
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
		if(strlen($_POST['senha'])> 0)
		$valores[] = md5($_POST['senha']);
		
			if(!$BD->atualiza("clientes", "id", $_POST['id'], $campos, $valores)){
			
			echo "Falha na gravação, por favor, tente novamente.";	
			return;
			}
		
		echo "SUCESSO_NA_GRAVACAO";
		}
		
	echo $erros;	
	}
	
	
	
/*********************************************************** solicitacoes *****************************************************************/

	
	
	public function mostrarSolicitacoes(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

	$BD = new Opcoes_BD_Gerais;
	
	if( !array_key_exists("id", $_POST))
	return;
	
	echo "
	<table width='100%' style='color:#FFF'>
		<tr><td align='left' width='80%'>
		<img src='/imgs/icon_arrow.png' class='marcador'><b>SOLICITAÇÕES:</b>
		</td><td align='right' width='20%'>
		<button onClick='javascript:novaSolicitacao(".$_POST['id'].");'>Nova Solicitação</button>
		</td></tr>
	</table>";
	
	$reg = $BD->get("select * from solicitacoes where fk_id_cliente=".$_POST['id']." order by id desc");

		if( count($reg) > 0){
		
		$tabela = "<div class='div_de_tabelas' id='tabela_solicitacao'>
		<table class='table'  border='1' cellspacing ='0'>
			<tr>
			<th width='15%'>Código</th>
			<th width='15%'>Solução</th>
			<th width='15%'>Status</th>
			<th width='15%'>Pagamentos</th>
			<th width='25%'>Destalhes</th>
			<th width='15%'>Ciclo de Pag.</th>
			</tr>";
		
		foreach($reg as $i=>$linha)
		$tabela .= "
			<tr id='solicitacao_tr_".$linha['id']."'>
			<td align = 'center'><a href='javascript:formAlterSolicitacao(".$_POST['id'].", ".$linha['id'].");'>".$linha['codigo']."</a></td>
			<td align = 'center'>".$linha['solucao']."</td>
			<td align = 'center'>".$linha['status']."</td>
			<td align = 'center'><a href='javascript:mostrarPagamentos(".$linha['id'].");'>Ver</a></td>
			<td align = 'left'>".$linha['detalhes']."</td>
			<td align = 'center'>".$linha['ciclo_pagamento']."</td>
			</tr>";
	
		echo $tabela."</table></div>";
		}	
		else
		$this->nadaEncontrado();
	
	
	
	}
	
	
	
	
/*********************************************************** nova solicitacao *****************************************************************/
	

	
	public function novaSolicitacao(){
	
	$form = "		
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>Nova Solicitação</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='34%' align='left'>
				Solução:<span style='color:red'>*</span><br>
					<select id='solucao' style='width:98%'>
					<option value='WEBDEV'>Desenvolvimento WEB</option>
					<option value='SISTEMAS'>Sistemas</option>
					<option value='INFRA'>Infraestrutura</option>
					<option value='TREINA'>Treinamento</option>
					</select>
				</td><td width='33%' align='left'>		
				Status:<span style='color:red'>*</span><br>
					<select id='status' style='width:98%'>
					<option value='ABERTO'>Aberto</option>
					<option value='EM DEV'>Em desenvolvimento</option>
					<option value='FECHADO'>Fechado</option>
					</select>
				</td><td width='33%' align='left'>
				Ciclo de Pagamento:<span style='color:red'>*</span><br>
					<select id='ciclo' style='width:98%'>
					<option value='INTEGRAL'>Integral</option>
					<option value='2 PARCELAS'>2 Parcelas</option>
					<option value='MENSAL'>Mensal</option>
					<option value='TRIMESTRAL'>Trimensal</option>
					<option value='SEMESTRAL'>Semestral</option>
					<option value='ANUAL'>Anual</option>
					</select>
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='25%' align='left'>
				Código Solicitação (CLIENT CODE):<br>
				<input type='text' id='cod_solicitacao' value='' style='width:60%' disabled>
				<button style='width:30%;height:25px' onclick='javascript:geraCodSolicitacao();'>Gerar</button>
				</td><td align='left' width='25%'>
				Detalhes:<br>
				<input type='text' id='detalhes' value='' style='width:98%' >
				</td><td align='left' width='25%'>
				</td><td align='left' width='25%'>
				</td></tr>
			</table>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;height:25px' onclick='javascript:mostrarSolicitacoes(".$_POST['id_cliente'].");'>Voltar</button><button style='width:150px;height:25px' onclick='javascript:salvaSolicitacao(".$_POST['id_cliente'].");'>Salvar</button>
		</td></tr>
	</table>";	

	echo $form;
	}
	
	
	
	
	
	public function validaSolicitacao(){
	

	if(strlen($_POST['cod']) == 0)
	return "Gere o código da solicitação.";
	
	return "";
	}



	
	public function salvaSolicitacao(){
	
	$erros = $this->validaSolicitacao();
	
		if(strlen($erros) == 0){
		
		include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
		
		$campos[] = "solucao";
		$campos[] = "detalhes";
		$campos[] = "status";
		$campos[] = "fk_id_cliente";
		$campos[] = "ciclo_pagamento";
		$campos[] = "data_solicitacao";
		$campos[] = "codigo";
			
			
		$valores[] = $_POST['solucao'];
		$valores[] = $_POST['detalhes'];
		$valores[] = $_POST['status'];
		$valores[] = $_POST['id'];
		$valores[] = $_POST['ciclo'];
		$valores[] = date("d/m/Y");
		$valores[] = $_POST['cod'];
			
			if(!$BD->aDD("solicitacoes", $campos, $valores)){
				
			echo "Falha na gravação, por favor, tente novamente.";	
			return;
			}
			
		echo "SUCESSO_NA_GRAVACAO";
		}
	
	echo $erros;
	}
	
	
	
	
	public function geraCodSolicitacao(){
	
	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

	$BD = new Opcoes_BD_Gerais;
	
	$cod = "";
		for($i = 0; $i< 10; $i++){
	
		$cod = str_pad(rand(1, 99999999), 8, "0", STR_PAD_LEFT);
		
			if(count($BD->get("select id form solicitacoes where codigo='".$cod."'")) == 0){
			
			echo $cod;
			return;
			}
		}
		
		
		
	echo "";
	}
	
	
	
		
/*********************************************************** altera solicitacao *****************************************************************/

	
	
	public function formAlterSolicitacao(){
	
	if( !array_key_exists("id_solicitacao", $_POST) ||  !array_key_exists("id_cliente", $_POST))
	return;
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	include_once '../../libs/Biblioteca.class.php';

	$bib = new Biblioteca;
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select * from solicitacoes where id=".$_POST['id_solicitacao']." order by id desc");

	if( count($reg) == 0)
	return;
	
	$value = $reg[0];
	
	$form = "		
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>ALTERAÇÃO DE SOLICITAÇÃO</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='34%' align='left'>
				Solução:<span style='color:red'>*</span><br>
					<select id='solucao' style='width:98%'>";
					
					foreach(array('WEBDEV','SISTEMAS','INFRA', 'TREINA') as $aux)
					$form .= "<option value='".$aux."' ".(strcmp($aux, $value['solucao'])==0?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>
				</td><td width='33%' align='left'>		
				Status:<span style='color:red'>*</span><br>
					<select id='status' style='width:98%'>";
							
					foreach(array('ABERTO','EM DEV','FECHADO') as $aux)
					$form .= "<option value='".$aux."' ".(strcmp($aux, $value['status'])==0?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>
				</td><td width='33%' align='left'>
				Ciclo de Pagamento:<span style='color:red'>*</span><br>
					<select id='ciclo' style='width:98%'>";
					
					foreach(array('INTEGRAL','2 PARCELAS','MENSAL', 'TRIMESTRAL', 'SEMESTRAL', 'ANUAL') as $aux)
					$form .= "<option value='".$aux."' ".(strcmp($aux, $value['ciclo_pagamento'])==0?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='25%' align='left'>
				Código Solicitação:<br>
				<input type='text' id='cod_solicitacao' value='".$value['codigo']."' style='width:98%' disabled>
				</td><td align='left' width='25%'>
				Detalhes:<br>
				<input type='text' id='detalhes' value='".$value['detalhes']."' style='width:98%' >
				</td><td align='left' width='25%'>
				</td><td align='left' width='25%'>
				</td></tr>
			</table>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;height:25px' onclick='javaacript:mostrarSolicitacoes(".$_POST['id_cliente'].");'>Voltar</button><button style='width:150px;height:25px' onclick='javaacript:alterSolicitacao(".$_POST['id_cliente'].", ".$_POST['id_solicitacao'].");'>Salvar</button>
		</td></tr>
	</table>";	

	echo $form;
	}
	
	
	
	
		
	public function alterSolicitacao(){
	
	$erros = $this->validaSolicitacao();
	
		if(strlen($erros) == 0){
		
		include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
		
		$campos[] = "solucao";
		$campos[] = "detalhes";
		$campos[] = "status";
		$campos[] = "ciclo_pagamento";
		
			
			
		$valores[] = $_POST['solucao'];
		$valores[] = $_POST['detalhes'];
		$valores[] = $_POST['status'];
		$valores[] = $_POST['ciclo'];
		
			
			if(!$BD->atualiza("solicitacoes", "id", $_POST['id_solicitacao'], $campos, $valores)){
				
			echo "Falha na gravação, por favor, tente novamente.";	
			return;
			}
			
		echo "SUCESSO_NA_GRAVACAO";
		}
	
	echo $erros;
	}
	

	
/*********************************************************** pagamentos *****************************************************************/
	
	
		
	public function mostrarPagamentos(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

	$BD = new Opcoes_BD_Gerais;
	
	if( !array_key_exists("id_solicitacao", $_POST))
	return;
	
	echo "
	<table width='100%' style='color:#FFF'>
		<tr><td align='left' width='80%'>
		<img src='/imgs/icon_arrow.png' class='marcador'><b>PAGAMENTOS:</b>
		</td><td align='right' width='20%'>
		<button onClick='javascript:novoPagamento(".$_POST['id_solicitacao'].");'>Novo Pagamento</button>
		</td></tr>
	</table>";
	
	$reg = $BD->get("select * from pagamentos where fk_solicitacao=".$_POST['id_solicitacao']." order by id desc");

		if( count($reg) > 0){
		
		$tabela = "<div class='div_de_tabelas'>
		<table class='table' border= '1' cellspacing ='0' >
			<tr>
			<th width='18%'>Tipo</th>
			<th width='17%'>Status</th>
			<th width='15%'>Status Pag.</th>
			<th width='12%'>valor (R$)</th>
			<th width='13%'>Mês/Ano</th>
			<th width='5%'>Num. Licen.</th>
			<th width='15%'>Código</th>
			<th width='5%'></th>
			</tr>";
		
		foreach($reg as $i=>$linha)
		$tabela .= "
			<tr>
			<td align = 'center'><a href='javascript:formAlteraPagamento(".$_POST['id_solicitacao'].", ".$linha['id'].");'>".$linha['tipo']."</a></td>
			<td align = 'center'>".$linha['status']."</td>
			<td align = 'center'>".$linha['status_pagamento']."</td>
			<td align = 'center'>".$linha['valor']."</td>
			<td align = 'center'>".$linha['mes']."/".$linha['ano']."</td>
			<td align = 'center'>".$linha['num_licencas']."</td>
			<td align = 'center'>".$linha['codigo']."</td>
			<td align = 'center'><button onClick='javascript:excluirPagamento(".$_POST['id_solicitacao'].", ".$linha['id'].");'>exc</button></td>
			</tr>";
	
		echo $tabela."</table></div>";
		}	
		else
		$this->nadaEncontrado();

	}
	
		
	
	
	
	
	
	public function excluirPagamento(){
		
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

	$BD = new Opcoes_BD_Gerais;
	
		if( !array_key_exists("id_solicitacao", $_POST) && !array_key_exists("id_pagamento", $_POST)){
		
		echo "Falha na exclusão.";	
		return;
		}

	
	$reg = $BD->get("select id from sistemas_ativados where fk_pagamento=".$_POST['id_pagamento']);

		if( count($reg) > 0){
		
			foreach($reg as $value){
			
				if(!$BD->deleta("sistemas_ativados", "id", $value['id'])){
				
				echo "Falha na exclusão.";	
				return;
				}
			}
		}
		
		if(!$BD->deleta("pagamentos", "id", $_POST['id_pagamento'])){
			
		echo "Falha na exclusão.";	
		return;
		}
			
	echo "SUCESSO_NA_GRAVACAO";
	}
	
	
	
	
	
	
	
	
/*********************************************************** novo pagamento *****************************************************************/

	
	
	
	public function formNovoPagamento(){
	
	$form = "		
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>NOVO PAGAMENTO</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='12%' align='left'>
				Tipo:<span style='color:red'>*</span><br>
					<select id='tipo_pagamento' style='width:98%' onchange='javascript:mudaTipoPagamento();'>
					<option value='MENSALIDADE'>Mensalidade</option>
					<option value='LICENCA'>Licença</option>
					<option value='PARCELA'>Parcela</option>
					<option value='INTEGRAL'>Integral</option>
					</select>
				</td><td width='13%' align='left'>		
				Status:<span style='color:red'>*</span><br>
					<select id='status_pagamento' style='width:98%'>
					<option value='AGUARDANDO'>Aguardando</option>
					<option value='CONFIRMADO'>Confirmado</option>
					</select>
				</td><td width='17%' align='left'>
				Valor:<span style='color:red'>*</span><br>
				<input type='text' id='valor_pagamento' value='' style='width:96%' maxlength='8' onchange='javascript:mascara(this, formatarMonetario);'>	
				</td><td width='10%' align='left'>
				Num de Licenças:<br>
				<input type='text' id='num_licencas' value='' style='width:96%' maxlength='6' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
				</td><td align='left' width='13%'>
				Mês/Ano:<span style='color:red'>*</span><br>
					<select id='mes_pagamento' style='width:30%'>
					<option value='01'>01</option>
					<option value='02'>02</option>
					<option value='03'>03</option>
					<option value='04'>04</option>
					<option value='05'>05</option>
					<option value='06'>06</option>
					<option value='07'>07</option>
					<option value='08'>08</option>
					<option value='09'>09</option>
					<option value='10'>10</option>
					<option value='11'>11</option>
					<option value='12'>12</option>
					</select>
				&nbsp;/&nbsp;<input type='text' id='ano_pagamento' value='' style='width:50%' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);'>
				</td><td align='left' width='10%'>
				Tempo de Licen.:<br>
				<input type='text' id='tempo_pagamento' value='30' style='width:98%' maxlength='3' onchange='javascript:mascara(this, formatarSomenteNum);'>
				</td><td align='left' width='15%'>
				Código:<br>
				<input type='text' id='cod_pagamento' value='' style='width:60%' maxlength='18' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
				<button style='width:30%;height:25px' onclick='javaacript:geraCodPagamento();'>Gerar</button>
				</td><td align='left' width='10%'>
				Solução:<br>
				".$this->getComboSolucoes("MENSALIDADE", 0)."
				</td></tr>
			</table>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;height:25px' onclick='javaacript:mostrarPagamentos(".$_POST['id_solicitacao'].");'>Voltar</button><button style='width:150px;margin-top:20px;height:25px' onclick='javaacript:salvaPagamento(".$_POST['id_solicitacao'].");'>Salvar</button>
		</td></tr>
	</table>";	

	echo $form;

	}
	
	
	
	
	private function getComboSolucoes($tipo,  $selecionado){
	
	
	$select = "<select id='combo_solucoes' style='width:98%' ".(strcmp($tipo, "MENSALIDADE") == 0?"disabled":"")."><option value=''>SELECIONE</option>";
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get("select id, nome, codigo from solucoes");

		if( count($reg) > 0){
		foreach($reg as $linha)
		$select  .= "<option value='".$linha['id']."' ".(strcmp($selecionado, $linha['id']) == 0?"selected":"").">".$linha['nome']." (".$linha['codigo'].")</option>";
		}	
	
	return $select."</select>";
	}
	
	

	
	
	public function validaPagamento(){
	
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
		
	return "";
	}

	
	
	
	
	public function salvaPagamento(){
	
	$erros = $this->validaPagamento();
	
		if(strlen($erros) == 0){
		
		include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
	
		$campos[] = "tipo";
		$campos[] = "status";
		$campos[] = "status_pagamento";
		$campos[] = "valor";
		$campos[] = "num_licencas";
		$campos[] = "mes";
		$campos[] = "ano";
		$campos[] = "codigo";
		$campos[] = "fk_solicitacao";
		$campos[] = "fk_solucao";
		$campos[] = "num_de_dias";
		

		$valores[] = $_POST['tipo'];
		$valores[] = "ABERTO";
		$valores[] = $_POST['status'];
		$valores[] = $_POST['valor'];
		$valores[] = $_POST['num_licencas'];
		$valores[] = $_POST['mes'];
		$valores[] = $_POST['ano'];
		$valores[] = $_POST['cod'];
		$valores[] = $_POST['id_solicitacao'];
		$valores[] = $_POST['solucao'];
		$valores[] = $_POST['tempo'];
		
		
			if(!$BD->aDD("pagamentos", $campos, $valores)){
				
			echo "Falha na gravação, por favor, tente novamente.";	
			return;
			}
			
		echo "SUCESSO_NA_GRAVACAO";
		}
	
	echo $erros;
	}
	
	
	
	
	
	
	public function geraCodPagamento(){

	$cod = date("dmY");
	
	echo $cod . str_pad(rand(1, 99999999), 8, "0", STR_PAD_LEFT);
	}
	
	
	
	
/*********************************************************** altera pagamento *****************************************************************/
	
	
	
		
	public function formAlteraPagamento(){
	
	if( !array_key_exists("id_pagamento", $_POST) ||!array_key_exists("id_solicitacao", $_POST))
	return;
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	include_once '../../libs/Biblioteca.class.php';

	$bib = new Biblioteca;
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select * from pagamentos where id=".$_POST['id_pagamento']." order by id desc");

	if( count($reg) == 0)
	return;
	
	$value = $reg[0];
	
	$form = "		
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>ALTERAÇÃO DE PAGAMENTO</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='12%' align='left'>
				Tipo:<span style='color:red'>*</span><br>
					<select id='tipo_pagamento' style='width:98%' onchange='javascript:mudaTipoPagamento();'>";
					
					foreach(array('MENSALIDADE','LICENCA','PARCELA', 'INTEGRAL') as $aux)
					$form .= "<option value='".$aux."' ".(strcmp($aux, $value['tipo'])==0?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>
				</td><td width='13%' align='left'>		
				Status Pag.:<span style='color:red'>*</span><br>
					<select id='status_pagamento' style='width:98%'>";
					
					foreach(array('AGUARDANDO', 'CONFIRMADO') as $aux)
					$form .= "<option value='".$aux."' ".(strcmp($aux, $value['status_pagamento'])==0?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>
				</td><td width='10%' align='left'>		
				Status Licen.:<span style='color:red'>*</span><br>
					<select id='status_licen_pagamento' style='width:98%'>";
					
					foreach(array('ABERTO', 'FECHADO') as $aux)
					$form .= "<option value='".$aux."' ".(strcmp($aux, $value['status'])==0?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>			
				</td><td width='10%' align='left'>
				Valor:<span style='color:red'>*</span><br>
				<input type='text' id='valor_pagamento' value='".$value['valor']."' style='width:96%' maxlength='8' onchange='javascript:mascara(this, formatarMonetario);'>	
				</td><td width='10%' align='left'>
				Num de Licenças:<br>
				<input type='text' id='num_licencas' value='".$value['num_licencas']."' style='width:96%' maxlength='6' onchange='javascript:mascara(this, formatarSomenteNum);' ".(strcmp("LICENCA", $value['tipo'])==0?"":"disabled").">
				</td><td align='left' width='10%'>
				Mês/Ano:<span style='color:red'>*</span><br>
					<select id='mes_pagamento' style='width:30%'>";
					
					foreach(array('01','02','03','04','05','06','07','08','09','10','11','12') as $aux)
					$form .= "<option value='".$aux."' ".($aux== $value['mes']?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>
				&nbsp;/&nbsp;<input type='text' id='ano_pagamento' value='".$value['ano']."' style='width:55%' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);'>
				</td><td align='left' width='10%'>
				Tempo de Licen.:<br>
				<input type='text' id='tempo_pagamento' value='".$value['num_de_dias']."' style='width:98%' maxlength='3' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
				</td><td align='left' width='15%'>
				Código:<br>
				<input type='text' id='cod_pagamento' value='".$value['codigo']."' style='width:60%' maxlength='18' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
				</td><td align='left' width='10%'>
				Solução:<br>
				".$this->getComboSolucoes($value['tipo'], $value['fk_solucao'])."
				</td></tr>
			</table>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;height:25px' onclick='javaacript:mostrarPagamentos(".$_POST['id_solicitacao'].");'>Voltar</button><button style='width:150px;margin-top:20px;height:25px' onclick='javaacript:alteraPagamento(".$_POST['id_solicitacao'].", ".$_POST['id_pagamento'].");'>Salvar</button>
		</td></tr>
	</table>";	

	echo $form;
	
	}
	
	
	
	
	
	public function alteraPagamento(){
	
	$erros = $this->validaPagamento();
	
		if(strlen($erros) == 0){
		
		include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

		$BD = new Opcoes_BD_Gerais;

		$campos = array();
		$valores = array();
	
		$campos[] = "tipo";
		$campos[] = "status_pagamento";
		$campos[] = "valor";
		$campos[] = "num_licencas";
		$campos[] = "mes";
		$campos[] = "ano";
		$campos[] = "status";
		$campos[] = "fk_solucao";
		
		
		$valores[] = $_POST['tipo'];
		$valores[] = $_POST['status'];
		$valores[] = $_POST['valor'];
		$valores[] = $_POST['num_licencas'];
		$valores[] = $_POST['mes'];
		$valores[] = $_POST['ano'];
		$valores[] = $_POST['status_licen'];
		$valores[] = $_POST['solucao'];


		
		
			if(!$BD->atualiza("pagamentos", "id", $_POST['id_pagamento'], $campos, $valores)){
				
			echo "Falha na gravação, por favor, tente novamente.";	
			return;
			}
			
		echo "SUCESSO_NA_GRAVACAO";
		}
	
	echo $erros;
	}
	
	
	
	
/*********************************************************** chamados *****************************************************************/

	
	
		
	public function mostrarChamados(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

	$BD = new Opcoes_BD_Gerais;
	
	if( !array_key_exists("id_cliente", $_POST))
	return;
	
	echo "
	<table width='100%' style='color:#FFF'>
		<tr><td align='left' width='80%'>
		<img src='/imgs/icon_arrow.png' class='marcador'><b>CHAMADOS:</b>
		</td><td align='right' width='20%'>
		</td></tr>
	</table>";
	
	$reg = array();
		foreach(array('PENDENTE', 'EM ATENDIMENTO', 'TERMINADO') as $status){
		
		$aux = $BD->get("select * from chamados where fk_cliente=".$_POST['id_cliente']." and status= '".$status."' order by id desc");
		if($aux != null)
		$reg = array_merge($reg, $aux);
		}

	
	if( count($reg) > 0){
		
		$tabela = "<div class='div_de_tabelas'>
		<table class='table' border= '1' cellspacing ='0' >
			<tr>
			<th width='15%'>Status</th>
			<th width='30%'>Assunto</th>
			<th width='45%'>Descrição</th>
			<th width='10%'>Data</th>
			</tr>";
		
			foreach($reg as $i=>$linha){
			
			$color = "#FFF";
				switch($linha['status']){
				
				case "PENDENTE":
				$color = "red";
				break;
					case "EM ATENDIMENTO":
					$color = "#F2CE57";
					break;
						case "TERMINADO":
						$color = "green";
						break;
				}
			
			$tabela .= "
				<tr>
				<td align = 'center'><span style='color:".$color."'>".$linha['status']."</span></td>
				<td align = 'center'><a href='javascript:formAlteraChamado(".$_POST['id_cliente'].", ".$linha['id'].");'>".$linha['assunto']."</a></td>
				<td align = 'center'>".$linha['descricao']."</td>
				<td align = 'center'>".$linha['data_cadastro']."</td>
				</tr>";
			}
		echo $tabela."</table></div>";
		
		}	
		else
		$this->nadaEncontrado();

	}
	
	
	
/*********************************************************** altera chamados *****************************************************************/


	
	public function formAlteraChamado(){
	
	if( !array_key_exists("id_cliente", $_POST) ||!array_key_exists("id_chamado", $_POST))
	return;
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	include_once '../../libs/Biblioteca.class.php';

	$bib = new Biblioteca;
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select * from chamados where id=".$_POST['id_chamado']);

	if( count($reg) == 0)
	return;
	
	$value = $reg[0];
	
	$form = "		
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>ALTERAÇÃO DE CHAMADO</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td align='left' colspan='2'>
				Assunto:<span style='color:red'>*</span><br>
				<input type='text' id='assunto_chama' value='".$value['assunto']."' style='width:98%' maxlength='200' disabled>	
				</td><td width='20%' align='left'>		
				Status:<span style='color:red'>*</span><br>
					<select id='status_chama' style='width:98%'>";
						
					foreach(array('PENDENTE','EM ATENDIMENTO', 'TERMINADO') as $aux)
					$form .= "<option value='".$aux."' ".(strcmp($aux, $value['status'])==0?"selected":"").">".$aux."</option>";
					
					$form .= "
					</select>
				</td></tr><tr><td align='left' colspan='3'>
				Descrição:<span style='color:red'>*</span><br>
				<textarea id='descricao_chama' style='width:99.4%;height:50px' disabled>".$value['descricao']."</textarea>
				</td></tr><tr><td align='left' width='30%'>
				Obs:<br>
				<input type='text' id='obs_chama' value='".$value['obs']."' style='width:98%'>
				</td><td align='left' width='50%'>
				Solução:<br>
				<input type='text' id='solucao_chama' value='".$value['solucao']."' style='width:99%'>
				</td><td align='left'>
				Anexo:<br>".(strlen($value['nome_doc_anexo']) == 0?"Sem Anexo":"<a href='/docs/".$value['nome_doc_anexo']."'>".$value['nome_doc_anexo']."</a>")."
				</td></tr><tr><td align='left' colspan='3'>
					<table width='100%'>
						<tr><td width='20%' align='left'>
						Data: ".$value['data_cadastro']."
						</td><td align='center' width='60%'>
						<button style='width:150px;height:25px' onclick='javaacript:mostrarChamados(".$_POST['id_cliente'].");'>Voltar</button><button style='width:150px;margin-top:20px;height:25px' onclick='javaacript:alteraChamado(".$_POST['id_cliente'].", ".$_POST['id_chamado'].");'>Salvar</button>
						</td><td align='left' width='20%'>
						</td></tr>
					</table>
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<div align='right'><button style='width:150px;height:25px' onclick='javaacript:novoAssentamento(".$_POST['id_cliente'].", ".$_POST['id_chamado'].");'>Novo Assentamento</button></v>
			<div class='div_de_tabelas' id='div_assentamentos'>";

	$reg = $BD->get("select * from assentamentos where fk_chamado=".$_POST['id_chamado']);

		if( count($reg) > 0){
		
		$form .= "
				<table class='table' border= '1' cellspacing ='0' style='color:#000'>
					<tr>
					<th width='75%'>Assentamento</th>
					<th width='11%'>Autor</th>
					<th width='14%'>Data</th>
					</tr>";
		
		foreach($reg as $i=>$linha)
		$form .= "
					<tr>
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
	
	
	
	
	

	
	public function alteraChamado(){
		
	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

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
	
		
		if(!$BD->atualiza("chamados", "id", $_POST['id_chamado'], $campos, $valores)){
				
		echo "Falha na gravação, por favor, tente novamente.";	
		return;
		}
			
	echo "SUCESSO_NA_GRAVACAO";
	}
	
	
	
	
	
	
	public function formNovoAssentamento(){
	
	$form = "		
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>NOVO ASSENTAMENTO</b>
		</td></tr><tr><td align='left'>
		Assentamento:<span style='color:red'>*</span><br>
		<textarea id='assentamento' style='width:99.4%;height:50px'></textarea>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;height:25px' onclick='javaacript:formAlteraChamado(".$_POST['id_cliente'].", ".$_POST['id_chamado'].");'>Voltar</button><button style='width:150px;margin-top:20px;height:25px' onclick='javaacript:salvaAssetamento(".$_POST['id_cliente'].", ".$_POST['id_chamado'].");'>Salvar</button>
		</td></tr>
	</table>";	

	echo $form;
	}
	
	
	
	
	
	
	public function salvaAssetamento(){
	
		if(strlen($_POST['assentamento']) == 0){
		echo "informe um assentamento.";
		return;
		}
		
	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

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
	$valores[] = $_POST['id_chamado'];
		
		
		if(!$BD->aDD("assentamentos", $campos, $valores)){
				
		echo "Falha na gravação, por favor, tente novamente.";	
		return;
		}
			
	echo "SUCESSO_NA_GRAVACAO";
	}
	
	
	
	
	
	
	public function getNotificacoesDeChamados(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

	$BD = new Opcoes_BD_Gerais;
	
	echo "
	<table width='100%' style='color:#FFF'>
		<tr><td align='left' width='80%'>
		<img src='/imgs/icon_arrow.png' class='marcador'><b>CHAMADOS PENDENTES:</b>
		</td><td align='right' width='20%'>
		</td></tr>
	</table>";
	
	$reg = $BD->get("select chamados.assunto, chamados.data_cadastro, clientes.nome_razao from chamados inner join clientes on chamados.fk_cliente = clientes.id where status= 'PENDENTE' order by chamados.id desc");

		if( count($reg) > 0){
		
		$tabela = "
		<div class='div_de_tabelas' style='height:150px'>
			<table class='table' border= '1' cellspacing ='0' >
				<tr>
				<th width='30%'>Cliente</th>
				<th width='60%'>Assunto</th>
				<th width='10%'>Data</th>
				</tr>";
		
		foreach($reg as $i=>$linha)	
		$tabela .= "
				<tr>
				<td align = 'left'>".$linha['nome_razao']."</td>
				<td align = 'left'>".$linha['assunto']."</td>
				<td align = 'center'>".$linha['data_cadastro']."</td>
				</tr>";
	
		echo $tabela."</table></div>";
		}	
		else
		echo "<div class='div_de_tabelas' align='center' style='height:100px;line-height:100px'>&laquo;Nenhum Chamado Pendente&raquo;</div>";

		
	echo "
	<table width='100%' style='color:#FFF'>
		<tr><td align='left' width='80%'>
		<img src='/imgs/icon_arrow.png' class='marcador'><b>CHAMADOS EM ATENDIMENTO:</b>
		</td><td align='right' width='20%'>
		</td></tr>
	</table>";
	
	$reg = $BD->get("select chamados.assunto, chamados.data_cadastro, clientes.nome_razao from chamados inner join clientes on chamados.fk_cliente = clientes.id where status= 'EM ATENDIMENTO' order by chamados.id desc");

		if( count($reg) > 0){
		
		$tabela = "
		<div class='div_de_tabelas' style='height:150px'>
			<table class='table' border= '1' cellspacing ='0' >
				<tr>
				<th width='30%'>Cliente</th>
				<th width='60%'>Assunto</th>
				<th width='10%'>Data</th>
				</tr>";
		
		foreach($reg as $i=>$linha)	
		$tabela .= "
				<tr>
				<td align = 'left'>".$linha['nome_razao']."</td>
				<td align = 'left'>".$linha['assunto']."</td>
				<td align = 'center'>".$linha['data_cadastro']."</td>
				</tr>";
	
		echo $tabela."</table></div>";
		}	
		else
		echo "<div class='div_de_tabelas' align='center' style='height:100px;line-height:100px'>&laquo;Nenhum Chamado Pendente&raquo;</div>";	
		
	}
	
	

	
/*********************************************************** solucoes *****************************************************************/

	

		
	public function mostrarSolucoes(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

	$BD = new Opcoes_BD_Gerais;
	
	echo "
	<table width='100%' style='color:#FFF'>
		<tr><td align='left' width='80%'>
		<img src='/imgs/icon_arrow.png' class='marcador'><b>SOLUÇÕES:</b>
		</td><td align='right' width='20%'>
		<button onClick='javascript:novaSolucao();' style='width:120px;height:25px'>Nova Solução</button>
		</td></tr>
	</table>";
	
	$reg = $BD->get("select * from solucoes order by id desc");

		if( count($reg) > 0){
		
		$tabela = "
		<div class='div_de_tabelas'>
			<table class='table' border= '1' cellspacing ='0' >
			<tr>
			<th width='35%'>Nome</th>
			<th width='15%'>Código</th>
			<th width='50%'>Descrição</th>
			</tr>";
		
		foreach($reg as $i=>$linha)
		$tabela .= "
				<tr>
				<td align = 'center'>".$linha['nome']."</td>
				<td align = 'center'>".$linha['codigo']."</td>
				<td align = 'center'>".$linha['descricao']."</td>
				</tr>";
			
		echo $tabela."</table></div>";
		
		}	
		else
		$this->nadaEncontrado();

	}
	
	


/*********************************************************** nova solucao *****************************************************************/



	public function formNovaSolucao(){
	
	$form = "		
	<table width='100%' style='color:#FFF;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>NOVA SOLUÇÂO</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td width='35%' align='left'>
				Nome:<span style='color:red'>*</span><br>
				<input type='text' id='nome_solucao' value='' style='width:98%' maxlength='200'>	
				</td><td width='45%' align='left'>		
				Descrição:<br>
				<input type='text' id='descricao_solucao' value='' style='width:98%' maxlength='200'>		
				</td><td align='left' width='20%'>
				Código:<span style='color:red'>*</span><br>
				<input type='text' id='cod_solucao' value='' style='width:60%' maxlength='18' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
				<button style='width:30%;height:25px' onclick='javaacript:geraCodSolucao();'>Gerar</button>
				</td></tr>
			</table>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;height:25px' onclick='javaacript:mostrarSolucoes();'>Voltar</button><button style='width:150px;margin-top:20px;height:25px' onclick='javaacript:salvaSolucao();'>Salvar</button>
		</td></tr>
	</table>";	

	echo $form;
	}
	
	


	
	public function geraCodSolucao(){
	
	
	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

	$BD = new Opcoes_BD_Gerais;
	
	$cod = "";
		for($i = 0; $i< 10; $i++){
	
		$cod = str_pad(rand(1, 9999), 4, "0", STR_PAD_LEFT);
		
			if(count($BD->get("select id form solucoes where codigo='".$cod."'")) == 0){
			
			echo $cod;
			return;
			}
		}
		
	echo "";
	}


	
	
	
	public function salvaSolucao(){
	
		if(strlen($_POST['nome']) == 0){
		echo "informe o nome da solução.";
		return;
		}
		
		if(strlen($_POST['cod']) == 0){
		echo "Gere o código da solução.";
		return;
		}

		
	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

	$BD = new Opcoes_BD_Gerais;

	$campos = array();
	$valores = array();
	
	$campos[] = "nome";
	$campos[] = "descricao";
	$campos[] = "codigo";
			
	$valores[] = $_POST['nome'];
	$valores[] = $_POST['descricao'];
	$valores[] = $_POST['cod'];
		
		
		if(!$BD->aDD("solucoes", $campos, $valores)){
				
		echo "Falha na gravação, por favor, tente novamente.";	
		return;
		}
			
	echo "SUCESSO_NA_GRAVACAO";
	}
	
	
	
	
	
	
	
	

	
	
}
?>