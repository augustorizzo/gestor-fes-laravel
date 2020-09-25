@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-balance-scale',
    'titulo'=>'Item Plano',
    'breadcrumb'=>['Cadastro','Item Plano']
])

@section('titulo')
    <i class="fas fa-cog"></i>
@endsection

@section('scripts')
    <script src="{{{ URL::asset('js/views/cadastro/item-plano.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col-md-12 text-left">
                <button id="btnNovoItemPlano" type="button" class="btn btn-primary" aria-label="Left Align" >
                    <i class="fa fa-plus-circle"></i> Novo item plano
                </button>
            </div>
        </div>
    <br/>
    <div class="row mt-3">
        <div class="col-md-12 table-responsive">

                <table id="tbItemPlano" class="table table-hover table-striped table-bordered text-left">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Nome do Item</th>
                            <th class="w-5">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($itens as $item)
                            <tr>
                                <td id="{{$item->getId()}}_nome">{{$item->getDescricao()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$item->getId()}}" title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash ml-2 text-danger cursor-pointer" data="{{$item->getId()}}"  title="Excluir"></span>
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
        'idItem'=>'mdlItemPlano',
        'titulo'=> 'Novo Item Plano',
		    'icone'=>'fa-balance-scale',
        'rota' => 'cadastro.item-plano.salvar',
        'campos'=>
        [
            [
                'id' =>'txtNome',
                'label'=>'Nome',
                'nome'=>'nome',
                'tamanho'=>'20',
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
        'rota'=>'cadastro.item-plano.delete',
        'titulo'=>'Confirma Exclusão',
        'mensagem_delete'=>'Tem certeza que deseja excluir o item'
    ])

@endsection
