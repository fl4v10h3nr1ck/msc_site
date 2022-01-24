<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'solicitacoes/Solicitacoes.class.php';


$base = new Base();
$solicitacoes = new Solicitacoes();


$base->getHead($solicitacoes->getDependencias());


$base->getTopo();


	if($base->permitido()){	
	
	if(array_key_exists("id_cliente", $_SESSION) && $_SESSION['id_cliente']>0)
	$solicitacoes->getHomeSolicitacoes();
	else
	$base->semClienteSelecionado();
	}
	else
	$base->getLogin();


$base->getRodape();


?>




	