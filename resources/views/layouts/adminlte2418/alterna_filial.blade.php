@extends('layouts.layout_base')

@section('css')
  
  <!--===============================================================================================-->	
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/vendor/bootstrap/css/bootstrap.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/vendor/animate/animate.css')}}">
  <!--===============================================================================================-->	
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/vendor/css-hamburgers/hamburgers.min.css')}}">
  <!--===============================================================================================-->
  
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/vendor/select2/select2.min.css')}}">

  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/vendor/animsition/css/animsition.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('temas/adminlte2418/login/css/main.css')}}">
  <!--===============================================================================================-->

@endsection

@section('scripts')
  <script src="{{URL::asset('temas/adminlte2418/login/vendor/select2/select2.min.js')}}"></script>
  <script>
    $(document).ready(function()
    {
      $('select').select2();
    });
  </script>

@endsection

@section('layout')

  <div class="limiter">
    <div class="container-login100" style="background-image: url('temas/adminlte2418/login/images/bg-01.jpg');">
      <div class="wrap-login100">
        <form class="login100-form validate-form" action="{{$rota_seta_filial}}" enctype="multipart/form-data" method="POST">
          @csrf

          <span class="login100-form-logo">

            <img src="{{Util::CaminhoCompleto('img/logo.png')}}"/>

          </span>

          <span class="login100-form-title p-b-34 p-t-27">
            Escolha a Filial
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Enter username">
            
            <select id="cbFilial" name="filial" class="input100">
              
              @foreach($filiais as $filial)
                <option value="{{$filial['id']}}">{{$filial['filial']}}</option>
              @endforeach

            </select>
          </div>


          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Selecionar
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection