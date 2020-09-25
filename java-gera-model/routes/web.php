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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home',function(){return redirect()->route('home');});


//Sistemas
Route::get('adm/sistema', 'SistemaController@indexSistema')->name('adm.sistema');
Route::post('adm/sistema/salvar', 'SistemaController@salvarSistema')->name('adm.sistema.salvar');
Route::post('adm/sistema/delete', 'SistemaController@deleteSistema')->name('adm.sistema.delete');

//Classe
Route::get('adm/classe', 'ClasseController@indexClasse')->name('adm.classe');
Route::post('adm/classe/salvar', 'ClasseController@salvarClasse')->name('adm.classe.salvar');
Route::post('adm/classe/delete', 'ClasseController@deleteClasse')->name('adm.classe.delete');

//Admin rotas
Route::get('adm/rotas','RotaController@indexRotas')->name('adm.rota');
Route::post('adm/rotas/salvar','RotaController@salvarRota')->name('adm.rota.salvar');
Route::post('adm/rotas/delete','RotaController@deleteRota')->name('adm.rota.delete');
Route::post('adm/ajax-carrega-rota-pai','RotaController@ajaxRotaPai')->name('ajax.rota.carrega.pai');

//Classe_x_Rotas
Route::get('adm/classe-rotas', 'ClasseController@indexClasseRotas')->name('adm.classe_rotas');
Route::post('adm/ajax-carrega-classe-rotas','ClasseController@ajaxCarregaRotasByClasse')->name('adm.classe_rotas.ajax-carrega-rotas');
Route::post('adm/ajax-associa-classe-rota','ClasseController@ajaxVinculaRotas')->name('adm.classe_rotas.ajax-associa-rotas');
Route::post('adm/ajax-seta-rota-padrao','ClasseController@ajaxSetaRotaPadrao');

//Parâmetros
Route::get('adm/parametros', 'ParametroController@indexParametro')->name('adm.parametro');
Route::post('adm/parametros/salvar', 'ParametroController@salvarParametro')->name('adm.parametro.salvar');
Route::post('adm/parametros/delete', 'ParametroController@deleteParametro')->name('adm.parametro.delete');

//Estado
Route::get('adm/uf', 'UfController@indexUf')->name('adm.uf');
Route::post('adm/uf/salvar', 'UfController@salvarEstado')->name('adm.uf.salvar');
//carrega cidades - geral
Route::post('cadastros/ajax-cidade-uf','UfCidadeController@ajaxCidadeByUF')->name('uf.cidade');

//Cidade
Route::get('adm/cidade', 'CidadeController@indexCidade')->name('adm.cidade');
Route::post('adm/cidade/salvar', 'CidadeController@salvarCidade')->name('adm.cidade.salvar');

//Usuários
Route::get('adm/usuario', 'UsuarioController@indexUsuario')->name('adm.usuario');
Route::post('adm/usuario/salvar', 'UsuarioController@salvarUsuario')->name('adm.usuario.salvar');
Route::post('adm/usuario/delete', 'UsuarioController@deleteUsuario')->name('adm.usuario.delete');