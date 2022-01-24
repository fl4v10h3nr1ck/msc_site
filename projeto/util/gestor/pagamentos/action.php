<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Pagamentos.class.php';


$pagamentos = new Pagamentos();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($pagamentos, $_POST["nome_da_funcao"])) 
	call_user_func(array($pagamentos, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
