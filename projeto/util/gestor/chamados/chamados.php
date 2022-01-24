<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'chamados/Chamados.class.php';


$base = new Base();
$chamados = new Chamados();


$base->getHead($chamados->getDependencias());


$base->getTopo(RAIZ_GESTOR."chamados/");


	if($base->permitido()){
	
	
		if(array_key_exists("id_chamado", $_GET) && $_GET["id_chamado"]>0)	{
		
		
		$valores = array(
						'descricao'=>'', 
						'data_cadastro'=>'',
						'assunto'=>'',
						'status'=>'',
						'solucao'=>'', 
						'obs'=>'',
						'fk_cliente'=>'',
						'nome_doc_anexo'=>'');
	
		$id = $_GET["id_chamado"];
	
		$chamados->getDados($_GET["id_chamado"], $valores);
	
?>
	
	<div id='chamados_principal'>	
		<table width='100%' style='color:#000;border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>ALTERAÇÃO DE CHAMADO</b>
		</td></tr><tr><td align='left'>
			<table width='100%'>
				<tr><td align='left' colspan='2'>
				Assunto:<span style='color:red'>*</span><br>
				<input type='text' id='assunto' value='<?php echo $valores['assunto'] ?>' style='width:98%' maxlength='200'>	
				</td><td width='20%' align='left'>		
				Status:<span style='color:red'>*</span><br>
					<select id='status' style='width:98%'>
					
					<?php
					
					foreach(array('PENDENTE','EM ATENDIMENTO', 'TERMINADO') as $aux)
					echo "<option value='".$aux."' ".(strcmp($aux, $valores['status'])==0?"selected":"").">".$aux."</option>";
					
					?>
					</select>
				</td></tr><tr><td align='left' colspan='3'>
				Descrição:<span style='color:red'>*</span><br>
				<textarea id='descricao' style='width:99.4%;height:100px'><?php echo $valores['descricao'] ?></textarea>
				</td></tr><tr><td align='left' width='30%'>
				Obs:<br>
				<input type='text' id='obs' value='<?php echo $valores['obs'] ?>' style='width:98%'>
				</td><td align='left' width='50%'>
				Solução:<br>
				<input type='text' id='solucao' value='<?php echo $valores['solucao'] ?>' style='width:99%'>
				</td><td align='left'>
				Anexo:<br><?php echo (strlen($valores['nome_doc_anexo']) == 0?"Sem Anexo":"<a href='".RAIZ."docs/".$valores['nome_doc_anexo']."'>".$valores['nome_doc_anexo']."</a>") ?>
				</td></tr><tr><td align='left' colspan='3'>
					<table width='100%'>
						<tr><td width='20%' align='left'>
						Data: <?php echo $valores['data_cadastro'] ?>
						</td><td align='center' width='60%'>
						<button style='width:150px;margin-top:20px;height:25px' onclick='javascript:salvaChamado(<?php echo $_GET['id_chamado'] ?>);'>Salvar</button>
						</td><td align='left' width='20%'>
						</td></tr>
					</table>
				</td></tr>
			</table>
		</td></tr><tr><td align='center'>
		<hr width='100%' style='margin:10px 0px 10px 0px'>
			<table width='100%' style='color:#000;border:solid 1px #FFF'>
				<tr><td align='center'>
				<b>NOVO ASSENTAMENTO</b>
				</td></tr><tr><td align='left'>
				Assentamento:<span style='color:red'>*</span><br>
				<textarea id='assentamento' style='width:99.4%;height:70px'></textarea>
				</td></tr><tr><td align='center'>	
				<button style='width:150px;margin-top:20px;height:25px' onclick='javascript:salvaAssetamento(<?php echo $_GET['id_chamado'] ?>);'>Salvar</button>
				</td></tr>
			</table>
		
		</td></tr><tr><td align='left'>
		<hr width='100%' style='margin:10px 0px 10px 0px'>
		
		<?php  $chamados->getAssentamentos($_GET['id_chamado'])?>
		
		</td></tr>
	</table>
	</div>
	
	
<?php
		}
		else
		echo "
		<div id='sem_cliente_selecionado' align='center'>
		<b>&laquo;CHamado não encontrado&raquo;</b><br><br><br><br><br><br>
		<button class='botao_voltar' onClick='javascript:location.href=\"".RAIZ_GESTOR."chamados\"' style='margin-right:10px' title='Área principal'></button>
		</div>";
	}
	else
	$base->getLogin();


$base->getRodape();


?>




	