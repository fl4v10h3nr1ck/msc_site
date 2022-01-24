<?php


include_once $_SERVER['DOCUMENT_ROOT'].'/libs/BD/Opcoes_BD_Gerais.class.php';

$BD = new Opcoes_BD_Gerais;
	

echo $BD->executaQuery("ALTER TABLE pagamentos ADD a_partir_de DATE NULL")===false?"ERRO":"OK";
echo "<br>";	
echo $BD->executaQuery("ALTER TABLE `clientes` ADD `status` ENUM('ATIVO', 'INATIVO')")===false?"ERRO":"OK";
echo "<br>";	
echo $BD->executaQuery("UPDATE clientes SET status = 'ATIVO'")===false?"ERRO":"OK";
echo "<br>";
echo $BD->executaQuery("ALTER TABLE solucoes ADD status ENUM('ATIVO', 'INATIVO')")===false?"ERRO":"OK";
echo "<br>";
echo $BD->executaQuery("UPDATE solucoes SET status = 'ATIVO'")===false?"ERRO":"OK";
echo "<br>";
echo $BD->executaQuery("ALTER TABLE ligue_para_mim ADD status ENUM('PENDENTE', 'RETORNADO') NULL")===false?"ERRO":"OK";
echo "<br>";
echo $BD->executaQuery("ALTER TABLE ligue_para_mim ADD data VARCHAR(20) NULL")===false?"ERRO":"OK";
echo "<br>";




?>