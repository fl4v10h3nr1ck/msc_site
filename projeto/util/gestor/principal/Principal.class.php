<?php

header('Content-type: text/html; charset=UTF-8');


if(!isset($_SESSION))
session_start();


chdir(dirname(__FILE__)); chdir('../');


include_once getcwd()."/define.php";





final class Principal{

	
	
	
	
	final function getDependencias(){
		
	return "<link rel='stylesheet' href='".RAIZ_GESTOR."principal/principal.css' type='text/css' media='all'>";
	}


	
	
	
	
	
	
	
	
	
	final function getHome(){

	$opcoes = "
	
	<div id='principal_principal' align='center'>
		<table width='80%'>
			<tr>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."clientes/\"' class='botao' id='botao_cliente'></button><br>Clientes</td>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."sistemas/\"' class='botao' id='botao_sistemas'></button><br>Soluções</td>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."solicitacoes/\"' class='botao' id='botao_solicitacoes' ".(array_key_exists("id_cliente", $_SESSION) && $_SESSION['id_cliente']>0?"":"disabled")."></button><br>Solicitações</td>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."pagamentos/\"' class='botao' id='botao_pagamentos' ".(array_key_exists("id_cliente", $_SESSION) && $_SESSION['id_cliente']>0?"":"disabled")."></button><br>Pagamentos</td>
			</tr>
			<tr>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."chamados/\"' class='botao' id='botao_chamado'></button><br>Chamados</td>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."ligue_pra_mim/\"' class='botao' id='botao_ligue'></button><br>Ligue p/ Mim</td>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."pedidos/\"' class='botao' id='botao_pedidos'></button><br>Pedidos</td>
				<td align='center' width='25%'><button onClick='location.href=\"".RAIZ_GESTOR."contatos/\"' class='botao' id='botao_contatos'></button><br>Contatos</td>
			</tr>
		</table>
	</div>";
	
	echo $opcoes;
	}


	
	
	
	
	
}
	

?>