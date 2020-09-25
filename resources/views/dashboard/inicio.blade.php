@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fas fa-fa fa-dashboard',
    'titulo'=>'DashBoard',
    'breadcrumb'=>['Início','Dashboard']
])

@section('scripts')
    <script src="{{{ URL::asset('js/views/adm/sistemas.js') }}}"></script>
@endsection

@section('pagina')

    <!-- painel superior -->
    <div class="row">

        <div class="col-lg-2 col-xs-6">

            <div class="small-box bg-olive">

                    <div class="inner">
                        <p style="font-size: medium;">Planejamento</p>
                        <h3 style="font-size: xx-large;">{{$informacao["total"]}}</h3>
                        <p style="text-align: right; font-size: medium;"><?php echo number_format($contarinformacao["qtd"])+number_format($contarinformacao["qtd"]);?> processos</p>
                    </div>

                <div class="icon">
                    <i class="ion-ios-compose-outline "></i>
                </div>

                <a href="informacao_caixa" class="small-box-footer">
                    Mais info <i class="fa fa-arrow-circle-right"></i>
                </a>

            </div>

        </div>

        <div class="col-lg-2 col-xs-6">

            <div class="small-box bg-gray">

                <div class="inner">

                    <p style="font-size: medium;">Informação</p>

                    <h3 style="font-size: xx-large;"><?php echo number_format($informacao["total"],2,',', '.'); ?></h3>

                    <p style="text-align: right; font-size: medium;"><?php echo number_format($contarinformacao["qtd"])+number_format($contarinformacao["qtd"]);?> processos</p>

                </div>

                <div>

                <i class="icon ion-speedometer"></i>

                </div>

                <a href="informacao_caixa" class="small-box-footer">

                        Mais info <i class="fa fa-arrow-circle-right"></i>

                </a>

            </div>

        </div>

        <div class="col-lg-2 col-xs-6">

            <div class="small-box bg-aqua">

                <div class="inner">

                <p style="font-size: medium;">Dotação</p>

                <h3 style="font-size: xx-large;"><?php echo number_format($dotacao["total"],2,',', '.'); ?></h3>

                <p style="text-align: right"><?php echo number_format($contardotacao["qtd"]);?> processos</p>

                </div>

                <div class="icon">

                <i class="ion-android-unlock"></i>

                </div>

                <a href="dotacao" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

            </div>

        </div>

        <div class="col-lg-2 col-xs-6">

            <div class="small-box bg-red">

                <div class="inner">

                <p style="font-size: medium;">Empenho</p>

                    <h3  style="font-size: xx-large;"><?php echo number_format($empenho["total"],2,',', '.'); ?></h3>

                <p style="text-align: right"><?php echo number_format($contarempenho["qtd"]);?> Processos</p>

                </div>

                <div class="icon">

                <i class="ion-android-lock"></i>

                </div>

                <a href="empenho" class="small-box-footer">More info

                <i class="fa fa-arrow-circle-right"></i>

                </a>

            </div>

        </div>

        <div class="col-lg-2 col-xs-6">
                <!-- small box -->

            <div class="small-box bg-yellow">

                <div class="inner">

                    <p style="font-size: medium;">Liquidação</p>

                    <h3 style="font-size: xx-large;"><?php echo number_format($liquidacao["total"],2,',', '.'); ?></h3>

                    <p style="text-align: right"><?php echo number_format($contarliquidacao["qtd"]);?> Processos</p>

                </div>

                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>

                <a href="liquidacao" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>

            </div>

        </div>

        <div class="col-lg-2 col-xs-6">

            <div class="small-box bg-green">

                <div class="inner">

                <p style="font-size: medium;">Pagamento</p>

                    <h3 style="font-size: xx-large;"><?php echo number_format($ob["total"],2,',', '.'); ?></h3>

                <p style="text-align: right"><?php echo number_format($contarob["qtd"]);?> Processos</p>

                </div>

                <div class="icon">

                <i class="ion-social-usd"></i>

                </div>

                <a href="ob" class="small-box-footer">More info

                <i class="fa fa-arrow-circle-right"></i>

                </a>

            </div>

        </div>

    </div>

    <!-- /painel superior -->


@endsection
