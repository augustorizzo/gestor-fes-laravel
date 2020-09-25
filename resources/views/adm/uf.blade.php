@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fas fa-map-marked-alt',
    'titulo'=>'Estados',
    'breadcrumb'=>['Admin','Estados']
])

@section('scripts')
    <script src="{{{ URL::asset('js/views/adm/uf.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col panel panel-primary table-responsive">

                <table id="tbEstados" class="table table-hover text-left">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($ufs as $uf)
                            <tr>
                                <td id="{{$uf->getId()}}_nome">{{$uf->getNome()}}</td>
                                <td id="{{$uf->getId()}}_sigla">{{$uf->getSigla()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$uf->getId()}}"  title="Editar"></span>
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
        'titulo'=> 'Atualizar Estado',
		'icone'=> 'fas fa-map-marked-alt',
        'rota' => 'adm.uf.salvar',
        'campos'=> 
        [
            [
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
                'id' =>'txtSigla',
                'label'=>'Sigla',
                'nome'=>'sigla',
                'tamanho'=>'2',
                'tipo'=>'txt',
                'required'=> true,
                'autofocus'=> true,
                'disabled'=>false
            ]
        ]
    ])

@endsection