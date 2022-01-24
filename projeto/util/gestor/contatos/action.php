<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Contatos.class.php';


$contatos = new Contatos();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($contatos, $_POST["nome_da_funcao"])) 
	call_user_func(array($contatos, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
