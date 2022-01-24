<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Pedidos.class.php';


$pedidos = new Pedidos();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($pedidos, $_POST["nome_da_funcao"])) 
	call_user_func(array($pedidos, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
