@extends('layouts.layout_base')

 <!-- CSS do layout -->
@section('css_layout')

    <!-- Bootstrap do Layout -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap_v4/bootstrap.min.css')}}"/>

    <!-- plugins -->
    <link rel="stylesheet" href="{{ URL::asset('js/jquery-ui-1.12.1/jquery-ui.min.css') }}" > 
    <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/fontawesome.min.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/all.min.css')}}"/>

    <!-- Tema -->
    <link rel="stylesheet" href="{{URL::asset('temas/atlantis/css/fonts.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('temas/atlantis/css/atlantis.css')}}">
@endsection

<!-- JS do layout -->
@section('scripts_layout')

    <!-- Bootstrap do Layout -->
    <script src="{{ URL::asset('js/bootstrap_v4/bootstrap.min.js') }}" ></script>

    <!-- Plugins -->
    <script src="{{ URL::asset('js/jquery-ui-1.12.1/jquery-ui.min.js') }}" ></script>
    <script src="{{ URL::asset('js/jquery-ui-1.12.1/i18n/datepicker-pt-BR.js') }}" ></script>

	<!-- Fonts and icons -->
	<script src="{{URL::asset('temas/atlantis/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['temas/atlantis/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>


    <!-- jQuery UI -->
	<script src="{{URL::asset('temas/atlantis/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{URL::asset('temas/atlantis/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
    <script src="{{URL::asset('temas/atlantis/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    
    <!-- Atlantis JS -->
    <script src="{{URL::asset('temas/atlantis/js/atlantis.min.js')}}"></script>

<script>
  
</script>

@endsection

@section('layout')

    <div class="wrapper">
        @include('layouts.atlantis.barra_superior')
        @include('layouts.atlantis.menu')

        <div class="main-panel">
            <div class="content">

				@yield('conteudo')

            </div>
            @include('layouts.atlantis.rodape')
        </div>

    </div>

    @include('partials.creditos')
@endsection