<?php
header('Content-type: text/html; charset=UTF-8');



/*
ERRO_10000= dados invalidos;
ERRO_10001= solicitacao invalida;
ERRO_20000 = licenciamento indisponivel (sem pagamento);
ERRO_20001 = pagamento fechado;
ERRO_30000 = erro ao fechar o pagamento;
ERRO_40000 = erro ao gravar nova chave;

*/



include_once "Util.class.php";
		
$util = new Util;


if($util->permitir()===false)
echo "ERRO_10000";
	else{

	
	include_once "BD/Opcoes_BD_Gerais.class.php";
		
	$bd = new Opcoes_BD_Gerais;
	

	$reg_solicitacao  = $util->getSolicitacao($bd);
	
	
		if($reg_solicitacao===false){
				
		echo "ERRO_10001";		
		return;	
		}
	
	
		
	$pagamento  = $util->ultimoPagamento($bd, $reg_solicitacao['id']);
	
	
		if($pagamento===false){
				
		echo "ERRO_20000";		
		return;	
		}
	
	
	$ativado  = $util->jaAtivado($bd, $pagamento['id']);
	
	
		if($ativado===false){
		
			if(strcmp($pagamento['status'], "FECHADO") == 0){
				
			echo "ERRO_20001";
			return;	
			}	
		}
		else{
		
		echo $ativado;
		return;
		}
	
	
	
	$chave = $util->geraChave($_GET["ID"], $_GET["clientCOD"], $_GET["softCOD"], $pagamento['num_de_dias']);

	
	
		if($util->addChave($bd, $_GET["ID"], $pagamento['id'], $chave, $bd)===false){
			
		echo "ERRO_40000";
		return;
		}	
		
	
		
		if($util->fechaPagamento($bd, $pagamento['id'], $pagamento['num_licencas'])===false){
			
		echo "ERRO_30000";
		return;
		}	
		
	
	echo $chave;
	}

	
?>