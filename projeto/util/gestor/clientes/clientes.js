



	function pesquisar(){

		jQuery.post(
		
		getPathDoGestor()+'clientes/action.php',
		
			{nome_da_funcao:'pesquisar', 
			termos:jQuery('#termos').val()},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			jQuery("#local_resultados_de_pesquisa").html(aux.dados);
			else
			alert("Um erro ocorreu ao realizar a pesquisa.");
			}
		);

	}
	 


	 
	 
	


	function mudaTipo(){
	
		if(jQuery("#tipo").val() == "PF"){
		jQuery("#cnpj").attr('disabled', 'disabled');
		jQuery("#cnpj").val("");
		jQuery("#cpf").removeAttr('disabled');
		}
		else{
		jQuery("#cnpj").removeAttr('disabled');
		jQuery("#cpf").val("");
		jQuery("#cpf").attr('disabled', 'disabled');
		}	
	}



	
	
	
	

	function geraSenha(){ 
		
		jQuery.post(
		getPathDoGestor()+'clientes/action.php',
			{nome_da_funcao:'geraSenha'},
			function(retorno){ jQuery("#senha").val(retorno);}
		);
	}




	
	
	
	 
	 	 
	function salvaCliente(param_id){
		
	var parans = {
	nome_da_funcao:"salvaCliente",
	tipo:jQuery("#tipo").val(),
	nome:jQuery("#nome_razao").val(),
	cpf_cnpj:(jQuery("#tipo").val()=="PF"?jQuery("#cpf").val():jQuery("#cnpj").val()),
	rg_ie:jQuery("#rg_ie").val(),
	email:jQuery("#email").val(),
	nome_contato:jQuery("#nome_contato").val(),
	ddd_1:jQuery("#tel_ddd_1").val(),
	num_1:jQuery("#tel_num_1").val(),
	ramal_1:jQuery("#tel_ramal_1").val(),
	ddd_2:jQuery("#tel_ddd_2").val(),
	num_2:jQuery("#tel_num_2").val(),
	ramal_2:jQuery("#tel_ramal_2").val(),
	descricao_empresa:jQuery("#descricao_empresa").val(),
	outras_info:jQuery("#outras_info").val(),
	cidade:jQuery("#cidade").val(),
	uf:jQuery("#uf").val(),
	logradouro:jQuery("#logradouro").val(),
	num:jQuery("#num").val(),
	cep:jQuery("#cep").val(),
	obs:jQuery("#obs").val(),
	nome_user:jQuery("#nome_user").val(),
	senha:jQuery("#senha").val(),
	id:param_id};
	

		jQuery.post(
		
		getPathDoGestor()+'clientes/action.php',
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
		 
	jQuery("#tipo").val("");
	jQuery("#nome_razao").val("");
	jQuery("#tipo").val("");
	jQuery("#cpf").val("");
	jQuery("#cnpj").val("");
	jQuery("#rg_ie").val("");
	jQuery("#email").val("");
	jQuery("#nome_contato").val("");
	jQuery("#tel_ddd_1").val("");
	jQuery("#tel_num_1").val("");
	jQuery("#tel_ramal_1").val("");
	jQuery("#tel_ddd_2").val("");
	jQuery("#tel_num_2").val("");
	jQuery("#tel_ramal_2").val("");
	jQuery("#descricao_empresa").val("");
	jQuery("#outras_info").val("");
	jQuery("#cidade").val("");
	jQuery("#uf").val("");
	jQuery("#logradouro").val("");
	jQuery("#num").val("");
	jQuery("#cep").val("");
	jQuery("#obs").val("");
	jQuery("#nome_user").val("");
	jQuery("#senha").val("");	 
	}
	 
	 
	 
	 
	 
	 
	 
	function selecionarCliente(param_id, param_nome){
		
		jQuery.post(
		
		getPathDoGestor()+'clientes/action.php',
		
			{nome_da_funcao:'selecionarCliente', 
			id:param_id, 
			nome:param_nome},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			jQuery("#nome_cliente_selecionado").html("<b>Cliente Selecionado:</b> "+aux.dados);
			
			}
		);	
	} 
	 
	 
	 
	 
	 
	 
	  
	 
	function deletarCliente(param_id){
	
	if(!confirm("Você tem certeza que deseja deletar este cliente e todos os dados a ele relacionados?"))
	return;
	
		jQuery.post(
		
		getPathDoGestor()+'clientes/action.php',
		
			{nome_da_funcao:'deletarCliente', 
			id:param_id},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
				if(aux.resultado=='OK'){
				
				alert("Cliente deletado com sucesso!");
				
				pesquisar();
				}
				
			
			}
		);	
	} 
	 
	 
	
	 
	 
	function desativarCliente(param_id, param_status){
	
		jQuery.post(
		
		getPathDoGestor()+'clientes/action.php',
		
			{nome_da_funcao:'desativarCliente', 
			id:param_id,
			status:param_status},
		
			function(retorno){
			
			//alert(retorno);
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			pesquisar();
				
			}
		);	
	}  
	 
	 
	 
	 
	 