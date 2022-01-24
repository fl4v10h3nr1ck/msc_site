<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Clientes.class.php';


$clientes = new Clientes();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($clientes, $_POST["nome_da_funcao"])) 
	call_user_func(array($clientes, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
