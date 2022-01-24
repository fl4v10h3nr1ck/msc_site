
	jQuery(document).ready(function(){
	
		jQuery('#bt_enviar').click(function(){
		
			 jQuery.ajax({
			 url : 'action.php?nome='+jQuery("#nome").val()+
			 '&empresa='+jQuery("#empresa").val()+
			 '&email='+jQuery("#email").val()+
			 '&msg='+jQuery("#msg").val(),
				success : function(requestReturn) {
					
				var aux = jQuery.parseJSON( requestReturn );

					if(aux.status){
					
					jQuery("#nome").val("");
					jQuery("#empresa").val("");
					jQuery("#email").val("");
					jQuery("#msg").val("");
					
					
					alert("Mensagem enviada com sucesso, em breve entraremos em contato!");
					}				
					else
					alert("Infelizmente um erro ocorreu!\n\n"+aux.erros); 

				}
			 });	 
		});
	});
	
	
	
	