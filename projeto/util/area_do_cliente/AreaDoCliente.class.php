<?php
if(!isset($_SESSION))
session_start();

header('Content-type: text/html; charset=UTF-8');




final class AreaDoCliente{




/********************************************************************************************* login *************************************************************************************/



	public function login(){
	
	if( array_key_exists( "id_user", $_SESSION) &&
	array_key_exists( "nome_user", $_SESSION) &&
	$_SESSION["id_user"] > 0 &&
	strlen($_SESSION["nome_user"]) > 0)
	$this->getAreaDoCliente();
	else
	$this->getFormLogin();
	}





	private function getFormLogin(){
	
	echo "<br><br><br>
			<table id='tb_login'>
					<tr><td align='center' width='50%' valign='top'>
						<div style='width:100%;margin: 20px 0px 0px 0px;font-size:16px' align='center'><b>Área do Cliente</b></div>
						<div style='width:80%;margin: 30px 0px 0px 0px;font-size:14px' align='left'>
						Usuário:<br>
						<input type='text' id='usuario' style='width:99%;height:23px' maxlengh='250'>
						<br>Senha:<br>
						<input type='password' id='senha' style='width:99%;height:23px' maxlengh='20'>
						</div>
						<div align='center' style='width:100%;margin: 20px 0px 0px 0px;font-size:16px'>
						<button id='bt_entrar' style='width:40%;height:27px'>Entrar</button>
						</div>		
					</td><td align='center' width='50%'>
					<img src='../../imgs/icon_cliente.png' style='margin: 10px 0px 20px 0px;height:200px'>
						<div style='margin: 10px 0px 10px 0px'>
						<p align='center' style='font-size:12px'>\"O único lugar onde o sucesso vem antes do trabalho é no dicionário.\"</p>
						<p align='right' style='font-size:12px'>(Albert Einstein)</p>
						</div>
					</td></tr>
				</table>";
	
	}



	
	
	public function logar(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	include_once '../../libs/Biblioteca.class.php';

	$BD= new Opcoes_BD_Gerais;

	$biblioteca = new Biblioteca();


	$_POST["usuario"] = $biblioteca->anti_injection( $_POST["usuario"]);
	$_POST["senha"] = $biblioteca->anti_injection($_POST["senha"]);


		if( strlen($_POST["usuario"] )== 0 || strlen ($_POST["senha"] ) < 6 ){
		
		echo '{"status": false, "erro":"Usuário ou senha inválida."}';
		return;
		}

		
	$reg = $BD->get("select id, nome_razao from clientes where (email = '".$_POST["usuario"] ."' or nome_usuario='".$_POST["usuario"]."' ) and password = '".  md5($_POST["senha"])."'");

		if( count($reg) == 0 ){
		
		echo '{"status": false, "erro":"Usuário ou senha inválida."}';
		return;
		}

	
	$_SESSION["id_user"]  = $reg[0]['id'];
	$_SESSION["nome_user"]  = $reg[0]['nome_razao'];
	
	echo '{"status": true}';
	}
	
	
	
	
	
	public function logoff(){
	
	unset ($_SESSION["id_user"]);
	unset ($_SESSION["nome_user"]);
	
	echo '{"status": true}';
	}
	
	
	
	
	
/********************************************************************************************* geral *************************************************************************************/
	
	
		
	
	
	private function getAreaDoCliente(){

	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD= new Opcoes_BD_Gerais;
	
	echo "
		<table width='100%'>
			<tr><td align='left' width='10%'>
			</td><td align='center' width='80%'>
			<div align='center' class='titulo_geral'><b>Área do Cliente</b></div>
			</td><td align='center' width='10%'>
			<img src='../../imgs/icon_sair.png' style='width:30px' id='bt_sair' title='sair'>
			</td></tr>
		</table>";
		
	$this->getDadosCadastrais($BD);
	$this->getDadosSolicitacoes($BD);
	$this->getChamados();
	
	echo $this->getManuais();
	
	echo "
	<div id='div_get_pagamento' align='center'>
		<div align='right' style='padding:5px'><a href='javascript:fechar();'><img src='../../imgs/fechar.png' title='Fechar'></a></div>
		<div id='div_get_pagamento_area' align='center'></div>
	</div>	";
	}
	
	
	
	

/********************************************************************************************* abas de opcoes *************************************************************************************/
	
	
	
	
	private function getDadosCadastrais(&$BD){
	
	
	$form = "
	<div class='div_conteudo' align='center'>
		<div class='sessao' align='left'>
		<img src='../../imgs/icon_ok.png' class='mark'><b>Seus Dados Cadastrais:</b><a href='javascript:mostrarAba(\"div_info_cadastrais\");'><img src='../../imgs/seta_pra_baixo.png' class='seta_aba' title='Mostrar dados cadastrais'></a>
		</div>
		<div class='aba' id='div_info_cadastrais'>";
		
	$reg = $BD->get("select * from clientes where id = ".$_SESSION["id_user"]);

	if( count($reg) == 0 )
	$form .= "<div class='aviso_erro'>Dados cadastrais não encontrados.</div>";
		else{

		$form .= "
			<table width='100%'>
				<tr><td width='30%' align='left'>
				Nome/Rarão Social:<br>
				<input type='text' id='nome_razao' value='".$reg[0]['nome_razao']."' style='width:98%' readOnly>
				</td><td width='20%' align='left'>
				CPF/CNPJ:<br>
				<input type='text' id='cpf_cnpj' value='".$reg[0]['cpf_cnpj']."' style='width:98%' readOnly>
				</td><td width='30%' align='left'>		
				E-mail:<br>
				<input type='text' id='email' value='".$reg[0]['email']."' style='width:98%' readOnly>
				</td><td width='20%' align='left'>		
				Nome de Usuário:<br>
				<input type='text' id='nome_user' value='".$reg[0]['nome_usuario']."' style='width:98%' readOnly>
				</td></tr><tr><td align='left'>
				Nome Contato:<br>
				<input type='text' id='nome_contato' value='".$reg[0]['nome_contato']."' style='width:98%' readOnly>
				</td><td align='left' colspan='3'>
					<table width='100%' margin=0>
						<tr><td width='50%' align='left' >
						<br>Telefone:<br>
						<input type='text' value='".$reg[0]['tel_1']."' style='width:98%' id='tel_1' readOnly>
						</td><td width='50%' align='left' >
						<br>Telefone:<br>
						<input type='text' value='".$reg[0]['tel_2']."' style='width:98%' id='tel_2' readOnly>
						</td></tr>
					</table>
				</td></tr><tr><td align='left' colspan='4'>
				Descrição Empresa:<br>
				<input type='text' id='descricao_empresa' value='".$reg[0]['descricao_empresa']."' style='width:98%' readOnly>
				</td></tr><tr><td align='left' colspan='3'>
				Informações Complementares:<br>
				<input type='text' id='outras_info' value='".$reg[0]['outras_info_empresa']."' style='width:98%' readOnly>
				</td></tr><tr><td align='left' colspan='3'>
					<table width='100%'>
						<tr><td width='30%' align='left' >
						Logradouro:<br>
						<input type='text' id='logradouro' style='width:98%' value='".$reg[0]['logradouro']."' readOnly>
						</td><td width='15%' align='left'>
						Número:<br>
						<input type='text' id='num' style='width:98%' value='".$reg[0]['num_residencia']."' readOnly>
						</td><td width='15%' align='left'>
						CEP:<br>
						<input type='text' id='cep' style='width:98%' value='".$reg[0]['cep']."' readOnly>
						</td><td width='25%' align='left'>
						Cidade:<br>
						<input type='text' id='cidade' style='width:98%' value='".$reg[0]['cidade']."' readOnly>
						</td><td width='15%' align='left'>
						Estado (UF):<br>
						<input type='text' id='uf' style='width:98%' value='".$reg[0]['uf']."' readOnly>
						</td></tr>
					</table>
				</td></tr>
			</table>";
		}		

	echo $form."
	
			<div align='left' style='padding:10px 0px 20px 10px;'><img src='../../imgs/icon_exclamacao.png' class='mark' style='vertical-align: middle'>
			Se alguma informação estiver incorreta, por favor, entre em contato conosco <a href='http://localhost/util/contato/'>clicando aqui.</a>
			</div>
		</div>
	</div>";
	}
	
	
	
	
	
	
	
	private function getDadosSolicitacoes(&$BD){
	
	$form = "
	<div class='div_conteudo' align='center'>
		<div class='sessao' align='left'>
		<img src='../../imgs/icon_ok.png' class='mark'><b>Suas Solicitações:</b><a href='javascript:mostrarAba(\"div_info_solicitacoes\");'><img src='../../imgs/seta_pra_baixo.png' class='seta_aba' title='Mostrar dados de solicitações'></a>
		</div>
		<div class='aba' id='div_info_solicitacoes'>";
		
	$reg = $BD->get("select * from solicitacoes where fk_id_cliente = ".$_SESSION["id_user"]);

	if( count($reg) == 0 )
	$form .= "<div class='aviso_erro'>Nenhuma Solicitação Cadastrada.</div>";
		else{

		$form .= "
			<table class='tb'>
				<tr>
				<th width='20%' align='center'>Solução</th>
				<th width='12%' align='center'>Status</th>
				<th width='68%' align='center'>Pagamentos</th>
				</tr>";
		
		foreach ($reg as $value)
		$form .= "
				<tr>
				<td align='left' valign='top'><img src='../../imgs/icon_arrow.png' class='icon_seta'>".$value['solucao']." (".$value['codigo'].")</td>
				<td align='center' valign='top'>".$value['status']."</td>
				<td align='center' valign='top'><div align='center' class='div_de_tabelas' style='height:100px'>".$this->getPagamentos($value['id'], $BD)."</div></td>
				</tr>";
			
		$form .= "</table>";	
		}
		
	$form .="
			<div align='center' style='margin:5px 0px 10px 0px'>
				<div class='titulo_geral' align='center'><b>Formas de Pagamento disponíveis:</b></div>
			<img src='../../imgs/formas_de_pag.jpg' style='width:90%'>
			</div>
			<div align='left' style='padding:10px 0px 10px 10px;'>
			<img src='../../imgs/icon_exclamacao.png' class='mark' style='vertical-align: middle'>
			Usamos o PagSeguro da UOL para transações na WEB. Basta logar na sua conta (caso não tenha, o cadastro é simples e rápido), escolher a forma de pagamento desejada e pronto! Aprovações são realizadas na hora!<br>
			<img src='../../imgs/icon_exclamacao.png' class='mark' style='vertical-align: middle'>
			É adicionado 2,49% (taxa de serviço bancário não relacionada à MSC Soluções) ao mês para pagamentos via cartão de crédito a partir de duas parcelas.<br>
			<img src='../../imgs/icon_exclamacao.png' class='mark' style='vertical-align: middle'>
			Todos os valores de licença ou mensalidades estão reajustados com 5% de desconto para pagamento por transferência/depósito bancário. Outras formas de pagamento não incluem desconto.
			<br>
			</div>
		</div>
	</div>";	
		
		
	echo $form;
	}
	
	
	
	
	
	
	
	public final function getChamados(){

	$opcoes = "
	<div class='div_conteudo' align='center'>
		<div class='sessao' align='left'>
		<img src='../../imgs/icon_ok.png' class='mark'><b>Seus Chamados (HelpDesk):</b><a href='javascript:mostrarAba(\"div_info_chamados\");'><img src='../../imgs/seta_pra_baixo.png' class='seta_aba' title='Mostrar chamados'></a>
		</div>
		<div class='aba' id='div_info_chamados'>
			<table width='100%'>
				<tr><td align='left' width='40%'>
				<b>Assunto:</b><br>
				<input type=\"text\" name=\"nome_pesq\" id=\"nome_pesq\"  value=\"\" maxlength=\"200\" style=\"width:98%\"/>
				</td><td align='left' width='40%'><br>
				<button onClick='javascript:pesquisar();' style='width:120px;height:25px'>Pesquisar</button>
				<button onClick='javascript:ultimos();' style='width:120px;height:25px'>Ver 10 últimos</button>
				</td><td align='right' width='20%'><br>
				<button onClick='javascript:formNovoChamado();' style='width:120px;height:25px'>Novo Chamado</button>
				</td></tr>
			</table>
			<div id='resultado_de_pesquisa' align='center' class='div_de_tabelas'>
			".$this->nadaEncontrado()."
			</div>
			<div align='left' style='padding:10px 0px 10px 10px;'><img src='../../imgs/icon_exclamacao.png' class='mark' style='vertical-align: middle'>
			Ocorreu algum problema com um de nossos produtos ou você tem alguma dúvida? Abra um chamado, responderemos o mais rápido possível.</a>
			</div>
			<div id='div_chamados'></div>
		</div>
	</div>";
	
	echo $opcoes;
	}


	
	
	
	
		
/********************************************************************************************* pagamentos *************************************************************************************/

	
	
	private function getPagamentos($id_solicitacao, &$BD){
	
		
	$reg = $BD->get("select * from pagamentos where fk_solicitacao = ".$id_solicitacao." order by id DESC");

	$form = "";
	
	if( count($reg) == 0 )
	$form .= "<p style='line-height:100px'>Nenhuma Pagamento Cadastrado</p>";
		else{

		$form .= "
		<table class='tb'>
			<tr>
			<th width=25%' align='center'>Tipo</th>
			<th width='15%' align='center'>Status</th>
			<th width='20%' align='center'>Valor</th>
			<th width='20%' align='center'>Mes/Ano</th>
			<th width='20%' align='center'>Pagar</th>
			</tr>";
		
		foreach ($reg as $value)
		$form .= "
			<tr>
			<td align='left'>".$value['tipo']."</td>
			<td align='center'>".$value['status']."</td>
			<td align='center'>R$: ".$value['valor']."</td>
			<td align='center'>".$value['mes']."/".$value['ano']."</td>
			<td align='center'>".(strcmp($value['status'], "ABERTO") == 0? "<a href='javascript:realizarPagamento(".$value['id'].");'>PAGAR</a>":"CONFIRMADO")."</td>
			</tr>";
			
		$form .= "</table>";	
		}
			
	return $form;
	}
	
	
	
	
	
/********************************************************************************************* realizar pagamentos *************************************************************************************/


	
	
	public function realizarPagamento(){
	
		if(!array_key_exists("id_pagamento", $_POST)){
		
		echo "ERRO COD:001";
		return;
		}
		
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	include_once '../../libs/Biblioteca_Financeira.class.php';
	
	
	$BD= new Opcoes_BD_Gerais;
	$bib= new Biblioteca_Financeira;
	
	$reg = $BD->get("select pagamentos.*, solucoes.codigo as sol_cod  from pagamentos left outer join solucoes on pagamentos.fk_solucao = solucoes.id where pagamentos.id = ".$_POST['id_pagamento']);


		if( count($reg) == 0 ){
		
		echo "ERRO COD:002";
		return;
		}
	
	
	include_once 'PagSeguroLibrary/PagSeguroLibrary.php';	
	
	$paymentRequest = new PagSeguroPaymentRequest();  
	
	$valor_desconto = $bib->formataMoeda($reg[0]['valor']);
	$valor_normal = $bib->formataMoeda(
									$bib->soma(array($reg[0]['valor'], 
										$bib->dividi(
											$bib->multiplica($reg[0]['valor'], "5,00"), "100"))));
	
	
	$valor = str_replace( ",", ".",  str_replace(".", "", str_replace( " ", "", $valor_normal))); 
	
		if( strlen($valor) == 0 ){
		
		echo "ERRO COD:003";
		return;
		}
	
	
    $paymentRequest->addItem($reg[0]['codigo'], $reg[0]['tipo']."-".$reg[0]['mes']."/".$reg[0]['ano']."-".$reg[0]['sol_cod'], 1, $valor);  
	$paymentRequest->setCurrency("BRL");  
	$paymentRequest->setRedirectUrl("http://www.mscsolucoes.com.br/util/area_do_cliente/");  
  
  
	    try {  
      
		$credentials = PagSeguroConfig::getAccountCredentials();  
		$checkoutUrl = $paymentRequest->register($credentials);  
      
		} catch (PagSeguroServiceException $e) {  
		
		echo "ERRO COD:004";
		return;
		}  
	
	echo '{"url_pag":"'.$checkoutUrl.'", "valor_desconto":"'.$valor_desconto.'", "valor_normal":"'.$valor_normal.'"}';
	}
	
	
	
	
	
/********************************************************************************************* chamados *************************************************************************************/
	
	


	public function resultadoPesquisaDeChamados(){
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get("select id, assunto, status, data_cadastro from chamados ".$this->getQueryTermos()." order by id desc ".(strlen($_POST["termo"])==0?"limit 10":""));

		if( count($reg) > 0){
		
		$tabela = "
				<table class='tb' border='1' cellspacing ='0'>
					<tr>
					<th width='60%'>Assunto</th>
					<th width='20%'>Status</th>
					<th width='20%'>Data</th>
					</tr>";
		
		foreach($reg as $linha)
		$tabela .= "
					<tr>
					<td align = 'left'>".$linha['assunto']." (<a href='javascript:formAlteraChamado(".$linha['id'].");'>Ver Completo</a>)</td>
					<td align = 'center'>".$linha['status']."</td>
					<td align = 'center'>".$linha['data_cadastro']."</td>
					</tr>";
	
		
		echo $tabela."</table>";
		}	
		else
		echo $this->nadaEncontrado();
	
	}





	private function getQueryTermos(){
	
	if( strlen( $_POST["termo"] ) == 0) 
	return "";
	
	$tokens_do_termo = explode(' ', $_POST["termo"]);
	
	$query_termo = " where (";
		
		foreach($tokens_do_termo as $j => $value){
		
		$query_termo .= "assunto like '%".$value."%'";
		
		if( $j < count($tokens_do_termo) -1)
		$query_termo .= " || ";
		}
		
	return $query_termo.")";	
	}
	
	

	
	
	private function nadaEncontrado(){
	
	return "<p align='center' style = \"background:#EEE;min-height: 200px;text-align:center;line-height:200px;width:100%;margin: 10px 0px 0px 0px\">&laquo;Nada Encontrado&raquo;</p>";
	}
	
		
	
	

	
	public final function formNovoChamado(){
	
	$form = "		
	<table width='100%' style='border:solid 1px #000'>
		<tr><td align='center'>
		<b>Novo Chamado</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td align='left' colspan='2'>
				Assunto:<span style='color:red'>*</span><br>
				<input type='text' id='assunto_chama' value='' style='width:99%' maxlength='200'>	
				</td></tr><tr><td align='left' colspan='2'>		
				Descrição:<span style='color:red'>*</span><br>
				<textarea id='descricao_chama' style='width:99.4%;height:70px'></textarea>
				</td></tr><tr><td align='left' width='60%'>
				Solicitação Relacionada:<span style='color:red'>*</span><br>
				".$this->getComboSolicitacoes()."				
				</td><td align='right' width='40%'>
				<!-- <button style='width:150px;margin-top:20px;height:25px' onclick='javascript:getPesquisa();'>Voltar</button> -->
				<button style='width:150px;margin-top:20px;height:25px' onclick='javascript:salvarChamado();'>Salvar</button>
				</td></tr>
			</table>
		</td></tr>
	</table>";	

	echo $form;	
	}
	
	
	
	
	
	
	private function getComboSolicitacoes(){
	
	
	$select = "<select id='solicitacao' style='width:98%'><option value=''>SELECIONE</option>";
	
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get("select id, solucao, codigo from solicitacoes where fk_id_cliente =".$_SESSION["id_user"]);

		if( count($reg) > 0){
		foreach($reg as $linha)
		$select  .= "<option value='".$linha['solucao']." (".$linha['codigo'].")'>".$linha['solucao']." (".$linha['codigo'].")</option>";
		}	
	
	
	
	return $select."</select>";
	}
	
	

	
	
	
	
	public function salvarChamado(){
	
		if(strlen($_POST['assunto']) == 0){
		echo "Informe o assunto do chamado.";
		return;
		}
		
		
		if(strlen($_POST['descricao']) == 0){
		echo "Informe a descrição do problema.";
		return;
		}
		
		
		if(strlen($_POST['solicitacao']) == 0){
		echo "Escolha a solicitação relacionada a este chamado.";
		return;
		}	
		
		
	include_once ( $_SERVER["DOCUMENT_ROOT"] .'/libs/BD/Opcoes_BD_Gerais.class.php');

	$BD = new Opcoes_BD_Gerais;

	$campos = array();
	$valores = array();
	
	$campos[] = "descricao";
	$campos[] = "assunto";
	$campos[] = "status";
	$campos[] = "fk_cliente";
	$campos[] = "data_cadastro";			
	
	$valores[] = $_POST['descricao'];
	$valores[] = $_POST['solicitacao']." ".$_POST['assunto'];
	$valores[] = "PENDENTE";
	$valores[] = $_SESSION["id_user"];
	$valores[] = date("d/m/Y H:m");

		
		if(!$BD->aDD("chamados", $campos, $valores)){
				
		echo "Falha na gravação, por favor, tente novamente.";	
		return;
		}
			
	echo "SUCESSO_NA_GRAVACAO";
	}
	
	
	
	
	
		
	public function formAlteraChamado(){
	
	if( !array_key_exists("id_chamado", $_POST))
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
	<table width='100%' style='border:solid 1px #000'>
		<tr><td align='center'>
		<b>DETALHES DE CHAMADO</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td align='left'>
				Assunto:<span style='color:red'>*</span><br>
				<input type='text' id='assunto_chama' value='".$value['assunto']."' style='width:98%' maxlength='200' disabled>	
				</td><td width='20%' align='left'>		
				Status:<span style='color:red'>*</span><br>
				<input type='text' id='status' value='".$value['status']."' style='width:98%' maxlength='200' disabled>	
				</td></tr><tr><td align='left' colspan='2'>
				Descrição:<span style='color:red'>*</span><br>
				<textarea id='descricao_chama' style='width:99.4%;height:60px' disabled>".$value['descricao']."</textarea>
				</td></tr><tr><td align='left' colspan='2'>
				Data: ".$value['data_cadastro']."
				</td></tr>
			</table>
		</td></tr><tr><td align='left'>
			<div align='right'><button style='width:150px;height:25px' onclick='javaacript:novoAssentamento(".$_POST['id_chamado'].");'>Novo Assentamento</button></v>
			<div class='div_de_tabelas' id='div_assentamentos'>";

	$reg = $BD->get("select * from assentamentos where fk_chamado=".$_POST['id_chamado']);

		if( count($reg) > 0){
		
		$form .= "
				<table class='tb' border= '1' cellspacing ='0' style='color:#000'>
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
		$form .= "<div style='width:100%;line-height:100px;color:#000;' align='center'>&laquo;Nenhum Assentamento&raquo;</div>";

		
	$form .= "	
			</div>
		</td></tr>
	</table>";	

	echo $form;	
	}
	
	
	
	
	
	
	
	public function formNovoAssentamento(){
	
	$form = "		
	<table width='100%' style='border:solid 1px #000'>
		<tr><td align='center'>
		<b>NOVO ASSENTAMENTO</b>
		</td></tr><tr><td align='left'>
		Assentamento:<span style='color:red'>*</span><br>
		<textarea id='assentamento' style='width:99.4%;height:80px'></textarea>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;height:25px' onclick='javascript:formAlteraChamado(".$_POST['id_chamado'].");'>Voltar</button><button style='width:150px;margin-top:20px;height:25px' onclick='javascript:salvaAssetamento(".$_POST['id_chamado'].");'>Salvar</button>
		</td></tr>
	</table>";	

	echo $form;
	}
	
	
	
	
	
	
	public function salvaAssetamento(){
	
		if(strlen($_POST['assentamento']) == 0){
		echo "informe um assentamento.";
		return;
		}
		
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;

	$campos = array();
	$valores = array();
	
	$campos[] = "assentamento";
	$campos[] = "data_cadastro";
	$campos[] = "autor";
	$campos[] = "fk_chamado";			
			
	$valores[] = $_POST['assentamento'];
	$valores[] = date("d/m/Y H:m");
	$valores[] = "CLIENTE";
	$valores[] = $_POST['id_chamado'];
		
		
		if(!$BD->aDD("assentamentos", $campos, $valores)){
				
		echo "Falha na gravação, por favor, tente novamente.";	
		return;
		}
			
	echo "SUCESSO_NA_GRAVACAO";
	}
	
	
	
	
	
	
	
	
/********************************************************************************************* chamados *************************************************************************************/
	
	
	public function getManuais(){
		
	include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$reg = $BD->get(
	"select DISTINCT sol.id, sol.nome, sol.codigo from solucoes as sol 
	inner join pagamentos as pag on pag.fk_solucao=sol.id 
	inner join solicitacoes as soli on soli.id=pag.fk_solicitacao and soli.fk_id_cliente = ".$_SESSION["id_user"]);

	$form = "
	<div class='div_conteudo' align='center'>
		<div class='sessao' align='left'>
		<img src='../../imgs/icon_ok.png' class='mark'><b>Manuais Disponíveis:
		</div>
		<div class='sessao' align='left' style='padding-left:40px'>";
	
		if( count($reg) > 0){
		foreach($reg as $value)
		$form .= "<a href='/util/manuais/".$value['codigo']."/'>".$value['nome']."</a><br>";
		
		}
	
	return $form."</div></div>";
	}
	
	
	
	
	
	
	
	
}
?>