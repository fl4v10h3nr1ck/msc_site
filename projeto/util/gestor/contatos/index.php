<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'contatos/Contatos.class.php';


$base = new Base();
$contatos = new Contatos();


$base->getHead($contatos->getDependencias());


$base->getTopo();


if($base->permitido())	
$contatos->getHomeContatos();	
else
$base->getLogin();


$base->getRodape();


?>




	