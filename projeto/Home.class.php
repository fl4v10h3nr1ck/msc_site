<?php
header('Content-type: text/html; charset=UTF-8');



include_once 'libs/slideshow/Slide_Portifolio.class.php';



final class Home{




private $slidePortifolio;




	function __construct(){
  
	$this->slidePortifolio = new Slide_Portifolio();
	}


	
	
	
	public function getDependencias(){
	
	echo "<link rel='stylesheet' href='".RAIZ."css/home.css' type='text/css' media='all'>";
	echo "<script type='text/javascript' src='".RAIZ."js/home.js'></script>";
	echo "<link rel='stylesheet' type='text/css' href='".RAIZ."libs/vegas/jquery.vegas.min.css'>";
	echo "<script type='text/javascript' src='".RAIZ."libs/vegas/jquery.vegas.min.js'></script>";

	
	
	$this->slidePortifolio->getDependencias();
	}


	
	
	
	
	
	public function getAreaApresentacao(){
	
	echo "
	<div class='area_total' id='apresentacao_container' align='center'>
		
		
		<div id='apresentacao_frases' align='center'>
			<div class='frases' id='frase_1'><b>Mais que desenvolver softwares</b></div>
			<div class='frases' id='frase_2'><b>criamos <span style='color:red'>soluções.</span></b></div>
			<div class='frases' id='frase_3'><b>Mais que clientes temos <span style='color:red;'>parceiros!</span></b></div>
		</div>
		
		
		
		<div id='apresentacao_opcoes' align='center'>
		<hr style='color:#FFF;background:#FFF;width:120px;height:2px;margin-bottom:20px'>
			<table width='100%'>
				<tr>
				<td width='20%' align='left'><a href='".RAIZ."util/portfolios/'><img src='".RAIZ."imgs/icon_portfolio.png' class='img_chamadas_apresentacao img_chamadas'></a></td>
				<td align='center' width='60%'>
				<a href='".RAIZ."servicos.php?id=WEB'><img src='imgs/icon_web.png' class='icon_apresentacao_opcoes' title='Desenvolvimento WEB'></a>
				<a href='".RAIZ."servicos.php?id=SOFT'><img src='imgs/icon_fabrica.png' class='icon_apresentacao_opcoes' title='Fábrica de Softwares'></a>
				<a href='".RAIZ."servicos.php?id=INFRA'><img src='imgs/icon_ti.png' class='icon_apresentacao_opcoes' title='Infraestrutura em T.I.'></a>
				<a href='".RAIZ."servicos.php?id=TREINA'><img src='imgs/icon_escola.png' class='icon_apresentacao_opcoes' title='Escola de Programação'></a>
				</td>
				<td width='20%' align='center'><a href='".RAIZ."util/portfolios/dialab/'><img src='".RAIZ."util/portfolios/dialab/imgs/chamada.png' class='img_chamadas_apresentacao img_chamadas'></a></td>
				</tr>
			</table>
		</div>
				
	</div>";
	}
	
	
	
	
	
	
	
	public function getAreaFront(){
	
	echo "	
	<div class='area_total' id='div_servicos' align='center'><br><br>
		<div class='container' align='center'>	
			<div class='item_servico'>
				<p class='servicos_titulo'><img src='imgs/icon_webdev.png' style='width:30px;margin-right:10px'>Criação e Administração de Websites</p>
				<p align='justify' style='margin-top:30px;padding:25px'>Desenvolvemos soluções WEB únicas e 100% gerenciáveis. Sites, lojas virtuais, intranets corporativas, sistemas WEB. Qualquer que seja a necessidade de sua empresa, pode ter certeza, temos a tecnologia certa e o melhor custo-benefício. </p>
				<p align='right' style='margin-top:30px;padding-right:25px'><a href='".RAIZ."servicos.php?id=WEB'>Mais Detalhes...</a></p>
			</div>	
			<div class='item_servico'>	
				<p class='servicos_titulo'><img src='imgs/icon_programacao.png' style='width:30px;margin-right:10px'>Fábrica de Software</p>
				<p align='justify' style='margin-top:30px;padding:25px'>Softwares de gestão oferencem um imenso ganho de produtividade, segurança de dados e automatização do acesso à informação. Saiba como alavancar seus negócios com um sistema seguro e estável, desenvolvido exclusivamente para a sua empresa.</p>
				<p align='right' style='margin-top:30px;padding-right:25px'><a href='".RAIZ."servicos.php?id=SOFT'>Mais Detalhes...</a></p>
			</div>			
			<div class='item_servico'>
				<p class='servicos_titulo'><img src='imgs/icon_infra.png' style='width:30px;margin-right:10px'>Infraesturura em TI</p>
				<p align='justify' style='margin-top:30px;padding:25px'>Há vários benefícios na terceirização do departamento de TI. Com a MSC, você não precisa mais se preocupar como isso, gerenciamos equipamentos, softwares e redes para empresas com suporte técnico rápido e eficiente.</p>
				<p align='right' style='margin-top:30px;padding-right:25px'><a href='".RAIZ."servicos.php?id=INFRA'>Mais Detalhes...</a></p>
			</div>		
			<div class='item_servico'>
				<p class='servicos_titulo'><img src='imgs/icon_treina.png' style='width:30px;margin-right:10px'>Escola de Programação</p>
				<p align='justify' style='margin-top:30px;padding:25px'>Seu objetivo é aprender programação ou você necessita de um curso personalizado para sua equipe? Ministramos cursos de programação in loco focados nas suas necessidades, aprende o que precisa no tempo e ritmo que desejar!</p>
				<p align='right' style='margin-top:30px;padding-right:25px'><a href='".RAIZ."servicos.php?id=TREINA'>Mais Detalhes...</a></p>
			</div>
			<div style='clear:both'></div>	

			<div align='center' style='margin:10px 0px 0px 0px'>
			<a href='".RAIZ."util/solicitacao/'><img class='img_chamadas' src='".RAIZ."imgs/pedido.png'></a>
			<br><br><br>
			</div>			
		</div>
	</div>";
	}
	
	
	
	
	
	
	public function getAreaPortifolio(){
	
	
	$frases = array(
	array("A MSC possui uma equipe técnica capacitada e os serviços são realizados com responsabilidade e eficiência.","Tiago Mendonça", "Engenheiro da FAB", "depo_1.jpg", ""),
	array("Com a MSC não tem enrolação, projetos entregues antes do prazo e com a menor burocracia possível.","Cleber dos Reis", "Analista de Redes", "depo_3.jpg", ""),
	array("Equipe técnica competente, transparência e rapidez. Isso resume a MSC Soluções.","Marcelo Pamplona", "Engenheiro da computação - SEMMA-PA", "depo_2.jpg", ""),
	array("A MSC vem preenchendo uma lacuna que existe na T.I. da Região Norte. Empresa séria e focada.","Fábio André", " Analista de TI - Ministério Público", "depo_4.jpg", ""));
	
	echo "
	<div class='area_total' id='div_portfolio' align='center'>
		<div class='container' align='center'>
		<p id='portifolio_titulo'><b>Cada um de nossos projetos foi um sucesso, <span style='color:#F3FF77'>você vai se surpreender!</span></b></p>
		<div id='portifolio_subtitulo'>
		Sistemas entregues antes do prazo com custo menor do que o estipulado no orçamento. O segredo é a boa prática de desenvolvimento e uma equipe extremamente qualificada que leva as metodologias a sério.
		</div>
		
		<div align='center'>		
			<div class='item_portfolio' align='left'>
						<table class='tablefrase'>
							<tr><td width='90%' align='center'>
							<span style='color:#F3FF77'>&ldquo;".$frases[0][0]."&rdquo;</span>
							</td><td width='10%' align='center' valign='top'>
							<img src='".RAIZ."imgs/".$frases[0][3]."' class='avatar'>
							</td></tr><tr><td colspan='2' align='right'>
							<span style='font-size:13px'>".$frases[0][1]." - ".$frases[0][2]."</span>
							</td></tr>
						</table>
			</div>
			<div class='item_portfolio' align='left'>
						<table class='tablefrase'>
							<tr><td width='90%' align='center'>
							<span style='color:#F3FF77'>&ldquo;".$frases[1][0]."&rdquo;</span>
							</td><td width='10%' align='center' valign='top'>
							<img src='".RAIZ."imgs/".$frases[1][3]."' class='avatar'>
							</td></tr><tr><td colspan='2' align='right'>
							<span style='font-size:13px'>".$frases[1][1]." - ".$frases[1][2]."</span>
							</td></tr>
						</table>
						
			</div>			
			<div class='item_portfolio' align='left'>			
						<table class='tablefrase'>
							<tr><td width='90%' align='center'>
							<span style='color:#F3FF77'>&ldquo;".$frases[2][0]."&rdquo;</span>
							</td><td width='10%' align='center' valign='top'>
							<img src='".RAIZ."imgs/".$frases[2][3]."' class='avatar'>
							</td></tr><tr><td colspan='2' align='right'>
							<span style='font-size:13px'>".$frases[2][1]." - ".$frases[2][2]."</span>
							</td></tr>
						</table>
			</div>			
			<div class='item_portfolio' align='left'>
						<table class='tablefrase'>
							<tr><td width='90%' align='center'>
							<span style='color:#F3FF77'>&ldquo;".$frases[3][0]."&rdquo;</span>
							</td><td width='10%' align='center' valign='top'>
							<img src='".RAIZ."imgs/".$frases[3][3]."' class='avatar'>
							</td></tr><tr><td colspan='2' align='right'>
							<span style='font-size:13px'>".$frases[3][1]." - ".$frases[3][2]."</span>
							</td></tr>
						</table>
			</div>	
			<div style='clear:both'></div>
		</div>
	<br><br>
	</div>";
	}

	
	
	

	
	public function getClientes(){
		
	echo "
	<div class='area_total' id='div_clientes' align='center'>
		<div class='container' align='center'>
		<p id='clientes_titulo'><b>Um seleto grupo de sucesso!</b></p>
		<div id='clientes_subtitulo'>Nossos clientes crescem a cada dia e temos orgulho de fazer parte disso. Confira os mais recentes cases de sucesso:</div>
		
		<div align='center' id='container_itens_clientes'>		
			<div class='item_clientes'><a href='util/portfolios/#gphs'><img class='img_chamadas' src='".RAIZ."imgs/clientes/ufpa.jpg' style='height:100px'></a></div>
			<div class='item_clientes'><a href='util/portfolios/#b_barra'><img class='img_chamadas' src='".RAIZ."imgs/clientes/bbarra.jpg' style='width:100px'></a></div>
			<div class='item_clientes'><a href='util/portfolios/#cris_cosmeticos'><img class='img_chamadas' src='".RAIZ."imgs/clientes/cris_cosmeticos.jpg' style='width:100px'></a></div>
			<div class='item_clientes'><a href='util/portfolios/#depilsoft'><img class='img_chamadas' src='".RAIZ."imgs/clientes/depilsoft.jpg' style='width:100px'></a></div>
			<div class='item_clientes'><a href='util/portfolios/#hrc'><img class='img_chamadas' src='".RAIZ."imgs/clientes/hrc.jpg' style='width:100px'></a></div>
			<div class='item_clientes'><a href='util/portfolios/#pref_cameta'><img class='img_chamadas' src='".RAIZ."imgs/clientes/prefeitura_cameta.jpg' style='height:100px'></a></div>
			<div class='item_clientes'><a href='util/portfolios/#sat'><img class='img_chamadas' src='".RAIZ."imgs/clientes/sat.jpg' style='width:100px'></a></div>	
			<div class='item_clientes'><a href='util/portfolios/'><img class='img_chamadas' src='".RAIZ."imgs/clientes/esaccon.jpg' style='width:100px'></a></div>	
			
			<div style='clear:both'></div>	
		
			<div align='center'>
			<a href='".RAIZ."util/portfolios/'><img src='".RAIZ."imgs/portfolio.png' class='img_chamadas'></a>
			</div>		
		</div>
	</div>";	
	}
	
	
	
	
	
	
	
	public function getAreaTech(){
	
	echo "
	<div class='area_total' id='div_tecnologias' align='center'>
		<div class='container' align='center'>
			<div id='descricao_tech'>
			<p id='tech_titulo'><b>As melhores tecnologias e a melhor equipe técnica!</b></p>
			<p id='sub_titulo'>Profissionais que sabem o que usar, quando usar e porque usar. Na MSC não há soluções prontas, cada projeto é planejado para satisfazer 100% as necessidades do cliente.</p>
			</div>
			<table width='100%'>
				<tr><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_blogger.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_css3.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_html5.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_java.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_joomla.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_jquery.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_js.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_php.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_python.png' class='logo_tech'>
				</td><td align='center' width='10%'>
				<img src='".RAIZ."imgs/logos_tech/logo_wordpress.png' class='logo_tech'>
				</td></tr>
			</table>
		</div><br><br><br>
	</div>";
	}

	
	
	
	
	
	
}
?>