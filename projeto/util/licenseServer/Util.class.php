 <?php 
 
 
final class Util {
  




	public function permitir(){
		
	
	if(	array_key_exists("ID", $_GET) 					&&  
	array_key_exists("accessKey2Server", $_GET) 		&& 
	array_key_exists("softCOD", $_GET) 					&& 
	array_key_exists("clientCOD", $_GET)				&&
	$_GET["ID"] != null 								&& 
	$_GET["accessKey2Server"] != null 					&&
	$_GET["softCOD"] != null 							&&
	$_GET["clientCOD"] != null 							&&
	strlen($_GET["ID"]) == 9 							&&
	strlen($_GET["softCOD"]) == 4 						&& 
	strlen($_GET["clientCOD"]) == 8 					&& 
	strcmp($_GET["accessKey2Server"], "61fFndxo4s1Z0x00ad2c7gC9sAw5rmNH") == 0)
	return true;
		
	
	return false;
	}





	public function getSolicitacao(&$bd){
	
	
	$reg_solicitacao = $bd->get("select * from solicitacoes where codigo =  '".$_GET["clientCOD"]."'");
	
	if(count($reg_solicitacao) == 0)
	return false;
			
			
	return $reg_solicitacao[0];
	}




	
	public function ultimoPagamento(&$bd, $id_solicitacao){
		
	$reg_pagamento = $bd->get("
	SELECT pag.id, pag.num_licencas, pag.status, pag.num_de_dias 
	FROM pagamentos as pag inner join solucoes as sol on pag.fk_solucao = sol.id 
	WHERE pag.fk_solicitacao = ".$id_solicitacao." AND sol.codigo = '".$_GET["softCOD"]."' AND pag.status_pagamento='CONFIRMADO' AND 
	pag.mes<=".date("m")." AND pag.ano<=".date("Y")." AND pag.tipo='LICENCA' 
	AND pag.a_partir_de <= '".date("Y-m-d")."' ORDER BY pag.id DESC");
			
	if(count($reg_pagamento) == 0)
	return false;
			
		
	return 	$reg_pagamento[0];	
	}

	



	public function jaAtivado(&$bd, $id_pagamento){
		
		
	$reg_ativados = $bd->get("select * from sistemas_ativados where fk_pagamento = ".$id_pagamento);
			
		if(count($reg_ativados)> 0){
				
			foreach( $reg_ativados as $value){
				
				
			if(strcmp($value['id_soft'],  $_GET["ID"]) == 0)
			return $value['chave'];
					
			}
		}
		
		
	return false;
	}






	public function geraChave($id_soft, $cliente_cod, $soft_cod, $cont_dias){
	
	$chaves = array(
	'527f57a40354545h',
	'905z35p31645hi92',
	'45789a12098s7g32',
	'90523f89210vjl98',
	'36993c70845j41xc',
	'5c84p6a04s42ncl2',
	'p70632f62120vc87',
	'q078v941j4781sb0',
	'786g6a91p1vk03fc',
	'4579823f21qrfb11',
	'k8562812f9m3bizc',
	'5m6921a56106bdtb',
	'89c303a04xxsf430',
	'0fk2352a3g461qaf',
	'498494268076zzb1',
	'24912g19a0q098i4',
	'7f99a0j3414gbczm',
	'k56723564m719798',
	'zmar2g503sklpdf3',
	'203a4f23p1134fvz');


	$indice_chave = $id_soft[6].$id_soft[3];
	
	
	if($indice_chave > 19)
	return "";

	if(strlen($cliente_cod) > 8)
	return "";

	if(strlen($id_soft) > 9)
	return "";

	if(strlen($soft_cod) > 4)
	return "";

	if(strlen($cont_dias) > 3)
	return "";
	
	$pre_chave = 
		str_pad($cliente_cod, 8, '0', STR_PAD_LEFT). 
		str_pad($id_soft, 9, '0', STR_PAD_LEFT) . 
		str_pad($soft_cod, 4, '0', STR_PAD_LEFT) .
		date("dmY").
		str_pad($cont_dias, 3, '0', STR_PAD_LEFT);
	
	
	if(strlen($pre_chave) != 32)
	return "";

	 return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, 
											  $chaves[(int)$indice_chave],
											  $pre_chave,
											  MCRYPT_MODE_CBC,
											  "AAAAAAAAAAAAAAAA")));
	}
	
	

	
		
	public function addChave(&$bd, $id_soft, $id_pagamento, $chave, &$bd){
		
		
	if($bd->aDD("sistemas_ativados", array("id_soft", "data", "fk_pagamento", "chave"), array($id_soft, date("d/m/Y"), $id_pagamento, $chave))==0)
	return false;

	return true;
	}
	
	
	
	
		
	public function fechaPagamento(&$bd, $id_pagamento, $num_licencas){
		
		
	$reg_ativados = $bd->get("select * from sistemas_ativados where fk_pagamento = ".$id_pagamento);
		
	if(count($reg_ativados) >= $num_licencas)	
	return $bd->atualiza("pagamentos", "id", $id_pagamento, array("status"), array("FECHADO"));
	
	return true;
	}
	
  
  
  
}
?>