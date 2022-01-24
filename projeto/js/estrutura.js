
PATH_RAIZ = '/';



	jQuery(document).ready(function(){
	/*
		jQuery(window).scroll(function() {
		
			if(jQuery(window).scrollTop() >=50) {
				
			if(jQuery('#superior').is(':visible'))
			jQuery('#superior').fadeOut(200);

			}
			else{
			
			if(!jQuery('#superior').is(':visible'))
			jQuery('#superior').fadeIn(200);
			
			}
		});
	*/	
		
		
	if(jQuery('#slider_portifolio').length)	
	jQuery('#slider_portifolio').coinslider({width: 300});
	
	
		jQuery('#bt_cad_tel').click(function(){
		
			 jQuery.ajax({
			 url : PATH_RAIZ+'util/cadastra_contatos/cad_tel.php?nome='+jQuery("#cad_tel_nome").val()+
			 '&ddd='+(jQuery("#cad_tel_ddd").val() == "DDD"? "":jQuery("#cad_tel_ddd").val())+
			 '&num='+(jQuery("#cad_tel_num").val() == "XXXX-XXXX"? "":jQuery("#cad_tel_num").val())+
			 '&ramal='+(jQuery("#cad_tel_ramal").val() == "RAMAL"? "":jQuery("#cad_tel_ramal").val())+
			 '&email='+jQuery("#cad_tel_email").val(),
				success : function(requestReturn) {
					
				var aux = jQuery.parseJSON( requestReturn );

					if(aux.status){
					
					jQuery("#cad_tel_nome").val("");
					jQuery("#cad_tel_ddd").val("");
					jQuery("#cad_tel_num").val("");
					jQuery("#cad_tel_ramal").val("");
					jQuery("#cad_tel_email").val("");
					
					alert("Dados cadastrados com sucesso! Em breve entraremos em contato!");
					}				
					else
					alert("Infelizmente um erro ocorreu!\n\n"+aux.erros); 

				}
			 });	 
		});
		
		
		jQuery('#cad_tel_ddd').focus(function(){
		
		if(jQuery('#cad_tel_ddd').val() == "DDD")
		jQuery('#cad_tel_ddd').val("");
		});
		
		jQuery('#cad_tel_num').focus(function(){
		
		if(jQuery('#cad_tel_num').val() == "XXXX-XXXX")
		jQuery('#cad_tel_num').val("");
		});
			
		jQuery('#cad_tel_ramal').focus(function(){
		
		if(jQuery('#cad_tel_ramal').val() == "RAMAL")
		jQuery('#cad_tel_ramal').val("");
		});
	});
	
	
	
	
	function getAltura(){
					
	if(window.innerHeight!= undefined)
	return window.innerHeight;
				
	var B= document.body, 
	D= document.documentElement;
	return Math.max(D.clientHeight, B.clientHeight);
	}
	
	