<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";



include_once RAIZ_GESTOR_ABSOLUTA.'Base.class.php';
include_once RAIZ_GESTOR_ABSOLUTA.'pedidos/Pedidos.class.php';


$base = new Base();
$pedidos = new Pedidos();


$base->getHead($pedidos->getDependencias());


$base->getTopo();


if($base->permitido())	
$pedidos->getHomePedidos();	
else
$base->getLogin();


$base->getRodape();


?>




	