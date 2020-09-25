@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-balance-scale',
    'titulo'=>'Unidade de Medida',
    'breadcrumb'=>['Cadastro','Unidade de Medida']
])

@section('titulo')
    <i class="fas fa-cog"></i>
@endsection

@section('scripts')
    <script src="{{{ URL::asset('js/views/cadastro/unidade-medida.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col-md-12 text-left">
                <button id="btnNovaUnidade" type="button" class="btn btn-primary" aria-label="Left Align" >
                    <i class="fa fa-plus-circle"></i> Nova Unidade
                </button>
            </div>
        </div>
    <br/>
    <div class="row mt-3">
        <div class="col-md-12 table-responsive">

                <table id="tbUnidadeMedida" class="table table-hover table-striped table-bordered text-left">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="w-10">Sigla</th>
                            <th>Nome</th>
                            <th class="w-5">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($unidades as $unidade)
                            <tr>
                                <td id="{{$unidade->getId()}}_sigla">{{$unidade->getSigla()}}</td>
                                <td id="{{$unidade->getId()}}_nome">{{$unidade->getDescricao()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$unidade->getId()}}" title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash ml-2 text-danger cursor-pointer" data="{{$unidade->getId()}}"  title="Excluir"></span>
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
        'idModal'=>'mdlUnidadeMedida',
        'titulo'=> 'Nova Unidade de Medida',
		'icone'=>'fa-balance-scale',
        'rota' => 'cadastro.unidade-medida.salvar',
        'campos'=>
        [
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
        ]
    ])

    @include('partials._modal_delete',
    [
        'rota'=>'cadastro.unidade-medida.delete',
        'titulo'=>'Confirma Exclusão',
        'mensagem_delete'=>'Tem certeza que deseja excluir a unidade de medida'
    ])

@endsection
