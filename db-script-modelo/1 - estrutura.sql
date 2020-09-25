/*########### ESTADOS ###########*/
CREATE TABLE IF NOT EXISTS uf
(
	uf CHAR(2) NOT NULL PRIMARY KEY,
	descricao varchar(100) NOT NULL
);

/*########### CIDADES ###########*/
CREATE TABLE IF NOT EXISTS cidade
(
	id INTEGER NOT NULL PRIMARY KEY,
	nome varchar(100) NOT NULL,
	latitude FLOAT NOT NULL,
	longitude FLOAT NOT NULL,
	eh_capital BOOL NOT NULL,
	uf CHAR(2) NOT NULL,

  	FOREIGN KEY(uf) REFERENCES uf(uf)
);

/* ######## SISTEMA ######## */
CREATE TABLE IF NOT EXISTS sistema
(
	id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
	codigo varchar(10) NULL,
	descricao varchar(100) NOT NULL,
	v_sistema varchar(10) NULL,
	v_core varchar(10) NULL,
	v_layout varchar(10) NULL
);

/* ######## PARAMETRO ######## */
CREATE TABLE IF NOT EXISTS parametro
(
	id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
	descricao varchar(50) NOT NULL,
	codigo varchar(6) NULL,
	valor varchar(200) NULL
);

/* ######## CLASSE ######## */
CREATE TABLE IF NOT EXISTS classe
(
	id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
	fk_sistema INTEGER NOT NULL,
	descricao varchar(50) NOT NULL,
	admin CHAR(1) NOT NULL DEFAULT 0,
	codigo varchar(6) NULL,

  FOREIGN KEY(fk_sistema) REFERENCES sistema(id)
);

/*########### ROTAS ###########*/
CREATE TABLE IF NOT EXISTS rota
(
	id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
	fk_sistema INTEGER NOT NULL,
	fk_rota INTEGER NULL,
	nome varchar(50) NOT NULL,
	rota varchar(50) NOT NULL,
	is_menu bool NOT NULL DEFAULT FALSE,
	icone varchar(50) NULL,
    idex INTEGER,

  FOREIGN KEY(fk_sistema) REFERENCES sistema(id),
  FOREIGN KEY(fk_rota) REFERENCES rota(id)
);

/* ######## CLASSE X ROTAS ######## */
CREATE TABLE IF NOT EXISTS classe_rota
(
	fk_classe_id INTEGER NOT NULL,
	fk_rota_id INTEGER NOT NULL,
	padrao BOOL NOT NULL DEFAULT FALSE,

  	PRIMARY KEY(fk_classe_id,fk_rota_id),
	FOREIGN KEY (fk_classe_id) REFERENCES classe(id),
  	FOREIGN KEY (fk_rota_id) REFERENCES rota(id)
);

/* ######## CARGO ######## */
CREATE TABLE IF NOT EXISTS cargo
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(50) NULL
);

/* ######## USUÁRIO ######## */
CREATE TABLE IF NOT EXISTS usuario
(
	id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
	fk_funcao INTEGER NULL,
	foto VARCHAR(500) NULL,
	usuario VARCHAR(20) NOT NULL UNIQUE,
	cpf VARCHAR(20) NULL,
	nome VARCHAR(50) NOT NULL,
	sobrenome VARCHAR(50) NOT NULL,
	email VARCHAR(100) NULL,
	celular VARCHAR(20) NULL,
	telefone VARCHAR(20) NULL,
	password VARCHAR(255) NOT NULL,
	remember_token VARCHAR(100) NULL,
	resetado BOOLEAN NULL DEFAULT FALSE,
  	primeiro_acesso BOOLEAN NULL DEFAULT TRUE,
	ativo BOOL NOT NULL,
	dt_criacao TIMESTAMP NULL,
	dt_alteracao TIMESTAMP NULL,

	FOREIGN KEY(fk_funcao) REFERENCES cargo(id)
);

/* ######## FILIAL ######## */
CREATE TABLE IF NOT EXISTS filial
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_cidade INTEGER NULL,
	nome VARCHAR(50) NULL,
	admin BOOLEAN DEFAULT FALSE,
	ativo BOOLEAN DEFAULT TRUE,
	dt_criacao TIMESTAMP NULL,
	dt_alteracao TIMESTAMP NULL,

	FOREIGN KEY(fk_cidade) REFERENCES cidade(id)
);

/* ######## PERMISSÃO ######## */
CREATE TABLE IF NOT EXISTS permissao
(
  	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_classe INTEGER NOT NULL,
	fk_usuario INTEGER NOT NULL,
  	fk_filial INTEGER NULL,
  	fk_cargo INTEGER NULL,
	dt_criacao TIMESTAMP NULL,
	dt_alteracao TIMESTAMP NULL,


	FOREIGN KEY(fk_classe) REFERENCES classe(id),
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id),
	FOREIGN KEY(fk_filial) REFERENCES filial(id),
	FOREIGN KEY(fk_cargo) REFERENCES cargo(id)
);

/* ######## TIPO LOG ######## */
CREATE TABLE IF NOT EXISTS tipo_log
(
	id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
	descricao VARCHAR(50) NOT NULL
);

/* ######## LOG ######## */
CREATE TABLE IF NOT EXISTS log
(
	id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
	fk_sistema INTEGER NOT NULL,
	fk_usuario INTEGER NOT NULL,
	fk_tipo INTEGER NOT NULL,
	fk_target INTEGER NULL,
	fk_filial INTEGER NOT NULL,
	data TIMESTAMP NOT NULL,
	ip VARCHAR(20) NULL,
	descricao VARCHAR(200) not NULL,
	status boolean not null,
	dt_criacao TIMESTAMP NULL,
	dt_alteracao TIMESTAMP NULL,

  	FOREIGN KEY(fk_sistema) REFERENCES sistema(id),
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id),
	FOREIGN KEY(fk_tipo) REFERENCES tipo_log(id),
	FOREIGN KEY(fk_filial)REFERENCES filial(id)
);

/* ######## TIPO NOTIFICAÇÃO ######## */
CREATE TABLE IF NOT EXISTS tipo_notificacao
(
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descricao VARCHAR(50) NOT NULL
);

/* ######## NOTIFICAÇÃO ######## */
CREATE TABLE IF NOT EXISTS notificacao
(
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fk_tipo INTEGER NOT NULL,
  fk_usuario INTEGER NULL,
  fk_usuario_leu INTEGER NULL,
  link VARCHAR(500),
  mensagem VARCHAR(100) NOT NULL,
  lida BOOLEAN DEFAULT FALSE,


  FOREIGN KEY(fk_tipo) REFERENCES tipo_notificacao(id)
);

/*-----------------------------TABELAS ESPECIFICAS-----------------------------*/

/* ######## UNIDADE ######## */
CREATE TABLE IF NOT EXISTS unidade
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sigla VARCHAR(5),
	descricao VARCHAR(100) NOT NULL,
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL
);

/* ######## GRUPO DESPESA ORÇAMENTÁRIA ######## */
CREATE TABLE IF NOT EXISTS grupo_despesa
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(100) NOT NULL,
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL
);

/* ######## CORPORAÇÃO ######## */
CREATE TABLE IF NOT EXISTS corporacao
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	sigla VARCHAR(50) NOT NULL,
	nome VARCHAR(100) NOT NULL,
    logo BLOB NULL,
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL
);

/* ######## Órgão ######## */
CREATE TABLE IF NOT EXISTS orgao
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_responsavel INTEGER NULL,
	fk_gestor INTEGER NULL,
	sigla VARCHAR(50) NULL,
	descricao VARCHAR(100) NOT NULL,
	cnpj VARCHAR(50) NULL,
	lei_criacao VARCHAR(50),
	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_responsavel) REFERENCES usuario(id),
	FOREIGN KEY(fk_gestor) REFERENCES usuario(id)
);

/* ######## LOA - Lei Orçamentária Anual ######## */
CREATE TABLE IF NOT EXISTS loa
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ano INTEGER NOT NULL,
	dt_validade_ini DATE,
	dt_validade_fim DATE,
	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL
);

/* ######## Lançamentos do LOA ######## */
CREATE TABLE IF NOT EXISTS loa_lancamento
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_loa INTEGER NOT NULL,
	dt_disponivel DATE NULL,
	dt_expiracao DATE NULl,
	dt_previsao DATE NULl,
	valor DECIMAL(38,2) NOT NULL,
	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_loa) REFERENCES loa(id)
);

/* ######## Programa (programas do governo para a segurança pública) ######## */
CREATE TABLE IF NOT EXISTS programa
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(100) NOT NULL,
	abrv VARCHAR(5) NOT NULL,
	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL
);


/* ######## Eixo (frentes de atuação do programa) ######## */
CREATE TABLE IF NOT EXISTS eixo_programa
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_programa INTEGER NOT NULL,
	nome VARCHAR(50) NOT NULL,
	abrv VARCHAR(5) NOT NULL,
	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL
);

/* ######## Tipos de auditoria ######## */
CREATE TABLE IF NOT EXISTS tipo_auditoria
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(50) NOT NULL
);


/* ######## Plano de Ação ######## */
CREATE TABLE IF NOT EXISTS plano_acao
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_eixo INTEGER NOT NULL,
	fk_orgao INTEGER NOT NULL,
	fk_responsavel INTEGER NOT NULL,
	fk_gestor INTEGER NOT NULL,
	identificador VARCHAR(100) NULL,
	abreviacao varchar(50) NULL,
	numero INTEGER NULL,
	ano INTEGER NOT NULL,
    apelido VARCHAR(50) NULL,
	resumo TEXT NULL,
	justificativa TEXT NULL,
    impacto TEXT NULL,
    territorio TEXT NULL,
    resultado TEXT NULL,
	objetivo TEXT NULL,
    estrategia TEXT NULL,

	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_orgao) REFERENCES orgao(id),
	FOREIGN KEY(fk_eixo) REFERENCES eixo_programa(id),
	FOREIGN KEY(fk_responsavel) REFERENCES usuario(id),
	FOREIGN KEY(fk_gestor) REFERENCES usuario(id)
);

/* ######## ARQUIVOS PLANO DE AÇÃO ######## */
CREATE TABLE IF NOT EXISTS plano_acao_anexo
(
	id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_usuario INTEGER NOT NULL,
	fk_plano INTEGER NULL,
    nome VARCHAR(100) NULL,
    comentario text not null,
    arquivo varchar(500) not null,
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_usuario) REFERENCES usuario(id),
	FOREIGN KEY(fk_plano) REFERENCES plano_acao(id)
);

/* ######## Auditoria do Plano de Ação ######## */
CREATE TABLE IF NOT EXISTS audit_plano_acao
(
	id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_usuario INTEGER NOT NULL,
	fk_plano INTEGER NOT NULL,
	fk_tipo INTEGER NOT NULL,
    ip varchar(20) not null,
    mensagem text not null,
    obs text null,
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_tipo) REFERENCES tipo_auditoria(id),
	FOREIGN KEY(fk_usuario) REFERENCES usuario(id),
	FOREIGN KEY(fk_plano) REFERENCES plano_acao(id)
);

/* ######## Agrupamento dos Objetivos do Plano de Ação ######## */
CREATE TABLE IF NOT EXISTS plano_acao_objetivo_grupo
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_plano INTEGER NOT NULL,
	descricao VARCHAR(100) NOT NULL,
	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_plano) REFERENCES plano_acao(id)
);

/* ######## Objetivos do Plano de Ação ######## */
CREATE TABLE IF NOT EXISTS plano_acao_objetivo
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_plano INTEGER NOT NULL,
	fk_grupo INTEGER NULL,


	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_plano) REFERENCES plano_acao(id),
	FOREIGN KEY(fk_grupo) REFERENCES plano_acao_objetivo_grupo(id)
);

/* ######## Itens do plano de ação ######## */
CREATE TABLE IF NOT EXISTS plano_acao_item
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_plano INTEGER NOT NULL,
	fk_acao_item INTEGER NULL,
	idx INTEGER NOT NULL,
	titulo VARCHAR(200)	NOT NULL,
	justificativa TEXT NULL,
    indicador TEXT NULL,
    meta TEXT NULL,
    territorio TEXT NULL,
    estrategia TEXT NULL,
    objetivo TEXT NULL,
    resultado TEXT NULL,
    impacto TEXT NULL,
	status CHAR(1) DEFAULT 'A',
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_plano) REFERENCES plano_acao(id),
	FOREIGN KEY(fk_acao_item) REFERENCES plano_acao_item(id)
);

/* ######## Plano Detalhe ######## */
CREATE TABLE IF NOT EXISTS plano_acao_item_detalhe
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_acao_item INTEGER NOT NULL,
	fk_tipo_credito INTEGER NOT NULL,
    fk_beneficiario INTEGER NULL,
	descricao VARCHAR(5000) NOT NULL,
	unidade VARCHAR(5),
	qtd DECIMAL(20,1),
	vlr_unitario DECIMAL(38,2),
	vlr_total DECIMAL(38,2),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_acao_item) REFERENCES plano_acao_item(id),
	FOREIGN KEY(fk_tipo_credito) REFERENCES grupo_despesa(id),
    FOREIGN KEY(fk_beneficiario) REFERENCES corporacao(id)
);

/* ######## TIPO APORTE ######## */
CREATE TABLE IF NOT EXISTS aporte_tipo
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(50) NOT NULL
);

/* ######## APORTE ######## */
CREATE TABLE IF NOT EXISTS aporte
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_tipo INTEGER NOT NULL,
    apelido VARCHAR(50) NULL,
    obs VARCHAR(200) NULL,
    dt_lancamento DATETIME NOT NULL,
    dt_vig_ini DATE NULL,
    dt_vig_fim DATE NULL,
    status CHAR(2) NOT NULL,
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_tipo) REFERENCES aporte_tipo(id)
);

/* ######## DETALHE APORTE ######## */
CREATE TABLE IF NOT EXISTS aporte_detalhe
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_aporte INTEGER NOT NULL,
    fk_eixo INTEGER NOT NULL,
    fk_categoria INTEGER NOT NULL,
    valor DECIMAL(38,2) NOT NULL,

	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_aporte) REFERENCES aporte(id),
    FOREIGN KEY(fk_categoria) REFERENCES grupo_despesa(id),
    FOREIGN KEY(fk_eixo) REFERENCES eixo_programa(id)
);

/* ######## PLANO X APORTE ######## */
CREATE TABLE IF NOT EXISTS plano_aporte
(
    fk_plano INTEGER NOT NULL,
    fk_aporte INTEGER NOT NULL,
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_aporte) REFERENCES aporte(id),
    FOREIGN KEY(fk_plano) REFERENCES plano_acao(id),
    PRIMARY KEY(fk_aporte,fk_plano)
);



/* ######## Etapas dos Itens do plano de ação ######## */
/*
CREATE TABLE IF NOT EXISTS plano_acao_item_etapa
(
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fk_acao_item INTEGER NOT NULL,
	index INTEGER NOT NULL,
	descricao VARCHAR(5000) NOT NULL,
	status CHAR(1),
	dt_criacao DATETIME NOT NULL,
	dt_alteracao DATETIME NOT NULL,

	FOREIGN KEY(fk_acao_item) REFERENCES plano_acao_item(id)
);
*/

/* ######## BENEFICIÁRIOS DO ITEM DO PLANO DE AÇÃO ######## */
/*
CREATE TABLE IF NOT EXISTS beneficiario_plano_acao_item
(
	fk_acao_item INTEGER,
	fk_corporacao INTEGER,

	FOREIGN KEY(fk_acao_item) REFERENCES plano_acao_item(id),
	FOREIGN KEY(fk_corporacao) REFERENCES corporacao(id),
	PRIMARY KEY(fk_corporacao,fk_acao_item)
);
*/


