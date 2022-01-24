<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'clientes/Clientes.class.php';


$base = new Base();
$clientes = new Clientes();


$base->getHead($clientes->getDependencias());


$base->getTopo();


if($base->permitido())	
$clientes->getHomeClientes();	
else
$base->getLogin();


$base->getRodape();


?>




	