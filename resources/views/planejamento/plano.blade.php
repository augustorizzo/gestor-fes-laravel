@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-building',
    'titulo'=>'Plano de ação',
    'breadcrumb'=>['Planejamento','Plano']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.css')}}"/>
@endsection

@section('scripts')
    <script src="{{{ URL::asset('js/views/administracao/combo_eixo.js') }}}"></script>
    <script src="{{{ URL::asset('js/views/planejamento/plano_acao.js') }}}"></script>
    <script src="{{{ URL::asset('js/views/planejamento/plano_detalhe.js') }}}"></script>


@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        {{--
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Filtros</legend>

                    <div class="row">
                         <!-- Programa -->
                        <div class="col-md-3 col-sm-12">

                            @include('partials.util.combo',['id'=>'cbPrograma','name'=>'programa','label'=>'Programa','padrao'=>'Selecione','opcoes'=>Combo::Programas()])

                        </div>

                        <!-- Eixo -->
                        <div class="col-md-3 col-sm-12">

                            @include('partials.util.combo',['id'=>'cbEixo','name'=>'eixo','label'=>'Ação','opcoes'=>[],'propriedades'=>'disabled'])

                        </div>

                        <!-- Eixo -->
                        <div class="col-md-3 col-sm-12">

                            @include('partials.util.combo',['id'=>'cbOrgao','name'=>'orgao','label'=>'Órgão','opcoes'=>Combo::Orgaos()])

                        </div>
                    </div>


                </fieldset>
            </div>
        </div>
        --}}

        <div class="row mt-3">
            <div class="col-md-12">
                <a id="btnNovoPlano" href="{{route('planejamento.plano.editar',Util::Criptografa(0))}}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Novo Plano de Ação
                </a>
            </div>
        </div>
        <br/>

        <div class="row mt-3">
            <div class="col-md-12 table-responsive">

                <table id="tbPrograma" class="table table-hover table-striped table-bordered">
                    <thead class="bg-primary text-white text-center">
                        <tr class="text-center">
                            <th>Identificador</th>
                            <th>Apelido</th>
                            <th>Órgão</th>
                            <th>Programa</th>
                            <th>Eixo</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($planos as $plano)
                                <tr class="text-center">
                                <td>{{$plano->getIdentificador()}}</td>
                                <td>{{$plano->getApelido()}}</td>
                                <td>{{$plano->Orgao->getSigla()}}</td>
                                <td>{{$plano->Eixo->Programa->getTitulo()}}</td>
                                <td>{{$plano->Eixo->getNome()}}</td>
                                <td class="mask_moeda text-right">{{$plano->Valor()}}</td>
                                <td>
                                    <span class="badge badge-pill {{STATUS_PLANO::GetBadge($plano->getStatus())}}">{{STATUS_PLANO::GetStatus($plano->getStatus())}}</span>
                                </td>
                                <td>
                                    <a href="{{route('planejamento.plano.editar',Util::Criptografa($plano->getId()))}}">
                                        <span class="fa fa-edit text-success cursor-pointer"></span>
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
