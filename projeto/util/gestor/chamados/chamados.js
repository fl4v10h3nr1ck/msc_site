	 
	 	 
	function salvaChamado(param_id){
		
	var parans = {
	nome_da_funcao:"salvaChamado",
	descricao:jQuery("#descricao").val(),
	assunto:jQuery("#assunto").val(),
	status:jQuery("#status").val(),
	solucao:jQuery("#solucao").val(), 
	obs:jQuery("#obs").val(),
	id:param_id};
	
		jQuery.post(
		
		getPathDoGestor()+'chamados/action.php',
		parans,
			function(retorno){ 
		
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			alert("Alteração realizada com sucesso.");
			else
			alert(aux.erro);
		
			}
		);
	}

	
	 
	
	 
	 
	 
	 
	function salvaAssetamento(param_id){
		
	var parans = {
	nome_da_funcao:"salvaAssetamento",
	assentamento:jQuery("#assentamento").val(),
	id:param_id};
	
		jQuery.post(
		
		getPathDoGestor()+'chamados/action.php',
		parans,
			function(retorno){ 
		
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Cadastro realizado com sucesso.");
				
				location.reload();
				}
				else
				alert(aux.erro);

			}
		);
	} 
	 
	 
	 
	 
	 
	 
	 
	 
	function deletaAssetamento(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar este assentamento?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'chamados/action.php',
		
			{nome_da_funcao:'deletaAssetamento', 
			id:param_id},
		
			function(retorno){
			
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Assentamento deletado com sucesso!");
	
				location.reload();
				}
				
			
			}
		);	
	} 
	  
	 
	 
	 
	 
	 
	 
	 
	  
	 
	function deletaChamado(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar este chamado e todos os dados a ele relacionados?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'chamados/action.php',
		
			{nome_da_funcao:'deletaChamado', 
			id:param_id},
		
			function(retorno){
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Chamado deletado com sucesso!");
				
				location.reload();
				}
			
			}
		);	
	} 
	 
	 
	
	 
	 
	 