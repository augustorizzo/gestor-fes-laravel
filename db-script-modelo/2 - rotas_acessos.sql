/*CODIGO PADRÃO DO SISTEMA*/
SET @sis_cod = "GFES";
SET @sis_desc = "Gestor - FES";

/*USUARIO INICIAL*/
SET @nome = "Admin";
SET @sobrenome = " ";
SET @usuario = "adm";
SET @senha = "$2y$10$OCrzpzhvjURxitB1GKcYde5Y/.W0CrNRfkkc.rBcUFKXCqzhYL7Wu"; -- 123456
SET @email = "admin@email.com.br";

/*CLASSE ADM*/
SET @classe = "Administrador";
SET @classe_cod = "ADM";

/* INSERE FILIAL ADMINISTRADOR(PADRÃO) */
INSERT INTO filial(nome,admin,ativo,dt_criacao,dt_alteracao) VALUES('Administração',true,true,now(),now());

/* INSERE SISTEMA*/
INSERT INTO sistema (descricao,codigo) values(@sis_desc,@sis_cod);

/* CRIA USUARIO PADRÃO*/
INSERT INTO usuario(nome,sobrenome,usuario,password,email,ativo,dt_criacao,dt_alteracao) VALUES(@nome,@sobrenome,@usuario,@senha,@email,true,now(),now());

/* GUARDA O ID DO SISTEMA NA VARIÁVEL */
SELECT @sistema := id FROM sistema WHERE codigo = @sis_cod LIMIT 1;

/* CRIA CLASSE 'ADM' NO SISTEMA, CASO AINDA NÃO EXISTA */
INSERT INTO classe(descricao,codigo,admin,fk_sistema) VALUES(@classe,@classe_cod,1,@sistema);

/* RELACIONA O USUÁRIO PADRÃO COM A CLASSE 'ADM' DO SISTEMA E A FILIAL PADRÃO*/
INSERT INTO permissao(fk_classe,fk_usuario,fk_filial) VALUES((SELECT id FROM classe WHERE codigo = @classe_cod AND fk_sistema = @sistema LIMIT 1),(SELECT id FROM usuario WHERE usuario = @usuario LIMIT 1),(SELECT id FROM filial WHERE admin is true LIMIT 1));


/* ROTAS ADM */
INSERT INTO rota(fk_sistema,nome,rota,is_menu,icone,fk_rota) VALUES
/* Menu 'Admin' */
(@sistema,'Admin','config',1,'fa fa-cog',NULL)

/* Sistema */
,(@sistema,'Sistema','adm.sistema',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'config' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'salva sistema','adm.sistema.salvar',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.sistema' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'deleta sistema','adm.sistema.delete',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.sistema' AND r.fk_sistema = @sistema LIMIT 1))

/* Classe*/
,(@sistema,'Classes','adm.classe',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'config' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'salva classe','adm.classe.salvar',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.classe' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'deleta classe','adm.classe.delete',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.classe' AND r.fk_sistema = @sistema LIMIT 1))

/* Rotas */
,(@sistema,'Rotas','adm.rota',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'config' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'salva rotas','adm.rota.salvar',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.rota' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'delete rotas','adm.rota.delete',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.rota' AND r.fk_sistema = @sistema LIMIT 1))

/* Classes x Rotas */
,(@sistema,'Classe x Rotas','adm.classe_rotas',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'config' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'associa classes x rotas','adm.classe_rotas.ajax-associa-rotas',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.rota' AND r.fk_sistema = @sistema LIMIT 1))

/* Usuários */
,(@sistema,'Usuários','adm.usuario',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'config' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'salva usuário','adm.usuario.salvar',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.usuario' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'delete usuário','adm.usuario.delete',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.usuario' AND r.fk_sistema = @sistema LIMIT 1))

/* Estados */
,(@sistema,'Estado','adm.uf',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'config' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'salva UF','adm.uf.salvar',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.uf' AND r.fk_sistema = @sistema LIMIT 1))

 /* Cidades */
,(@sistema,'Cidades','adm.cidade',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'config' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'salva cidade','adm.cidade.salvar',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'adm.cidade' AND r.fk_sistema = @sistema LIMIT 1));



/**** Menus do Sistema ****/
/*--------------- adicione os menus específicos do sistema a partir deste ponto ---------------*/

/*--------------- <menus específicos do sistema> ---------------*/

/* Menu Cadastro */

/*
INSERT INTO rota(fk_sistema,nome,rota,is_menu,icone,fk_rota) VALUES
(@sistema,'Cadastro','cadastro',1,'fa fa-pencil',NULL)
*/

 /* Produto */
/* 
,(@sistema,'Produto','cadastro.produto',1,'fa fa-caret-right',(SELECT r.id FROM rota r WHERE r.rota = 'cadastro' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'salva produto','cadastro.produto.salvar',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'cadastro.produto' AND r.fk_sistema = @sistema LIMIT 1))
,(@sistema,'deleta produto','cadastro.produto.delete',0,NULL,(SELECT r.id FROM rota r WHERE r.rota = 'cadastro.produto' AND r.fk_sistema = @sistema LIMIT 1));
*/

/*--------------- </menus específicos do sistema> ---------------*/


/*RELACIONA TODAS AS ROTAS DO SISTEMA COM A CLASSE 'ADM'*/
INSERT INTO classe_rota(fk_classe_id,fk_rota_id)
SELECT (SELECT id FROM classe WHERE codigo = @classe_cod AND fk_sistema = @sistema LIMIT 1),id
FROM rota
WHERE fk_sistema = @sistema;
