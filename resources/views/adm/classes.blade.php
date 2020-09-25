@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fa fa-tag',
    'titulo'=>'Classes',
    'breadcrumb'=>['Admin','Classes']
])

@section('scripts')
    <script src="{{{ URL::asset('js/views/adm/classes.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col text-left">
                <button id="btnNovaClasse" type="button" class="btn btn-primary" aria-label="Left Align" >
                    <i class="fa fa-plus-circle"></i> Nova Classe
                </button>
            </div>
        </div>
    <br/>
    <div class="row mt-3">
        <div class="col panel panel-primary table-responsive">

                <table id="tbClasses" class="table table-hover text-left">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Admin</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($classes as $cls)
                            <tr>
                                <td id="{{$cls->getId()}}_codigo">{{$cls->getCodigo()}}</td>
                                <td id="{{$cls->getId()}}_descricao">{{$cls->getDescricao()}}</td>
                                <td id="{{$cls->getId()}}_admin">

                                    @if($cls->isAdmin())
                                        <span class="badge badge-success">Sim</span>
                                    @else
                                        <span class="badge badge-danger">Não</span>
                                    @endif


                                </td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$cls->getId()}}"  title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash text-danger cursor-pointer" data="{{$cls->getId()}}"  title="Excluir"></span>
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
        'titulo'=> 'Nova Classe',
		'icone'=>'fa fa-tag',
        'rota' => 'adm.classe.salvar',
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
            ]
        ]
    ])

    @include('partials._modal_delete',
    [
        'rota'=>'adm.classe.delete',
        'titulo'=>'Confirma Exclusão',
        'mensagem_delete'=>'Tem certeza que deseja excluir a Classe'
    ])

@endsection
