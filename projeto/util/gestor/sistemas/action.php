<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Sistemas.class.php';


$sistemas = new Sistemas();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($sistemas, $_POST["nome_da_funcao"])) 
	call_user_func(array($sistemas, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
