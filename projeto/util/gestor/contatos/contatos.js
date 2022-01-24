	 

	 
	 
	function deletaContato(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar este contato?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'contatos/action.php',
		
			{nome_da_funcao:'deletaContato', 
			id:param_id},
		
			function(retorno){
			
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Contato deletado com sucesso!");
	
				location.reload();
				}
				
			
			}
		);	
	} 
	  
	 
	 
	 
	 
	 
