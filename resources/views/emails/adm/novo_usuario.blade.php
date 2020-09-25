@extends('layouts.base_email')

@section('titulo')

@endsection

@section('conteudo')
     
    <div class="text-center">
        <h2>Olá {{$nome}}, seja bem vindo ao {{env('APP_SISTEMA')}}</h2>
    </div>

    <div class="font-16 jumbotron col-md-5 text-center">
        <p>senha temporária:</p>
        <h3>{{$senha}}</h3>
    </div>

    <p>Para acessar, informe seu CPF e a senha temporária que você está recebendo neste e-mail. Clique no link abaixo para ser redirecionado: </p>

    <p class="col-md-12 text-center font-16">
        <a href="{{env('APP_URL')}}">{{env('APP_URL')}}</a>
    </p>
     
    
@endsection