
ALTER TABLE pagamentos ADD a_partir_de DATE NULL;


ALTER TABLE clientes ADD status ENUM('ATIVO', 'INATIVO');


UPDATE clientes SET status = 'ATIVO';


ALTER TABLE solucoes ADD status ENUM('ATIVO', 'INATIVO');


UPDATE solucoes SET status = 'ATIVO';


ALTER TABLE ligue_para_mim ADD status ENUM('PENDENTE', 'RETORNADO') NULL;


ALTER TABLE ligue_para_mim ADD data VARCHAR(20) NULL;