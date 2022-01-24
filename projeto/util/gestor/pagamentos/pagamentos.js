



	function geraPagamentos(){
	
	if(jQuery('#solicitacao').val()==0)
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'pagamentos/action.php',
		
			{nome_da_funcao:'geraPagamentos', 
			id:jQuery('#solicitacao').val()},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			jQuery("#resultado").html(aux.dados);
			else
			alert("Um erro ocorreu ao realizar a pesquisa.");
			}
		);
	
	}




	
	 
	function mudaTipoPagamento(){
	
	if(jQuery("#tipo_pagamento").val() == "LICENCA")
	jQuery("#num_licencas").removeAttr('disabled');
		else{
		
		jQuery("#num_licencas").attr('disabled', 'disabled');
		jQuery("#num_licencas").val("");
		}

		if(jQuery("#tipo_pagamento").val() == "MENSALIDADE"){
		
		jQuery("#combo_solucoes option:first").attr('selected','selected');
		jQuery("#combo_solucoes").attr('disabled', 'disabled');
		}
		else
		jQuery("#combo_solucoes").removeAttr('disabled');
	
	}

	
	
	



	function geraCodPagamento(){
	 
	jQuery.post(
	getPathDoGestor()+'pagamentos/action.php',
	{nome_da_funcao:'geraCodPagamento'},
		function(retorno){ 
			
		var aux = jQuery.parseJSON(retorno);
			
		if(aux.resultado=='OK')
		jQuery("#cod_pagamento").val(aux.codigo);
		else
		alert("Um erro ocorreu ao gerar o código da solicitação.");
		});
	}
	 
	


	
	 
	 	 
	function salvaPagamento(param_id_solicitacao, param_id){
		
	var parans = {
	nome_da_funcao:"salvaPagamento",
	mes:jQuery("#mes_pagamento").val(),
	ano:jQuery("#ano_pagamento").val(),
	tipo:jQuery("#tipo_pagamento").val(),
	num_licencas:jQuery("#num_licencas").val(),
	valor:jQuery("#valor_pagamento").val(),
	id_solucao:jQuery("#combo_solucoes").val(),
	num_de_dias:jQuery("#tempo_pagamento").val(),
	status_pagamento:jQuery("#status_pagamento").val(),
	codigo:jQuery("#cod_pagamento").val(),
	a_partir_de:jQuery("#a_partir_de").val(),
	id_solicitacao:param_id_solicitacao,
	id:param_id};
	
		jQuery.post(
		
		getPathDoGestor()+'pagamentos/action.php',
		parans,
			function(retorno){ 
		
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Cadastro realizado com sucesso.");
				
				if(aux.limpa=='SIM')
				limpaCampos();
			
				}
				else
				alert(aux.erro);
			}
		);
	}

	
	 
	

	
	
	
	function limpaCampos(){
		 
	jQuery("#mes_pagamento").val("");
	jQuery("#ano_pagamento").val("");
	jQuery("#tipo_pagamento option").eq(0).prop('selected', true);
	jQuery("#num_licencas").val("");
	jQuery("#valor_pagamento").val("");
	jQuery("#combo_solucoes option").eq(0).prop('selected', true);
	jQuery("#tempo_pagamento").val("");
	jQuery("#status_pagamento option").eq(0).prop('selected', true);
	jQuery("#cod_pagamento").val("");
	jQuery("#a_partir_de").val("");
	}
	 
	 
	 
	 
	 
	
	 
	  
	 
	function deletarPagamento(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar este pagamento e todos os dados a ela relacionados?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'pagamentos/action.php',
		
			{nome_da_funcao:'deletarPagamento', 
			id:param_id},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Pagamento deletada com sucesso!");
				geraPagamentos();
				}
			}
		);	
	} 
	 
	 
	
	 
