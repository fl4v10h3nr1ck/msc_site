<?php




class Biblioteca{






	public function anti_injection($sql) {
		   
	$sql = preg_replace( "/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $sql);
	   $sql = trim($sql);
	   $sql = strip_tags($sql);
	   $sql = addslashes($sql);
	   
	return $sql;
	 }






	public function validaEmail($mail){

	if(strlen($mail) == 0)
	return false;


	if(preg_match("/^([[:alnum:]_.-]){2,}@([[:lower:][:digit:]_.-]{2,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/", $mail))
	return true;
	else
	return false;

	}






	public function validaCNPJ($cnpj){

	
	if(strlen($cnpj) > 19) 
	return false;
	
	$soment_num = preg_replace("/[^0-9\s]/", "", $cnpj);
	
	if(strlen($soment_num) < 14 || strlen($soment_num) > 15) 
	return false;
	
	$char_validos = array('0','1','2','3','4','5','6','7','8','9','.','/','-');
	
	$comp = strlen($cnpj);
		for($i = 0; $i < $comp; $i++){
		$control = false;	
			foreach( $char_validos as $value){
		
				if(strcmp($cnpj[$i], $value) == 0){
				$control = true;	
				break;
				}
			}
		
		if(!$control)
		return false;
		}
	
	return true;
	}
		
		
		

	

	public function formataCNPJ($cnpj){
	

	$cnpj = preg_replace("/[^0-9\s]/", "", $cnpj);
	
	$dig = 0;
	if(strlen($cnpj) == 15)
	$dig = 1;
	
	return substr($cnpj, 0, 2+$dig).".".substr($cnpj, 2+$dig, 3).".".substr($cnpj, 5+$dig, 3)."/".substr($cnpj, 8+$dig, 4).'-'.substr($cnpj, 12+$dig, 2);
	}



		
		
		

	public function validaCPF($cpf){

	if(strlen($cpf) > 14)
	return false;
	
	$soment_num = preg_replace("/[^0-9\s]/", "", $cpf);
	
	if(strlen($soment_num) != 11) 
	return false;
	
	
	$char_validos = array('0','1','2','3','4','5','6','7','8','9','.','-');
	
	$comp = strlen($cpf);
		for($i = 0; $i < $comp; $i++){
		$control = false;	
			foreach( $char_validos as $value){
		
				if(strcmp($cpf[$i], $value) == 0){
				$control = true;	
				break;
				}
			}
		
		if(!$control)
		return false;
		}
	
	return true;
	}
		
		
		




	public function formataCPF($cnpj){
	

	$cnpj = preg_replace("/[^0-9\s]/", "", $cnpj);
	
	return substr($cnpj, 0, 3).".".substr($cnpj, 3, 3).".".substr($cnpj, 6, 3)."-".substr($cnpj, 9, 2);
	}



		

		

	public function somenteNUM( $campo, $pode_zero, $min =0, $max=0){
	
		if($min != 0){
	
		if( strlen($campo) < $min)
		return false;
		}
	
	
		if($max != 0){
	
		if( strlen($campo) > $max)
		return false;
		}
	
	
	$char_validos = array('0','1','2','3','4','5','6','7','8','9');
	
	$comp = strlen($campo);
		for($i = 0; $i < $comp; $i++){
		$control = false;	
			foreach( $char_validos as $value){
		
				if(strcmp($campo[$i], $value) == 0){
				$control = true;	
				break;
				}
			}
		
		if(!$control)
		return false;
		}
	
	
	
	if(!$pode_zero && $campo==0)
	return false;
	
	
	return true;
	}
	



	
	
	
	
	public function validaData( $data){
	
	if(strlen($data) > 10)
	return false;
	
	$soment_num = preg_replace("/[^0-9\s]/", "", $data);
	
	if(strlen($soment_num) != 8) 
	return false;
	
	
	$char_validos = array('0','1','2','3','4','5','6','7','8','9','/');
	
	$comp = strlen($data);
		for($i = 0; $i < $comp; $i++){
		$control = false;	
			foreach( $char_validos as $value){
		
				if(strcmp($data[$i], $value) == 0){
				$control = true;	
				break;
				}
			}
		
		if(!$control)
		return false;
		}
	
	
	if( substr($soment_num, 0, 2) > 31 || substr($soment_num, 2, 2) > 12)
	return false;
	
	
	return true;
	}
	
	
	
	
	
	
	

	public function formataData($data){
	

	$data = preg_replace("/[^0-9\s]/", "", $data);
	
	return substr($data, 0, 2)."/".substr($data, 2, 2)."/".substr($data, 4, 4);
	}

	
	
	
	
	
	

	public function validaCEP( $cep){
	
	if(strlen($cep) > 9)
	return false;
	
	$soment_num = preg_replace("/[^0-9\s]/", "", $cep);
	
	if(strlen($soment_num) != 8) 
	return false;
	
	
	$char_validos = array('0','1','2','3','4','5','6','7','8','9','-');
	
	$comp = strlen($cep);
		for($i = 0; $i < $comp; $i++){
		$control = false;	
			foreach( $char_validos as $value){
		
				if(strcmp($cep[$i], $value) == 0){
				$control = true;	
				break;
				}
			}
		
		if(!$control)
		return false;
		}
	
	
	return true;
	}
	
	
	
	
	
	
	
	
	public function formataCEP($cep){
	

	$cep = preg_replace("/[^0-9\s]/", "", $cep);
	
	return substr($cep, 0, 5)."-".substr($cep, 5, 8);
	}

	
	
	
	
	
	
	
	
	/* um tel valido tem a forma xx xxxx-xxxx ou xx xxxxx-xxxx e ramal xxxx, a funcao apenas valida, nao formata, logo,
	parênteses e traços bem como suas posições serão ignorados*/
	
	public function validaTEL( $ddd, $tel, $ramal, $opcional = false){
	
	
		if($opcional){
			
		if(strlen($tel) == 0 && strlen($ramal) == 0 && strlen($ddd) == 0)
		return true;	
		}
		
		
		
	if( !$this->somenteNUM( $ddd, false, 2, 2))
	return false;
		
		
		if(strlen ($ramal)> 0){
			
		if( !$this->somenteNUM( $ramal, false, 0, 4))
		return false;
		}
		
		
	if(strlen(preg_replace("/[^0-9\s]/", "", $tel)) < 8 || strlen(preg_replace("/[^0-9\s]/", "", $tel)) > 9)
	return false;

		


	$char_validos = array('0','1','2','3','4','5','6','7','8','9','-');
	
	$comp = strlen($tel);
		for($i = 0; $i < $comp; $i++){
		$control = false;	
			foreach( $char_validos as $value){
		
				if(strcmp($tel[$i], $value) == 0){
				$control = true;	
				break;
				}
			}
		
		if(!$control)
		return false;
		}
	
	
	return true;
	}
	

	
	
	
	
	
	
	public function formataTEL($ddd, $num, $ramal){
	
	if( strlen($ddd)==0)
	return '';
	
	return "(".$ddd.") ".$num.(strlen($ramal)==0? "" : " Ramal: ".$ramal);
	}

	
	
	
	
	
	
	
	// recebe um telefone em forma de string e retorna um array contendo as chaves 'ddd' 'num' 'ramal' com os respectivos dados. 
	public function getTEL( $tel){
	
	$aux = array('ddd'=>'', 'num'=>'', 'ramal'=>'');
	
		if( strlen($tel) > 0){
		
		$tel = str_replace(' ', '', $tel);
		$posicao_traco = strpos($tel, '-')-4;
		$tel = preg_replace("/[^0-9\s]/", "", $tel);
		
		$aux['ddd'] = substr( $tel, 0, 2);
		$aux['num'] = substr( $tel, 2, $posicao_traco).'-'.substr( $tel, $posicao_traco+2, 4);
		$aux['ramal'] = substr( $tel, $posicao_traco+ 6 );
		
		
		}
	return $aux;
	}
	
	
	
	
	
	
	
	
	public function  validaMoeda($valor, $pode_zero =false) {
	
	$aux = str_replace('.', '', $valor);
	$aux = str_replace(',', '', $aux);
		
	if(!$this->somenteNUM($aux, $pode_zero, 1, 15))
	return false;
	
	if(substr_count($valor, ',') > 1 )
	return false;
	
	//nao importa onde esteja o ponto, o campo será formatado depois
	//porem a virgula decimal, caso haja, deverá está no local correto
	
	if( strripos($valor, ',') ===false || strripos($valor, ',') == (strlen($valor) - 3) || strripos($valor, ',') == (strlen($valor) - 2))
	return true;	
		
	return false;
	}
	
	
	
	
	
	

	
	public function  FormataMoeda($valor) {
	
	$valor_format = "";
	$aux = str_replace('.', '', $valor);

	
	$decimal = "";
	$posicao_virg = strripos($aux, ',');
	
	if($posicao_virg === false)
	$decimal = ",00";
		else{	
		$decimal = substr($aux, $posicao_virg, strlen($aux));
		
		if(strlen($decimal )== 2)
		$decimal .="0";
		
		$aux = substr($aux, 0, $posicao_virg);
		
		}
	
	
	$resto = strlen($aux)%3;
	$primeira_parte = substr($aux, 0, $resto);
	$segunda_parte = substr($aux, $resto, strlen($aux));
	
	for($i = 0; $i<strlen($segunda_parte); $i+=3)
	$valor_format.=substr($segunda_parte, $i, 3).($i == (strlen($segunda_parte)-3)?"":".");
	
	$final = $primeira_parte;
	if( strlen($segunda_parte)>0 && strlen($primeira_parte)>0)
	$final .="."; 
	
	
	return $final.$valor_format.$decimal;
	}
	
	
	
	
	
	
	
	
	public function somaValorMonetario(&$reg){
	
	$cont = "0.00";
		foreach($reg  as $valor){
		
		$aux = str_replace(".","",$valor);
		$aux = str_replace(",",".",$aux);
		
		$cont += $aux;
		
		$cd=explode(".",$cont);
		
		if (empty($cd)) 
		$cont .=".00";
		elseif (count($cd) < 2)
		$cont .=".0";
		}
	
	$cont= str_replace(".",",",$cont);

	return $this->FormataMoeda($cont);
	}
	
	
		
	
	

	
	
	public function extraiNumTEL($tel){
	
	$resultado = array('ddd'=>'', 'num'=>'', 'ramal'=>'');
	
	$tel = preg_replace("/[^0-9\s]/", "", str_replace(" ", "", $tel));
	
	if(strlen($tel) < 10)
	return $resultado;

	$resultado['ddd'] = substr($tel, 0, 2);
	
		switch( strlen($tel)){
		
		case  14:
		$resultado['ramal'] = substr($tel, -4);
		case 10:
		$resultado['num']  = substr($tel, 2, 4).'-'.substr($tel, 6, 4);	
		break;
			
			case  15:
			$resultado['ramal'] = substr($tel, -4);
			case 11;
			$resultado['num']  = substr($tel, 2, 5).'-'.substr($tel, 7, 4);	

		}
	
	
	return $resultado;
	}
	
	
	
	
	
	
	public function enviaEmail($assunto, $corpo){
	$descricao_pedido = "";
	
	
	$assinatura_do_site="MSC Soluções";
	
	$email_destino = "contato@mscsolucoes.com.br";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

	$headers .= 'To: '.$assinatura_do_site.' <'.$email_destino.'>'. "\r\n";
	$headers .= 'From: '.$assinatura_do_site.' <'.$email_destino.'>' . "\r\n";

	$corpo_da_msg = 
	"<!DOCTYPE html>
	<html xmlns=\"http://www.w3.org/1999/xhtml\">
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
		<meta http-equiv=\"Content-Language\" content=\"pt-BR\">
		</head>
		
		<body style='font-family: arial, verdana, sans-serif;font-size: 14px;' border='1'>
		<center>
		".$corpo."
		</center>
		</body>
	</html>";
	
	return mail($email_destino, $assunto, html_entity_decode(htmlentities($corpo_da_msg)), $headers);
	}


	
	
	
	
	//faz a decomposição léxica dos termos de pesquisa e transforma em condicional para a query
	public function getQueryTermos($termos = "", $locais = array()){
	
	if( strlen( $termos ) == 0 || count($locais) == 0) 
	return "";
	
	$tokens_do_termo = explode(' ', $termos);
	
	$query_termo = " (";
		
		foreach($locais as $i=>$local){
		
		$query_termo .= "(";
		
			foreach($tokens_do_termo as $j => $value){
			
			$query_termo .= $local. " like '%".$value."%'";
			
			if( $j < count($tokens_do_termo) -1)
			$query_termo .= " AND ";
			}
		
		$query_termo .= ")";
		
		
		if( $i < count($locais) -1)
		$query_termo .= " OR ";		
		}
		
	return $query_termo.")";	
	}
	
	
	
	
	
	
	
	
	public function preparaHTMLParaJson($valor){
		
	return 	str_replace('"', '\"', str_replace("\t", "\\t", str_replace("\n", "\\n", str_replace("\r", "\\r", $valor))));
	}
	
	
	
}

?>


