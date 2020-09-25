@extends('layouts.layout_base',['titulo'=>'Administrador'])

 {{-- CSS do layout --}}
@section('css_layout')

    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="{{URL::asset('plugins/bootstrap_v4/css/bootstrap.min.css')}}"/>

    {{-- Font Awesome --}}
   <link rel="stylesheet" href="{{URL::asset('plugins/font-awesome-5.11.2/css/fontawesome.min.css')}}"/>
   <link rel="stylesheet" href="{{URL::asset('plugins/font-awesome-5.11.2/css/all.min.css')}}"/>
    <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="{{URL::asset('temas/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    {{-- Theme style --}}
    <link rel="stylesheet" href="{{URL::asset('temas/adminlte3/css/AdminLTE.css')}}"/>

    <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <style>
        html
        {
            font-size: 14px;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333333;
            background-color: #fff;
            }

            * {
    box-sizing: border-box;
}
    </style>


@endsection

{{-- JS do layout --}}
@section('scripts_layout')

    <!-- jQuery UI 1.11.4 -->
    <script src="{{URL::asset('temas/adminlte3/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    {{-- Bootstrap 4 --}}
    <script src="{{URL::asset('plugins/bootstrap_v4/js/bootstrap.min.js')}}"></script>

    <!-- overlayScrollbars -->
    <script src="{{URL::asset('temas/adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

    {{-- AdminLTE App --}}
    <script src="{{URL::asset('temas/adminlte3/js/adminlte.min.js')}}"></script>


@endsection

{{-- CSS do body do layout --}}
@section('layout_class_body')
hold-transition sidebar-mini layout-fixed
@endsection

@section('layout')

    <div class="wrapper">
        @include('layouts.adminlte3.barra_superior')
        @include('layouts.adminlte3.menu')


        @yield('conteudo')

        @include('layouts.adminlte3.rodape')

    </div>

    @include('partials.creditos')
@endsection
