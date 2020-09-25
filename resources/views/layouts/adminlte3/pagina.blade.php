@extends('layouts.adminlte3.app')

@section('conteudo')

    <div class="content-wrapper">


        @include('layouts.adminlte3.breadcrumb',['icone_titulo'=>$icone_titulo,'titulo'=>$titulo,'breadcrumb'=>$breadcrumb])

        <section class="content">
            @yield('pagina')
        </section>

    </div>

@endsection
