@extends('layouts.atlantis.app')

@section('conteudo')

    <div class="page-inner">

        @include('layouts.atlantis.breadcrumb',['icone_titulo'=>$icone_titulo,'titulo'=>$titulo,'breadcrumb'=>$breadcrumb])

        @yield('pagina')

    </div>

@endsection