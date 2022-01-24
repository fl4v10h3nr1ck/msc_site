<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'pagamentos/Pagamentos.class.php';
include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	

$base = new Base();
$pagamentos = new Pagamentos();
$BD = new Opcoes_BD_Gerais;
	


$base->getHead($pagamentos->getDependencias());


$base->getTopo(RAIZ_GESTOR."pagamentos/");


	if($base->permitido()){
	
		if(array_key_exists("id_cliente", $_SESSION) && $_SESSION['id_cliente']>0){
	
		$valores = array( 	'mes'=>'',
							'ano'=>'',
							'tipo'=>'',
							'num_licencas'=>'',
							'valor'=>'',
							'codigo'=>'',
							'fk_solucao'=>'',
							'num_de_dias'=>'',
							'status_pagamento'=>'',
							'a_partir_de'=>'');
		
		$id = 0;
		
		
			if(array_key_exists("id_pagamento", $_GET) && $_GET["id_pagamento"]>0)	{
			
			$pagamentos->getDados($_GET["id_pagamento"], $valores);
			$id = $_GET["id_pagamento"];
			}
	
	
	$reg = $BD->get("select * from solicitacoes where id= ".$_GET["id_solicitacao"]);

?>
	<div id='pagamentos_principal'>	
	<p><b>Solicitação: <?php echo (count($reg) > 0?$reg[0]['solucao']." - ".$reg[0]['status']." - ".$reg[0]['codigo']:"")?></b></p>
	<hr width='100%' style='margin:10px 0px 10px 0px'>
		<table width='100%' style='border:solid 1px #FFF'>
			<tr><td align='center'>
			<b>DADOS DE PAGAMENTO</b>
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='20%' align='left'>
					Tipo:<span style='color:red'>*</span><br>
						<select id='tipo_pagamento' style='width:98%' onchange='javascript:mudaTipoPagamento();'>
						<option value='MENSALIDADE' <?php echo strcmp($valores['tipo'], "MENSALIDADE")==0?"selected":""?>>Mensalidade</option>
						<option value='LICENCA'     <?php echo strcmp($valores['tipo'], "LICENCA")==0?"selected":""?>>Licença</option>
						<option value='PARCELA'     <?php echo strcmp($valores['tipo'], "PARCELA")==0?"selected":""?>>Parcela</option>
						<option value='INTEGRAL'    <?php echo strcmp($valores['tipo'], "INTEGRAL")==0?"selected":""?>>Integral</option>
						</select>
					</td><td width='20%' align='left'>		
					Status:<span style='color:red'>*</span><br>
						<select id='status_pagamento' style='width:98%'>
						<option value='AGUARDANDO' <?php echo strcmp($valores['status_pagamento'], "AGUARDANDO")==0?"selected":""?>>Aguardando</option>
						<option value='CONFIRMADO' <?php echo strcmp($valores['status_pagamento'], "CONFIRMADO")==0?"selected":""?>>Confirmado</option>
						</select>
					</td><td width='20%' align='left'>
					Valor:<span style='color:red'>*</span><br>
					<input type='text' id='valor_pagamento' value='<?php echo $valores['valor']?>' style='width:96%' maxlength='8' onchange='javascript:mascara(this, formatarMonetario);'>	
					</td><td width='20%' align='left'>
					Num de Licenças:<br>
					<input type='text' id='num_licencas' value='<?php echo $valores['num_licencas']?>' style='width:96%' maxlength='6' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
					</td><td align='left' width='20%'>
					Mês/Ano:<span style='color:red'>*</span><br>
						<select id='mes_pagamento' style='width:30%'>
						<option value='01' <?php echo $valores['mes']==1?"selected":""?>>01</option>
						<option value='02' <?php echo $valores['mes']==2?"selected":""?>>02</option>
						<option value='03' <?php echo $valores['mes']==3?"selected":""?>>03</option>
						<option value='04' <?php echo $valores['mes']==4?"selected":""?>>04</option>
						<option value='05' <?php echo $valores['mes']==5?"selected":""?>>05</option>
						<option value='06' <?php echo $valores['mes']==6?"selected":""?>>06</option>
						<option value='07' <?php echo $valores['mes']==7?"selected":""?>>07</option>
						<option value='08' <?php echo $valores['mes']==8?"selected":""?>>08</option>
						<option value='09' <?php echo $valores['mes']==9?"selected":""?>>09</option>
						<option value='10' <?php echo $valores['mes']==10?"selected":""?>>10</option>
						<option value='11' <?php echo $valores['mes']==11?"selected":""?>>11</option>
						<option value='12' <?php echo $valores['mes']==12?"selected":""?>>12</option>
						</select>
					&nbsp;/&nbsp;<input type='text' id='ano_pagamento' value='<?php echo $valores['ano']?>' style='width:55%' maxlength='4' onchange='javascript:mascara(this, formatarSomenteNum);'>
					</td></tr>
				</table>
				<table width='100%'>	
					<tr><td align='left' width='20%'>
					Tempo de Licen. (em dias):<br>
					<input type='text' id='tempo_pagamento' value='<?php echo $valores['num_de_dias']?>' style='width:98%' maxlength='3' onchange='javascript:mascara(this, formatarSomenteNum);'>
					</td><td align='left' width='25%'>
					Código:<br>
					<input type='text' id='cod_pagamento' value='<?php echo $valores['codigo']?>' style='width:60%' maxlength='18' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
					<button style='width:30%;height:25px' onclick='javascript:geraCodPagamento();'>Gerar</button>
					</td><td align='left' width='35%'>
					Solução:<br>
					<?php echo getComboSolucoes($valores['tipo'], $valores['fk_solucao'])?>
					</td><td align='left' width='20%'>
					Permitir  a partir de:<br>
					<input type='text' id='a_partir_de' value='<?php echo $valores['a_partir_de']?>' style='width:98%' maxlength='10' onchange='javascript:mascara(this, formatarData);'>
					</td></tr>
				</table>
			</td></tr><tr><td align='center'>	
			<button style='width:150px;margin-top:20px;height:25px' onclick='javascript:salvaPagamento(<?php echo $_GET["id_solicitacao"].", ".$id ?>);'>Salvar</button>
			</td></tr>
		</table>	
	</div>
	
	
<?php
		}
		else
		$base->semClienteSelecionado();
	
	}
	else
	$base->getLogin();


$base->getRodape();









	function getComboSolucoes($tipo,  $selecionado){
	
	include_once RAIZ_ABSOLUTA.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	$select = "<select id='combo_solucoes' style='width:98%' ".(strcmp($tipo, "MENSALIDADE") == 0?"disabled":"")."><option value=''>SELECIONE</option>";
	
	$reg = $BD->get("select id, nome, codigo from solucoes");

		if( count($reg) > 0){
		foreach($reg as $linha)
		$select  .= "<option value='".$linha['id']."' ".(strcmp($selecionado, $linha['id']) == 0?"selected":"").">".$linha['nome']." (".$linha['codigo'].")</option>";
		}	
	
	return $select."</select>";
	}
	
	

	
	






?>




	