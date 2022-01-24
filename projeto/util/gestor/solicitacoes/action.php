<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Solicitacoes.class.php';


$solicitacoes = new Solicitacoes();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($solicitacoes, $_POST["nome_da_funcao"])) 
	call_user_func(array($solicitacoes, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
