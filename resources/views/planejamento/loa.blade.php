@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fa fa-building',
    'titulo'=>'LOA - Lei Orçamentária Anual',
    'breadcrumb'=>['Planejamento','LOA']
])


@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.css')}}"/>
@endsection

@section('scripts')
    
@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        <!--
        <div class="row">
            <div class="col-md-12">
                <button id="btnNovoEixo" type="button" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Adicionar Novo Eixo
                </button>
            </div>
        </div>
        <br/>
        -->

        <div class="row mt-3">
            <div class="col-md-12">

                <table id="tbPrograma" class="table table-responsive table-hover table-striped table-bordered">
                    <thead class="bg-primary text-white text-center">
                        <tr class="text-center">
                            <th>Ano</th>
                            <th>Inicio Vigência</th>
                            <th>Fim Vigência</th>
                            <th>Valor Disponivel</th>
                            <th>Valor Utilizado</th>
                            <th>Valor Pendente</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($loas as $loa)

                            <tr class="text-center">
                                <td>{{$loa->getAno()}}</td>
                                <td>{{$loa->getDtValidadeIni()}}</td>
                                <td>{{$loa->getDtValidadeFim()}}</td>
                                <td class="text-right">{{Util::FormataMoeda($loa->ValorDisponivel())}}</td>
                                <td class="text-right">{{Util::FormataMoeda($loa->ValorUtilizado())}}</td>
                                <td class="text-right">{{Util::FormataMoeda($loa->ValorPendente())}}</td>
                                <td>
                                    <span class="badge badge-pill badge-success">Ativo</span>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection