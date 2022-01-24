<?php

if(!isset($_SESSION))
session_start();



chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";




final class Login{

	
	



	
	
	
	final function getForm(){

	$opcoes = "
	<form action='javascript:login();' method='POST'>
		<table id='login_tab_form_login'>
			<tr><td>
			Usuário:<br>
			<input type='text' name='usuario' id='usuario'  value='' maxlength='200' style='width:98%;margin:0px 0px 7px 0px'/>
			</td></tr>
			<tr><td>
			Senha:<br>
			<input type='password' name='senha' id='senha'  value='' maxlength='200' style='width:98%'/>
			</td></tr>
			<tr><td align='center'>
			<input type='submit' value='Entrar' style='margin:40px;width:120px;height:25px'>
			</td></tr>
		</table>
	</form>";
	
	echo $opcoes;
	}


	
	
	

	
	
	final function logar(){
	
	include_once RAIZ_ABSOLUTA.'libs/Biblioteca.class.php';

	$biblioteca = new Biblioteca();
	
	$_POST['usuario'] = $biblioteca->anti_injection($_POST['usuario']);
	$_POST['senha']   = $biblioteca->anti_injection($_POST['senha']);
	
	
		if(
			$_POST['usuario']!=null && 
			$_POST['senha']!=null &&	 	
			strlen($_POST['usuario'])>0 && 
			strlen($_POST['senha'])>0 && 
			strcmp($_POST['usuario'], "@dmin")==0 && 
			strcmp($_POST['senha'], "99214334234fl4v10")==0){
		

		$_SESSION['status'] = true;
		$_SESSION['usuario'] = $_POST['usuario'];

		
		echo '{"resultado":"OK"}'; 
	
		return;
		}
			
			

	echo '{"resultado":"ERRO"}';		
	}
	
	
	
	

	
	
	
	
	final function sair(){
		
	$_SESSION['status'] = false;
	$_SESSION['usuario'] = "";

	echo '{"resultado":"OK"}';		
	}




	
}
	

	
?>