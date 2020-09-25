@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-file-invoice-dollar',
    'titulo'=>'Tipos de Aporte',
    'breadcrumb'=>['Aporte','Tipos de Aporte','Listagem']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.css')}}"/>
@endsection

@section('scripts')
    <script src="{{{ URL::asset('js/views/aporte/tipo_aporte.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        <div class="row mt-3">
            <div class="col-md-12">
                <button id="btnNovoTipoAporte" type="button" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Novo Tipo de Aporte
                </button>
            </div>
        </div>
        <br/>

        <div class="row mt-3">
            <div class="col-md-12 table-responsive">

                <table id="tbTipoAporte" class="table table-hover table-striped table-bordered">
                    <thead class="bg-primary text-white text-center">
                        <tr class="text-center">
                            <th>Descrição</th>
                            <th class="w-5">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($tipos as $tipo)

                            <tr class="text-left">
                                <td id="nome_{{$tipo->getId()}}">{{$tipo->getDescricao()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$tipo->getId()}}" title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash ml-2 text-danger cursor-pointer" data="{{$tipo->getId()}}"  title="Excluir"></span>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{-- Modal tipo de aporte --}}
    @include('partials._modal_form',
    [
        'idModal'=>'mdlTipoAporte',
        'titulo'=> 'Novo Tipo de Aporte',
		'icone'=>'fa fa-file-invoice-dollar',
        'rota' => 'aporte.tipo.salvar',
        'campos'=>
        [
            [
                'id' =>'txtDescricao',
                'label'=>'Descrição',
                'nome'=>'descricao',
                'tamanho'=>'50',
                'tipo'=>'txt',
                'autocomplete'=>'off',
                'required'=> true,
                'autofocus'=> true
            ],
        ]
    ])


    {{-- Modal excluir tipo de aporte --}}
    @include('partials._modal_delete',
    [
        'rota'=>'aporte.tipo.delete',
        'titulo'=>'Excluir tipo de aporte',
        'mensagem_delete'=>'Tem certeza que deseja excluir o tipo de aporte'
    ])

@endsection
