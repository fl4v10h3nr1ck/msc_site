<?php

header('Content-type: text/html; charset=UTF-8');

include_once '../../libs/Biblioteca.class.php';

$biblioteca = new Biblioteca;


$erro = array();

$_POST['solucoes'] = $biblioteca->anti_injection($_POST['solucoes']);
$_POST['solicitante'] = $biblioteca->anti_injection($_POST['solicitante']);
$_POST['empresa'] = $biblioteca->anti_injection($_POST['empresa']);
$_POST['descricao_empresa']  = $biblioteca->anti_injection($_POST['descricao_empresa']);
$_POST['outras_info_empresa'] = $biblioteca->anti_injection($_POST['outras_info_empresa']);
$_POST['ddd'] = $biblioteca->anti_injection($_POST['ddd']);
$_POST['num'] = $biblioteca->anti_injection($_POST['num']);
$_POST['ramal']  = $biblioteca->anti_injection($_POST['ramal']);
$_POST['email'] = $biblioteca->anti_injection($_POST['email']);
$_POST['cidade'] = $biblioteca->anti_injection($_POST['cidade']);
$_POST['uf']  = $biblioteca->anti_injection($_POST['uf']);
$_POST['descricao_projeto'] = $biblioteca->anti_injection($_POST['descricao_projeto']);
$_POST['complementares'] = $biblioteca->anti_injection($_POST['complementares']);

if(strlen($_POST['solucoes']) == 0)
$erro[] = "Escolha a solução desejada.";


if(strlen($_POST['solicitante']) == 0)
$erro[] = "Informe. por favor, o nome do solicitante.";

if(!$biblioteca->validaTEL($_POST['ddd'], $_POST['num'], $_POST['ramal']))
$erro[] = "Informe. por favor, um número de telefone válido.";


if(!$biblioteca->validaEmail($_POST['email']))
$erro[] = "Informe. por favor, um endereço de E-mail válido. ";

if(strlen($_POST['cidade']) == 0)
$erro[] = "Informe. por favor, a sua cidade.";

if(strlen($_POST['uf']) == 0)
$erro[] = "Informe. por favor, o seu estado (UF).";


if(strlen($_POST['descricao_projeto']) == 0)
$erro[] = "Você esqueceu de informar a descrição do projeto.";


	if(count($erro) > 0){
	
	echo '{"status": false, "erros":'.json_encode($erro).'}';
	return;
	}
	

include_once '../../libs/BD/Opcoes_BD_Gerais.class.php';

$BD = new Opcoes_BD_Gerais();

	if(!$BD->aDD("pedidos", 
			array(
			"solicitante",
			"empresa",
			"descricao_empresa",
			"outras_info_empresa",
			"telefone",
			"email",
			"cidade",
			"uf",
			"descricao_projeto",
			"info_complementares",
			"solucoes",
			"data_pedido"),
			array(
			$_POST['solicitante'],
			$_POST['empresa'],
			$_POST['descricao_empresa'],
			$_POST['outras_info_empresa'],
			"(".$_POST['ddd'].") ".$_POST['num'].(strlen($_POST['ramal']) == 0? "":" Ramal: ".$_POST['ramal']),
			$_POST['email'],
			$_POST['cidade'],
			$_POST['uf'],
			$_POST['descricao_projeto'],
			$_POST['complementares'],
			$_POST['solucoes'],
			date("d/m/Y H:i")))){
	
	echo '{"status": false, "erros":"Falha na gravação das informações."}';
	return;
	}

$biblioteca->enviaEmail("Nova solicitação de serviço", "Há uma nova solicitação de serviço cadastrada. ".date("d/m/Y H:i"));

echo '{"status": true}';
?>