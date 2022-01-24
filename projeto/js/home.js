	
	jQuery(document).ready(function(){
		
		var alt_apresentacao = getAltura();
		//if(alt_apresentacao> 750)
		//alt_apresentacao = 700;
	
		jQuery('#apresentacao_container').css('height', alt_apresentacao);
		
		jQuery('#img_apresentacao').css('height', alt_apresentacao - 20);
		
		/*
		jQuery.vegas( 'slideshow', {
		delay: 20000,
		backgrounds: [
			{ src: 'imgs/slide_1.jpg', fade: 4000 },
			{ src: 'imgs/slide_1.jpg', fade: 4000 }
		]} )( 'overlay' );
		*/
		
		
	anima();
	});
		
		
		
	function anima(){
		
/*
			jQuery("#frase_1").fadeIn(3000, function(){
				
				window.setTimeout(function(){ 
						
					jQuery("#frase_2").fadeIn(2000, function(){
										
						window.setTimeout(function(){ 
							
							jQuery("#frase_3").fadeIn(2000, function(){
																
								window.setTimeout(function(){ 			
																
									jQuery("#frase_4").fadeIn(2000, function(){
									
									jQuery("#apresentacao_opcoes").fadeIn(1000);
									
									});
								});	
							});
						});	
					});
				});
			});
			*/
			
		
		jQuery(".frases").fadeIn(1000);							
		jQuery("#apresentacao_opcoes").fadeIn(2000);
		}
