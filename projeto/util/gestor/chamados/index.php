<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'chamados/Chamados.class.php';


$base = new Base();
$chamados = new Chamados();


$base->getHead($chamados->getDependencias());


$base->getTopo();


if($base->permitido())	
$chamados->getHomeCHamados();	
else
$base->getLogin();


$base->getRodape();


?>




	