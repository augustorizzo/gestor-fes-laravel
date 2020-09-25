@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-file-invoice-dollar',
    'titulo'=>'Aporte',
    'breadcrumb'=>['Aporte']
])

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('plugins/breadcrumbs-and-multistep-indicator-master/css/reset.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('plugins/breadcrumbs-and-multistep-indicator-master/css/style.css')}}"/>

    {{-- CSS DATE PICKER --}}
    <link rel="stylesheet" href="{{ URL::asset('js/jquery-ui-1.12.1/jquery-ui.min.css')}}"/>

    <style>
        .cd-breadcrumb.triangle li.visited > *
        {
            color:#f1b827;
            background-color: #0b0b45 !important;
            border-color: #0b0b45 !important;
        }

        fieldset
        {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow:  0px 0px 0px 0px #000;
                    box-shadow:  0px 0px 0px 0px #000;
        }

        legend
        {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width:auto;
            padding:0 10px;
            border-bottom:none;
        }
    </style>
@endsection

@section('scripts')
    {{-- SCRIPTS DATE PICKER --}}
    <script src="{{{ URL::asset('js/jquery-ui-1.12.1/jquery-ui.min.js') }}}"></script>
    <script src="{{{ URL::asset('js/jquery-ui-1.12.1/i18n/datepicker-pt-BR.js') }}}"></script>

    <script src="{{{ URL::asset('js/views/aporte/aporte_acessar.js') }}}"></script>
    <script src="{{{ URL::asset('plugins/breadcrumbs-and-multistep-indicator-master/js/modernizr.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        <div class="row">
            <div class="col-md-12">
                {{-- STATUS --}}
                <nav>
                    <ol class="cd-breadcrumb triangle">
                        <li class="visited"><a href="#0">Previsto</a></li>
                        <li class="visited"><a href="#0">Bloqueado</a></li>
                        <li class="current"><em>Liberado</em></li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- FORMULÁRIO --}}
        <form method="POST" action="{{route('aporte.salvar')}}" enctype="multipart/form-data">
            @csrf

            {{-- 1ª LINHA --}}
            <div class="row">

                {{-- TIPO DO APORTE --}}
                <div class="col-sm-12 col-md-3">
                    @include('partials.controle.combo',
                    [
                        'id'=>'cbTipoAporte',
                        'name'=>'tipo_aporte',
                        'label'=>'Tipo de Aporte',
                        'opcoes'=>Combo::TipoAporte(),
                        'selecionado'=>(!empty($aporte) ? $aporte->getFkTipo() : ''),
                        'obrigatorio'=>true,
                        'padrao'=>'Selecione',
                    ])
                </div>

                {{-- APELIDO --}}
                <div class="col-sm-12 col-md-3">
                    @include('partials.controle.texto',
                    [
                        'id'=>'txtApelido',
                        'name'=>'apelido',
                        'label'=>'Apelido',
                        'tamanho'=>'50',
                        'obrigatorio'=>true,
                        'texto'=>(!empty($aporte) ? $aporte->getApelido() : ''),
                    ])
                </div>

                {{-- DATA LANÇAMENTO --}}
                <div class="col-sm-12 col-md-2">
                    @include('partials.controle.texto',
                    [
                        'id'=>'txtDtLancamento',
                        'name'=>'dt_lancamento',
                        'label'=>'Data do lançamento',
                        'classe'=>'mask_data text-right',
                        'tamanho'=>'10',
                        'obrigatorio'=>true,
                        'texto'=>(!empty($aporte) ? $aporte->getDtLancamento() : ''),
                    ])
                </div>

                {{-- VALOR TOTAL --}}
                <div class="col-sm-12 col-md-2">
                    @include('partials.controle.texto',
                    [
                        'id'=>'txtVlrRepasseTotal',
                        'name'=>'vlr_repasse_total',
                        'label'=>'Valor repasse total',
                        'classe'=>'mask_moeda text-right',
                        'tamanho'=>'50',
                        'obrigatorio'=>true,
                        'texto'=>(!empty($aporte) ? $aporte->ValorTotal() : ''),
                    ])
                </div>

            </div>

            {{-- 2ª LINHA --}}
            <div class="row mt-3">
                <div class="col-md-12">

                    {{-- EIXOS --}}
                    @foreach(Combo::Eixos() as $key=>$valor)

                        <div class="row">
                            <div class="col-md-4">

                                <fieldset>
                                    <legend>{{$valor}}</legend>

                                    {{-- VALOR DO EIXO --}}
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            @include('partials.controle.texto',
                                            [
                                                'id'=>'txtValorEixo_'.$key,
                                                'name'=>'vlr_eixo_'.$key,
                                                'label'=>'',
                                                'classe'=>'mask_moeda text-right',
                                                'tamanho'=>'50',
                                                'obrigatorio'=>true,
                                                'texto'=>(!empty($aporte) ? $aporte->ValorEixo($key) : ''),
                                            ])
                                        </div>
                                    </div>

                                     {{-- DIVISÃO DO EIXO --}}
                                     <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12">

                                            <table class="table table-hover table-striped table-bordered">
                                                <thead class="bg-primary text-white text-center">
                                                    <th class="w-50">Grupo Despesa</th>
                                                    <th>Valor</th>
                                                    <th class="w-15 text-center">%</th>
                                                </thead>
                                                <tbody>

                                                    @foreach($aporte->DetalhesEixo($key) as $detalhe)
                                                        <tr>
                                                            <td>{{$detalhe->Categoria->getDescricao()}}</td>
                                                            <td class="text-right">
                                                                @include('partials.controle.texto',
                                                                [
                                                                    'id'=>'txtValorEixoDetalhe_'.$detalhe->getId(),
                                                                    'name'=>'vlr_eixo_detalhe_'.$detalhe->getId(),
                                                                    'label'=>'',
                                                                    'classe'=>'mask_moeda text-right',
                                                                    'tamanho'=>'50',
                                                                    'texto'=>($detalhe->getValor()),
                                                                ])
                                                            </td>
                                                            <td class="text-right">

                                                                @include('partials.controle.number',
                                                                [
                                                                    'id'=>'txtPercentualEixoDetalhe_'.$detalhe->getId(),
                                                                    'name'=>'percentual_eixo_detalhe_'.$detalhe->getId(),
                                                                    'label'=>'',
                                                                    'classe'=>'p-0 text-right',
                                                                    'minimo'=>0,
                                                                    'maximo'=>100,
                                                                    'intervalo'=>0.1,
                                                                    'valor'=>round((($detalhe->getValor() / $aporte->ValorEixo($key)) * 100),2),
                                                                    'obrigatorio'=>true,
                                                                ])

                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </fieldset>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </form>

    </div>

@endsection
