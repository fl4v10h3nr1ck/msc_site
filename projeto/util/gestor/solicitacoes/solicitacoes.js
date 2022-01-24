



	 function geraCodSolicitacao(){
	 
	 	jQuery.post(
		getPathDoGestor()+'solicitacoes/action.php',
		{nome_da_funcao:'geraCodSolicitacao'},
			function(retorno){ 
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			jQuery("#cod_solicitacao").val(aux.codigo);
			else
			alert("Um erro ocorreu ao gerar o código da solicitação.");
			}
		);
	 }
	 
	


	
	 
	 	 
	function salvaSolicitacao(param_id_cliente, param_id){
		
	var parans = {
	nome_da_funcao:"salvaSolicitacao",
	status:jQuery("#status").val(),
	solucao:jQuery("#solucao").val(),
	codigo:jQuery("#cod_solicitacao").val(),
	ciclo:jQuery("#ciclo").val(),
	detalhes:jQuery("#detalhes").val(),
	id_cliente:param_id_cliente,
	id:param_id};
	
		jQuery.post(
		
		getPathDoGestor()+'solicitacoes/action.php',
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
		 
	jQuery("#status").val("");
	jQuery("#solucao").val("");
	jQuery("#cod_solicitacao").val("");
	jQuery("#ciclo").val("");
	jQuery("#detalhes").val("");
	}
	 
	 
	 
	 
	 
	
	 
	  
	 
	function deletarSolicitacao(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar esta solicitação e todos os dados a ela relacionados?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'solicitacoes/action.php',
		
			{nome_da_funcao:'deletarSolicitacao', 
			id:param_id},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Solicitação deletada com sucesso!");
				location.reload(); 
				}
			}
		);	
	} 
	 
	 
	
	 
