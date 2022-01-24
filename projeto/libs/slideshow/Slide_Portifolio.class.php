<?php
header('Content-type: text/html; charset=UTF-8');


chdir(dirname(__FILE__)); 
chdir('../');



final class Slide_Portifolio{




	public function getDependencias(){
	
	echo "
	<link rel='stylesheet' href='".RAIZ."libs/slideshow/coin-slider-styles.css' type='text/css' media='all'>
	<script type='text/javascript' src='".RAIZ."libs/slideshow/coin-slider.min.js'></script>";
	}

	
	
	
	
	
	public function getSlide(){
	
	return  "
	<div id='slider_portifolio'>
    <img src='".RAIZ."imgs/portfolio/portfolio_1.png'/>
    <img src='".RAIZ."imgs/portfolio/portfolio_2.png'/>
	<img src='".RAIZ."imgs/portfolio/portfolio_3.png'/>
	<img src='".RAIZ."imgs/portfolio/portfolio_4.png'/>
	<img src='".RAIZ."imgs/portfolio/portfolio_5.png'/>
	<img src='".RAIZ."imgs/portfolio/portfolio_6.png'/>
	</div>";
	
	
	}
	
	
	
	
	
	
	
	
	


}