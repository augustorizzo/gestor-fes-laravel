@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fas fa-code-branch',
    'titulo'=>'Classes x Rotas',
    'breadcrumb'=>['Admin','Classes x Rotas']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins/jquery-picklist/picklist.css') }}" />
    <link rel="stylesheet" href="{{{ URL::asset('plugins/bootstrap-select-1.13.2/bootstrap-select.min.css') }}}" />
@endsection

@section('scripts')
    <script src="{{{ URL::asset('plugins/bootstrap-select-1.13.2/bootstrap-select.min.js') }}}"></script>
    <script src="{{{ URL::asset('plugins/bootstrap-select-1.13.2/i18n/defaults-pt_BR.min.js') }}}"></script>

    <script src="{{{ URL::asset('plugins/jquery-picklist/picklist.js') }}}"></script>
    <script src="{{{ URL::asset('js/views/adm/classe_rota.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">
        <div class="row" >
            <div class="col col-sm-5 text-left">
                <label for="cbClasses" class="col-sm-7 col-form-label text-md-left">Classes</label>
                <br/>
                <select id="cbClasses" class="form-control">

                    <option value="">Selecione</option>

                    @foreach($classes as $classe)
                        <option value="{{$classe->getId()}}">{{$classe->getDescricao()}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <br/>

    <div id="divOpcoes" class="row d-none mt-3">
        <div class="col col-sm-8" align="center">

            <div class="content-center btn-group">
                <button id="btnVincularRotas" type="button" class="btn btn-secondary">Vincular Rotas</button>
                <button id="btnRotaPadrao" type="button" class="btn btn-default">Rota Padrão</button>
            </div>

        </div>
    </div>
    <br/>

    <div id="corpoPagina" class="row" >
        <div class="col col-sm-8">
            <div id="colunaPagina"></div>

            <div id="divRotaPadrao" class="d-none">
                <br/>
                <label for="cbRotaPadrao">Rota Padrão da classe</label>
                <select id="cbRotaPadrao"
                        data-width="100%"
                        data-style="form-control col-sm-8 campo-emserh"
                        data-live-search="true">
                    <option value="">Selecione</option>
                </select>
            </div>

        </div>
    </div>

    </div>
@endsection
