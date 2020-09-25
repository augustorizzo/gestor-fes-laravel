@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fa fa-building',
    'titulo'=>'Programas Governamentais para a Segurança Pública',
    'breadcrumb'=>['Administração','Programa']
])

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins_proprios/bootstrap4/bootstrap4_reduzido.css')}}"/>
@endsection

@section('scripts')
    
@endsection

@section('pagina')

    <div class="container-fluid card p-3">

        <div class="row">
            <div class="col-md-12">
                <button id="btnNovoPrograma" type="button" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Adicionar Programa
                </button>
            </div>
        </div>
        <br/>

        <div class="row mt-3">
            <div class="col-md-12">

                <table id="tbPrograma" class="table table-responsive table-hover table-striped table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Titulo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($programas as $prog)

                            <tr>
                                <td>{{$prog->getTitulo()}}</td>
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