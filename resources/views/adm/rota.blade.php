@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fa fa-map-marker-alt',
    'titulo'=>'Rotas',
    'breadcrumb'=>['Admin','Rotas']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/jquery-ui-1.12.1/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.css')}}"/>
@endsection

@section('scripts')

    <script src="{{{ URL::asset('js/jquery-ui-1.12.1/jquery-ui.min.js') }}}"></script>

	<script src="{{{ URL::asset('js/treetable/treeTable.js') }}}"></script>
    <script src="{{{ URL::asset('js/views/adm/rota.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        @if($permEditar)
            <div class="row" >
                <div class="col-md-12 text-left">
                    <button id="btnNovaRota" type="button" class="btn btn-primary" aria-label="Left Align" >
                        <i class="fa fa-plus-circle"></i> Nova Rota
                    </button>
                </div>
            </div>
            <br/>
        @endif

        <div class="row mt-3">
            <div class="col-md-12">

                <table id="tbRotas" class="table table-hover text-left">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Rota</th>
                            <th>Rota Pai</th>
                            <th>Menu</th>
                            <th>Ícone</th>

                            @if($permEditar || $permDelete)
                                <th>Ações</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($rotas as $rota)

                            @include('partials.adm._linha_tabela_rota',
                            [
                                'rota_id'=>$rota->getId(),
                                'rota_nome'=>$rota->getNome(),
                                'rota_rota'=>$rota->getRota(),
                                'rota_pai_id'=>(empty($rota->RotaPai) ? '' : $rota->RotaPai->getId()),
                                'rota_pai'=>(empty($rota->RotaPai) ? '' : $rota->RotaPai->getNome()),
                                'rota_menu'=>$rota->isMenu(),
                                'rota_icone'=>$rota->getIcone(),
                                'permEditar'=>$permEditar,
                                'permDelete'=>$permDelete,
                                'rotasFilhas'=>$rota->Rotas,
                                'nivel'=>'1'
                            ])

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @if($permEditar)

        <!-- Inclui formulário modal -->
        @include('partials._modal_form',
        [
            'idModal'=>'dlgRota',
            'titulo'=> 'Nova Rota',
            'icone'=>'fa fa-map-marker',
            'rota' => 'adm.rota.salvar',
            'campos'=>
            [
                [
                    'tipo'=>'array',
                    'campos'=>
                    [
                        [
                            'largura'=>'5',
                            'id' =>'cbMenu',
                            'label'=>'Menu',
                            'nome'=>'menu',
                            'tipo'=>'slider'
                        ]
                    ]
                ],
                [
                    'id' =>'txtNome',
                    'label'=>'Nome',
                    'nome'=>'nome',
                    'tamanho'=>'50',
                    'tipo'=>'txt',
                    'required'=> true,
                    'autofocus'=> true,
                    'autocomplete'=>'off'
                ],
                [
                    'id' =>'txtRota',
                    'label'=>'Rota',
                    'nome'=>'rota',
                    'tamanho'=>'50',
                    'tipo'=>'txt',
                    'required'=> true,
                    'autocomplete'=>'off'
                ],
                [
                    'tipo'=>'array',
                    'campos'=>
                    [
                        [
                            'largura'=>'10',
                            'id' =>'txtIcone',
                            'label'=>'icone',
                            'nome'=>'icone',
                            'tamanho'=>'50',
                            'tipo'=>'txt'
                        ],
                        [
                            'largura'=>'2',
                            'id' =>'icnRota',
                            'label'=>'',
                            'style'=>'font-size:xx-large;padding-top:32px;',
                            'tipo'=>'icone'
                        ]
                    ]
                ],
                [
                    'id' =>'cbPai',
                    'label'=>'Rota pai',
                    'nome'=>'pai',
                    'tipo'=>'combo',
                    'opcoes'=>[]
                ]
            ]
        ])
    @endif

    @if($permDelete)
        @include('partials._modal_delete',
        [
            'rota'=>'adm.rota.delete',
            'titulo'=>'Confirma Exclusão',
            'mensagem_delete'=>'Tem certeza que deseja excluir a rota'
        ])
    @endif

@endsection
