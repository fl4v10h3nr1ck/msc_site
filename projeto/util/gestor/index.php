<?php
header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


include_once 'Base.class.php';
include_once 'principal/Principal.class.php';

$base = new Base();
$principal = new Principal();


$base->getHead($principal->getDependencias());


$base->getTopo();


if($base->permitido())
$principal->getHome();	

else
$base->getLogin();


$base->getRodape();


?>

