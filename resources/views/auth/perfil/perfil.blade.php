@extends('layouts.'.env('APP_LAYOUT').'.pagina', 
[
    'icone_titulo'=>'fa fa-user',
    'titulo'=>'Perfil',
    'breadcrumb'=>['Perfil']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.css')}}"/>
@endsection

@section('scripts')
    <script src="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.js') }}" ></script>
    <script src="{{ URL::asset('js/views/auth/perfil.js' ) }}"></script>
@endsection

@section('pagina')

    <div class="container-xl">
        <div class="card">

            <form id="frmPerfil" method="POST" enctype="multipart/form-data" action="{{route('perfil.salvar')}}">
                @csrf

                <div class="card-header">
                    <!-- <i class="fa fa-pencil"></i> Editar informações -->
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-12 col-md-4 text-center">
                            <!-- FOTO -->
                            <img id="imgFoto" class="img-thumbnail cursor-pointer" src="{{Util::UsuarioFoto()}}" style="width:220px;height:220px;"/>
                            <input id="dlgArquivo" type="file" class="form-control d-none" name="foto" accept="image/*"/>
                        </div> 

                        <div class="col-md-8">

                            <!-- lista de abas -->
                            <ul id="tabsPerfil" class="nav nav-tabs" role="tablist">
                                    
                                <!-- ABA DADOS -->
                                <li class="nav-item">
                                    <a id="tab_dados"
                                        class="nav-link {{$senha ? '' : 'ativo'}}"
                                        data-toggle="tab"
                                        href="#content_tab_dados"
                                        role="tab"
                                        aria-controls="content_tab_dados"
                                        aria-selected="false">Informações</a>
                                </li>
                                <!-- ABA SENHA -->
                                <li class="nav-item">
                                    <a id="tab_senha"
                                        class="nav-link {{$senha ? 'ativo' : ''}}"
                                        data-toggle="tab"
                                        href="#content_tab_senha"
                                        role="tab"
                                        aria-controls="content_tab_senha"
                                        aria-selected="true">Senha</a>
                                </li>
                    
                            </ul>

                            <!-- CONTEÚDO DAS ABAS -->
                            <div id="tabsPerfil_conteudo" class="tab-content pt-2" style="overflow-y:auto;overflow-x:hidden;">

                                <!-- ABA DADOS -->
                                <div id="content_tab_dados" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_dados">
                                    
                                    <div class="row pt-2">
                                        <!-- CPF -->
                                        <div class="col-sm-12 col-md-4">
                                            <label for="txtUsuario" class="text-md-left font-weight-bold">Usuário</label>
                                            <input id="txtUsuario" class="form-control" type="text" maxlength="50" name="usuario" value="{{auth::user()->getUsuario()}}" autocomplete="off" disabled/>
                                        </div>
                                    </div>

                                    <!-- 1ª linha -->
                                    <div class="row">
                                        <!-- Nome -->
                                        <div class="col-sm-12 col-md-6">
                                            <label for="txtNome" class="text-md-left font-weight-bold">Primeiro nome*</label>
                                            <input id="txtNome" class="form-control" type="text" maxlength="50" name="nome" value="{{auth::user()->getNome()}}" autocomplete="off" autofocus/>
                                        </div>
                                    
                                        <!-- Sobrenome -->
                                        <div class="col-sm-12 col-md-6">
                                            <label for="txtSobreNome" class="text-md-left font-weight-bold">Sobrenome*</label>
                                            <input id="txtSobreNome" class="form-control" type="text" maxlength="50" name="sobrenome" value="{{auth::user()->getSobreNome()}}" autocomplete="off" />
                                        </div>
                                    </div>

                                    <!-- 2ª linha -->
                                    <div class="row">
                                        <!-- Email -->
                                        <div class="col-sm-12 col-md-6">
                                            <label for="txtEmail" class="text-md-left font-weight-bold">E-mail*</label>
                                            <input id="txtEmail" class="form-control" type="email" maxlength="100" name="email" value="{{auth::user()->getEmail()}}" autocomplete="off"/>
                                        </div>
                                        
                                        <!-- Celular -->
                                        <div class="col-sm-12 col-md-3">
                                            <label for="txtCelular" class="text-md-left font-weight-bold">Celular*</label>
                                            <input id="txtCelular" class="form-control mask_celular" type="text" maxlength="50" name="celular" value="{{auth::user()->getCelular()}}" autocomplete="off" />
                                        </div>
                                    </div>

                                </div>

                                <!-- ABA SENHA -->
                                <div id="content_tab_senha" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_senha">

                                    <div class="row pt-2">
                                        <!-- Senha Atual-->
                                        <div class="col-sm-12 col-md-6">
                                            <label for="txtSenhaAtual" class="text-md-left">Senha atual</label>
                                            <input id="txtSenhaAtual" class="form-control" type="password" name="senha_atual" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Senha nova -->
                                        <div class="col-sm-12 col-md-6">
                                            <label for="txtSenha" class="text-md-left">Nova senha</label>
                                            <input id="txtSenha" class="form-control" type="password" name="nova_senha" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Confirmar senha nova -->
                                        <div class="col-sm-12 col-md-6">
                                            <label for="txtConfirmaSenha" class="text-md-left">Confirmar senha</label>
                                            <input id="txtConfirmaSenha" class="form-control" type="password" name="confirma_senha" autocomplete="off" />
                                        </div>
                                    </div>

                                </div>

                            </div>

                            
                        </div>
                    </div>
                </div>                       
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>Salvar
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection