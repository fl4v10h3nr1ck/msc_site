
/*********************************************************** clientes *****************************************************************/

	function mudaTipo(){
	
		if(jQuery("#tipo").val() == "PF"){
		jQuery("#cnpj").attr('disabled', 'disabled');
		jQuery("#cpf").removeAttr('disabled');
		}
		else{
		jQuery("#cnpj").removeAttr('disabled');
		jQuery("#cpf").attr('disabled', 'disabled');
		}	
	}




	function pesquisar(){


	 jQuery('#div_clientes').html("<p align='center' style = \"background:#EEE;min-height: 200px;text-align:center;line-height:200px;width:99%;margin: 20px 0px 0px 0.5%\">&laquo;Pesquisando, aguarde...&raquo;</p>");	
		
	var parans = "nome_da_funcao=getClientes&termo="+jQuery('#senha').val();
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_clientes').html(retorno);}
		});

	}
	 

	
	
	function selecionaCliente(param_id_cliente){
	
	jQuery("#tabela_clientes tr").css("background", "#FFF");
	jQuery("#cliente_tr_"+param_id_cliente).css("background", "#36C9C4");
	}
	
	
	
	
	function novoCliente(){


	 jQuery('#div_area_de_dados').html("");	
		
	var parans = "nome_da_funcao=formNovoCliente";
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_dados').html(retorno);}
		});

	}
	 

	 
	 	 
	function salvaCliente(){
		
	var parans = "nome_da_funcao=salvaCliente"+
	"&tipo="+jQuery("#tipo").val()+
	"&nome="+jQuery("#nome_razao").val()+
	"&cpf_cnpj="+(jQuery("#tipo").val()=="PF"?jQuery("#cpf").val():jQuery("#cnpj").val())+
	"&rg_ie="+jQuery("#rg_ie").val()+
	"&email="+jQuery("#email").val()+
	"&nome_contato="+jQuery("#nome_contato").val()+
	"&ddd_1="+jQuery("#tel_ddd_1").val()+
	"&num_1="+jQuery("#tel_num_1").val()+
	"&ramal_1="+jQuery("#tel_ramal_1").val()+
	"&ddd_2="+jQuery("#tel_ddd_2").val()+
	"&num_2="+jQuery("#tel_num_2").val()+
	"&ramal_2="+jQuery("#tel_ramal_2").val()+
	"&descricao_empresa="+jQuery("#descricao_empresa").val()+
	"&outras_info="+jQuery("#outras_info").val()+
	"&cidade="+jQuery("#cidade").val()+
	"&uf="+jQuery("#uf").val()+
	"&logradouro="+jQuery("#logradouro").val()+
	"&num="+jQuery("#num").val()+
	"&cep="+jQuery("#cep").val()+
	"&obs="+jQuery("#obs").val()+
	"&nome_user="+jQuery("#nome_user").val()+
	"&senha="+jQuery("#senha").val();
	

		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ 
		
			if(retorno.indexOf("SUCESSO_NA_GRAVACAO") < 0)
			alert("ERRO\n"+retorno);
				else{
				alert("SUCESSO\nGravação realizada com sucesso.");
				 jQuery('#div_area_de_dados').html("");	
				pesquisar();
				}
			}
		});
	 }

	 
	 
	 
	function geraSenha(){ 
	
	jQuery.ajax({
	type: 'post',
	data: "nome_da_funcao=geraSenha",
	dataType: 'html',
	url:'action.php',
	success: function(retorno){ jQuery("#senha").val(retorno);}
	});
	


	
	}
	 
	 
	 
	 
	 function formAlterCliente(param_id){
	 
	 selecionaCliente(param_id);
	 
	 jQuery('#div_area_de_dados').html("");	
		
	var parans = "nome_da_funcao=formAlterCliente&id="+param_id;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_dados').html(retorno);}
		}); 
	 
	 }
	 
	 
	 
	 
	 function alterarCliente(param_id){
	 
	 var parans = "nome_da_funcao=alteraCliente&id="+param_id+
	"&tipo="+jQuery("#tipo").val()+
	"&nome="+jQuery("#nome_razao").val()+
	"&cpf_cnpj="+(jQuery("#tipo").val()=="PF"?jQuery("#cpf").val():jQuery("#cnpj").val())+
	"&rg_ie="+jQuery("#rg_ie").val()+
	"&email="+jQuery("#email").val()+
	"&nome_contato="+jQuery("#nome_contato").val()+
	"&ddd_1="+jQuery("#tel_ddd_1").val()+
	"&num_1="+jQuery("#tel_num_1").val()+
	"&ramal_1="+jQuery("#tel_ramal_1").val()+
	"&ddd_2="+jQuery("#tel_ddd_2").val()+
	"&num_2="+jQuery("#tel_num_2").val()+
	"&ramal_2="+jQuery("#tel_ramal_2").val()+
	"&descricao_empresa="+jQuery("#descricao_empresa").val()+
	"&outras_info="+jQuery("#outras_info").val()+
	"&cidade="+jQuery("#cidade").val()+
	"&uf="+jQuery("#uf").val()+
	"&logradouro="+jQuery("#logradouro").val()+
	"&num="+jQuery("#num").val()+
	"&cep="+jQuery("#cep").val()+
	"&obs="+jQuery("#obs").val()+
	"&nome_user="+jQuery("#nome_user").val()+
	"&senha="+jQuery("#senha").val();
	

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
				 jQuery('#div_area_de_dados').html("");	
				pesquisar();
				}
			}
		});
	 }
	 
	 
/*********************************************************** solicitacoes *****************************************************************/	 
	
	
	 function mostrarSolicitacoes(param_id){
	 
	 selecionaCliente(param_id);
	 
	 jQuery('#div_area_de_dados').html("");	
		
	var parans = "nome_da_funcao=mostrarSolicitacoes&id="+param_id;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_dados').html(retorno);}
		}); 
	 }
	 
	 
	 
	 
	function selecionaSolicitacao(param_id_solicitacao){
	
	jQuery("#tabela_solicitacao tr").css("background", "#FFF");
	jQuery("#solicitacao_tr_"+param_id_solicitacao).css("background", "#36C9C4");
	}
	
	
	
	 
	 
	 function novaSolicitacao(param_id_cliente){
	 
	 jQuery('#div_area_de_dados').html("");	
		
	var parans = "nome_da_funcao=novaSolicitacao&id_cliente="+param_id_cliente;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_dados').html(retorno);}
		});

	 }
	 
	 
	 
	 
	 function salvaSolicitacao(param_id_cliente){
	
	 var parans = "nome_da_funcao=salvaSolicitacao&id="+param_id_cliente+
	"&solucao="+jQuery("#solucao").val()+
	"&status="+jQuery("#status").val()+
	"&ciclo="+jQuery("#ciclo").val()+
	"&detalhes="+jQuery("#detalhes").val()+
	"&cod="+jQuery("#cod_solicitacao").val();
	

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
				
				mostrarSolicitacoes(param_id_cliente);
				}
			}
		});

	 }
	 
	 
	 
	 
	 function formAlterSolicitacao(param_id_cliente, param_id_solicitacao){
	 
	 jQuery('#div_area_de_dados').html("");	
		
	var parans = "nome_da_funcao=formAlterSolicitacao&id_cliente="+param_id_cliente+"&id_solicitacao="+param_id_solicitacao;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_dados').html(retorno);}
		});

	 }
	 
	 
	 
	 
	  function alterSolicitacao(param_id_cliente, param_id_solicitacao){
	
	 var parans = "nome_da_funcao=alterSolicitacao&id_solicitacao="+param_id_solicitacao+
	"&solucao="+jQuery("#solucao").val()+
	"&status="+jQuery("#status").val()+
	"&ciclo="+jQuery("#ciclo").val()+
	"&detalhes="+jQuery("#detalhes").val()+
	"&cod="+jQuery("#cod_solicitacao").val();
	
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
			
				mostrarSolicitacoes(param_id_cliente);
				}
			}
		});

	 }
	 
	 
	 
/*********************************************************** pagamentos *****************************************************************/	 
	
	 
	 function mudaTipoPagamento(){
	
	if(jQuery("#tipo_pagamento").val() == "LICENCA")
	jQuery("#num_licencas").removeAttr('disabled');
	else
	jQuery("#num_licencas").attr('disabled', 'disabled');
	

	if(jQuery("#tipo_pagamento").val() == "MENSALIDADE")
	jQuery("#combo_solucoes").attr('disabled', 'disabled');
	else
	jQuery("#combo_solucoes").removeAttr('disabled');

	
	}

	 
	 
	 
	function mostrarPagamentos(param_id_solicitacao){
	 
	 selecionaSolicitacao(param_id_solicitacao);
	 
	 jQuery('#div_area_de_pagamento').html("");	
		
	var parans = "nome_da_funcao=mostrarPagamentos&id_solicitacao="+param_id_solicitacao;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_pagamento').html(retorno);}
		}); 
	 }
	 
	 
	 
	 
	function novoPagamento(param_id_solicitacao){
	 
	 jQuery('#div_area_de_pagamento').html("");	
		
	var parans = "nome_da_funcao=formNovoPagamento&id_solicitacao="+param_id_solicitacao;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_pagamento').html(retorno);}
		});
	 }
	 
	 
	  
	  
	function geraCodSolicitacao(){
	
		 jQuery.ajax({
		type: 'post',
		data: "nome_da_funcao=geraCodSolicitacao",
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery("#cod_solicitacao").val(retorno);}
		 });
	}  
	  
	 
	 
	 
	 function salvaPagamento(param_id_solicitacao){
	 
	 var parans = "nome_da_funcao=salvaPagamento&id_solicitacao="+param_id_solicitacao+
	"&tipo="+jQuery("#tipo_pagamento").val()+
	"&status="+jQuery("#status_pagamento").val()+
	"&valor="+jQuery("#valor_pagamento").val()+
	"&num_licencas="+jQuery("#num_licencas").val()+
	"&mes="+jQuery("#mes_pagamento").val()+
	"&cod="+jQuery("#cod_pagamento").val()+
	"&solucao="+jQuery("#combo_solucoes").val()+
	"&tempo="+jQuery("#tempo_pagamento").val()+
	"&ano="+jQuery("#ano_pagamento").val();
	
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
				
				mostrarPagamentos(param_id_solicitacao);
				}
			}
		});

	 }
	 
	 

	 
	 function formAlteraPagamento(param_id_solicitacao, param_id_pagamento){
	 
	 jQuery('#div_area_de_pagamento').html("");	
		
	var parans = "nome_da_funcao=formAlteraPagamento&id_solicitacao="+param_id_solicitacao+"&id_pagamento="+param_id_pagamento;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_pagamento').html(retorno);}
		});

	 }
	 
	 
	 
	 
	 function alteraPagamento(param_id_solicitacao, param_id_pagamento){
	
	 var parans = "nome_da_funcao=alteraPagamento&id_pagamento="+param_id_pagamento+
	"&tipo="+jQuery("#tipo_pagamento").val()+
	"&status="+jQuery("#status_pagamento").val()+
	"&valor="+jQuery("#valor_pagamento").val()+
	"&num_licencas="+jQuery("#num_licencas").val()+
	"&ano="+jQuery("#ano_pagamento").val()+
	"&mes="+jQuery("#mes_pagamento").val()+
	"&status_licen="+jQuery("#status_licen_pagamento").val()+
	"&solucao="+jQuery("#combo_solucoes").val();
	
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
				
				mostrarPagamentos(param_id_solicitacao);
				}
			}
		});

	 }
	 
	 
	 
	 
	 function geraCodPagamento(){
	 
		 jQuery.ajax({
		type: 'post',
		data: "nome_da_funcao=geraCodPagamento",
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery("#cod_pagamento").val(retorno);}
		 });
	 }
	 
	 
	 
	 
	 function excluirPagamento(param_id_solicitacao, param_id_pagamento){
		 
	 var parans = "nome_da_funcao=excluirPagamento&id_pagamento="+param_id_pagamento+
	"&id_solicitacao="+param_id_solicitacao;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ 
		
			if(retorno.indexOf("SUCESSO_NA_GRAVACAO") < 0)
			alert("ERRO\n\n"+retorno);
				else{
				alert("SUCESSO\n\nExclusão realizada com sucesso.");
				
				mostrarPagamentos(param_id_solicitacao);
				}
			}
		});	 
		 
	 }
	 
	 
	 
/*********************************************************** chamados *****************************************************************/	 

	 
	function mostrarChamados(param_id){
	 
	 selecionaCliente(param_id);
	 
	 jQuery('#div_area_de_dados').html("");	
		
	var parans = "nome_da_funcao=mostrarChamados&id_cliente="+param_id;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_dados').html(retorno);}
		}); 
	 }
	 
	


	function formAlteraChamado(param_id_cliente, param_id_chamada){
	 
	 jQuery('#div_area_de_dados').html("");	
		
	var parans = "nome_da_funcao=formAlteraChamado&id_cliente="+param_id_cliente+"&id_chamado="+param_id_chamada;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_dados').html(retorno);}
		});

	 }
	 
	
	
	
	function alteraChamado(param_id_cliente, param_id_chamado){
	
	 var parans = "nome_da_funcao=alteraChamado&id_chamado="+param_id_chamado+
	"&assunto="+jQuery("#assunto_chama").val()+
	"&status="+jQuery("#status_chama").val()+
	"&descricao="+jQuery("#descricao_chama").val()+
	"&obs="+jQuery("#obs_chama").val()+
	"&solucao="+jQuery("#solucao_chama").val();
	
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
				
				mostrarChamados(param_id_cliente);
				atualizaNotificacaoDeChamados();
				}
			}
		});

	 }
	
	
	
	
	function novoAssentamento(param_id_cliente, param_id_chamado){
	
	 jQuery('#div_assentamentos').html("");	
		
	var parans = "nome_da_funcao=formNovoAssentamento&id_cliente="+param_id_cliente+"&id_chamado="+param_id_chamado;
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_assentamentos').html(retorno);}
		});
	}
	
	
	
	
	
	function salvaAssetamento(param_id_cliente, param_id_chamado){
	 
	 var parans = "nome_da_funcao=salvaAssetamento&id_chamado="+param_id_chamado+"&assentamento="+jQuery("#assentamento").val();
	
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
				
				formAlteraChamado(param_id_cliente, param_id_chamado);
				}
			}
		});

	 }
	 
	 

	
	
	function atualizaNotificacaoDeChamados(){
	

	 jQuery('#div_chamados_notificacoes').html("");	
		
	var parans = "nome_da_funcao=getNotificacoesDeChamados";
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_chamados_notificacoes').html(retorno);}
		}); 

	}
	
	
	
	
/*********************************************************** solucoes *****************************************************************/	 
	
	
	
	function novaSolucao(){
	
	 jQuery('#div_area_de_solucoes').html("");	
		
	var parans = "nome_da_funcao=formNovaSolucao";
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_solucoes').html(retorno);}
		});
	}
	
	
	
	
	function mostrarSolucoes(){
	
	 jQuery('#div_area_de_solucoes').html("");	
		
	var parans = "nome_da_funcao=mostrarSolucoes";
	
		jQuery.ajax({
		type: 'post',
		data: parans,
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery('#div_area_de_solucoes').html(retorno);}
		}); 
	}
	


	 
	 function geraCodSolucao(){
	 
		 jQuery.ajax({
		type: 'post',
		data: "nome_da_funcao=geraCodSolucao",
		dataType: 'html',
		url:'action.php',
		success: function(retorno){ jQuery("#cod_solucao").val(retorno);}
		 });
	 }
	 
	
	
	
	function salvaSolucao(){
	
	 var parans = "nome_da_funcao=salvaSolucao"+
	"&nome="+jQuery("#nome_solucao").val()+
	"&descricao="+jQuery("#descricao_solucao").val()+
	"&cod="+jQuery("#cod_solucao").val();
	
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
				
				mostrarSolucoes();
				}
			}
		});

	
	
	
	}
	
	
	
	
	
	
	

	