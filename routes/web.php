<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/pdf',function()
{
    $pdf = PDF::loadView('pdf.teste');
    return $pdf ->stream();
});


//Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home',function(){return redirect()->route('home');});

//Auth
Route::group(['namespace'=>'Auth'],function()
{
    //Força o Logout
    Route::get('logout','LoginControllerExtension@GetLogout')->name('logout');

    Route::get('ajax-logout','LoginControllerExtension@TerminarSessao');

    //rota padrão para verificação dos acessos
    Route::get('filial-login','LoginControllerExtension@VerificaPermissoes')->name('filial.login');

    //alterna entre os acessos às filiais
    Route::get('filial-alternar','LoginControllerExtension@AlternaFilial')->name('filial.alternar');
    Route::post('filial-alternar-set','LoginControllerExtension@LoginFilial')->name('filial.alternar.setar');
});

//Perfil
Route::group(['prefix'=>'perfil','as'=>'perfil.','namespace'=>'ADM'],function()
{
    //usuario
    Route::get('', 'UsuarioController@perfil')->name('index');
    Route::post('salvar', 'UsuarioController@salvarPerfil')->name('salvar');
});

//Admin
Route::group(['prefix'=>'adm','as'=>'adm.','namespace'=>'ADM'],function()
{
    Route::get('', 'SistemaController@indexSistema')->name('index');

    //Sistemas
    Route::get('sistema', 'SistemaController@indexSistema')->name('sistema');
    Route::post('sistema/salvar', 'SistemaController@salvarSistema')->name('sistema.salvar');
    Route::post('sistema/delete', 'SistemaController@deleteSistema')->name('sistema.delete');

    //Classe
    Route::get('classe', 'ClasseController@indexClasse')->name('classe');
    Route::post('classe/salvar', 'ClasseController@salvarClasse')->name('classe.salvar');
    Route::post('classe/delete', 'ClasseController@deleteClasse')->name('classe.delete');

    //Admin rotas
    Route::get('rotas','RotaController@indexRotas')->name('rota');
    Route::post('rotas/salvar','RotaController@salvarRota')->name('rota.salvar');
    Route::post('rotas/delete','RotaController@deleteRota')->name('rota.delete');
    Route::post('ajax-carrega-rota-pai','RotaController@ajaxRotaPai');
    Route::post('ajax-rota-organiza-index','RotaController@ajaxOrganizaIndex');

    //Classe_x_Rotas
    Route::get('classe-rotas', 'ClasseController@indexClasseRotas')->name('classe_rotas');
    Route::post('ajax-carrega-classe-rotas','ClasseController@ajaxCarregaRotasByClasse');
    Route::post('ajax-associa-classe-rota','ClasseController@ajaxVinculaRotas');
    Route::post('ajax-seta-rota-padrao','ClasseController@ajaxSetaRotaPadrao');

    //Parâmetros
    Route::get('parametros', 'ParametroController@indexParametro')->name('parametro');
    Route::post('parametros/salvar', 'ParametroController@salvarParametro')->name('parametro.salvar');
    Route::post('parametros/delete', 'ParametroController@deleteParametro')->name('parametro.delete');

    //Estado
    Route::get('uf', 'UfController@indexUf')->name('uf');
    Route::post('uf/salvar', 'UfController@salvarEstado')->name('uf.salvar');
    //carrega cidades - geral
    Route::post('ajax-cidade-uf','UfCidadeController@ajaxCidadeByUF');

    //Cidade
    Route::get('cidade', 'CidadeController@indexCidade')->name('cidade');
    Route::post('cidade/salvar', 'CidadeController@salvarCidade')->name('cidade.salvar');

    //Usuários
    Route::get('usuario', 'UsuarioController@indexUsuario')->name('usuario');
    Route::post('usuario/salvar', 'UsuarioController@salvarUsuario')->name('usuario.salvar');
    Route::post('usuario/delete', 'UsuarioController@deleteUsuario')->name('usuario.delete');
    //bloqueio de alteracao de senha não reconhecida
    Route::get('usuario/senha/bloqueio/{prefixo}&{prefixo2}&{id_usuario}&{sufixo}', 'Auth\ResetPasswordController@BloqueiaUsuarioAlteracaoSenha')->name('usuario.senha_alterada_nao_reconhecida');
    //resetar senha pelo 'esqueci minha senha'
    Route::post('usuario/senha/reset', 'Auth\ResetPasswordController@ResetarSenha')->name('usuario.senha_resetar');
    //resetar senha pelo 'adm.usuario'
    Route::post('usuario/adm-reseta-senha', 'UsuarioController@ResetarSenha');
});

//Requisições combos ajax
Route::group(['prefix'=>'combo_ajax','as'=>'combo.'],function()
{
    //Eixos
    Route::post('eixos/{id_programa}', 'ComboController@ajaxEixos');
});

//Módulo Administração
Route::group(['prefix'=>'administracao','as'=>'administracao.','namespace'=>'Administracao'],function()
{
    //Órgão
    Route::get('orgao', 'OrgaoController@ListarOrgao')->name('orgao');
    Route::post('orgao/salvar','OrgaoController@SalvarOrgao')->name('orgao.salvar');
    Route::post('orgao/deletar','OrgaoController@DeletarOrgao')->name('orgao.deletar');

    //Programa de governo relativo à segurança pública
    Route::get('programa', 'ProgramaController@ListarPrograma')->name('programa');
    Route::post('programa/salvar','ProgramaController@SalvarPrograma')->name('programa.salvar');
    Route::post('programa/deletar','ProgramaController@DeletarPrograma')->name('programa.deletar');

    //Eixo
    Route::get('eixo', 'EixoController@ListarEixo')->name('eixo');
    Route::post('eixo/salvar','EixoController@SalvarEixo')->name('eixo.salvar');
    Route::post('eixo/deletar','EixoController@DeletarEixo')->name('eixo.deletar');

});

//Módulo Cadastros
Route::group(['prefix'=>'cadastro','as'=>'cadastro.','namespace'=>'Cadastro'],function()
{
    //Corporação
    Route::get('corporacao', 'CorporacaoController@ListarCorporacao')->name('corporacao');
    Route::post('corporacao/salvar','CorporacaoController@SalvarCorporacao')->name('corporacao.salvar');
    Route::post('corporacao/deletar','CorporacaoController@DeletarCorporacao')->name('corporacao.deletar');

    //Unidade de Medida
    Route::get('unidade-medida', 'UnidadeMedidaController@ListarUnidadeMedida')->name('unidade-medida');
    Route::post('unidade-medida/salvar','UnidadeMedidaController@SalvarUnidadeMedida')->name('unidade-medida.salvar');
    Route::post('unidade-medida/deletar','UnidadeMedidaController@ ')->name('unidade-medida.delete');

    //Itens Plano
    Route::get('item-plano', 'ItemPlanoController@ListarItemPlano')->name('item-plano');
    Route::post('item-plano/salvar','ItemPlanoController@SalvarItemPlano')->name('item-plano.salvar');
    Route::post('item-plano/deletar','ItemPlanoController@ ')->name('item-plano.delete');

});

//Módulo Planejamento
Route::group(['prefix'=>'planejamento','as'=>'planejamento.','namespace'=>'Planejamento'],function()
{
    //LOA - Lei Orçamentária Anual
    Route::get('loa', 'LoaController@ListarLoa')->name('loa');
    Route::post('loa/salvar','LoaController@SalvarLoa')->name('loa.salvar');
    Route::post('loa/deletar','LoaController@DeletarLoa')->name('loa.deletar');

    //Plano
    Route::get('plano-lista', 'PlanoController@ListarPlano')->name('plano');
    Route::get('plano/{id_plano}', 'PlanoController@EditarPlano')->name('plano.editar');
    Route::get('plano/imprimir/{id_plano}&{anexo}', 'PlanoController@GerarPdfPlanoAcao')->name('plano.imprimir');
    Route::post('plano/salvar','PlanoController@SalvarPlano')->name('plano.salvar');
    Route::post('plano/deletar','PlanoController@DeletarPlano')->name('plano.deletar');


    Route::post('plano/ajax-carrega-acoes-plano','PlanoController@AjaxCarregaAcoes');
    Route::post('plano/ajax-gera-identificador-plano/{programa}&{eixo}','PlanoController@AjaxGeraIdentificadorPlano');
    Route::post('plano/ajax-anexa-arquivo','PlanoController@ajaxAnexaArquivo');

});

//Aporte - por enquanto ainda sem módulo
Route::group(['prefix'=>'aporte','as'=>'aporte.','namespace'=>'Aporte'],function()
{
    //Aporte
    Route::get('listar', 'AporteController@ListarAportes')->name('listar');
    Route::get('{id_aporte}', 'AporteController@AcessaAporte')->name('acessar');
    Route::post('salvar', 'AporteController@SalvarAporte')->name('salvar');
    Route::post('deletar', 'AporteController@DeletarrAporte')->name('delete');

    Route::post('ajax-detalhes-aportes', 'AporteController@AjaxDetalhesAportes');

    //Tipo de Aporte
    Route::get('tipo/listar', 'TipoAporteController@ListarTipoAportes')->name('tipo.listar');
    Route::post('tipo/salvar', 'TipoAporteController@SalvarTipoAporte')->name('tipo.salvar');
    Route::post('tipo/deletar', 'TipoAporteController@DeletarTipoAporte')->name('tipo.delete');

});
