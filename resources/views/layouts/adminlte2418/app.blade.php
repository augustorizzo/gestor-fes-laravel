@extends('layouts.layout_base',['titulo'=>'Administrador'])

 {{-- CSS do layout --}}
@section('css_layout')

    <style>
        /* bug no bootstrap 3 que deixa o sweetalert2 pequeno*/
      .swal2-popup {font-size: 1.6rem !important;}
    </style>

    {{-- Bootstrap 3.3.7 --}}
    <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/css/bootstrap/bootstrap.css')}}"/>

    {{-- Font Awesome --}}
    {{-- <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/bower_components/font-awesome/css/font-awesome.min.css')}}"/> --}}

    <!-- plugins -->
   <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/fontawesome.min.css')}}"/>
   <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/all.min.css')}}"/>

    {{-- Ionicons --}}
    <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/bower_components/Ionicons/css/ionicons.min.css')}}"/>

    {{-- Theme style --}}
    <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/css/AdminLTE.css')}}"/>

    {{-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. --}}
    <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/css/skins/_all-skins.css')}}"/>

    <style>
        .main-header,.wrapper
        {
            box-shadow: 1px 1px 0px {{env('APP_SECONDARY_COLOR')}};
        }
    </style>

@endsection

{{-- JS do layout --}}
@section('scripts_layout')

    {{-- jQuery UI 1.11.4 --}}
    <script src="{{URL::asset('temas/adminlte2418/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    {{-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --}}
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    {{-- Bootstrap 3.3.7 --}}
    <script src="{{URL::asset('temas/adminlte2418/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    {{-- AdminLTE App --}}
    <script src="{{URL::asset('temas/adminlte2418/js/adminlte.min.js')}}"></script>

<script>

</script>

@endsection

{{-- CSS do body do layout --}}
@section('layout_class_body')
hold-transition skin-blue sidebar-mini
@endsection

@section('layout')

    <div class="wrapper">
        @include('layouts.adminlte2418.barra_superior')
        @include('layouts.adminlte2418.menu')


        @yield('conteudo')

        @include('layouts.adminlte2418.rodape')

    </div>

    @include('partials.creditos')
@endsection
