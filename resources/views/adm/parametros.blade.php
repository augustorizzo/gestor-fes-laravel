@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fa fa-hashtag',
    'titulo'=>'Parâmetros',
    'breadcrumb'=>['Admin','Parâmetros']
])

@section('titulo')
    <i class="fas fa-cog"></i> 
@endsection

@section('scripts')
    <script src="{{{ URL::asset('js/views/adm/parametros.js') }}}"></script>
@endsection

@section('pagina')
    
    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col text-left">
                <button id="btnNovoParametro" type="button" class="btn btn-primary" aria-label="Left Align" >
                    <i class="fa fa-plus-circle"></i> Novo Parâmetro
                </button>
            </div>
        </div>
    <br/>
    <div class="row mt-3">
        <div class="col panel panel-primary table-responsive">

                <table id="tbParametros" class="table table-hover table-striped text-left">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($parametros as $param)
                            <tr>
                                <td id="{{$param->getId()}}_codigo">{{$param->getCodigo()}}</td>
                                <td id="{{$param->getId()}}_descricao">{{$param->getDescricao()}}</td>
                                <td id="{{$param->getId()}}_valor">{{$param->getValor()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit fa-lg text-success cursor-pointer" data="{{$param->getId()}}" title="Editar"></span> 
                                    <span name="delBtn" class="fa fa-trash fa-lg text-danger cursor-pointer" data="{{$param->getId()}}"  title="Excluir"></span>
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
        'titulo'=> 'Novo Parâmetro',
		'icone'=>'fa-cog',
        'rota' => 'adm.parametro.salvar',
        'campos'=> 
        [
            [
                'id' =>'txtCodigo',
                'label'=>'Código',
                'nome'=>'codigo',
                'classe'=>'text-uppercase',
                'tamanho'=>'6',
                'tipo'=>'txt',
                'autocomplete'=>'off',
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
                'autocomplete'=>'off',
                'required'=> true,
                'autofocus'=> true,
                'disabled'=>false
            ],
            [
                'id' =>'txtValor',
                'label'=>'Valor',
                'nome'=>'valor',
                'tamanho'=>'50',
                'tipo'=>'txt',
                'autocomplete'=>'off',
                'required'=> true,
                'autofocus'=> true,
                'disabled'=>false
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