<!doctype html>
<html>
	<head>
        <meta charset="utf-8"/>
				<style>


            .bg-cinza{background-color: #cccccc !important;}
            table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }
/*
							@font-face
            {
                font-family: 'arial-narrow';
                src: url({{Util::CaminhoFisico('/public/css/fonts/arial-narrow.ttf')}}) format('truetype');
            } */
						html{font-family: 'arial-narrow'; font-size:12px; line-height: 1.2 !important;}
						body{background-size:50% 50%;background-repeat:no-repeat;/*opacity: 0.2;*/}
						footer {position: fixed;left: 0;bottom: 0;width: 100%;text-align: center;opacity: 0.9;}
						.page-break {page-break-after: always;}
						.msg{line-height: 1.5 !important;font-size:8px;}
						.recuo { text-indent:4em }

						.div-letra-tamanho{width: 20px;height: 17px;}
						.row {width: 100%;}
						.col-md-1 {width: 8.333333333%;}
						.col-md-2 {width: 16.666666667%;}
						.col-md-3 {width: 24.999999999%;}
						.col-md-6 {width: 49.999999998%;}
						.col-md-7 {width: 58.333333331%;}
						.col-md-8 {width: 66.666666664%;}
						.col-md-9 {width: 74.999999997%;}
						.col-md-10 {width: 83.33333333%;}
						.col-md-11 {width: 91.666666663%;}
						.col-md-12 {width: 99.999999996%;}
						.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
						.col-md-auto{min-height: 1px;padding-right: 15px;padding-left: 15px;}
						.text-justify {text-align: justify !important;}
						.ml-0,.mx-0 {margin-left: 0 !important;}
						.ml-auto,.mx-auto {margin-left: auto !important;}
						.pl-0,.px-0 {padding-left: 0 !important;}
						.font-weight-bold{font-weight: 700 !important;}
						.float-left {float: left !important;}
						.float-right {float: right !important;}
						.float-none {float: none !important;}

						.text-left{text-align: left !important;}
						.text-right{text-align: right !important;}
						.text-center {text-align: center !important;}
						.text-top {text-align: top !important;}
						.text-white {color: #fff !important;}
						.text-primary {color: #007bff !important;}
						.text-secondary {color: #6c757d !important;}
						.text-success {color: #28a745 !important;}
						.text-info {color: #17a2b8 !important;}
						.text-warning {color: #ffc107 !important;}
						.text-danger {color: #dc3545 !important;}
						.text-light {color: #f8f9fa !important;}
						.text-dark {color: #343a40 !important;}
						.text-body {color: #212529 !important;}
						.text-muted {color: #6c757d !important;}
						.text-black-50 {color: rgba(0, 0, 0, 0.5) !important;}
						.text-white-50 {color: rgba(255, 255, 255, 0.5) !important;}
						.text-lowercase {text-transform: lowercase !important;}
						.text-uppercase {text-transform: uppercase !important;}
						.text-capitalize {text-transform: capitalize !important;}

						.bg-primary {background-color: #007bff !important;}
						.border {border: 1px solid #dee2e6 !important;}
						.border-primary {border-color: #007bff !important;}
						.border-secondary {border-color: #6c757d !important;}
						.border-success {border-color: #28a745 !important;}
						.border-info {border-color: #17a2b8 !important;}
						.border-warning {border-color: #ffc107 !important;}
						.border-danger {border-color: #dc3545 !important;}
						.border-light {border-color: #f8f9fa !important;}
						.border-dark {border-color: #343a40 !important;}
						.border-white {border-color: #fff !important;}
						.border-black {border: 1px solid #000 !important;}
						.rounded {border-radius: 5px !important;}
						.p-0 {padding: 0 !important;}
						.p-1 {padding: 0.25rem !important;}
						.mt-2,.my-2 {margin-top: 0.5rem !important;}
						.pt-2,.py-2 {padding-top: 0.5rem !important;}
						.pb-4,.py-4 {padding-bottom: 1.5rem !important;}
						.pt-0,.py-0 {padding-top: 0 !important;}
						.pr-0,.px-0 {padding-right: 0 !important;}
						.pb-0,.py-0 {padding-bottom: 0 !important;}
						.pl-0,.px-0 {padding-left: 0 !important;}
						.p-1 {padding: 0.25rem !important;}
						.pt-1,.py-1 {padding-top: 0.25rem !important;}
						.pr-1,.px-1 {padding-right: 0.25rem !important;}
						.pb-1,.py-1 {padding-bottom: 0.25rem !important;}
						.pl-1,.px-1 {padding-left: 0.25rem !important;}
						.p-2 {padding: 0.5rem !important;}
						.pt-2,.py-2 {padding-top: 0.5rem !important;}
						.pr-2,.px-2 {padding-right: 0.5rem !important;}
						.pb-2,.py-2 {padding-bottom: 0.5rem !important;}
						.pl-2,.px-2 {padding-left: 0.5rem !important;}
						.p-3 {padding: 1rem !important;}
						.pt-3,.py-3 {padding-top: 1rem !important;}
						.pr-3,.px-3 {padding-right: 1rem !important;}
						.pb-3,.py-3 {padding-bottom: 1rem !important;}
						.pl-3,.px-3 {padding-left: 1rem !important;}
						.p-4 {padding: 1.5rem !important;}
						.pt-4,.py-4 {padding-top: 1.5rem !important;}
						.pr-4,.px-4 {padding-right: 1.5rem !important;}
						.pb-4,.py-4 {padding-bottom: 1.5rem !important;}
						.pl-4,.px-4 {padding-left: 1.5rem !important;}
						.p-5 {padding: 3rem !important;}
						.pt-5,.py-5 {padding-top: 3rem !important;}
						.pr-5,.px-5 {padding-right: 3rem !important;}
						.pb-5,.py-5 {padding-bottom: 3rem !important;}
						.pl-5,.px-5 {padding-left: 3rem !important;}
						.m-auto {margin: auto !important;}
						.mt-auto,.my-auto {margin-top: auto !important;}
						.mr-auto,.mx-auto {margin-right: auto !important;}
						.mb-auto,.my-auto {margin-bottom: auto !important;}
			.ml-auto,.mx-auto {margin-left: auto !important;}
			.m-0 {margin: 0 !important;}
			.mt-0,.my-0 {margin-top: 0 !important;}
			.mr-0,.mx-0 {margin-right: 0 !important;}
			.mb-0 mt-1 p-0,.my-0 {margin-bottom: 0 !important;}
			.mb-0,.my-0 {margin-bottom: 0 !important;}
			.ml-0,.mx-0 {margin-left: 0 !important;}
			.m-1 {margin: 0.25rem !important;}
			.mt-1,.my-1 {margin-top: 0.25rem !important;}
			.mr-1,.mx-1 {margin-right: 0.25rem !important;}
			.mb-1,.my-1 {margin-bottom: 0.25rem !important;}
			.ml-1,.mx-1 {margin-left: 0.25rem !important;}
			.m-2 {margin: 0.5rem !important;}
			.mt-2,.my-2 {margin-top: 0.5rem !important;}
			.mr-2,.mx-2 {margin-right: 0.5rem !important;}
			.mb-2,.my-2 {margin-bottom: 0.5rem !important;}
			.ml-2,.mx-2 {margin-left: 0.5rem !important;}
			.m-3 {margin: 1rem !important;}
			.mt-3,.my-3 {margin-top: 1rem !important;}
			.mr-3,.mx-3 {margin-right: 1rem !important;}
			.mb-3,.my-3 {margin-bottom: 1rem !important;}
			.ml-3,.mx-3 {margin-left: 1rem !important;}
			.m-4 {margin: 1.5rem !important;}
			.mt-4,.my-4 {margin-top: 1.5rem !important;}
			.mr-4,.mx-4 {margin-right: 1.5rem !important;}
			.mb-4,.my-4 {margin-bottom: 1.5rem !important;}
			.ml-4,.mx-4 {margin-left: 1.5rem !important;}
			.m-5 {margin: 3rem !important;}
			.mt-5,.my-5 {margin-top: 3rem !important;}
			.mr-5,.mx-5 {margin-right: 3rem !important;}
			.mb-5,.my-5 {margin-bottom: 3rem !important;}
			.ml-5,.mx-5 {margin-left: 3rem !important;}

						/* tabela */
						table{border-collapse: collapse;width: 100%;margin-bottom: 1rem;background-color: transparent;}
						td[class^="col-"]{line-height: 5px;padding-top:2px;}
						.table th,
						.table td {padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;}
						.table thead th {vertical-align: bottom;border-bottom: 2px solid #dee2e6;}
						.table tbody + tbody {border-top: 2px solid #dee2e6;}
						.table .table {background-color: #fff;}
						.table-bordered {border: 1px solid #dee2e6;}
						.table-bordered th,.table-bordered td {border: 1px solid #dee2e6;}

						.table-bordered thead th,.table-bordered thead td {border-bottom-width: 2px;}
						.table-striped tbody tr:nth-of-type(odd) {background-color: rgba(0, 0, 0, 0.05);}
						.table-hover tbody tr:hover {background-color: rgba(0, 0, 0, 0.075);}

						.table-bordered th,.table-bordered td {border: 1px solid #000 !important;}
						.table-dark {color: inherit;}
						.table-dark th,.table-dark td,.table-dark thead th,.table-dark tbody + tbody {border-color: #dee2e6;}
						.table-black {color: inherit;}
						.table-black th,.table-black td,.table-black thead th,.table-black tbody + tbody {border-color: #000;}
						.table .thead-black th {color: inherit;border-color: #000;}
						.table .thead-dark th {color: inherit;border-color: #dee2e6;}

						.bg-primary {background-color: #007bff !important;}
						.bg-secondary {background-color: #6c757d !important;}
						.bg-success {background-color: #28a745 !important;}
						.bg-info {background-color: #17a2b8 !important;}
						.bg-warning {background-color: #ffc107 !important;}
						.bg-danger {background-color: #dc3545 !important;}
						.bg-light {background-color: #f8f9fa !important;}
						.bg-dark {background-color: #343a40 !important;}
						.bg-white {background-color: #fff !important;}
						.bg-transparent {background-color: transparent !important;}

						/* tamanhos de font */
						.font-8{font-size: 8px;}
						.font-9{font-size: 9px;}
						.font-10{font-size: 10px;}
						.font-12{font-size: 12px;}
						.font-14{font-size: 14px;}
						.font-16{font-size: 16px;}
						.font-18{font-size: 18px;}
						.font-20{font-size: 20px;}
						.font-24{font-size: 24px;}
						.font-28{font-size: 28px;}
						.font-30{font-size: 30px;}
						.font-weight-normal {font-weight: 400 !important;}
						.font-weight-bold {font-weight: 700 !important;}
						.font-italic {font-style: italic !important;}
						.font-line-height-1{line-height: 1.2 !important;}

			.w-1{width: 1% !important;}
			.w-2{width: 2% !important;}
			.w-3{width: 3% !important;}
			.w-4{width: 4% !important;}
			.w-5{width: 5% !important;}
			.w-6{width: 6% !important;}
			.w-7{width: 7% !important;}
			.w-8{width: 8% !important;}
			.w-9{width: 9% !important;}
			.w-10{width: 10% !important;}
			.w-11{width: 11% !important;}
			.w-12{width: 12% !important;}
			.w-13{width: 13% !important;}
			.w-14{width: 14% !important;}
			.w-15{width: 15% !important;}
			.w-16{width: 16% !important;}
			.w-17{width: 17% !important;}
			.w-18{width: 18% !important;}
			.w-19{width: 19% !important;}
			.w-20{width: 20% !important;}
			.w-21{width: 21% !important;}
			.w-22{width: 22% !important;}
			.w-23{width: 23% !important;}
			.w-24{width: 24% !important;}
			.w-25{width: 25% !important;}
			.w-26{width: 26% !important;}
			.w-27{width: 27% !important;}
			.w-28{width: 28% !important;}
			.w-29{width: 29% !important;}
			.w-30{width: 30% !important;}
			.w-31{width: 31% !important;}
			.w-32{width: 32% !important;}
			.w-33{width: 33% !important;}
			.w-34{width: 34% !important;}
			.w-35{width: 35% !important;}
			.w-36{width: 36% !important;}
			.w-37{width: 37% !important;}
			.w-38{width: 38% !important;}
			.w-39{width: 39% !important;}
			.w-40{width: 40% !important;}
			.w-41{width: 41% !important;}
			.w-42{width: 42% !important;}
			.w-43{width: 43% !important;}
			.w-44{width: 44% !important;}
			.w-45{width: 45% !important;}
			.w-46{width: 46% !important;}
			.w-47{width: 47% !important;}
			.w-48{width: 48% !important;}
			.w-49{width: 49% !important;}
			.w-50{width: 50% !important;}
			.w-55{width: 55% !important;}
			.w-56{width: 56% !important;}
			.w-57{width: 57% !important;}
			.w-58{width: 58% !important;}
			.w-59{width: 59% !important;}
			.w-60{width: 60% !important;}
			.w-61{width: 61% !important;}
			.w-62{width: 62% !important;}
			.w-63{width: 63% !important;}
			.w-64{width: 64% !important;}
			.w-65{width: 65% !important;}
			.w-66{width: 66% !important;}
			.w-67{width: 67% !important;}
			.w-68{width: 68% !important;}
			.w-69{width: 69% !important;}
			.w-70{width: 70% !important;}
			.w-75{width: 75% !important;}
			.w-100{width: 100% !important;}
			.w-auto{width: auto !important;}

			.h-1{height: 1% !important;}
			.h-2{height: 2% !important;}
			.h-5{height: 5% !important;}
			.h-10{height: 10% !important;}
			.h-25{height: 25% !important;}
			.h-50{height: 50% !important;}
			.h-75{height: 75% !important;}
			.h-100{height: 100% !important;}
			.h-auto{height: auto !important;}
        </style>

  </head>
    <body>
      {{-- cabeçalho --}}
			@include('pdf.cabecalho')

      {{-- TITULO --}}
      <div class="row">
          <div class="col-md-12 text-center">
              <h3 class="mb-0">PLANO DE AÇÃO</h3>
          </div>
      </div>

      {{-- EIXO --}}
      <div class="row">
          <div class="col-md-12 text-center">
              <h3 class="text-uppercase">{{$plano->Eixo->getNome()}}</h3>
          </div>
      </div>

      {{-- RESUMO --}}
      <div class="row">
          <div class="col-md-12 text-justify font-14">
              {!! $plano->getResumo() !!}
          </div>
      </div>

      {{-- TITULO PROGRAMA --}}
      <table class="table-bordered text-center">
          <tr>
              <td class="w-30 p-3 bg-cinza font-weight-bold">Título do Programa</td>
              <td class="p-3 text-uppercase">{{$plano->Eixo->Programa->getTitulo()}}</td>
          </tr>
      </table>

      {{-- DADOS DO FUNDO --}}
      <table class="table-bordered text-center">
          <tr>
              <td rowspan="3" class="w-30 font-weight-bold bg-cinza font-line-height-1">
                  Dados do Fundo Estadual de Segurança Pública
              </td>
              <td class="w-30 bg-cinza font-weight-bold p-3"> Ente Federativo</td>
              <td class="w-40">Estado do Maranhão</td>
          </tr>
          <tr>
              <td class="w-30 bg-cinza font-weight-bold p-3">Lei de Criação do Fundo</td>
              <td class="w-40">11.139 de 22/10/2019</td>
          </tr>
          <tr>
              <td class="w-30 bg-cinza font-weight-bold p-3">CNPJ</td>
              <td class="w-40">35.565.747/0001-71</td>
          </tr>
      </table>


      {{-- DADOS DO RESPONSÁVEL --}}
      <table class="table-bordered text-center">
          <tr>
              <td rowspan="4" class="w-30 font-weight-bold bg-cinza font-line-height-1">
                  Dados do responsável pelo Fundo Estadual de Segurança Pública
              </td>
              <td class="w-30 bg-cinza font-weight-bold p-3">Nome</td>
              <td class="w-40">{{$plano->Responsavel->getNomeCompleto()}}</td>
          </tr>
          <tr>
              <td class="w-30 bg-cinza font-weight-bold p-3">Cargo</td>
              <td class="w-40">Coordenador Executivo do FES</td>
          </tr>
          <tr>
              <td class="w-30 bg-cinza font-weight-bold p-3">CPF</td>
              <td class="w-40">{{$plano->Responsavel->getCpf()}}</td>
          </tr>
          <tr>
              <td class="w-30 bg-cinza font-weight-bold p-3">Contato: e-mail e telefone</td>
              <td class="w-40">

                  {{$plano->Responsavel->getTelefone().' / '.$plano->Responsavel->getCelular()}}

              </td>
          </tr>
      </table>

      {{-- DADOS DO GESTOR --}}
      <table class="table-bordered text-center">
          <tr>
              <td rowspan="4" class="w-30 font-weight-bold bg-cinza">
                  Dados do responsável pela Gestão do Fundo Estadual de Segurança Pública
              </td>
              <td class="bg-cinza font-weight-bold p-3">Nome</td>
              <td class="w-40">{{$plano->Gestor->getNomeCompleto()}}</td>
          </tr>
          <tr>
              <td class="bg-cinza font-weight-bold p-3">Cargo</td>
              <td class="w-40">Secretário de Estado da Segurança Pública</td>
          </tr>
          <tr>
              <td class="bg-cinza font-weight-bold p-3">CPF</td>
              <td class="w-40">{{$plano->Gestor->getCpf()}}</td>
          </tr>
          <tr>
              <td class="bg-cinza font-weight-bold p-3">Contato: e-mail e telefone</td>
              <td class="w-40">

                  {{$plano->Gestor->getEmail().' / '.$plano->Gestor->getTelefone()}}

              </td>
          </tr>
      </table>


      {{-- NOVA PÁGINA --}}
      <div class="page-break"></div>

      {{-- cabeçalho --}}
      @include('pdf.cabecalho')

      {{-- JUSTIFICATIVA --}}
      <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Justificativa</td>
              <td class="w-80 font-16 text-justify p-3">
                  {!! $plano->getJustificativa() !!}

                  {{-- percorre as ações --}}
                  @foreach($plano->Acoes as $item)

                      <p>{{$item->getTitulo()}}</p>

                  @endforeach

              </td>
          </tr>

      </table>

      {{-- TERRITÓRIO --}}
      <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Território</td>
              <td class="w-80 font-16 text-justify p-3">{!! $plano->getTerritorio() !!}</td>
          </tr>
      </table>


      {{-- ESTRATÉGIA DE IMPLEMENTAÇÃO --}}
      <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Estratégia de Implementação</td>
              <td class="w-80 font-16 text-justify p-3">{!! $plano->getObjetivo() !!}</td>
          </tr>
      </table>


      {{-- OBJETIVOS --}}
      <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Objetivos</td>
              <td class="w-80 font-16 text-justify p-3">{!! $plano->getObjetivo() !!}</td>
          </tr>
      </table>

      {{-- RESULTADOS --}}
      <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Resultados</td>
              <td class="w-80 font-16 text-justify p-3">{!! $plano->getResultado() !!}</td>
          </tr>
      </table>

      {{-- IMPACTOS --}}
      <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Impacto</td>
              <td class="w-80 font-16 text-justify p-3">{!! $plano->getImpacto() !!}</td>
          </tr>
      </table>

      <!-- {{-- NOVA PÁGINA --}}
      <div class="page-break"></div> -->




      {{-- Indicadores e Metas --}}
      <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Indicadores e metas</td>
              <td class="w-80 font-16 text-justify p-3">

                  <p><u>Indicadores</u></p>

                  {{-- LISTA DE INDICADORES --}}
                  <ul>
                      @foreach($plano->Acoes as $acao)

                          @if(!empty($acao->getIndicador()))

                              <li>{!! $acao->getIndicador() !!}</li>

                          @endif

                      @endforeach
                  </ul>

                  <p><u>Metas</u></p>

                  {{-- LISTA DE METAS --}}
                  <ul>
                      @foreach($plano->Acoes as $acao)

                          @if(!empty($acao->getMeta()))

                              <li>{!! $acao->getMeta() !!}</li>

                          @endif

                      @endforeach
                  </ul>

              </td>
          </tr>
      </table>


       {{-- ASSINATURA --}}
       <table class="table-bordered">
          <tr>
              <td class="w-20 font-weight-bold bg-cinza text-center">Assinatura do Responsável pela Gestão do Fundo</td>
              <td class="w-80 font-16 text-center pt-5 align-bottom">

                  <p>____________________________________________________________</p>
                  <p><b>{{$plano->Gestor->getNomeCompleto()}}</b></p>

              </td>
          </tr>
      </table>

      {{-- ###################################################### ANEXOS ######################################################--}}

      @if(!empty($anexo) && $anexo)

          {{-- NOVA PÁGINA --}}
          <div class="page-break"></div>

          {{-- cabeçalho --}}
           @include('pdf.cabecalho')


          {{-- TITULO --}}
          <div class="row">
              <div class="col-md-12 text-center">
                  <h5>ANEXO I</h5>
              </div>
          </div>

          {{-- EIXO --}}
          <div class="row">
              <div class="col-md-12 text-center">
                  <h3 class="text-uppercase">{{$plano->Eixo->getNome()}}</h3>
              </div>
          </div>

          {{-- PERCORRE AS AÇÕES DO PLANO --}}
          @foreach ($plano->Acoes as $acao)

              {{-- TITULO AÇÃO --}}
              <div class="row">
                  <div class="col-md-12 text-center">
                      <h4>{{$acao->getTitulo()}}</h4>
                  </div>
              </div>

              {{-- PERCORRE OS DETALHES DA AÇÃO --}}
              <table class="table-bordered text-center">
                  <thead class="bg-cinza">
                      <th class="w-5">ITEM</th>
                      <th class="w-10">GRUPO</th>
                      <th class="w-10">BENEFICIARIO</th>
                      <th class="w-50">DESCRIÇÃO</th>
                      <th class="w-5">UND</th>
                      <th class="w-5">QTD</th>
                      <th class="w-5">VALOR</th>
                      <th class="w-10">TOTAL</th>
                  </thead>
                  <tbody>

                      @if(!empty($acao->Detalhes) && $acao->Detalhes->count() > 0)
                          @foreach ($acao->Detalhes as $item)
                              <tr>
                                  <td>{{($loop->index + 1)}}</td>
                                  <td>{{$item->GrupoDespesa->getDescricao()}}</td>
                                  <td class="text-center">{{$item->Beneficiario->getNome()}}</td>
                                  <td class="text-left">{{$item->getDescricao()}}</td>
                                  <td>{{$item->getUnidade()}}</td>
                                  <td>{{$item->getQtd()}}</td>
                                  <td class="text-right">{{Util::FormataMoeda($item->getVlrUnitario())}}</td>
                                  <td class="text-right">{{Util::FormataMoeda($item->getVlrTotal())}}</td>
                              </tr>
                          @endforeach
                      @else

                          <tr>
                              <td colspan="8">Nenhum detalhe encontrado</td>
                          </tr>

                      @endif

                      <tr class="bg-cinza">
                          <td colspan="7" class="text-right font-weight-bold pr-2">VALOR TOTAL(R$)</td>
                          <td class="text-right font-weight-bold">{{Util::FormataMoeda($acao->ValorTotalDetalhes())}}</td>
                      </tr>

                  </tbody>
              </table>
          @endforeach

      @endif


    </body>
</html>
