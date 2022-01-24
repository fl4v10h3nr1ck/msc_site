<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'pedidos/Pedidos.class.php';


$base = new Base();
$pedidos = new Pedidos();


$base->getHead($pedidos->getDependencias());


$base->getTopo(RAIZ_GESTOR."pedidos/");


	if($base->permitido()){
	

	$valores = array(
						'solicitante'=>'', 
						'empresa'=>'',
						'descricao_empresa'=>'',
						'outras_info_empresa'=>'',
						'telefone'=>'', 
						'email'=>'',
						'cidade'=>'',
						'uf'=>'',
						'descricao_projeto'=>'',
						'info_complementares'=>'',
						'solucoes'=>'',
						'data_pedido'=>'');
	
	
	if(array_key_exists("id_pedido", $_GET) && $_GET["id_pedido"]>0)
	$pedidos->getDados($_GET["id_pedido"], $valores);
	
	
?>
	
	<div id='pedidos_principal'>	
		<table width='100%' style='color:#000;border:solid 1px #FFF'>
			<tr>
				<td align='center'>
				<b>DADOS DE PEDIDO</b>
				</td>
			</tr><tr>
				<td align='left'>
					<table width='100%'>
						<tr>
							<td align='left' width='50%'>
							Empresa:<br>
							<input type='text' id='empresa' value='<?php echo $valores['empresa'] ?>' style='width:98%'>	
							</td><td width='50%' align='left'>		
							Solicitante:<br>
							<input type='text' id='solicitante' value='<?php echo $valores['solicitante'] ?>' style='width:98%'>
							</td>
						</tr>
						<tr>
							<td align='left' width='50%'>
							Descrição da Empresa:<br>
							<input type='text' id='descricao_empresa' value='<?php echo $valores['descricao_empresa'] ?>' style='width:98%'>	
							</td><td width='50%' align='left'>		
							Outras Informações:<br>
							<input type='text' id='outras_info' value='<?php echo $valores['outras_info_empresa'] ?>' style='width:98%'>
							</td>
						</tr>
					</table>	
				</td>
			</tr><tr>
				<td align='left'>		
					<table width='100%'>
						<tr>
							<td align='left' width='30%'>
							Telefone:<br>
							<input type='text' id='telefone' value='<?php echo $valores['telefone'] ?>' style='width:98%'>	
							</td><td width='30%' align='left'>	
							E-mail:<br>
							<input type='text' id='email' value='<?php echo $valores['email'] ?>' style='width:98%'>
							</td><td align='left' width='25%'>
							Cidade:<br>
							<input type='text' id='cidade' value='<?php echo $valores['cidade'] ?>' style='width:99%'>
							</td><td align='left' width='15%'>
							UF:<br>
							<input type='text' id='uf' value='<?php echo $valores['uf'] ?>' style='width:94%'>
							</td>
						</tr>
					</table>
				</td>
			</tr><tr>
				<td align='left'>		
					<table width='100%'>
						<tr>
							<td align='left' width='50%'>
							Descrição Projeto:<br>
							<input type='text' id='descricao_projeto' value='<?php echo $valores['descricao_projeto'] ?>' style='width:98%'>	
							</td><td width='50%' align='left'>		
							Informações Complementares:<br>
							<input type='text' id='info_complementares' value='<?php echo $valores['info_complementares'] ?>' style='width:98%'>
							</td>
						</tr>
						<tr>
							<td align='left' width='50%'>
							Soluções:<br>
							<input type='text' id='solucoes' value='<?php echo $valores['solucoes'] ?>' style='width:98%'>	
							</td><td width='50%' align='left'>		
							Data do Pedido:<br>
							<input type='text' id='data_pedido' value='<?php echo $valores['data_pedido'] ?>' style='width:98%'>
							</td>
						</tr>
					</table>		
				</td>
			</tr>
		</table>
	</div>
	
	
<?php
	
	}
	else
	$base->getLogin();


$base->getRodape();


?>




	