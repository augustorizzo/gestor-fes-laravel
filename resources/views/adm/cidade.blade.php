@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fas fa-building',
    'titulo'=>'Cidades',
    'breadcrumb'=>['Admin','Cidades']
])

@section('scripts')
    <script src="{{{ URL::asset('js/views/adm/cidade.js') }}}"></script>
@endsection

@section('pagina')


    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col panel panel-primary table-responsive">

                <table id="tbCidades" class="table table-hover table-striped text-left">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Estado</th>
                            <th>UF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($cidades as $cidade)
                            <tr>
                                <td id="{{$cidade->getId()}}_nome">{{$cidade->getDescricao()}}</td>
                                <td id="{{$cidade->getId()}}_latitude">{{$cidade->getLatitude()}}</td>
                                <td id="{{$cidade->getId()}}_longitude">{{$cidade->getLongitude()}}</td>
                                <td id="{{$cidade->getId()}}_estado" data="{{$cidade->Estado->getId()}}">{{$cidade->Estado->getNome()}}</td>
                                <td id="{{$cidade->getId()}}_uf">{{$cidade->Estado->getSigla()}}</td>
                                <td>
                                    <span name="editBtn" class="fa fa-edit text-success cursor-pointer" data="{{$cidade->getId()}}"  title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash text-danger cursor-pointer" data="{{$cidade->getId()}}"  title="Excluir"></span>
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
        'titulo'=> 'Atualizar Cidade',
		'icone'=>'fa-city',
        'rota' => 'adm.cidade.salvar',
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
                'id' =>'cbEstado',
                'label'=>'Estado',
                'nome'=>'uf',
                'tipo'=>'combo',
                'opcoes'=> $estados,
                'default'=>'Selecione',
                'required'=> true,
                'autofocus'=> false,
                'disabled'=>false
            ],
        ]
    ])

@endsection
