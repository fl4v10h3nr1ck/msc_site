<?php
if(!isset($_SESSION))
session_start();

header('Content-type: text/html; charset=UTF-8');


include_once '../../../Estrutura.class.php';

$estrutura = new Estrutura();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="DiaLab, sistemas, software, programa, clinica, diagnostico, laboratorio, gestao, financeiro,  adminisitrativo">
	<meta name="description" content="Empresa que presta serviços em T.I. focados no desenvolvimento, gerenciamento, manutenção, adequação e atualização de softwares. Também ajudamos nossos clientes com toda a infraestrutura necessário à operação dos sistemas desenvolvidos.">
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("MSC - DiaLab") ?>
	
	<link rel="icon" href="/imgs/favicon.png">
	
	<?php $estrutura->getDependencias() ?>
	
	
	<link rel='stylesheet' href='estilo.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='script.js'></script>
	
	
	</head>
	<body>

	<?php $estrutura->getMenuPrincipal() ?>
	
	
	
		<div id="titulo" class="bgParallax" data-speed="15">
			 <article>
				<div><img src='imgs/logo.png'></div>
				<p><h1>Sistema de Gestão Laboratorial</h1></p>
			</article>
		</div>
		<div id="introducao" class="bgParallax" data-speed="15">
			 <article>
				<p><font color=red><b>DiaLab</b></font> é uma solução de software que busca auxiliar na gestão administrativo-financeira dos laboratórios de análise clínica. Possui recursos avançados desenvolvidos cuidadosamente a fim de otimizar todas as rotinas pertinentes aos laboratórios, desde o laçamento e geracão de resultados de exames de forma automática até o controle financeiro completo.</p>
				<div align='right'><br><img src='imgs/fundo_introducao.png' style='height:180px;'></div>
				<p>Confira os principais recursos!</p>
			</article>
		</div>
		<div id="movimentos" class="bgParallax" data-speed="10">
			 <article>
				<table cellspacing='10px'>
					<tr>
						<td width='50%'>
						<div class='titulo'>Atendimentos e Caixa</div>
						<br>
						<p align='justify'>Realize atendimentos rápidos e tenha, com poucos cliques, seu paciente cadastrado, comprovantes gerados, resultados prontos para serem lançados e impressos e o financeiro atualizado em tempo real!</p>
						<br><br>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Atendimentos em 3 passos: cadastro de paciente, cadastro de solicitação e geração de comprovantes.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Cadastre uma única vez, tenha os dados e histórico para sempre.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Geração de via do paciente, via de controle interno e via de lançamento de resultados.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Relatórios estatísticos disponíveis em tempo real.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Tudo feito de forma simples e intuitiva.</p>
						</td>			
						<td width='50%' align='right'><img src='imgs/movimento_1.png' style='width:100%'></td>
					</tr>
				</table>
			</article>
		</div>
		<div id="clientes" class="bgParallax" data-speed="10">
			 <article>
				<table cellspacing='10px'>
					<tr>
						<td width='55%' align='left'><img src='imgs/gere_cliente.jpg' style='width:100%'></td>
						<td width='45%'>
						<div class='titulo'>Gestão Fácil de Pacientes</div>
						<br><br>
						<p align='justify'>Cadastrar e atualizar informações de clientes se torna algo corriqueiro. Você tem a sua disposição poderosas ferramentas de pesquisa que filtram os dados a partir de qualquer atributo (nome, data de nascimento, CPF, TEL, etc.) e apresentam as informações corretas rapidamente.</p>
						</td>			
					</tr>
				</table>
			</article>
		</div>
		<div id="cadastros" class="bgParallax" data-speed="10">
			 <article>
				<table cellspacing='20px'>
					<tr>
						<td width='45%'>
						<div class='titulo'>Quantitativos e Qualitativos de Exames</div>
						<br>
						<p align='justify'>Tudo que você precisa para lançar resultados está disponível no sistema <b>DiaLab</b>:</p>
						<br><br>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Materiais.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Métodos.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Parasitos, bactérias, sedimentos, etc.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Exames, grupos de exames e tipos de resultados.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>índice/moeda e valores.</p>		
						<p align='left'><img src='imgs/ok.png' class='marcador'>Especialidades, postos e convênios.</p>
						<p align='left'><img src='imgs/ok.png' class='marcador'>Tudo 100% gerenciável!</p>
						</td>
						<td width='55%' align='right'><img src='imgs/tabelas_1.jpg' style='width:100%'></td>
					</tr>
				</table>
			</article>
		</div>
		<div id="resultados" class="bgParallax" data-speed="10">
			 <article>
				<table cellspacing='20px'>
					<tr>
						<td width='50%' align='left'><img src='imgs/resultado_1.png' style='width:100%'></td>	
						<td width='50%'>
						<div class='titulo'>Resultados de Exames</div>
						<br>
						<p align='justify'>Gerencie os resultados de seus pacientes de forma simples e produtiva independentemente do volume de dados. DiaLab utiliza o que há de mais moderno e bem conceituado no que diz respeito à armazenamento de dados, desse forma, os resultados de seus pacientes estarão disponíveis sempre!</p>
						<p align='justify'>Lançar resultados é muito simples, basta escolher o paciente e selecionar o exame, produtividade levada a outro nível!</p>
						</td>
					</tr>
				</table>
			</article>
		</div>
		<div id="lancamentos" class="bgParallax" data-speed="10">
			 <article>
				<table cellspacing='20px'>
					<tr>
						<td width='45%'>
						<div class='titulo'>Lançamento de Resultados</div>
						<br>
						<p align='justify'><b>DiaLab</b> possui mais de 490 layouts de exames prontos para uso e que são periodicamente atualizados. Você pode ainda personalizar os resultados do exames da forma que quiser.</p>
						<p align='justify'>O próprio <b>DiaLab</b> calcula as relações, referenciais e normalidades e valida os resultados para você.</p>
						</td>
						<td width='55%' align='right'><img src='imgs/resultado_2.png' style='width:100%'></td>	
					</tr>
				</table>
			</article>
		</div>
		
		
		
		<div id="imprissao_resultado" class="bgParallax" data-speed="10">
			 <article>
				<table cellspacing='20px'>
					<tr>
						<td width='40%' align='left'><img src='imgs/resultado_3.png' style='width:90%'></td>
						<td width='60%'>
						<div class='titulo'>Impressão de Resultados</div>
						<br>
						<p align='justify'>Salve em PDF (e vários outros formatos) ou imprima os resultados lançados com apenas um clique. <b>DiaLab</b> foi projeta para suportar alta demanda de geração e impressão de relatórios sem perda de desempenho.</p>	
						<p align='justify'>Você tem ainda a opção de imprimir o resultado de um único exame em específico ou todos os exames no mesmo relatório economizando, assim, recursos de impressão.</p>	
						<p align='justify'>Os resultados sempre serão listados por grupos de exames para melhor entendimento.</p>	
						</td>
					</tr>
				</table>
			</article>
		</div>
		<div id="historico" class="bgParallax" data-speed="10">
			 <article>
				<table cellspacing='20px'>
					<tr>
						<td width='50%'>
						<div class='titulo'>Histórico de Paciente</div>
						<br>
						<p align='justify'>Tenha o histórico de seus pacientes sempre que precisar e sem ocupar espaço em arquivos ou perder tempo para encontrá-los. Com <b>DiaLab</b>, uma simples pesquisa lhe entrega em forma de relatório todos os dados do paciente incluindo os exames que este realizou no laboratório e seus respectivos resultados.</p>
						</td>
						<td width='50%' align='right'><img src='imgs/historico.png' style='width:90%'></td>
					</tr>
				</table>
			</article>
		</div>
		<div id="rel_financeiro" class="bgParallax" data-speed="10">
			<article>
				<table cellspacing='20px'>
					<tr>
						<td width='50%' align='left'><img src='imgs/faturamento.png' style='width:76%'></td>
						<td width='50%'>
						<div class='titulo'>Relatório de Faturamento</div>
						<br>
						<p align='justify'>A qualquer momento você poderá gerar relatórios financeiros com todos os dados referentes à entrada e saída de fundos no período que você desejar (fatura do dia, semana, mês, ano, etc.).</p>
						<p align='justify'>Assim como os resultados de exames, você poderá salvar em PDF (e vários outros formatos) ou imprimir os relatórios financeiro sem complicação.</p>		
						<p align='justify'>Os relatórios trazem informações detalhadas a cerca das operações financeiras e a partir destes é possível traçar metas, compor estratégias e identificar quais serviços são os mais (ou menos) procurados. Além disso, pode-se facilmente analisar a relação de faturamento entre períodos distintos.</p>		
						</td>
					</tr>
				</table>
			</article>
		</div>
		<div id="licenciamento" class="bgParallax" data-speed="10">
			<article>
				<table cellspacing='20px'>
					<tr>
						<td width='50%'>
						<div class='titulo'>Licenciamento</div>
						<br>
						<p align='justify'>Realizar o licenciamento do seu software é rápido e 100% online. Esqueça chaves seriais ou formulários de registro, com <b>DiaLab</b> basta manter a mensalidade de seu sistema em dia e o licenciamento se dará de forma automática e sem a menor intervenção do usuário, seu sistema estará sempre disponível!</p>
						<p align='justify'>Além disso, a <b>MSC Soluções</b> disponibiliza para você várias formas de pagamento como: boleto bancário, cartão de crédito em até 18 vezes, depósito, transferência, etc. Você poderá escolher o ciclo de pagamento que preferir (mensal, trimestral, semestral ou anual) e ganhar descontos!</p>
						</td>
						<td width='50%' align='right'><img src='imgs/registro.png' style='width:90%'></td>	
					</tr>
				</table>
			</article>
		</div>
		<div id="outros" class="bgParallax" data-speed="10">
			<article>
				<table cellspacing='20px' width='100%'>
					<tr>
						<td colspan='3' align='center'>
						<div class='titulo' align='center'>E muitos outros recursos!</div>
						</td>
					</tr>	
					<tr>
						<td width='33%' align='left'>
						<p><img src='imgs/ok.png' class='marcador'>Orçamento (impresso ou PDF).</p>
						<p><img src='imgs/ok.png' class='marcador'>Geração de segunda via de comprovantes.</p>
						<p><img src='imgs/ok.png' class='marcador'>Resultados personalizados.</p>
						<p><img src='imgs/ok.png' class='marcador'>Gestão de convênios e descontos promocionais.</p>
						<p><img src='imgs/ok.png' class='marcador'>Gestão de convênios e descontos promocionais.</p>
						<p><img src='imgs/ok.png' class='marcador'>Gestão de normalidades.</p>
						<p><img src='imgs/ok.png' class='marcador'>Integração outras unidade de coleta (filiais).</p>
						</td>
						<td width='34%' align='left'>
						<p><img src='imgs/ok.png' class='marcador'>Cadastro de médicos solicitantes.</p>
						<p><img src='imgs/ok.png' class='marcador'>PCCU.</p>
						<p><img src='imgs/ok.png' class='marcador'>Relatório de clientes (impresso ou PDF).</p>
						<p><img src='imgs/ok.png' class='marcador'>Faturamento de convênios (impresso ou PDF).</p>
						<p><img src='imgs/ok.png' class='marcador'>Faturamento de postos (impresso ou PDF).</p>
						<p><img src='imgs/ok.png' class='marcador'>Relatório de exames e tabela de preços (impresso ou PDF).</p>
						<p><img src='imgs/ok.png' class='marcador'>Atendimento agendado.</p>
						</td>
						<td width='33%' align='left'>
						<p><img src='imgs/ok.png' class='marcador'>Relatório de convênios e postos (impresso ou PDF).</p>
						<p><img src='imgs/ok.png' class='marcador'>Gestão completa de usuários, permissões e níveis de acesso.</p>
						<p><img src='imgs/ok.png' class='marcador'>Cadastro de informações institucionais.</p>
						<p><img src='imgs/ok.png' class='marcador'>Cadastro filiais.</p>
						<p><img src='imgs/ok.png' class='marcador'>Resultados online através do website do laboratório.</p>
						<p><img src='imgs/ok.png' class='marcador'>Atualizações gratuitas.</p>
						<p><img src='imgs/ok.png' class='marcador'>Suporte e manuais de utilização.</p>
						</td>
					</tr>		
				</table>
			</article>
		</div>
		
		
	
	<?php $estrutura->getRodape() ?>
	
	
	</body>
</html>

