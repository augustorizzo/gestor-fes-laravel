@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-hashtag',
    'titulo'=>'Corporação',
    'breadcrumb'=>['Cadastro','Corporação']
])

@section('titulo')
    <i class="fas fa-cog"></i>
@endsection

@section('scripts')
    <script src="{{{ URL::asset('js/views/cadastro/corporacao.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col-md-12 text-left">
                <button id="btnNovaCorporacao" type="button" class="btn btn-primary" aria-label="Left Align" >
                    <i class="fa fa-plus-circle"></i> Nova Corporação
                </button>
            </div>
        </div>
    <br/>
    <div class="row mt-3">
        <div class="col-md-12 table-responsive">

                <table id="tbCorporacao" class="table table-hover table-striped table-bordered text-left">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="w-5 text-center">Logo</th>
                            <th class="w-10">Sigla</th>
                            <th>Nome</th>
                            <th class="w-5">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($corporacoes as $corporacao)
                            <tr>
                                <td class="text-center">
                                    <img id="{{$corporacao->getId()}}_logo" src="{{Util::CaminhoCompleto($corporacao->getLogo())}}" height="30"/>
                                </td>
                                <td id="{{$corporacao->getId()}}_sigla">{{$corporacao->getSigla()}}</td>
                                <td id="{{$corporacao->getId()}}_nome">{{$corporacao->getNome()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$corporacao->getId()}}" title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash ml-2 text-danger cursor-pointer" data="{{$corporacao->getId()}}"  title="Excluir"></span>
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
        'idModal'=>'mdlCorporacao',
        'titulo'=> 'Nova Corporação',
		'icone'=>'fa-hashtag',
        'rota' => 'cadastro.corporacao.salvar',
        'campos'=>
        [
            [
                'id'=>'imgCorporacao',
                'tipo'=>'img-miniatura',
                'src'=>'/img/placeholder_logo.png',
                'classeLinha'=>'text-center cursor-pointer',
                'style'=>'height:200px;'
            ],
            [
                'id' =>'txtSigla',
                'label'=>'Sigla',
                'nome'=>'sigla',
                'classe'=>'text-uppercase',
                'tamanho'=>'10',
                'tipo'=>'txt',
                'autocomplete'=>'off',
                'required'=> true,
                'autofocus'=> true,
                'disabled'=>false
            ],
            [
                'id' =>'txtNome',
                'label'=>'Nome',
                'nome'=>'nome',
                'tamanho'=>'100',
                'tipo'=>'txt',
                'autocomplete'=>'off',
                'required'=> true,
                'autofocus'=> true,
                'disabled'=>false
            ],
            [
                'id'=>'dlgLogo',
                'nome'=>'logo',
                'tipo'=>'arquivo',
                'classe'=>'d-none'
            ]

        ]
    ])

    @include('partials._modal_delete',
    [
        'rota'=>'adm.parametro.delete',
        'titulo'=>'Confirma Exclusão',
        'mensagem_delete'=>'Tem certeza que deseja excluir o Parâmetro'
    ])

@endsection
