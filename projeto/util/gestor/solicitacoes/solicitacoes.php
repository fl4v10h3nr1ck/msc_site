<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'solicitacoes/Solicitacoes.class.php';


$base = new Base();
$solicitacoes = new Solicitacoes();


$base->getHead($solicitacoes->getDependencias());


$base->getTopo(RAIZ_GESTOR."solicitacoes/");


	if($base->permitido()){
	
		if(array_key_exists("id_cliente", $_SESSION) && $_SESSION['id_cliente']>0){
	
		$valores = array( 	'status'=>'',
							'solucao'=>'',
							'ciclo_pagamento'=>'',
							'detalhes'=>'',
							'codigo'=>'');
		
		$id = 0;
		
		
			if(array_key_exists("id_solicitacao", $_GET) && $_GET["id_solicitacao"]>0)	{
			
			$solicitacoes->getDados($_GET["id_solicitacao"], $valores);
			$id = $_GET["id_solicitacao"];
			}
	
	
?>
	
	<div id='solicitacoes_principal'>	
		<table width='100%' style='border:solid 1px #FFF'>
			<tr><td align='center'>
			<b>Dados de Solicitação</b>
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='34%' align='left'>
					Solução:<span style='color:red'>*</span><br>
					<select id='solucao' style='width:98%'>
						<option value='WEBDEV' <?php echo strcmp($valores['solucao'], "WEBDEV")==0?"selected":""?>>Desenvolvimento WEB</option>
						<option value='SISTEMAS' <?php echo strcmp($valores['solucao'], "SISTEMAS")==0?"selected":""?>>Sistemas</option>
						<option value='INFRA' <?php echo strcmp($valores['solucao'], "INFRA")==0?"selected":""?>>Infraestrutura</option>
						<option value='TREINA' <?php echo strcmp($valores['solucao'], "TREINA")==0?"selected":""?>>Treinamento</option>
						</select>
					</td><td width='33%' align='left'>		
					Status:<span style='color:red'>*</span><br>
						<select id='status' style='width:98%'>
						<option value='ABERTO' <?php echo strcmp($valores['status'], "ABERTO")==0?"selected":""?>>Aberto</option>
						<option value='EM DEV' <?php echo strcmp($valores['status'], "EM DEV")==0?"selected":""?>>Em desenvolvimento</option>
						<option value='FECHADO'<?php echo strcmp($valores['status'], "FECHADO")==0?"selected":""?>>Fechado</option>
						</select>
					</td><td width='33%' align='left'>
					Ciclo de Pagamento:<span style='color:red'>*</span><br>
						<select id='ciclo' style='width:98%'>
						<option value='INTEGRAL'   <?php echo strcmp($valores['ciclo_pagamento'], "INTEGRAL")==0?"selected":""?>>Integral</option>
						<option value='2 PARCELAS' <?php echo strcmp($valores['ciclo_pagamento'], "2 PARCELAS")==0?"selected":""?>>2 Parcelas</option>
						<option value='MENSAL'     <?php echo strcmp($valores['ciclo_pagamento'], "MENSAL")==0?"selected":""?>>Mensal</option>
						<option value='TRIMESTRAL' <?php echo strcmp($valores['ciclo_pagamento'], "TRIMESTRAL")==0?"selected":""?>>Trimensal</option>
						<option value='SEMESTRAL'  <?php echo strcmp($valores['ciclo_pagamento'], "SEMESTRAL")==0?"selected":""?>>Semestral</option>
						<option value='ANUAL'      <?php echo strcmp($valores['ciclo_pagamento'], "ANUAL")==0?"selected":""?>>Anual</option>
						</select>
					</td></tr>
				</table>
			</td></tr><tr><td align='left'>
				<table width='100%'>
					<tr><td width='25%' align='left'>
					Código Solicitação (CLIENT CODE):<br>
					<input type='text' id='cod_solicitacao' value='<?php echo $valores['codigo']?>' style='width:60%' disabled>
					<button style='width:30%;height:25px' onclick='javascript:geraCodSolicitacao();'>Gerar</button>
					</td><td align='left' width='75%'>
					Detalhes:<br>
					<input type='text' id='detalhes' value='<?php echo $valores['detalhes']?>' style='width:99%' >
					</td></tr>
				</table>
			</td></tr><tr><td align='center'>	
			<button style='width:150px;height:25px' onclick='javascript:salvaSolicitacao(<?php echo $_SESSION['id_cliente'].", ".$id ?>);'>Salvar</button>
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


?>




	