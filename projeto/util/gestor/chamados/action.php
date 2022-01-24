<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Chamados.class.php';


$chamados = new Chamados();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($chamados, $_POST["nome_da_funcao"])) 
	call_user_func(array($chamados, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
