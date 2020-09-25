@extends('layouts.layout_pagina', 
[
    'icone_titulo'=>'fa fa-building',
    'titulo'=>'Órgãos Governamentais',
    'breadcrumb'=>['Administração','Órgão']
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
                <button id="btnNovoOrgao" type="button" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Adicionar Órgão
                </button>
            </div>
        </div>
        <br/>

        <div class="row mt-3">
            <div class="col-md-12">

                <table id="tbOrgao" class="table table-responsive table-hover table-striped table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Sigla</th>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>Gestor</th>
                            <th>Responsável</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orgaos as $org)

                            <tr>
                                <td>{{$org->getSigla()}}</td>
                                <td>{{$org->getDescricao()}}</td>
                                <td>{{$org->getCnpj()}}</td>
                                <td>{{$org->Gestor->getNomeCompleto()}}</td>
                                <td>{{$org->Responsavel->getNomeCompleto()}}</td>
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