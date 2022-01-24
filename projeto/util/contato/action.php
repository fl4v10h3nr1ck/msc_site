<?php

header('Content-type: text/html; charset=UTF-8');

include_once '../../libs/Biblioteca.class.php';

$biblioteca = new Biblioteca;


$erro = "";

$_GET['nome'] = $biblioteca->anti_injection($_GET['nome']);
$_GET['empresa'] = $biblioteca->anti_injection($_GET['empresa']);
$_GET['msg']  = $biblioteca->anti_injection($_GET['msg']);
$_GET['email'] = $biblioteca->anti_injection($_GET['email']);


if(strlen($_GET['nome']) == 0)
$erro .= "Informe. por favor, seu nome. ";

if(!$biblioteca->validaEmail($_GET['email']))
$erro .= "Informe. por favor, um endereço de E-mail válido. ";


if(strlen($_GET['msg']) == 0)
$erro .= "Você esqueceu de escrever a mensagem. ";


	if(strlen($erro) > 0){
	
	echo '{"status": false, "erros":"'.$erro.'"}';
	return;
	}
	

include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

$BD = new Opcoes_BD_Gerais();

	if(!$BD->aDD("contatos", 
			array("nome", "empresa", "email", "msg", "data"), 
				array($_GET['nome'], $_GET['empresa'], $_GET['email'], $_GET['msg'], date("d/m/Y H:i")))){
	
	echo '{"status": false, "erros":"Falha na gravação das informações."}';
	return;
	}


	
$biblioteca->enviaEmail("Nova mensagem de contato cadastrada no site", "Há uma nova mensagem de contato cadastrada no site. ".date("d/m/Y H:i"));
	
	
echo '{"status": true}';
?>