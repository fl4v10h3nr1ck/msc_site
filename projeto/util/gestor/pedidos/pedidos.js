	 

	 
	 
	function deletaPedido(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar este pedido?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'pedidos/action.php',
		
			{nome_da_funcao:'deletaPedido', 
			id:param_id},
		
			function(retorno){
			
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Pedido deletado com sucesso!");
	
				location.reload();
				}
				
			
			}
		);	
	} 
	  
	 
	 
	 
	 
	 
