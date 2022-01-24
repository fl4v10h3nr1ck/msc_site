
	jQuery(document).ready(function(){
		
		
		jQuery('#ddd').focus(function(){
		
		if(jQuery('#ddd').val() == "DDD")
		jQuery('#ddd').val("");
		});
		
		jQuery('#num').focus(function(){
		
		if(jQuery('#num').val() == "XXXX-XXXX")
		jQuery('#num').val("");
		});
			
		jQuery('#ramal').focus(function(){
		
		if(jQuery('#ramal').val() == "RAMAL")
		jQuery('#ramal').val("");
		});
	
	
		jQuery('#bt_enviar').click(function(){
		
		var aux = document.getElementsByName('solucao');
		var solucoes = "";
			for( var i = 0; i < aux.length; i++){
			
			if(aux[i].checked)
			solucoes +=aux[i].value+". ";
				
			}
		
			jQuery.post( 'action.php', {
			
			solucoes:solucoes,
			solicitante:jQuery("#solicitante").val(),
			empresa:jQuery("#empresa").val(),
			descricao_empresa:jQuery("#descricao_empresa").val(),
			outras_info_empresa:jQuery("#outras_info_empresa").val(),
			ddd:(jQuery("#ddd").val() == "DDD"? "":jQuery("#ddd").val()),
			num:(jQuery("#num").val() == "XXXX-XXXX"? "":jQuery("#num").val()),
			ramal:(jQuery("#ramal").val() == "RAMAL"? "":jQuery("#ramal").val()),
			email:jQuery("#email").val(),
			cidade:jQuery("#cidade").val(),
			uf:jQuery("#uf").val(),
			descricao_projeto:jQuery("#descricao_projeto").val(),
			complementares:jQuery("#complementares").val()
			}, function(requestReturn){
			
			var aux = jQuery.parseJSON( requestReturn );

				if(aux.status){
				

				var aux_sol = document.getElementsByName('solucao');
		
				for( var i = 0; i < aux_sol.length; i++)
				aux_sol[i].checked = false;
						
				jQuery("#solicitante").val("");
				jQuery("#empresa").val("");
				jQuery("#descricao_empresa").val("");
				jQuery("#outras_info_empresa").val("");
				jQuery("#ddd").val("");
				jQuery("#num").val("");
				jQuery("#ramal").val("");
				jQuery("#email").val("");
				jQuery("#cidade").val("");
				jQuery("#uf option").eq(0).prop('selected', true);
				jQuery("#descricao_projeto").val("");
				jQuery("#complementares").val("");
					
					
				alert("Pedido de orçamento enviado com sucesso, em breve entraremos em contato!");
				}				
				else{
					
				var erro = "ERRO\n\n";
		  
				for( var i = 0; i < aux.erros.length; i++)
				erro+=" - "+aux.erros[i]+"\n"; 
		
				alert(erro);
				}
			});
		});
	});
	
	
	
	