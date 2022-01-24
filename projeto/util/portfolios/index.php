<?php
if(!isset($_SESSION))
session_start();

header('Content-type: text/html; charset=UTF-8');


include_once '../../Estrutura.class.php';

$estrutura = new Estrutura();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="DiaLab, portfolio, solucoes, clientes, parceiros, projetos, orçamento, site, sistemas, web">
	<meta name="description" content="Empresa que presta serviços em T.I. focados no desenvolvimento, gerenciamento, manutenção, adequação e atualização de softwares. Também ajudamos nossos clientes com toda a infraestrutura necessário à operação dos sistemas desenvolvidos.">
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("MSC - Portfólio") ?>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<?php $estrutura->getDependencias() ?>
	
	
	<link rel='stylesheet' href='estilo.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='script.js'></script>
	
	
	</head>
	<body>

	<?php $estrutura->getMenuPrincipal() ?>
	
	
	
		<div id="titulo" class="bgParallax" data-speed="15">
			 <article>
				<div><img src='/imgs/logo.png'></div>
				<p><h1>Estes são nossos projetos mais recentes (Julho à Outubro de 2015), <br>cada um foi um <span style='color:red'>sucesso!</span></h1></p>
			</article>
		</div>
		
		
		<div id="b_barra" class="bgParallax" data-speed="10">
		<a name="b_barra" id="b_barra"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
						<td width='50%'>
						<div align='center'><img src='imgs/dialab_logo.png' width='150px'><br><br></div>
						<div class='titulo'>Rede Laboratorial Barbosa Barra (DiaLab)</div>
						<br>
						<p align='justify'>Referência em exames laboratoriais no município de Cametá -PA, 
						o laboratório Barbosa Barra necessitava de um sistema que, além de auxiliar nas rotinas 
						administrativas e financeiras, podesse automatizar o processo de laçamento de resultados. 
						Dessa forma, desenvolvemos a solução <a href='dialab/'>DiaLab</a> que possui recursos 
						avançados desenvolvidos cuidadosamente a fim de otimizar todas as rotinas pertinentes 
						aos laboratórios, desde o laçamento e geracão de resultados de exames de forma automática 
						até o controle financeiro completo. A solução desenvolvida interliga os vários postos 
						de coleta da rede Barbosa Barra como se fosse apenas um e os pacientes podem imprimir 
						seus resutados no website do laborario que é 100% integrado ao sistema.
						<br><br></p>
						<p align='center'><a href='dialab/'>Conheça a solução DiaLab</a></p>
						<br>
						</td>			
						<td width='50%' align='right'><img src='imgs/b_barra.png' style='width:70%'></td>
					</tr>
				</table>
			</article>
		</div>
		
		
		<div id="gphs" class="bgParallax" data-speed="10">
		<a name="gphs" id="gphs"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
					<td width='50%' align='left'><img src='imgs/gphs.jpg' style='width:70%'></td>
						<td width='50%'>
						<div class='titulo'>GPHS - UFPA (site) </div>
						<br>
						<p align='justify'>O GPHS é um grupo de pesquisa da Universidade Federal do Pará (UFPA), 
						registrado no Conselho Nacional de Desenvolvimento Científico e Tecnológico (CNPQ). 
						A proposta deste projeto foi desenvolver um website que, mesmo seguindo os padrões estabelecidos pela instituição educacional, 
						fosse moderno e possuísse personalidade própria. O resultado não poderia ser melhor, o novo website do grupo é dinâmico, 
						leve e 100% responsivo e adaptativo. Respeita a padronização estabelecida porém consegue ser único.
						<br><br></p>
						<br>
						</td>			
					</tr>
				</table>
			</article>
		</div>
		
		
		<div id="cris_cosmeticos" class="bgParallax" data-speed="10">
		<a name="cris_cosmeticos" id="cris_cosmeticos"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
						<td width='50%'>
						<div align='center'><img src='imgs/logo_erp_web.png' width='150px'><br><br></div>
						<div class='titulo'>Cris Cosméticos (ERP WEB) </div>
						<br>
						<p align='justify'>A Cris Cosméticos comercializa produtos cosméticos, embelezadores e 
						de cuidado com o corpo. Assim como todo negócio do ramo a Cris Cosméticos necessitava 
						de um sistema para gerenciar vendas, estoque, financeiro, etc. Após uma rápida reunião, 
						desenvolvemos um ERP (Sistema integrado de gestão empresarial) que supriu 100% das necessidades 
						gerenciais do cliente. O sistem é WEB, hospedado pela própria MSC Soluções e está disponível para à 
						Cris Cosméticos 24 horas por dia e em qualquer lugar do mundo!
						<br><br></p>
						<br>
						</td>
						<td width='50%' align='right'><img src='imgs/cris_cosmeticos.jpg' style='width:90%'></td>						
					</tr>
				</table>
			</article>
		</div>
		
		
		
		<div id="depilsoft" class="bgParallax" data-speed="10">
		<a name="depilsoft" id="depilsoft"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
					<td width='50%' align='left'><img src='imgs/depilsoft.jpg' style='width:90%'></td>
						<td width='50%'>
						<div class='titulo'>Centro de Depilação DepilSoft (ERP)</div>
						<br>
						<p align='justify'>Gerenciar uma rede de clínicas de estética sem um sistema de 
						gestão é um verdadeiro desafio sujeito a erros e improdutividade. Um gestor experiente sabe 
						das vantagens que um ERP traz e experiência os gestores da DepilSoft têm de sobra! 
						Desenvolvemos uma solução que oferece, com poucos cliques, todos dos dados financeiros e administrativos da empresa, 
						além de controle de caixa, estoque, inventário, envio e recebimento de materiais para outras unidades, etc. A rede de 
						franguias DepilSoft está liga pelo ERP e seus gestores possuem controle total!
						
						<br><br></p>
						<br>
						</td>			
					</tr>
				</table>
			</article>
		</div>
		
		
		<div id="hrc" class="bgParallax" data-speed="10">
		<a name="hrc" id="hrc"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
						<td width='50%'>
						<div class='titulo'>Hospital Regional de Cametá (DiaLab)</div>
						<br>
						<p align='justify'>O Hospital Regional de Cametá -PA também utiliza nossa solução 
						<a href='dialab/'>DiaLab</a> no seu departamento de exames. Seu diferencial é a adaptatividade do 
						sistema à realidade do cliente. Um solução inteligente se adapta ao negócio e não o contrário. Nosso sistema 
						está preparado para suprir as necessidades de nossos clientes, sejam elas quais forem.
						<br><br></p>
						<p align='center'><a href='dialab/'>Conheça a solução DiaLab</a></p>
						<br>
						</td>			
						<td width='50%' align='right'><img src='imgs/hrc.jpg' style='width:90%'></td>
					</tr>
				</table>
			</article>
		</div>
		
		
		<div id="pref_cameta" class="bgParallax" data-speed="10">
		<a name="pref_cameta" id="pref_cameta"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
					<td width='50%' align='left'><img src='imgs/pref_cameta.jpg' style='width:90%'></td>
						<td width='50%'>
						<div align='center'><img src='imgs/logo_sisiptu.png' width='120px'><br><br></div>
						<div class='titulo'>Prefeitura de Cametá (sisIPTU)</div>
						<br>
						<p align='justify'>Um problema comum nas prefeituras municipais é a falta de ferramentas para 
						a gestão financeira e tributário. Pelo menos na prefeitura municipal de Cametá-PA este problema é 
						coisa do passado! Com a solução sisITPU a prefeitura gera quias de cobrança de impostos de forma automática, 
						assim como documentos de certidões, notas fiscais, etc. São dezenas de recursos utilissimos que mudarão para 
						melhor a administração tributária do município.
						<br><br></p>
						<br>
						</td>			
					</tr>
				</table>
			</article>
		</div>
		
		
		<div id="sat" class="bgParallax" data-speed="10">
		<a name="sat" id="sat"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
						<td width='50%'>
						<div class='titulo'>Câmara Municipal de Santo Antônio do Tauá-PA (site)</div>
						<br>
						<p align='justify'>Buscando promover de forma fácil e rápida o acesso à informação por toda comunidade do município, a 
						Câmara Municipal de Santo Antônio do Tauá-PA nos solicitou o desenvolvimendo do seu porta da transparência. E em menos de 10 dias, 
						estava no ar o novo site da câmara, com layout responsivo, adaptativo, leve e dinâmico.						
						<br></p>
						<br>
						</td>			
						<td width='50%' align='right'><img src='imgs/sat.jpg' style='width:70%'></td>
					</tr>
				</table>
			</article>
		</div>
		
		
		<div id="pref_cameta" class="bgParallax" data-speed="10">
		<a name="pref_cameta" id="pref_cameta"></a>
			<article>
				<table cellspacing='10px'>
					<tr>
					<td width='50%' align='left'><img src='imgs/b_barra_site.jpg' style='width:70%'></td>
						<td width='50%'>
						<div class='titulo'>Laboratorial Barbosa Barra (site)</div>
						<br>
						<p align='justify'>Com o sucesso do sistema <a href='dialab/' style='color:#000'>DiaLab</a> os gestores do laboratorial 
						Barbosa Barra nos solicitaram o desenvolvimento do site. O site é leve e utiliza das técnicas 
						mais modernas de desenvolvimento WEB. Seu layout é responsivo e adaptativo.
						<br><br></p>
						<br>
						</td>			
					</tr>
				</table>
			</article>
		</div>
		
		
		
		

	
	<?php $estrutura->getRodape() ?>
	
	
	</body>
</html>

