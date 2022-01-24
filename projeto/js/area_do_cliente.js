
	jQuery(document).ready(function(){
		
		jQuery('#bt_entrar').click(function(){
		
			jQuery.post( 'action.php', {
			funcao:"logar",
			usuario:jQuery("#usuario").val(),
			senha:jQuery("#senha").val(),
			}, function(requestReturn){
			
			
			var aux = jQuery.parseJSON( requestReturn );

			if(aux.status)
			location.reload();			
			else
			alert("ERRO\n\n"+aux.erro);
			
			});	
		});
		
		
		
		jQuery('#bt_sair').click(function(){
		
			jQuery.post( 'action.php', {funcao:"logoff"}, function(requestReturn){
			
			var aux = jQuery.parseJSON( requestReturn );

			if(aux.status)
			location.reload();			
			else
			alert("ERRO\n\n"+aux.erro);
			
			});
		});
		
	mostrarAba("");	
	});
	
	
	
	
	function mostrarAba(param){
	
	jQuery('.aba').hide("fast");
	
	if(param == "")
	return;
	
	
	jQuery('#'+param).show("slow");
	}
	
	
	

	function pesquisar(){


	 jQuery('#resultado_de_pesquisa').html("<p align='center' style = \"background:#EEE;min-height: 200px;text-align:center;line-height:200px;width:99%;margin: 20px 0px 0px 0.5%\">&laquo;Pesquisando, aguarde...&raquo;</p>");	
		
	var parans = "funcao=resultadoPesquisaDeChamados&termo="+jQuery('#nome_pesq').val();
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){jQuery('#resultado_de_pesquisa').html(retorno);}
		});

	}
	 
	
	
	
	
	function ultimos(){

	jQuery('#nome_pesq').val("");
	pesquisar();
	}
	
	
	
	
	
	function formNovoChamado(){
	
	 jQuery('#div_chamados').html("");	
		
	var parans = "funcao=formNovoChamado";
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_chamados').html(retorno);}
		});
	}
	
	
	
	
	
	function salvarChamado(){
	
	var parans = "funcao=salvarChamado"+
	"&assunto="+jQuery("#assunto_chama").val()+
	"&descricao="+jQuery("#descricao_chama").val()+
	"&solicitacao="+jQuery("#solicitacao").val();
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ 
		
			if(retorno.indexOf("SUCESSO_NA_GRAVACAO") < 0)
			alert("ERRO\n\n"+retorno);
				else{
				alert("SUCESSO\n\nGravação realizada com sucesso.");
				jQuery('#div_chamados').html("");	
				pesquisar();
				}
			}
		});
	}
	
	
	
	
	function formAlteraChamado(param_id_chamado){
	
	
	 jQuery('#div_chamados').html("");	
	
	var parans = "funcao=formAlteraChamado&id_chamado="+param_id_chamado;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_chamados').html(retorno);}
		});
	
	
	
	}
	
	
	
	
	
	
	function novoAssentamento(param_id_chamado){
	
	
	jQuery('#div_assentamentos').html("");	
	
	var parans = "funcao=formNovoAssentamento&id_chamado="+param_id_chamado;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_assentamentos').html(retorno);}
		});
	
	
	}
	
	
	
	
	
	function salvaAssetamento(param_id_chamado){
	
	var parans = "funcao=salvaAssetamento&id_chamado="+param_id_chamado+
	"&assentamento="+jQuery("#assentamento").val();
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ 
		
			if(retorno.indexOf("SUCESSO_NA_GRAVACAO") < 0)
			alert("ERRO\n\n"+retorno);
				else{
				alert("SUCESSO\n\nGravação realizada com sucesso.");
				
				formAlteraChamado(param_id_chamado);
				}
			}
		});
	
	}
	




	function realizarPagamento(param_id_pagamento){
	
	jQuery("#div_get_pagamento_area").html("<p style='padding-top:20px'><img src='../../imgs/wait.gif'></p><p style='padding-top:20px'>Aguarde... Processando sua solicitação.</p>");
	jQuery("#div_get_pagamento").show("fast");
	
	var parans = "funcao=realizarPagamento&id_pagamento="+param_id_pagamento;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ 
		
				if(retorno.indexOf("ERRO") >= 0){
				
				alert("ERRO\n\nInfelizmente um erro ocorreu, por favor, entre em contato conosco para relatar o ocorrido."+retorno);
				jQuery("#div_get_pagamento_area").html("");
				jQuery("#div_get_pagamento").hide("fast");
				}
				else{
				
				var aux = $.parseJSON( retorno );
		
				
				jQuery("#div_get_pagamento_area").html(
				"<p><img src='../../imgs/icon_ok.png' style='height:25px;margin-right:10px'><b>Feito! Escolha o meio de pagamento de sua preferência:</b><hr width='100%'></p>"+	
				"<div align='left' style='padding-left:5px'>"+
				"<p><br><br><img src='../../imgs/dot.png' style='height:8px;margin:0px 10px 5px 10px'>Depósito bancário ou transferência.</p><br>"+
				"<p align='left'><img src='../../imgs/logo-bradesco.png' style='height:30px;margin:0px 10px 0px 0px'></p>"+
				"<p><b>conta: </b> 1333 -1 <b>Agência:</b> 2398 -1 <b>Títular: </b>Flávio Henrique Pinheiro de Sousa</p>"+
				"<p><b>Valor (R$): </b>"+aux.valor_desconto+" (5% de desconto)</p>"+
				"<p><br><br><img src='../../imgs/dot.png' style='height:8px;margin:0px 10px 5px 10px'>Outras formas de Pagamento (cartão de crédito, boleto, etc.).</p><br>"+
				"<p><b>Valor (R$): </b>"+aux.valor_normal+"</p>"+
				"<p align='center'><a href='"+aux.url_pag+"' target='_bank'><img src='../../imgs/bt_pagar.png' width='150px'></a></p></div>");

					
				}
			}
		});
	}




	function fechar(){
	
	jQuery("#div_get_pagamento_area").html("");
	jQuery("#div_get_pagamento").hide("fast");
	}















	