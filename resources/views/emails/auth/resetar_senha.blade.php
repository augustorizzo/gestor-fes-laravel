@extends('layouts.base_email')

@section('titulo')
Sua senha foi resetada
@endsection

@section('conteudo')
    
    <div class="text-center">
        <h2>Olá {{$nome}}, sua senha de acesso ao {{env('APP_SISTEMA')}} foi resetada.</h2>
    </div>


    <div class="font-16 jumbotron col-md-5 text-center">
        <p>senha temporária:</p>
        <h3>{{$senha}}</h3>
    </div>

    <h2>Caso você não reconheça esta ação, clique no link abaixo para bloqueio imediato do acesso:</h2>
    <p class="text-justify font-16">
        <a href="{{route('adm.usuario.senha_alterada_nao_reconhecida',[Util::StringAleatoria(),Util::StringAleatoria(),$id_usuario,Util::StringAleatoria()])}}">{{route('adm.usuario.senha_alterada_nao_reconhecida',[Util::StringAleatoria(),Util::StringAleatoria(),$id_usuario,Util::StringAleatoria()])}}</a>
    </p>
    
@endsection