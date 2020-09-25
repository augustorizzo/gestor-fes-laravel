@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fa fa-users',
    'titulo'=>'Usuários',
    'breadcrumb'=>['Admin','Usuários']
])

@section('scripts')
    <script src="{{{ URL::asset('js/views/adm/usuario.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        <div class="row" >
            <div class="col text-left">
                <button id="btnNovoUsuario" type="button" class="btn btn-primary" aria-label="Left Align" >
                    <i class="fa fa-plus-circle"></i> Novo Usuário
                </button>
            </div>
        </div>
        <br/>
        <div class="row" >
            <div class="col-md-12">
                <table id="tbUsuarios" class="table table-hover text-left">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Usuário</th>
                            <th>E-mail</th>
                            <th>Celular</th>
                            <th>Classe</th>

                            <!-- filial aqui -->
                            <!-- <th>Comunidade</th> -->

                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($usuarios as $usu)
                            <tr>
                                <td id="{{$usu->getId()}}_nome">{{$usu->getNome()}}</td>
                                <td id="{{$usu->getId()}}_sobrenome">{{$usu->getSobreNome()}}</td>
                                <td id="{{$usu->getId()}}_usuario">{{$usu->getUsuario()}}</td>
                                <td id="{{$usu->getId()}}_email">{{$usu->getEmail()}}</td>
                                <td id="{{$usu->getId()}}_celular">{{$usu->getCelular()}}</td>
                                <td id="{{$usu->getId()}}_classe" data="{{(!empty($usu->Classe->first()) ? $usu->Classe->first()->getId() : '')}}">
                                    {{(!empty($usu->Classe->first()) ? $usu->Classe->first()->getDescricao() : '')}}
                                </td>
                                
                                <!-- filial aqui -->
                                <!-- 
                                <td id="{{$usu->getId()}}_comunidade" data="{{(!empty($usu->Comunidades) ? $usu->Comunidades->first()->getId() : '')}}">
                                    {{(!empty($usu->Comunidades) ? $usu->Comunidades->first()->getNome() : '')}}
                                </td>
                                -->
                                <td id="{{$usu->getId()}}_ativo" data="{{$usu->getAtivo()}}">
                                    @if($usu->getAtivo())
                                        <span class="badge badge-success">Ativo</span>
                                    @else
                                        <span class="badge badge-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>
                                    <span name="editBtn" class="cursor-pointer fa fa-edit text-success" data="{{$usu->getId()}}" title="Editar"></span>
                                    <span name="delBtn" class="cursor-pointer fa fa-trash text-danger" data="{{$usu->getId()}}" title="Excluir"></span>
                                </td>

                                <input id="{{$usu->getId()}}_foto" type="hidden" value="{{(!empty($usu->getFoto()) ? $usu->getFoto() : 'img/default-user.png')}}" />
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Inclui formulário modal -->
    @include('partials._modal_form',
    [
        'titulo'=> 'Novo Usuário',
        'rota' => 'adm.usuario.salvar',
        'icone' => 'fa-user',
        'campos'=>
        [
            [
                'tipo'=>'array',
                'campos'=>
                [
                    [
                        'largura'=>'4',
                        'id'=>'imgFoto',
                        'classe'=>'cursor-pointer',
                        'tipo'=>'img-miniatura',
                        'src'=>env('APP_URL').'/img/default-user.png',
                    ],
                    [
                        'largura'=>'5',
                        'padding'=>'50',
                        'id' =>'txtUsuario',
                        'label'=>'Usuário',
                        'nome'=>'usuario',
                        'tamanho'=>'50',
                        'tipo'=>'txt',
                        'required'=> true,
                        'autofocus'=> true
                    ],
                    [
                        'largura'=>'3',
                        'id' =>'cbAtivo',
                        'label'=>'Ativo',
                        'nome'=>'ativo',
                        'tipo'=>'slider',
                        'required'=> true
                    ],
                ]
            ],
            [
                'tipo'=>'array',
                'campos'=>
                [
                    [
                        'largura'=>'6',
                        'id' =>'txtNome',
                        'label'=>'Nome',
                        'nome'=>'nome',
                        'tamanho'=>'50',
                        'tipo'=>'txt',
                        'required'=> true,
                        'autofocus'=> true,
                        'disabled'=>false
                    ],
                    [
                        'largura'=>'6',
                        'id' =>'txtSobreNome',
                        'label'=>'Sobrenome',
                        'nome'=>'sobrenome',
                        'tamanho'=>'50',
                        'tipo'=>'txt',
                        'required'=> true,
                        'autofocus'=> true,
                        'disabled'=>false
                    ],
                ]
            ],
            [
                'tipo'=>'array',
                'campos'=>
                [
                    [
                        'largura'=>'8',
                        'id' =>'txtEmail',
                        'label'=>'E-mail',
                        'nome'=>'email',
                        'tamanho'=>'100',
                        'tipo'=>'email',
                        'required'=> true,
                        'autofocus'=> true,
                        'disabled'=>false
                    ],
                    [
                        'largura'=>'4',
                        'id' =>'txtCelular',
                        'label'=>'Celular',
                        'nome'=>'celular',
                        'classe'=>'mask_celular',
                        'tamanho'=>'10',
                        'tipo'=>'txt',
                        'autocomplete'=>'off',
                        'required'=> false,
                        'disabled'=>false
                    ]
                ]
            ],
            [
                'id'=>'dlgArquivo',
                'tipo'=>'arquivo',
                'classeLinha'=>'d-none',
                'nome'=>'foto',
                'filtro'=>'image/*'
            ],
            [
                'id' =>'cbClasse',
                'label'=>'Nível de acesso',
                'nome'=>'classe',
                'tipo'=>'combo',
                'opcoes'=>$classes,
                'required'=> true,
                'disabled'=>false
            ],
            /*
            [
                'id' =>'cbFilial',
                'label'=>'Acesso à Filial',
                'nome'=>'filial',
                'tipo'=>'combo',
                'opcoes'=>[],
                'required'=> false,
                'disabled'=>false
            ],
            */
            [
                'tipo'=>'array',
                'campos'=>
                [
                    [
                        'largura'=>'6',
                        'id' =>'txtSenha',
                        'label'=>'Senha',
                        'nome'=>'senha',
                        'tamanho'=>'50',
                        'tipo'=>'password',
                        'autocomplete'=>'off',
                        'required'=> true,
                        'disabled'=>false
                    ],
                    [
                        'largura'=>'6',
                        'id' =>'txtConfirmSenha',
                        'label'=>'Confirmar senha',
                        'nome'=>'confirma_senha',
                        'tamanho'=>'50',
                        'tipo'=>'password',
                        'autocomplete'=>'off',
                        'required'=> true,
                        'disabled'=>false
                    ]
                ]
            ],
        ]
    ])

    @include('partials._modal_delete',
    [
        'rota'=>'adm.usuario.delete',
        'titulo'=>'Confirma Exclusão',
        'mensagem_delete'=>'Tem certeza que deseja excluir o Usuário'
    ])

@endsection
