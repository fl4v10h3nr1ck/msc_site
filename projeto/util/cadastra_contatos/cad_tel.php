<?php

header('Content-type: text/html; charset=UTF-8');

include_once '../../libs/Biblioteca.class.php';

$biblioteca = new Biblioteca;


$erro = "";

$_GET['nome'] = $biblioteca->anti_injection($_GET['nome']);
$_GET['ddd'] = $biblioteca->anti_injection($_GET['ddd']);
$_GET['num']  = $biblioteca->anti_injection($_GET['num']);
$_GET['ramal'] = $biblioteca->anti_injection($_GET['ramal']);
$_GET['email'] = $biblioteca->anti_injection($_GET['email']);


if(strlen($_GET['nome']) == 0)
$erro .= "Informe. por favor, seu nome ou nome da empresa. ";

if(!$biblioteca->validaTEL($_GET['ddd'], $_GET['num'], $_GET['ramal']))
$erro .= "Informe. por favor, um número de telefone válido. ";

if(!$biblioteca->validaEmail($_GET['email']))
$erro .= "Informe. por favor, um endereço de E-mail válido. ";


	if(strlen($erro) > 0){
	
	echo '{"status": false, "erros":"'.$erro.'"}';
	return;
	}
	

include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

$BD = new Opcoes_BD_Gerais();

	if(!$BD->aDD("ligue_para_mim", 
			array("nome", "telefone", "email", "status", "data"), 
				array($_GET['nome'], "(".$_GET['ddd'].") ".$_GET['num']." Ramal: ".$_GET['ramal'], $_GET['email'], "PENDENTE", date("d/m/Y")))){
	
	echo '{"status": false, "erros":"Falha na gravação das informações."}';
	return;
	}

	
$biblioteca->enviaEmail("Nova solicitação de -me ligue- cadastrada no site", "Há uma nova solicitação de -me ligue- cadastrada no site ".date("d/m/Y H:i"));

echo '{"status": true}';
?>