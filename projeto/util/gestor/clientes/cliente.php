<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'clientes/Clientes.class.php';


$base = new Base();
$clientes = new Clientes();


$base->getHead($clientes->getDependencias());


$base->getTopo(RAIZ_GESTOR."clientes/");


	if($base->permitido()){
	
	$valores = array(	'tipo'=>'PF', 
						'nome'=>'',
						'cpf_cnpj'=>'',
						'rg_ie'=>'',
						'email'=>'', 
						'nome_contato'=>'',
						'ddd_1'=>'',
						'num_1'=>'',
						'ramal_1'=>'',
						'ddd_2'=>'',
						'num_2'=>'',
						'ramal_2'=>'',
						'cidade'=>'',
						'uf'=>'PA',
						'logradouro'=>'', 
						'num'=>'', 
						'cep'=>'', 
						'obs'=>'', 	
						'senha'=>'', 	
						'descricao_empresa'=>'',
						'outras_info'=>'', 
						'nome_user'=>'');
	
	$id = 0;
	
	
		if(array_key_exists("id_cliente", $_GET) && $_GET["id_cliente"]>0)	{
		
		$clientes->getDados($_GET["id_cliente"], $valores);
		$id = $_GET["id_cliente"];
		}
	
	
?>
	
	<div id='clientes_principal'>	
		<table width='100%' style='color:#000;border:solid 1px #000'>
			<tr><td align='center'>
			<br>
			<b>Dados de Cliente</b>
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='30%' align='left'>
					Nome/Rarão Social:<span style='color:red'>*</span><br>
					<input type='text' id='nome_razao' value='<?php echo $valores['nome'] ?>' style='width:98%' >
					</td><td width='10%' align='left'>		
					Tipo:<span style='color:red'>*</span><br>
						<select id='tipo' style='width:98%' onchange='javascript:mudaTipo();'>
						<option value='PF' <?php echo (strcmp($valores['tipo'], "PF")==0? "selected":"") ?>>PF</option>
						<option value='PJ' <?php echo (strcmp($valores['tipo'], "PJ")==0? "selected":"") ?>>PJ</option>
						</select>
					</td><td width='15%' align='left'>
					CPF:<span style='color:red'>*</span><br>
					<input type='text' id='cpf' <?php echo (strcmp($valores['tipo'], "PF") ==0? "value='".$valores['cpf_cnpj']."'": "disabled") ?> style='width:98%' maxlength='14' onchange='javascript:mascara(this, formatarCPF);' >
					</td><td width='15%' align='left'>
					CNPJ:<span style='color:red'>*</span><br>
					<input type='text' id='cnpj' <?php echo (strcmp($valores['tipo'], "PF") ==0? "disabled":"value='".$valores['cpf_cnpj']."'") ?> style='width:98%' maxlength='19' onchange='javascript:mascara(this, formatarCNPJ);' >
					</td><td width='10%' align='left'>		
					RG/IE:<br>
					<input type='text' id='rg_ie' value='<?php echo $valores['rg_ie'] ?>' style='width:98%' maxlength='8' >
					</td><td width='20%' align='left'>
					E-mail:<br>
					<input type='text' id='email' value='<?php echo $valores['email'] ?>' style='width:98%' >
					</td></tr>
				</table>
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='40%' align='left'>
					Nome Contato:<br>
					<input type='text' id='nome_contato' value='<?php echo $valores['nome_contato'] ?>' style='width:98%' >
					</td><td align='left' width='30%'>
						<table width='100%'>
							<tr><td colspan = '3' valign='top'  align='left'>
							Telefone Principal:<span style='color:red'>*</span>
							</td></tr>
							<tr><td align = 'right' width='20%'>
							<input type='text' value='<?php echo $valores['ddd_1'] ?>' id='tel_ddd_1' maxlength='2' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
							</td><td align = 'center' width='50%'>
							<input type='text' value='<?php echo $valores['num_1'] ?>' id='tel_num_1' maxlength='10' onchange='javascript:mascara(this, formatarTEL);' style='width:98%'>
							</td><td align = 'left' width='30%'>
							<input type='text' value='<?php echo $valores['ramal_1'] ?>' id='tel_ramal_1' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
							</td></tr>
						</table>
					</td><td align='left' width='30%'>
						<table width='100%'>
							<tr><td colspan = '3' valign='top'  align='left'>
							Telefone Secundário:
							</td></tr>
							<tr><td align = 'center' width='20%'>
							<input type='text' value='<?php echo $valores['ddd_2'] ?>' id='tel_ddd_2' maxlength='2' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
							</td><td align = 'center'  width='50%'>
							<input type='text' value='<?php echo $valores['num_2'] ?>' id='tel_num_2' maxlength='10' onchange='javascript:mascara(this, formatarTEL);' style='width:98%'>
							</td><td align = 'center'  width='30%'>
							<input type='text' value='<?php echo $valores['ramal_2'] ?>' id='tel_ramal_2' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);' style='width:98%'>
							</td></tr>
						</table>	
					</td></tr>
				</table>
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='30%' align='left'>
					Descrição Empresa:<br>
					<input type='text' id='descricao_empresa' value='<?php echo $valores['descricao_empresa'] ?>' style='width:98%'>
					</td><td align='left' width='30%' >
					Informações Complementares:<br>
					<input type='text' id='outras_info' value='<?php echo $valores['outras_info'] ?>' style='width:98%'>
					</td><td align='left' width='40%' >
					OBS:<br>
					<input type='text' id='obs' style='width:99%' value='<?php echo $valores['obs'] ?>'>
					</td></tr>
				</table>	
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='30%' align='left' >
					Logradouro:<br>
					<input type='text' id='logradouro' style='width:98%' value='<?php echo $valores['logradouro'] ?>'>
					</td><td width='15%' align='left'>
					Número:<br>
					<input type='text' id='num' style='width:98%' value='<?php echo $valores['num'] ?>'>
					</td><td width='15%' align='left'>
					CEP:<br>
					<input type='text' id='cep' style='width:98%' value='<?php echo $valores['cep'] ?>' onchange='javascript:mascara(this, formatarCEP);'  maxlength='9'>
					</td><td width='25%' align='left'>
					Cidade:<br>
					<input type='text' id='cidade' style='width:98%' value='<?php echo $valores['cidade'] ?>'>
					</td><td width='15%' align='left'>
					Estado (UF):<br>
					<select id='uf' style='width:98%'>
					
					
					<?php
					
					foreach( array('PA', 'AC', 'AL', 'AP', 'AM',  'BA', 'CE',  'DF',  'ES',  'GO',  'MA',  'MT',  'MS',  'MG', 'PB',  'PR',  'PE',  'RJ',  'RJ',  'RN',  'RS', 'RO',  'RR',  'SC',  'SP',  'SE',  'TO') as $value)
					echo "<option value='".$value."' ".(strcmp($valores['uf'], $aux)==0?"selected":"").">".$value."</option>";

					?>
					 
					</select>
					</td></tr>
				</table>
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='30%' align='left' >
					Nome de Usuário:<br>
					<input id='nome_user' type='text' style='width:98%' value='<?php echo $valores['nome_user'] ?>'>	
					</td><td align='left'>
					Senha:<span style='color:red'>*</span><br>
					<input id='senha' type='text' style='width:200px' value='' readonly>	
					<button style='width:150px;height:25px' onclick='javascript:geraSenha();'>Gerar Senha</button><br>
					</td></tr>
				</table>
			</td></tr><tr><td align='center'><br><br>
			<br><br>
			<button style='width:150px;height:25px' onclick='javascript:salvaCliente(<?php echo $id ?>);'>Salvar</button><br><br>
			<br>
			</td></tr>
		</table>
	</div>
	
	
<?php
	
	}
	else
	$base->getLogin();


$base->getRodape();


?>




	