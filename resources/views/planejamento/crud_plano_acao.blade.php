@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-outdent',
    'titulo'=>'Plano de ação',
    'breadcrumb'=>['Planejamento','Plano de Ação']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins/trumbowyg/ui/trumbowyg.min.css')}}"/>
    <style>

        .index-999
        {   z-index: 999;
            max-width:200vh!important;
            @media screen and (max-width: 600px) {
             z-index: 999;
             background-color: black!important;
             }
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ URL::asset('plugins/trumbowyg/trumbowyg.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/trumbowyg/langs/pt_br.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/trumbowyg/plugins/pasteimage/trumbowyg.pasteimage.min.js') }}"></script>

    {{-- Sticky --}}
    <script src="{{ URL::asset('plugins/sticky/jquery.sticky.js')}}"></script>

    {{-- CHARTS --}}
    <script src="{{ URL::asset('plugins/highcharts8/highcharts.js') }}"></script>
    <script src="{{ URL::asset('plugins/highcharts8/highcharts-3d.js') }}"></script>

    {{-- GAUGE --}}
    {{-- <script src="{{ URL::asset('plugins/gauge/gauge.coffee') }}"></script> --}}
    <script src="{{ URL::asset('plugins/gauge/gauge.js') }}"></script>


    <!-- FusionCharts -->
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <!-- jQuery-FusionCharts -->
    <script type="text/javascript" src="https://rawgit.com/fusioncharts/fusioncharts-jquery-plugin/develop/dist/fusioncharts.jqueryplugin.min.js"></script>
    <!-- Fusion Theme -->
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

    <script src="{{URL::asset('plugins/jquery_form/jquery.form.min.js')}}"></script>

    <script src="{{ URL::asset('temas/adminlte2418/bower_components/chart.js/Chart.js') }}"></script>

    <script src="{{ URL::asset('js/views/administracao/combo_eixo.js') }}"></script>
    <script src="{{ URL::asset('js/views/planejamento/plano_acao/graficos.js') }}"></script>
    <script src="{{ URL::asset('js/views/planejamento/plano_acao/plano_acao_editar.js') }}"></script>
    <script src="{{ URL::asset('js/views/planejamento/plano_acao/plano_item.js') }}"></script>
    <script src="{{ URL::asset('js/views/planejamento/plano_acao/plano_detalhe.js') }}"></script>
    <script src="{{ URL::asset('js/views/planejamento/plano_acao/plano_acao_aporte.js') }}"></script>
    <script src="{{ URL::asset('js/views/planejamento/plano_acao/plano_acao_arquivos.js') }}"></script>

@endsection

@section('pagina')
    <div class="container-fluid p-3">


    {{-- COMBOS ESCONDIDOS PARA O DETALHES --}}
    <div class="d-none">
        {{-- Combo escondido Corporação --}}
        @include('partials.util.combo',
        [
            'id'=>'cbCorporacao',
            'name'=>'hdn_corporacao',
            'label'=>'',
            'opcoes'=>Combo::Corporacao()
        ])

        {{-- Combo escondido Grupo Despesa --}}
        @include('partials.util.combo',
        [
            'id'=>'cbGrupoDespesa',
            'name'=>'hdn_grupodespesa',
            'label'=>'',
            'opcoes'=>Combo::GrupoDespesa()
        ])

        {{-- Combo escondido Unidades --}}
        @include('partials.util.combo',
        [
            'id'=>'cbUnidadesMedida',
            'name'=>'hdn_unidade_medida',
            'label'=>'',
            'opcoes'=>Combo::Unidades()
        ])

        {{-- Combo escondido Unidades --}}
        @include('partials.util.combo',
        [
            'id'=>'cbUnidadesMedida',
            'name'=>'hdn_unidade_medida',
            'label'=>'',
            'opcoes'=>Combo::Unidades()
        ])
    </div>

    {{-- PLANO DE AÇÃO --}}
    <form id="frmPlanoAcao" method="POST" enctype="multipart/form-data" action="{{route('planejamento.plano.salvar')}}">
        @csrf

        {{-- ID do plano --}}
        <input type="hidden" id="hdnIdPlano" name="id" value="{{!empty($plano) ? Util::Criptografa($plano->getId()) : ''}}"/>

        {{-- APORTES --}}
        <div class="row mb-3 card card-outline card-success">
            <div class="card-header">
                <h4 class="card-title">Aportes</h4>
                <div class="card-tools">
                    <button id="btnControleAportes" type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-sm-12 col-md-4 mb-3">

                        <label for="cbAporte">Aportes</label>
                        <select name="aporte[]" id="cbAporte" data-placeholder="Selecione o(s) aportes" class="form-control" multiple>
                            @foreach($aportes as $aporte)
                                <option value="{{$aporte->getId()}}" {{in_array($aporte->getId(),(!empty($plano) ? $plano->FkAportes() : [])) ? 'selected' : ''}} >{{$aporte->getApelido()}}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- BOX INVESTIMENTO -->
                    <div class="col-md-3 col-sm-12">

                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Investimento</span>
                                <span class="info-box-number">
                                    R$ <b id="bxVlrInvestimento">0,00</b>
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description"></span>
                            </div>
                        </div>

                    </div>

                    <!-- BOX CUSTEIO -->
                    <div class="col-md-3 col-sm-12">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Custeio</span>
                                <span class="info-box-number">R$ <b id="bxVlrCusteio">0,00</b></span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                    </div>

                </div>

            </div>
        </div>

        {{-- CABEÇALHO DO PLANO DE AÇÃO --}}
        <div id="pnlGraficosEixo" class="index-999" >

        <div class="row card card-outline card-primary">
            <input class="d-none mask_moeda" type="text"/>

            <div class="card-header">

                {{-- TÍTULO --}}
                <h3 class="card-title">
                    Plano de Ação -
                    <b id="hdrIdentificador" class="font-weight-bold badge {{STATUS_PLANO::GetBadge(!empty($plano) ? $plano->getStatus() : STATUS_PLANO::$RASCUNHO)}}">{{!empty($plano) ? $plano->getIdentificador() : (Util::GetData()->format('Y').'XXXX0000')}}</b>
                    <i id="loading_identificador" class="fa fa-spinner fa-spin d-none text-primary"></i>
                    <input id="hdnIdentificador" type="hidden" name="identificador" value="{{!empty($plano) ? $plano->getIdentificador() : ''}}"/>

                    {{-- APELIDO --}}
                    <input name="apelido" maxlength="50" type="text" placeholder="apelido" value="{{!empty($plano) ? $plano->getApelido() : ''}}"/>
                </h3>

                {{-- BOTÕES --}}
                <div class="card-tools">

                    {{-- IMPRIMIR PLANO DE AÇÃO --}}
                    @if(!empty($plano))

                        <i id="btnImprimirPlano" class="fa fa-print cursor-pointer text-primary" title="Imprimir plano de ação"></i>

                    @endif

                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>

            </div>

            {{-- GRÁFICOS PLANO DE AÇÃO --}}
            <div class="card-body">
                <div class="row">

                    {{-- COMBOS --}}
                    <div class="col-md-3 col-sm-12">

                        {{-- Programa --}}
                        @include('partials.util.combo',
                        [
                            'id'=>'cbPrograma',
                            'name'=>'programa',
                            'label'=>'Programa',
                            'padrao'=>'Selecione',
                            'classe'=>'valida',
                            'opcoes'=>Combo::Programas(),
                            'selecionado'=>(!empty($plano) ? $plano->Eixo->getFkPrograma() : null),
                            'propriedades'=>(!empty($plano) ? ('data-eixo='.$plano->getFkEixo()) : null),
                        ])

                        {{-- Eixo --}}
                        @include('partials.util.combo',
                        [
                            'id'=>'cbEixo',
                            'name'=>'eixo',
                            'label'=>'Eixo',
                            'opcoes'=>[],
                            'classe'=>'valida',
                            'propriedades'=>'disabled',
                        ])
                    </div>

                        <div class="row col-sm-9">

                            {{-- GAUGE EIXO --}}
                            <div id="divGaugeEixo" class="col-sm-8 col-md-4">

                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title float-left">Eixo</h3>
                                        <h3 id="lblValorTotalEixo" class="card-title float-right font-weight-bold">R$ 0.00</h3>
                                    </div>

                                    <div id="gauge-eixo" style = "margin-bottom:10px"></div>
                                </div>

                            </div>

                            {{-- GAUGE INVESTIMENTO --}}
                            <div id="divGaugeInvestimento" class="col-sm-6 col-md-4">

                                <div class="description-block card card-outline card-success pb-3 mt-0">
                                    <div class="card-header">
                                        <h3 class="card-title float-left">Investimento</h3>
                                        <h3 id="lblValorInvestimento" class="card-title float-right font-weight-bold">R$ 0.00</h3>
                                    </div>

                                        <div class="row p-0">
                                            <div class="col-md-6 col-sm-12 p-0 text-md-right text-sm-center">
                                                <canvas id="gauge-investimento" height="50" width="70"></canvas>
                                            </div>
                                            <div class="col-md-6 col-sm-12 text-md-left text-sm-center">
                                                <h3 id="lblInvestimentoPercentual" class="mt-md-4 mt-sm-0">0.00%</h3>
                                            </div>
                                        </div>

                                    <h5 id="lblTotalInvestimentoPlano" class="description-header">R$ 0,00</h5>

                                </div>

                            </div>

                            {{-- GAUGE CUSTEIO --}}
                            <div id="divGaugeCusteio" class="col-md-4 col-sm-6">

                                <div class="description-block border-right card card-outline card-warning pb-3 mt-0">
                                    <div class="card-header ">
                                        <h3 class="card-title pull-left">Custeio</h3>
                                        <h3 id="lblValorCusteio" class="card-title pull-right font-weight-bold">R$ 0.00</h3>
                                    </div>


                                    <div class="row p-0">
                                        <div class="col-md-6 col-sm-12 p-0 text-md-right text-sm-center">
                                            <canvas id="gauge-custeio" height="50" width="70"></canvas>
                                        </div>
                                        <div class="col-md-6 col-sm-12 text-md-left text-sm-center">
                                            <h3 id="lblCusteioPercentual" class="mt-4">0.00%</h3>
                                        </div>
                                    </div>

                                    <h5 id="lblTotalCusteioPlano" class="description-header">R$ 0,00</h5>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- CORPO PLANO DE AÇÃO --}}
        <div class="row mt-4">
            <div class="col-mb-3">

                {{-- LINHA DAS ABAS --}}
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">

                        {{-- ABAS --}}
                        <ul id="tabsPlanoAcao" class="nav nav-tabs" role="tablist">

                            {{-- ABA DADOS --}}
                            <li class="nav-item">
                                <a id="tab_dados"
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#content_tab_dados"
                                    role="tab"
                                    aria-controls="content_tab_dados"
                                    aria-selected="false">Dados e Resumo</a>
                            </li>

                            {{-- ABA JUSTIFICATIVA --}}
                            <li class="nav-item">
                                <a id="tab_justificativa"
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#content_tab_justificativa"
                                    role="tab"
                                    aria-controls="content_tab_justificativa"
                                    aria-selected="false">Justificativa</a>
                            </li>

                            {{-- ABA TERRITÓRIO --}}
                            <li class="nav-item">
                                <a id="tab_territorio"
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#content_tab_territorio"
                                    role="tab"
                                    aria-controls="content_tab_territorio"
                                    aria-selected="false">Território</a>
                            </li>

                            {{-- ABA ESTRATÉGIA --}}
                            <li class="nav-item">
                                <a id="tab_estrategia"
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#content_tab_estrategia"
                                    role="tab"
                                    aria-controls="content_tab_estrategia"
                                    aria-selected="false">Estratégia de implantação</a>
                            </li>

                            {{-- ABA OBJETIVO --}}
                            <li class="nav-item">
                                <a id="tab_objetivo"
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#content_tab_objetivo"
                                    role="tab"
                                    aria-controls="content_tab_objetivo"
                                    aria-selected="false">Objetivos</a>
                            </li>

                            {{-- ABA IMPACTOS --}}
                            <li class="nav-item">
                                <a id="tab_impacto"
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#content_tab_impacto"
                                    role="tab"
                                    aria-controls="content_tab_impacto"
                                    aria-selected="false">Impactos</a>
                            </li>

                            {{-- ABA RESULTADOS --}}
                            <li class="nav-item">
                                <a id="tab_resultado"
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#content_tab_resultado"
                                    role="tab"
                                    aria-controls="content_tab_resultado"
                                    aria-selected="false">Resultados</a>
                            </li>

                            {{-- ABA AÇÕES --}}
                            <li class="nav-item">
                                <a id="tab_acoes"
                                    class="nav-link ativo"
                                    data-toggle="tab"
                                    href="#content_tab_acoes"
                                    role="tab"
                                    aria-controls="content_tab_acoes"
                                    aria-selected="true">Ações</a>
                            </li>

                            {{-- ABA ARQUIVOS --}}
                            <li class="nav-item">
                                <a id="tab_arquivo"
                                    class="nav-link  {{empty($plano) ? 'd-none' : ''}}"
                                    data-toggle="tab"
                                    href="#content_tab_arquivo"
                                    role="tab"
                                    aria-controls="content_tab_arquivo"
                                    aria-selected="true"><i class="fa fa-paperclip"></i> Arquivos</a>
                            </li>

                            {{-- ABA HISTÓRICO --}}
                            <li class="nav-item">
                                <a id="tab_historico"
                                    class="nav-link  {{empty($plano) ? 'd-none' : ''}}"
                                    data-toggle="tab"
                                    href="#content_tab_historico"
                                    role="tab"
                                    aria-controls="content_tab_historico"
                                    aria-selected="true"><i class="fa fa-history"></i> Histórico</a>
                            </li>


                        </ul>

                    </div>

                    {{-- CORPO DAS ABAS --}}
                    <div class="card-body">

                        {{-- CONTEÚDO DAS ABAS --}}
                        <div id="tabsPerfil_conteudo" class="tab-content" style="overflow-y:auto;overflow-x:hidden;height:'100vh;">

                            {{-- ABA DADOS --}}
                            <div id="content_tab_dados" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_dados">

                                {{-- Órgão --}}
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        @include('partials.util.combo',
                                        [
                                            'id'=>'cbOrgao',
                                            'name'=>'orgao',
                                            'label'=>'Órgão',
                                            'padrao'=>'Selecione',
                                            'classe'=>'valida',
                                            'opcoes'=>Combo::Orgaos(),
                                            'selecionado'=>(!empty($plano) ? $plano->getFkOrgao() : null),

                                        ])
                                    </div>
                                </div>

                                {{-- RESPONSÁVEIS --}}
                                <div class="row">

                                    {{-- Responsável --}}
                                    <div class="col-md-3 col-sm-6">
                                        @include('partials.util.combo',
                                        [
                                            'id'=>'cbResponsavel',
                                            'name'=>'responsavel',
                                            'label'=>'Responsável',
                                            'padrao'=>'Selecione',
                                            'opcoes'=>Combo::Responsaveis(),
                                            'selecionado'=>(!empty($plano) ? $plano->getFkResponsavel() : null),
                                            'classe'=>'valida',
                                        ])
                                    </div>

                                    {{-- Gestor --}}
                                    <div class="col-md-3 col-sm-6">
                                        @include('partials.util.combo',
                                        [
                                            'id'=>'cbGestor',
                                            'name'=>'gestor',
                                            'label'=>'Gestor',
                                            'padrao'=>'Selecione',
                                            'opcoes'=>Combo::Responsaveis(),
                                            'selecionado'=>(!empty($plano) ? $plano->getFkGestor() : null),
                                            'classe'=>'valida',
                                        ])
                                    </div>
                                </div>

                                {{-- Resumo --}}
                                <div class="row">
                                    <div class="col-sm-12">

                                        @include('partials.controle.textarea',
                                        [
                                            'id'=>'txtResumo',
                                            'name'=>'resumo',
                                            'label'=>'Resumo do plano',
                                            'classe'=>'textarea',
                                            'texto'=>(!empty($plano) ? $plano->getResumo() : ''),
                                        ])

                                    </div>
                                </div>
                            </div>

                            {{-- ABA JUSTIFICATIVA --}}
                            <div id="content_tab_justificativa" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_justificativa">

                                <div class="row">
                                    {{-- Justificativa --}}
                                    <div class="col-sm-12">

                                        @include('partials.controle.textarea',
                                        [
                                            'id'=>'txtJustificativa',
                                            'name'=>'justificativa',
                                            'classe'=>'textarea',
                                            'texto'=>(!empty($plano) ? $plano->getJustificativa() : '')
                                        ])

                                    </div>
                                </div>

                            </div>

                            {{-- ABA TERRITÓRIO --}}
                            <div id="content_tab_territorio" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_territorio">

                                <div class="row">
                                    {{-- Territorio --}}
                                    <div class="col-sm-12">

                                        @include('partials.controle.textarea',
                                        [
                                            'id'=>'txtTerritorio',
                                            'name'=>'territorio',
                                            'classe'=>'textarea',
                                            'texto'=>(!empty($plano) ? $plano->getTerritorio() : '')
                                        ])

                                    </div>

                                </div>
                            </div>

                            {{-- ABA ESTRATÉGIA --}}
                            <div id="content_tab_estrategia" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_estrategia">

                                <div class="row">
                                    {{-- Territorio --}}
                                    <div class="col-sm-12">

                                        @include('partials.controle.textarea',
                                        [
                                            'id'=>'txtEstrategia',
                                            'name'=>'estrategia',
                                            'classe'=>'textarea',
                                            'texto'=>(!empty($plano) ? $plano->getEstrategia() : '')
                                        ])

                                    </div>

                                </div>
                            </div>

                            {{-- ABA OBJETIVO --}}
                            <div id="content_tab_objetivo" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_objetivo">

                                <div class="row">
                                    {{-- Territorio --}}
                                    <div class="col-sm-12">

                                        @include('partials.controle.textarea',
                                        [
                                            'id'=>'txtObjetivo',
                                            'name'=>'objetivo',
                                            'classe'=>'textarea',
                                            'texto'=>(!empty($plano) ? $plano->getObjetivo() : '')
                                        ])

                                    </div>

                                </div>
                            </div>

                            {{-- ABA IMPACTOS --}}
                            <div id="content_tab_impacto" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_impacto">

                                <div class="row">
                                    {{-- Impacto --}}
                                    <div class="col-sm-12">

                                        @include('partials.controle.textarea',
                                        [
                                            'id'=>'txtImpacto',
                                            'name'=>'impacto',
                                            'classe'=>'textarea',
                                            'texto'=>(!empty($plano) ? $plano->getImpacto() : '')
                                        ])

                                    </div>

                                </div>
                            </div>

                            {{-- ABA RESULTADOS --}}
                            <div id="content_tab_resultado" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_resultado">

                                <div class="row">
                                    {{-- Resultado --}}
                                    <div class="col-sm-12">

                                        @include('partials.controle.textarea',
                                        [
                                            'id'=>'txtResultado',
                                            'name'=>'resultado',
                                            'classe'=>'textarea',
                                            'texto'=>(!empty($plano) ? $plano->getResultado() : '')
                                        ])

                                    </div>

                                </div>
                            </div>

                            {{-- ABA AÇÕES --}}
                            <div id="content_tab_acoes" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_acoes">

                                <div class="row pt-2">
                                    <div class="col-sm-12">
                                        <button id="btnNovoPlanoItem" type="button" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i> Nova Ação
                                        </button>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-sm-12 table-responsive">

                                            {{-- TABELA DE AÇÕES --}}
                                        <table id="tbAcoes" class="table table-hover table-striped table-bordered">
                                            <thead class="bg-primary text-white text-center">
                                                <tr class="text-center">
                                                    <th class="w-5"></th>
                                                    <th class="w-5">Item</th>
                                                    <th class="w-80">Titulo</th>
                                                    <th class="w-10">Investimento</th>
                                                    <th class="w-10">Custeio</th>
                                                    <th class="w-10">Valor</th>
                                                    <th class="w-5">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody class="acoes">
                                                <tr class="text-center font-weight-bold">
                                                    <td  colspan="3">Nenhuma ação encontrada.</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                            {{-- ABA ARQUIVOS --}}
                            <div id="content_tab_arquivo" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_arquivo">

                                <div class="row pt-2">

                                    {{-- BOTÃO ENVIAR ARQUIVO --}}
                                    <div class="col-sm-12">
                                        <button id="btnEnviarArquivo" type="button" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i> Novo anexo
                                        </button>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-sm-12 table-responsive">

                                            {{-- TABELA DE ARQUIVOS --}}
                                        <table id="tbArquivos" class="table table-hover table-striped table-bordered">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="w-10 text-center">Arquivo</th>
                                                    <th class="w-50 text-center">Comentário</th>
                                                    <th class="w-10 text-center">Usuário</th>
                                                    <th class="w-10 text-center">Data</th>

                                                    <th class="w-5"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if(!empty($plano) && count($plano->Anexos) > 0)

                                                    @foreach($plano->Anexos as $upload)
                                                        <tr>
                                                            <td class="text-center">
                                                                <a target="_blank" href="{{Util::CaminhoCompleto($upload->getArquivo())}}">
                                                                    <i class="fa fa-file"></i> <b name="td_nome_arquivo">{{$upload->getNome()}}</b>
                                                                </a>
                                                            </td>
                                                            <td>{{$upload->getMensagem()}}</td>
                                                            <td class="text-center">{{$upload->Usuario->getNomeCompleto()}}</td>
                                                            <td class="text-center">{{$upload->getDtCriacao()}}</td>
                                                            <td class="text-center">
                                                                <i name="delete_upload" class="fa fa-lg fa-times-circle text-danger cursor-pointer" title="Excluir anexo"></i>
                                                            </td>

                                                            <input type="hidden" name="anexo[{{$upload->getId()}}]" value="{{$upload->getId()}}"/>
                                                        </tr>
                                                    @endforeach

                                                @else
                                                    <tr id="linha_vazia_arquivos_upload" class="text-center font-weight-bold">
                                                        <td  colspan="5">Nenhum arquivo encontrado.</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                            {{-- ABA HISTÓRICO --}}
                            <div id="content_tab_historico" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_historico">

                                <div class="row pt-2">
                                    <div class="col-sm-12 table-responsive">

                                        {{-- TABELA DE HISTÓRICO --}}
                                        <table id="tbHistorico" class="table table-hover table-striped table-bordered">
                                            <thead class="bg-primary text-white">
                                                <th class="text-center w-15">Data</th>
                                                <th class="text-center w-15">Usuário</th>
                                                <th class="text-center">Evento</th>
                                                <th class="text-center">Obs</th>
                                            </thead>
                                            <tbody>

                                                @if(!empty($plano))

                                                    @foreach($plano->Historico as $historico)

                                                        <tr>
                                                            <td class="text-center">{{$historico->getData()}}</td>
                                                            <td class="text-center">{{$historico->Usuario->getNomeCompleto()}}</td>
                                                            <td>
                                                                {{$historico->getMensagem()}}
                                                            </td>
                                                            <td>{{$historico->getObs()}}</td>
                                                        </tr>

                                                    @endforeach

                                                @endif

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- FOOTER PLANO DE AÇÃO --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>Salvar
                        </button>
                    </div>

                </div>
            </div>
        </div>

        </form>

    </div>

    {{-- Modal  Ação--}}
    @include('partials._modal_form',
    [
        'idModal'=>'mdlPlanoItem',
        'titulo'=> 'Nova Ação',
        'icone'=>'fa fa-refresh',
        'responsivo'=>'true',
        'tamanho'=>'lg',
        'atributos'=>'max-width:80%;',
        'campos'=>
        [
            [
                'id'=>'hdnIdPlanoItem',
                'nome'=>'idPlanoItem',
                'tipo'=>'hidden'
            ],
            [
                'id'=>'hdnIdxPlanoItem',
                'nome'=>'indexPlanoItem',
                'tipo'=>'hidden'
            ],
            [
                'tipo'=>'array',
                'campos'=>
                [
                    [
                        'largura'=>'4',
                        'id' =>'sldSubItem',
                        'label'=>'Sub Item',
                        'nome'=>'is_subitem',
                        'posicao'=>'left',
                        'tipo'=>'slider',
                        'ativado'=>false,
                        'required'=> false
                    ]
                ]
            ],
            [
                'id' =>'cbPlanoItemPai',
                'label'=>'Item pai',
                'nome'=>'item_pai_acao_item',
                'classeLinha'=>'d-none',
                'opcoes'=>[],
                'tipo'=>'combo',
                'required'=> false
            ],
            [
                'id' =>'txtTituloPlanoItem',
                'label'=>'Título da Ação',
                'nome'=>'titulo_acao_item',
                'tamanho'=>'200',
                'tipo'=>'txt',
                'required'=> true,
                'autofocus'=> true,
            ],

            //ABAS
            [
                'id'=>'tbasAutuacao',
                'altura'=>'300px',
                'tipo'=>'tabs',
                'abas'=>['Justificativa','Território','Estratégia Implementação','Objetivos','Resultados','Impactos','Indicadores','Metas'],
                'conteudo'=>
                [
                    //Justificativa
                    [
                        'aba'=>'Justificativa',
                        'campos'=>
                        [
                            [
                                'id' =>'txtJustificativaPlanoItem',
                                'label'=>'',
                                'nome'=>'descricao_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                    //Território
                    [
                        'aba'=>'Território',
                        'campos'=>
                        [
                            [
                                'id' =>'txtTerritorioPlanoItem',
                                'label'=>'',
                                'nome'=>'territorio_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                    //Estratégia Implementação
                    [
                        'aba'=>'Estratégia Implementação',
                        'campos'=>
                        [
                            [
                                'id' =>'txtEstrategiaPlanoItem',
                                'label'=>'',
                                'nome'=>'estrategia_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                    //Objetivos
                    [
                        'aba'=>'Objetivos',
                        'campos'=>
                        [
                            [
                                'id' =>'txtObjetivoPlanoItem',
                                'label'=>'',
                                'nome'=>'objetivo_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                    //Resultados
                    [
                        'aba'=>'Resultados',
                        'campos'=>
                        [
                            [
                                'id' =>'txtResultadoPlanoItem',
                                'label'=>'',
                                'nome'=>'resultado_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                    //Impactos
                    [
                        'aba'=>'Impactos',
                        'campos'=>
                        [
                            [
                                'id' =>'txtImpactoPlanoItem',
                                'label'=>'',
                                'nome'=>'impacto_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                    //Indicadores e Metas
                    [
                        'aba'=>'Indicadores',
                        'campos'=>
                        [
                            [
                                'id' =>'txtIndicadorPlanoItem',
                                'label'=>'',
                                'nome'=>'indicador_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                    //Metas
                    [
                        'aba'=>'Metas',
                        'campos'=>
                        [
                            [
                                'id' =>'txtMetaPlanoItem',
                                'label'=>'',
                                'nome'=>'meta_acao_item',
                                'tamanho'=>'5000',
                                'tipo'=>'textarea',
                                'rows'=>'0',
                                'required'=> true,
                                'autofocus'=> true,
                            ],
                        ]
                    ],
                ]
            ]
        ]
    ])


{{-- Modal  Ação--}}
@include('partials._modal_form',
[
    'idModal'=>'mdlPlanoArquivos',
    'titulo'=> 'Anexar arquivo',
    'icone'=>'fa fa-paperclip',
    'responsivo'=>'true',
    'icone_submit'=>'fa fa-upload',
    'botao_submit'=>'Enviar Arquivo',
    'campos'=>
    [
        [
            'id'=>'hdnFkPlanoAcaoUpload',
            'nome'=>'fk_plano',
            'tipo'=>'hidden'
        ],
        [
            'id'=>'arqUploadPlanoAcao',
            'nome'=>'arquivo_upload_plano_acao',
            'label'=>'Selecione o Arquivo',
            'tipo'=>'arquivo',
            'classe'=>'pt-1',
            'required'=>true
        ],
        [
            'id' =>'txtNomeUploadPlanoAcao',
            'label'=>'Nome do arquivo (plano assinado, termo de referência, etc)',
            'nome'=>'nome_upload_plano_acao',
            'tipo'=>'txt',
            'tamanho'=>100,
            'required'=> true,
        ],
        [
            'id' =>'txtComentarioUploadPlanoAcao',
            'label'=>'Comentários',
            'nome'=>'comentario_upload_plano_acao',
            'tipo'=>'textarea',
            'classe'=>'no-resize',
            'rows'=>'3',
            'tamanho'=>5000,
        ]

    ]
])

    {{-- MODAL IMPRIMIR COM OU SEM ANEXOS --}}
    <div id="mdlImprimirPlano" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg  modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white ">
                    <h4 class="modal-title"><i id="icone_form_modal_mdlImprimirPlano" class="fa fa fa-question-circle"></i>
                        <txt id="titulo_form_modal_mdlImprimirPlano">Imprimir plano de ação</txt>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">

                    <div class="container-fluid">
                        <form id="form_modal_mdlImprimirPlano">
                            @csrf
                            <input type="hidden" id="id_form_modal_mdlImprimirPlano" name="id">

                            <div class="row">
                                <div class="col-sm-12 col-md-6">

                                    <a id="btnImprimirSemAnexo" target="_blank" href="{{route('planejamento.plano.imprimir',[Util::Criptografa(!empty($plano) ? $plano->getId() : 0),0])}}" class="form-control btn btn-lg btn-info font-weight-bold mb-2">

                                        <i class="fa fa-unlink"></i> Sem anexos
                                    </a>
                                </div>

                                <div class="col-sm-12 col-md-6">

                                    <a id="btnImprimirComAnexo" target="_blank" href="{{route('planejamento.plano.imprimir',[Util::Criptografa(!empty($plano) ? $plano->getId() : 0),1])}}" class="form-control btn btn-lg btn-success font-weight-bold">

                                        <i class="fa fa-paperclip"></i> Com anexos
                                    </a>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
