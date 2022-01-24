<?php

header('Content-type: text/html; charset=UTF-8');

include_once 'Estrutura.class.php';

$estrutura = new Estrutura();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="solicitação, servicos, ti, tecnologia, orçamento, pedidos, preços, valores, venda, como trabalhamos">
	<meta name="description" content="Empresa que presta serviços em T.I. focados no desenvolvimento, gerenciamento, manutenção, adequação e atualização de softwares. Também ajudamos nossos clientes com toda a infraestrutura necessário à operação dos sistemas desenvolvidos.">
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("MSC - Serviços") ?>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<?php $estrutura->getDependencias() ?>
	
	<link rel='stylesheet' href='css/servicos.css' type='text/css' media='all'>
	<script type='text/javascript' src='js/servicos.js'></script>	
	
	</head>
	<body>

	<?php $estrutura->getMenuPrincipal() ?>
		
		<div class='area_total' align='center'>
			<div class='container' align='left' id='div_servicos'>
			<p id='title' align='left'>Soluções únicas para empresas únicas</p>
			<p align='justify'>
			<img src='imgs/equipe2.jpg' align='right' style='width:300px;margin:0px 20px'>
			Desenvolvemos softwares sob medida 100% enquadrados na realidade do cliente. Nossos sistemas são construídos levando em consideração a dinâmica do mercado e, por isso, são adaptáveis e eficientes. Toda solução oferecida pela MSC deve:</p>
			<p><img src='imgs/icon_ok.png' class='marker'>Atender integralmente as necessidades do cliente;</p>
			<p><img src='imgs/icon_ok.png' class='marker'>Ser simples de usar, manter e atualizar;</p>
			<p><img src='imgs/icon_ok.png' class='marker'>Comprir os requisitos demandando menos recursos possíveis;</p>
			<p><img src='imgs/icon_ok.png' class='marker'>Ser uma solução inteligente, bem planejada e estruturada;</p>
			<p><img src='imgs/icon_ok.png' class='marker'>Possuir documentação clara e completa. A manutenção e atualização devem ser fácil.</p>
			<p><img src='imgs/icon_ok.png' class='marker'>Priorizar sempre que possível a utilização de softwares e/ou tecnologias livres;</p>
			<p><img src='imgs/icon_ok.png' class='marker'>Seguir metodologias e padrões de projeto bem definidos;</p>
			
			<p align='justify'>Nosso orçamentos são sempre flexíveis, determinados exclusivamente por quanto o cliente pode investir (em tempo e dinheiro). Dessa forma, as soluções desenvolvidas se adequam à necessidade do cliente e não o contrário.</p>
			
			<p align='center' id='p_frase'><b>"Nossas expectativas vão sempre além das metas"</b></p>
			
			<div align='left'>Clique e confira:</div>
			<img src='imgs/banner_website.jpg' class='aba' onclick='javascript:showItem("serv_website");'>
			<hr style='width:99.94%;height:1px;color:#066BED;background:#066BED'>
			<div class='item_servico' align='center' id='serv_website' <?php if(array_key_exists("id", $_GET) && strcmp($_GET['id'], "WEB") == 0)echo"style='display:block'"?>>
				<div class='container_item' align='left'>
				<p align='justify'>Desenvolvemos soluções WEB únicas e 100% gerenciáveis. Sites, lojas virtuais, intranets corporativas, sistemas WEB. Qualquer que seja a necessidade de sua empresa, pode ter certeza, temos a tecnologia certa e o melhor custo-benefício. As soluções WEB desenvolvidas pela MSC possuem os mais modernos padrões de desenvolvimento e as melhores tecnologias, dentre os quais é válido destacar:</p>
				<br>
				<p><img src='imgs/icon_ok.png' class='marker_menor'>Sistemas e websites 100% responsivos e adaptativos;</p>
				<p><img src='imgs/icon_ok.png' class='marker_menor'>Otmizados para mecanismos de busca e redes sociais;</p>
				<p><img src='imgs/icon_ok.png' class='marker_menor'>Otimizados para dispositivos móveis;</p>
				<p><img src='imgs/icon_ok.png' class='marker_menor'>Scripts homologados e à prova de falhas;</p>
				<p><img src='imgs/icon_ok.png' class='marker_menor'>Planejados desde início à facilitar a adição de novos recursos e atualizações;</p>
				<br>
				<div align='center'><hr style='width:40%;height:1px;color:#262E39;background:#262E39'></div>
				<p align='center'><a href='util/solicitacao/index.php?type=WEB'><img src='imgs/bt_orcamento.png' class='bt_orçamento'></a></p>
				</div>
			</div>
			
			<img src='imgs/banner_fabrica.jpg' class='aba' onclick='javascript:showItem("serv_fabrica");'>
			<hr style='width:99.94%;height:1px;color:#285116;background:#285116'>
			<div class='item_servico' align='center' id='serv_fabrica' <?php if(array_key_exists("id", $_GET) && strcmp($_GET['id'], "SOFT") == 0)echo"style='display:block'"?>>		
				<div class='container_item' align='left'>
					<p align='justify'>Softwares de gestão oferencem um imenso ganho de produtividade, segurança de dados e automatização do acesso à informação. Temos experiência na criação de sistemas de:</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Gestão financeira;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Gestão de estoque;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Gestão de serviços;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Folha de pagamento;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Contabilidade;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Gestão imobiliária;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Advocacia;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Controle de vendas;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Escolas, instituição de ensino e treinamento;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Agendas empresariais;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Sistema para Autoescolas;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Sistema para estatísticas e relatórios;</p>
					<br>
					<p align='justify'>Caso a necessidade da sua empresa não esteja na lista não se preoculpe, nossa equipe técnica conta com engenheiros de requisitos talentos que irão, de forma rápida e eficiente, projetar a melhor solução pra você!</p>
					<div align='center'><hr style='width:40%;height:1px;color:#262E39;background:#262E39'></div>
					<p align='center'><a href='util/solicitacao/index.php?type=SOFT'><img src='imgs/bt_orcamento.png' class='bt_orçamento'></a></p>
				</div>
			</div>
			
			<img src='imgs/banner_infra.jpg' class='aba' onclick='javascript:showItem("serv_infra");'>
			<hr style='width:99.94%;height:1px;color:#CF000A;background:#CF000A'>
			<div class='item_servico' align='center' id='serv_infra' <?php if(array_key_exists("id", $_GET) && strcmp($_GET['id'], "INFRA") == 0)echo"style='display:block'"?>>
				<div class='container_item' align='left'>
					<p align='justify'>Há vários benefícios na terceirização do departamento de TI. Com a MSC, você não precisa mais se preocupar com isso, gerenciamos equipamentos, softwares e redes para empresas com suporte técnico rápido e eficiente. Se a sua necessidade é um software mas não dispõe da infraestrtura necessária, não se preocupe, nós cuidamos de tudo! desde a implantação da rede à configuração do sistema nas estações de trabalho. Podemos lhe ajudar com:</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Projeto, implantação e reestruturação de redes;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Leventamento de servidores e serviços;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Configuração de estações de trabalho;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Sistemas de usuários, arquivos, e-mails;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Gestão de equipamentos de informática;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Suporte técnico (Helpdesk);</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Treinamento técnico;</p>
					<br>
					<div align='center'><hr style='width:40%;height:1px;color:#262E39;background:#262E39'></div>
					<p align='center'><a href='util/solicitacao/index.php?type=INFRA'><img src='imgs/bt_orcamento.png' class='bt_orçamento'></a></p>
				</div>
			</div>
			
			<img src='imgs/banner_treina.jpg' class='aba' onclick='javascript:showItem("serv_treina");'>
			<hr style='width:99.94%;height:1px;color:#858584;background:#858584'>
			<div class='item_servico' align='center' id='serv_treina' <?php if(array_key_exists("id", $_GET) && strcmp($_GET['id'], "TREINA") == 0)echo"style='display:block'"?>>
				<div class='container_item' align='left'>
					<p align='justify'>Oferecemos cursos de programação in loco individuais ou para equipes. Nossos cursos são flexíveis tanto na carga horária quanto no conteúdo programático que são definidos baseados na realidade do aluno. As aulas têm duração de 2 a 6 horas e podem ser realizadas 2 ou 3 vezes por semana. Ao finalizar o curso os alunos realizam um exame e recebem um certificado de conclusão.</p>
					<p align='justify'>Formamos programadores em pouquíssimas semanas! Escolha o curso:</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Linguagem C (nível 1 e 2);</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Linguagem Java SE (nível 1 e 2);</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Linguagem Java EE;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Linguagem PHP;</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Desenvolvedor WEB (nível 1 e 2);</p>
					<p><img src='imgs/icon_ok.png' class='marker_menor'>Engenharia de software;</p><br>
					<p align='justify'>...E solicite um orçamento!</p>
					<br>
					<div align='center'><hr style='width:40%;height:1px;color:#262E39;background:#262E39'></div>
					<p align='center'><a href='util/solicitacao/index.php?type=TREINA'><img src='imgs/bt_orcamento.png' class='bt_orçamento'></a></p>
				</div>
			</div>		
		</div>
	<?php $estrutura->getRodape() ?>
	
	
	</body>
</html>