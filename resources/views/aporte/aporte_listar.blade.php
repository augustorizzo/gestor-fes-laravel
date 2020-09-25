@extends('layouts.layout_pagina',
[
    'icone_titulo'=>'fa fa-funnel-dollar',
    'titulo'=>'Aportes',
    'breadcrumb'=>['Aporte','Listagem']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.css')}}"/>
@endsection

@section('scripts')
    <script src="{{{ URL::asset('js/views/aporte/aporte_listar.js') }}}"></script>
@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        <div class="row mt-3">
            <div class="col-md-12">
                <button id="btnNovoAporte" type="button" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Novo Aporte
                </button>
            </div>
        </div>
        <br/>

        <div class="row mt-3">
            <div class="col-md-12 table-responsive">

                <table id="tbAporte" class="table table-hover table-striped table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Apelido</th>
                            <th class="w-15 text-center">Tipo</th>
                            <th class="w-10 text-center">Data Lançamento</th>
                            <th class="w-10 text-center">Data Validade</th>
                            <th class="w-10 text-center">Valor Total</th>
                            <th class="w-10 text-center">Status</th>
                            <th class="w-5  text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($aportes as $aporte)

                            <tr class="text-left">
                                <td id="apelido_{{$aporte->getId()}}">{{$aporte->getApelido()}}</td>
                                <td>{{$aporte->Tipo->getDescricao()}}</td>
                                <td class="text-center">{{$aporte->getDtLancamento()}}</td>
                                <td class="text-center">{{$aporte->getDtVigFim()}}</td>
                                <td class="text-right">{{Util::FormataMoeda($aporte->ValorTotal())}}</td>
                                <td class="text-center">
                                    <span class="badge-pill {{STATUS_APORTE::getBadge($aporte->getStatus())}}">
                                        {{STATUS_APORTE::getTipo($aporte->getStatus())}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{route('aporte.acessar',Util::Criptografa($aporte->getId()))}}" class="fa fa-edit text-success cursor-pointer" title="Editar"></span>
                                    <span name="delBtn" class="fa fa-trash ml-2 text-danger cursor-pointer" data="{{$aporte->getId()}}"  title="Excluir"></span>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
