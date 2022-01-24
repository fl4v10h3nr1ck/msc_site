<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'sistemas/Sistemas.class.php';


$base = new Base();
$sistemas = new Sistemas();


$base->getHead($sistemas->getDependencias());


$base->getTopo(RAIZ_GESTOR."sistemas/");


	if($base->permitido()){
	
	$valores = array(   'nome'=>'',
						'descricao'=>'',
						'codigo'=>'');
	
	$id = 0;
	
	
		if(array_key_exists("id_sistema", $_GET) && $_GET["id_sistema"]>0)	{
		
		$sistemas->getDados($_GET["id_sistema"], $valores);
		$id = $_GET["id_sistema"];
		}
	
	
?>
	
	<div id='sistemas_principal'>	
		<table width='100%' style='border:solid 1px #FFF'>
		<tr><td align='center'>
		<b>DADOS DE SOLUÇÃO</b>
		</td></tr>
		<tr><td align='left'>
			<table width='100%'>
				<tr><td width='35%' align='left'>
				Nome:<span style='color:red'>*</span><br>
				<input type='text' id='nome' value='<?php echo $valores['nome'] ?>' style='width:98%' maxlength='200'>	
				</td><td width='45%' align='left'>		
				Descrição:<br>
				<input type='text' id='descricao' value='<?php echo $valores['descricao'] ?>' style='width:98%' maxlength='200'>		
				</td><td align='left' width='20%'>
				Código:<span style='color:red'>*</span><br>
				<input type='text' id='codigo' value='<?php echo $valores['codigo'] ?>' style='width:60%' maxlength='18' onchange='javascript:mascara(this, formatarSomenteNum);' disabled>
				<button style='width:30%;height:25px' onclick='javascript:geraCodSolucao();'>Gerar</button>
				</td></tr>
			</table>
		</td></tr><tr><td align='center'>	
		<button style='width:150px;margin-top:20px;height:25px' onclick='javascript:salvaSistema(<?php echo $id ?>);'>Salvar</button>
		</td></tr>
	</table>
	</div>
	
	
<?php
	
	}
	else
	$base->getLogin();


$base->getRodape();


?>




	