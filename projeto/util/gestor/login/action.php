<?php

header('Content-type: text/html; charset=UTF-8');


include_once 'Login.class.php';


$login = new Login();



	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($login, $_POST["nome_da_funcao"])) 
	call_user_func(array($login, $_POST["nome_da_funcao"]));

	}






	
	

	
	
	
	




	
?>
