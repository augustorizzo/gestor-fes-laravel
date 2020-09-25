@extends('layouts.adminlte2418.app')

@section('conteudo')

    <div class="content-wrapper">

        @include('layouts.adminlte2418.breadcrumb',['icone_titulo'=>$icone_titulo,'titulo'=>$titulo,'breadcrumb'=>$breadcrumb])

        <section class="content">
            @yield('pagina')
        </section>

    </div>

@endsection