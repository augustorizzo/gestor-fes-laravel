@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fas fa-laptop',
    'titulo'=>'Sistema',
    'breadcrumb'=>['Admin','Sistema']
])

@section('scripts')
    <script src="{{{ URL::asset('js/views/adm/sistemas.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col text-left">
                <button id="btnNovoSistema" type="button" class="btn btn-primary" aria-label="Left Align" >
                    <i class="fa fa-plus-circle"></i> Novo Sistema
                </button>
            </div>
        </div>
    <br/>
    <div class="row mt-3">
        <div class="col panel panel-primary table-responsive">

                <table id="tbSistema" class="table table-hover text-left">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Versão Sistema</th>
                            <th>Versão Core</th>
                            <th>Versão Layout</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($sistemas as $sist)
                            <tr>
                                <td id="{{$sist->getId()}}_codigo">{{$sist->getCodigo()}}</td>
                                <td id="{{$sist->getId()}}_descricao">{{$sist->getDescricao()}}</td>
                                <td id="{{$sist->getId()}}_versao_sistema">{{$sist->getVersaoSistema()}}</td>
                                <td id="{{$sist->getId()}}_versao_core">{{$sist->getVersaoCore()}}</td>
                                <td id="{{$sist->getId()}}_versao_layout">{{$sist->getVersaoLayout()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$sist->getId()}}"  title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash text-danger cursor-pointer" data="{{$sist->getId()}}"  title="Excluir"></span>
                                </td>
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
		'icone'=>'fa-laptop',
        'titulo'=> 'Novo Sistema',
        'rota' => 'adm.sistema.salvar',
        'campos'=>
        [
            [
                'id' =>'txtCodigo',
                'label'=>'Código',
                'nome'=>'codigo',
                'tamanho'=>'5',
                'tipo'=>'txt',
                'required'=> true,
                'autofocus'=> true,
                'disabled'=>false
            ],
            [
                'id' =>'txtDescricao',
                'label'=>'Descrição',
                'nome'=>'descricao',
                'tamanho'=>'50',
                'tipo'=>'txt',
                'required'=> true,
                'autofocus'=> true,
                'disabled'=>false
            ],
            [
                'id' =>'txtVersaoSistema',
                'label'=>'Versão Sistema',
                'nome'=>'versao_sistema',
                'tamanho'=>'50',
                'tipo'=>'txt',
                'required'=> true,
            ],
            [
                'id' =>'txtVersaoCore',
                'label'=>'Versão do Core',
                'nome'=>'versao_core',
                'tamanho'=>'10',
                'tipo'=>'txt',
                'required'=> true,
            ],
            [
                'id' =>'txtVersaoLayout',
                'label'=>'Versão Layout',
                'nome'=>'versao_layout',
                'tamanho'=>'10',
                'tipo'=>'txt',
                'required'=> true,
            ],
        ]
    ])

    @include('partials._modal_delete',
    [
        'rota'=>'adm.sistema.delete',
        'titulo'=>'Confirma Exclusão',
        'mensagem_delete'=>'Tem certeza que deseja excluir o Sistema'
    ])

@endsection
