@extends('layouts.base_email')

@section('titulo')
Sua senha foi alterada
@endsection

@section('conteudo')
    
    <div class="text-center">
        <h2>Olá {{$nome}}, sua senha de acesso ao {{env('APP_SISTEMA')}} foi alterada.</h2>
    </div>
    
    
    <h2>Caso você não reconheça esta ação, clique no link abaixo para bloqueio imediato do acesso:</h2>
    <p class="text-justify font-16">
        <a href="{{route('adm.usuario.senha_alterada_nao_reconhecida',[Util::StringAleatoria(),Util::StringAleatoria(),$id_usuario,Util::StringAleatoria()])}}">{{route('adm.usuario.senha_alterada_nao_reconhecida',[Util::StringAleatoria(),Util::StringAleatoria(),$id_usuario,Util::StringAleatoria()])}}</a>
    </p>
    
@endsection