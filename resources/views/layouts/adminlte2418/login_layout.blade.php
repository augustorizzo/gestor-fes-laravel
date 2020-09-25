@extends('layouts.layout_base')

@section('css')

   <!-- Bootstrap do Layout -->
   <link rel="stylesheet" href="{{ URL::asset('css/bootstrap_v4/bootstrap.min.css')}}"/>

   <!-- plugins -->
   <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/fontawesome.min.css')}}"/>
   <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome-5.11.2/css/all.min.css')}}"/>

    <style>
        /* Coded with love by Mutiullah Samim */
		body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			background: #0b0b45 !important;
		}
		.user_card {
			/*height: 400px;*/
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			/*background: #e5a80f;*/

            background: linear-gradient(#e5a80f,#f3cc30,#e5a80f);

			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 270px;
			width: 270px;
			top: -130px;
			border-radius: 50%;
			background: #0b0b45;
			padding: 10px;
			text-align: center;
		}
        .brand_logo
        {
			height: 250px;
			width: 250px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #0b0b45 !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #0b0b45 !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
        .input-group
        {
            box-shadow: 0 1px 3px darkblue;
        }
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #0b0b45 !important;
		}
    </style>

@endsection

@section('scripts')

 <!-- Bootstrap do Layout -->
 <script src="{{ URL::asset('js/bootstrap_v4/bootstrap.min.js') }}" ></script>

<script src="{{$script_login}}"></script>

@endsection

@section('layout_class_body')
    bg-gradient-primary
@endsection

@section('layout')

    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card pt-4 pb-4">
                <div class="d-flex justify-content-center pt-4">
                    <div class="brand_logo_container">
                        <img src="{{env('APP_LOGO')}}" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form id="{{$id_form_login}}" action="{{$rota_login}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="{{$name_usuario}}" class="form-control input_user" value="" placeholder="{{$placeholder_usuario}}" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="{{$name_senha}}" class="form-control input_pass" value="" placeholder="{{$placeholder_senha}}" required>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="{{$name_check_lembrar}}" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Lembrar-me</label>
                            </div>
                        </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="submit" name="button" class="btn login_btn">Acessar</button>
                </div>
                    </form>
                </div>

                {{--

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Don't have an account? <a href="#" class="ml-2">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>

                --}}

            </div>
        </div>
    </div>

@endsection
