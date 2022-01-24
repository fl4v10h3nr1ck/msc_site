



	function login(){

		jQuery.post(
		
		getPathDoGestor()+'login/action.php',
		{nome_da_funcao:'logar',usuario:jQuery('#usuario').val(), senha:jQuery('#senha').val()},
			function(retorno){
				
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			location.href=getPathDoGestor();
			else
			alert("Usuário e ou senha inválida.");
			}
		);

	}
	 


	 
	 
	 
	 
	 
	 
	 
	 
	 
	function sair(){

		jQuery.post(
		
		getPathDoGestor()+'login/action.php',
		{nome_da_funcao:'sair'},
			function(retorno){
				
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			location.href=getPathDoGestor();
			else
			alert("Um erro ocorreu ao desconectar o usuário atual.");
			}
		);

	}
	 
