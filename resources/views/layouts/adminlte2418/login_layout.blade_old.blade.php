@extends('layouts.layout_base')

@section('css')

  {{-- Bootstrap 3.3.7 --}}
  <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  {{-- Font Awesome --}}
  <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/bower_components/font-awesome/css/font-awesome.min.css')}}">
  {{-- Ionicons --}}
  <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/bower_components/Ionicons/css/ionicons.min.css')}}">
  {{-- Theme style --}}
  <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/css/AdminLTE.min.css')}}">
  {{-- iCheck --}}
  <link rel="stylesheet" href="{{URL::asset('temas/adminlte2418/plugins/iCheck/square/blue.css')}}">
  {{-- Google Font --}}
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .login-page #back
        {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            /background: url("{{URL::asset('img/fes/Brasão_do_Maranhão.svg.png')}}");
            background-size: cover;
            overflow: hidden;
            z-index: -1;
        }

        .login-page
        {
            background: linear-gradient(rgba(0,0,0,1), rgba(0,30,50,1));
        }

        /* bug no bootstrap 3 que deixa o sweetalert2 pequeno*/
      .swal2-popup {font-size: 1.6rem !important;}

    </style>

@endsection

@section('scripts')

 {{-- jQuery 3 --}}
 <script src="{{URL::asset('temas/adminlte2418/bower_components/jquery/dist/jquery.min.js')}}"></script>
  {{-- Bootstrap 3.3.7 --}}
  <script src="{{URL::asset('temas/adminlte2418/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  {{-- iCheck --}}
  <script src="{{URL::asset('temas/adminlte2418/plugins/iCheck/icheck.min.js')}}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>

<script src="{{$script_login}}"></script>

@endsection

@section('layout_class_body')
  hold-transition login-page
@endsection

@section('layout')

    <div id="back"></div>

  <div class="login-box">
    <div class="login-logo">
        <img src="img/logo.png" class="img-responsive" />
    </div>
    {{-- /.login-logo --}}
    <div class="login-box-body">
      <p class="login-box-msg">Acessar o Sistema</p>

      <form id="{{$id_form_login}}" action="{{$rota_login}}" enctype="multipart/form-data" method="post">
        @csrf

        <div class="form-group has-feedback">
          <input type="text" name="{{$name_usuario}}" class="form-control" placeholder="{{$placeholder_usuario}}" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="{{$name_senha}}" class="form-control" placeholder="{{$placeholder_senha}}" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input name="{{$name_check_lembrar}}" type="checkbox"> Lembrar-me
              </label>
            </div>
          </div>
          {{-- /.col --}}
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Acessar</button>
          </div>
          {{-- /.col --}}
        </div>
      </form>

    {{--
      <a href="#">I forgot my password</a><br>
      <a href="register.html" class="text-center">Register a new membership</a>
    --}}

    </div>
    {{-- /.login-box-body --}}
  </div>
  {{-- /.login-box --}}

@endsection
