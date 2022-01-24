<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Gestor.class.php';

$gestor = new Gestor();



	if( 	array_key_exists( "nome_da_funcao", $_POST) ){
	
	if (method_exists($gestor, $_POST["nome_da_funcao"])) 
	call_user_func(array($gestor, $_POST["nome_da_funcao"]));
		
			
	}


	

	
	
?>
