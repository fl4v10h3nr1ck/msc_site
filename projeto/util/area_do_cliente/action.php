<?php
header('Content-type: text/html; charset=UTF-8');

include_once 'AreaDoCliente.class.php';

$area = new AreaDoCliente();



	if( 	array_key_exists( "funcao", $_POST) ){

		
	if (method_exists($area, $_POST["funcao"])) 
	call_user_func(array($area, $_POST["funcao"]));
		
			
	}


	

	
	
?>
