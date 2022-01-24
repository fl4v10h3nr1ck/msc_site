<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Ligue.class.php';


$ligue = new Ligue();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($ligue, $_POST["nome_da_funcao"])) 
	call_user_func(array($ligue, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
