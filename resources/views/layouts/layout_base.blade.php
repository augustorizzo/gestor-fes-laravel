<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="csrf-token" content="{{csrf_token()}}"/>
        <meta name="description" content="{{env('APP_DESCRIPTION')}}"/>

        {{-- Titulo --}}
        <title>{{env('APP_NAME')}} {{!empty($titulo) ? (' - '.$titulo) : ''}}</title>

        {{-- favicon --}}
        <link rel="shortcut icon" href="{{ URL::asset(env('APP_FAVICON'))}}" type="image/x-icon"/>

        {{-- Plugins --}}
        <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css')}}"/>
        <link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css')}}"/>

        {{-- CSS --}}
        <link rel="stylesheet" href="{{ URL::asset('css/views/main_layout.css')}}"/>

        @yield('css_layout')
        @yield('css')

        <style>

            /*
            .nav-tabs .nav-item.show, .nav-tabs .nav-item.active .nav-link, .nav-tabs .nav-link.active
            {
                color: #fff !important;
                background-color: {{env('APP_PRIMARY_COLOR')}} !important;
                border-color: #dee2e6 #dee2e6 #fff;
            }

            .tab-content
            {
                border-top: 2px solid {{env('APP_PRIMARY_COLOR')}};
            }
            */
            .text-primary
            {
                color: {{env('APP_PRIMARY_COLOR')}} !important;
            }

            .se-pre-con
            {
                /*color: {{env('APP_PRIMARY_COLOR')}} !important;*/
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                /*background: url(../img/loader/64x/Preloader_2.gif) center no-repeat; */
                /*background-color: #0a0066;*/
                background-color: rgba(255, 255, 255, 0.5);

            }

        </style>
    </head>
    <body class="@yield('layout_class_body')">

    <input id="hdnUrlBase" type="hidden" value="{{env('APP_URL')}}"/>

    {{-- Loading --}}
    <div class="se-pre-con text-center">
      <i class="fa fa-spinner fa-spin fa-4x fa-fw loading-pagina centralizar text-primary"></i>
    </div>

    @yield('layout')

    {{-- Necessários --}}
    <script src="{{ URL::asset('plugins/jquery_v3.3.1/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/popper/popper.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/moment/min/moment.min.js') }}"></script>

    {{-- Plugins --}}
    <script src="{{ URL::asset('plugins/sweetalert2/sweetalert2.all.min.js') }}" ></script>
    <script src="{{ URL::asset('plugins/JqueryMaxLength/jquery.maxlength.js') }}" ></script>
    <script src="{{ URL::asset('plugins/jquery_mask/jquery.mask.min.js') }}" ></script>

    <script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}" ></script>
    <script src="{{ URL::asset('plugins/select2/js/i18n/pt-BR.js') }}" ></script>

    {{-- JS das msg  do layout --}}
    <script src="{{ URL::asset('js/views/layout_msg.js') }}" ></script>


    {{-- Mensagens do controller --}}
    <script type="text/javascript">

        const SESSAO_USUARIO = {{(!empty(session('user.session')) ? session('user.session') : 'null')}},
            TEMPO_SESSAO = {{config('session.lifetime')}},
            HORA_ATUAL_SERVIDOR = {{Carbon::now()->getTimestamp()}};
        var TEMPO_SESSAO_RESTANTE = null;

        @if (count($errors) > 0)
            var message = "";

            @foreach($errors->all() as $error)
                message += "{{ $error }}\n";
            @endforeach

            MensagemBox('erro',message,'');
        @endif

        @if(session('erro'))
            MensagemBox ('erro',"{{ session('msg_titulo') }}","{{ session('erro') }}","{{ session('msg_timer') }}");
        @elseif(session('sucesso'))
            MensagemBox ('sucesso',"{{ session('msg_titulo') }}","{{ session('sucesso') }}","{{ session('msg_timer') }}");
        @elseif(session('alerta'))
            MensagemBox ('alerta',"{{ session('msg_titulo') }}","{{ session('alerta') }}","{{ session('msg_timer') }}");
        @elseif(session('info'))
            MensagemBox ('info',"{{ session('msg_titulo') }}","{{ session('info') }}","{{ session('msg_timer') }}");
        @endif
    </script>

    {{-- JS do Layout --}}
    <script src="{{ URL::asset('js/views/layout.js') }}" ></script>

    @yield('scripts_layout')
    @yield('scripts')
  </body>
</html>
