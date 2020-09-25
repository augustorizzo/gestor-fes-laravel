@extends('layouts.layout_base')

@section('css')

  <!-- Bootstrap do Layout -->
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap_v4/bootstrap.min.css')}}"/>

   <!-- plugins -->
   <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/fontawesome.min.css')}}"/>
   <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/all.min.css')}}"/>

   <!-- Tema -->
   <link rel="stylesheet" href="{{URL::asset('temas/atlantis/css/fonts.min.css')}}">
   
  <style>
    @charset "utf-8";
   
    [class*="fontawesome-"]:before 
    {
      font-family: 'FontAwesome', sans-serif;
    }
  
    /* ---------- GENERAL ---------- */
  


    /*   Login   */
    .login-main
    {
      background: {{env('APP_SECONDARY_COLOR')}}; /* Old browsers */
      background: -moz-radial-gradient(center, ellipse cover,  {{env('APP_SECONDARY_COLOR')}} 1%, {{env('APP_PRIMARY_COLOR')}} 100%); /* FF3.6+ */
      background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,{{env('APP_SECONDARY_COLOR')}}), color-stop(100%,{{env('APP_PRIMARY_COLOR')}})); /* Chrome,Safari4+ */
      background: -webkit-radial-gradient(center, ellipse cover,  {{env('APP_SECONDARY_COLOR')}} 1%,{{env('APP_PRIMARY_COLOR')}} 100%); /* Chrome10+,Safari5.1+ */
      background: -o-radial-gradient(center, ellipse cover,  {{env('APP_SECONDARY_COLOR')}} 1%,{{env('APP_PRIMARY_COLOR')}} 100%); /* Opera 12+ */
      background: -ms-radial-gradient(center, ellipse cover,  {{env('APP_SECONDARY_COLOR')}} 1%,{{env('APP_PRIMARY_COLOR')}} 100%); /* IE10+ */
      background: radial-gradient(ellipse at center,  {{env('APP_SECONDARY_COLOR')}} 1%,{{env('APP_PRIMARY_COLOR')}} 100%); /* W3C */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{{env('APP_SECONDARY_COLOR')}}', endColorstr='{{env('APP_PRIMARY_COLOR')}}',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
      height:calc(100vh);
      width:100%;
    }

    * 
    {
      box-sizing: border-box;
      margin:0px auto;
      &:before,
      &:after 
      {
        box-sizing: border-box;
      }
  
    }
  
    body {
      
        color: #606468;
      font: 87.5%/1.5em 'Open Sans', sans-serif;
      margin: 0;
    }
  
    a {
      color: #eee;
      text-decoration: none;
    }
  
    a:hover {
      text-decoration: underline;
    }
  
    input {
      border: none;
      font-family: 'Open Sans', Arial, sans-serif;
      font-size: 14px;
      line-height: 1.5em;
      padding: 0;
      -webkit-appearance: none;
    }
  
    p {
      line-height: 1.5em;
    }
  
    .clearfix {
      *zoom: 1;
  
      &:before,
      &:after {
        content: ' ';
        display: table;
      }
  
      &:after {
        clear: both;
      }
  
    }
  
    .container {
      left: 50%;
      position: fixed;
      top: 50%;
      transform: translate(-50%, -50%);
    }
  
    /* ---------- LOGIN ---------- */
  
    #login form{
      width: 250px;
    }
    #login, .logo{
        display:inline-block;
        width:40%;
    }
    #login{
    /*border-right:1px solid #000;*/
      padding: 0px 22px;
      width: 59%;
    }
    .logo{
    color:#fff;
    font-size:50px;
      line-height: 125px;
    }
  
    #login form span.fa {
      background-color: #fff;
      border-radius: 3px 0px 0px 3px;
      color: #000;
      display: block;
      float: left;
      height: 50px;
        font-size:24px;
      line-height: 50px;
      text-align: center;
      width: 50px;
    }
  
    #login form input {
      height: 50px;
    }

    #login form input[type=submit]
    {
      /*background-color: {{env('APP_PRIMARY_COLOR')}} !important;*/
    }

    fieldset{
        padding:0;
        border:0;
        margin: 0;
  
    }
    #login form input[type="text"], input[type="password"] {
      background-color: #fff;
      border-radius: 0px 3px 3px 0px;
      color: #000;
      margin-bottom: 1em;
      padding: 0 16px;
      width: 200px;
    }
  
    #login > p {
      text-align: center;
    }
  
    #login > p span {
      padding-left: 5px;
    }
    .middle {
      display: flex;
      width: 600px;
    }
  </style>
@endsection

@section('scripts')

  <!-- Bootstrap do Layout -->
  <script src="{{ URL::asset('js/bootstrap_v4/bootstrap.min.js') }}" ></script>

@endsection

@section('layout')

  <div class="login-main">

      
    <div class="container">
      <center>
        
        <div class="mb-3 d-sm-block d-md-none">
          <img src="{{env('APP_LOGO')}}" height="100"/>
          <h2 class="text-primary">{{env('APP_NOME')}}</h2>
          <h6 class="text-secondary">{{env('APP_SLOGAN')}}</h6>
        </div>

        <div class="middle">
          <div id="login" class="border-right border-primary mr-3 pr-0">

            <form id="{{$id_form_login}}" method="POST" action="{{$rota_login}}">
              @csrf

              <fieldset class="clearfix">
                <p><span class="fa fa-user bg-primary text-white"></span>
                  <input type="text" class="form-control" name="{{$name_usuario}}" placeholder="{{$placeholder_usuario}}" autocomplete="off" required>
                </p>
                <p>
                  <span class="fa fa-lock bg-primary text-white"></span>
                  <input type="password" class="form-control" name="{{$name_senha}}"  placeholder="{{$placeholder_senha}}" autocomplete="off" required>
                </p>
        
                <div class="row">
                  <div class="col-md-12">
                    <input type="submit" value="Entrar" class="btn btn-primary form-control" />
                  </div>
                  
                </div>
              </fieldset>
              <div class="clearfix"></div>
            </form>

            <div class="clearfix"></div>

          </div> <!-- end login -->
          <div class="logo my-auto">
            <img src="{{env('APP_LOGO')}}" height="100" class="pl-3">
            <h2 class="text-primary">{{env('APP_NOME')}}</h2>
            <h6 class="text-secondary">{{env('APP_SLOGAN')}}</h6>
            <div class="clearfix"></div>
          </div>

        </div>
      </center>

    </div>
  </div>
@endsection