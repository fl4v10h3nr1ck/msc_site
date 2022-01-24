



	 function geraCodSolucao(){
	 
	 	jQuery.post(
		getPathDoGestor()+'sistemas/action.php',
		{nome_da_funcao:'geraCodSolucao'},
			function(retorno){ 
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			jQuery("#codigo").val(aux.codigo);
			else
			alert("Um erro ocorreu ao gerar o código da solução.");
			}
		);
	 }
	 
	



	
	
	
	 
	 	 
	function salvaSistema(param_id){
		
	var parans = {
	nome_da_funcao:"salvaSistema",
	nome:jQuery("#nome").val(),
	descricao:jQuery("#descricao").val(),
	codigo:jQuery("#codigo").val(),
	id:param_id};
	
		jQuery.post(
		
		getPathDoGestor()+'sistemas/action.php',
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
		 
	jQuery("#nome").val("");
	jQuery("#descricao").val("");
	jQuery("#codigo").val("");
	}
	 
	 
	 
	 
	 
	
	 
	  
	 
	function deletarSistema(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar esta solução e todos os dados a ela relacionados?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'sistemas/action.php',
		
			{nome_da_funcao:'deletarSistema', 
			id:param_id},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Solução deletada com sucesso!");
				location.reload(); 
				}
			}
		);	
	} 
	 
	 
	
	 
