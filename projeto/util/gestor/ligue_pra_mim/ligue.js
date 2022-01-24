	 

	 
	 
	 
	function deletaLigue(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar este ligue para mim?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'ligue_pra_mim/action.php',
		
			{nome_da_funcao:'deletaLigue', 
			id:param_id},
		
			function(retorno){
			
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Ligue para mim deletado com sucesso!");
	
				location.reload();
				}
				
			
			}
		);	
	} 
	  
	 
	 
	 
	 
	 
	 
	 
	  
	 
	 
	 
	function desativarLigue(param_id, param_status){
	
		jQuery.post(
		
		getPathDoGestor()+'ligue_pra_mim/action.php',
		
			{nome_da_funcao:'desativarLigue', 
			id:param_id,
			status:param_status},
		
			function(retorno){
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			location.reload();
				
			}
		);	
	}  
	 
	 
	
	 
	 
	 