<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @font-face {font-family: 'taile';src: url('/css/fonts/taile.ttf') format('truetype');}
            html{font-family: taile;font-size:10px;line-height: 1;}
            body{background-size:50% 50%;background-repeat:no-repeat;/*opacity: 0.2;*/}
            footer {position: fixed;left: 0;bottom: 0;width: 100%;text-align: center;opacity: 0.9;}
            .page-break {page-break-after: always;}
            .msg{line-height: 1.5 !important;font-size:8px;}
            .recuo { text-indent:4em }
            .div-letra{width: 20px;height: 17px;}
            .div-letra-tamanho{width: 20px;height: 17px;}
            .row {width: 100%;}
            .col-md-1 {width: 8.333333333%;}
            .col-md-2 {width: 16.666666667%;}
            .col-md-3 {width: 24.999999999%;}
            .col-md-6 {width: 49.999999998%;}
            .col-md-7 {width: 58.333333331%;}
            .col-md-8 {width: 66.666666664%;}
            .col-md-9 {width: 74.999999997%;}
            .col-md-10 {width: 83.33333333%;}
            .col-md-11 {width: 91.666666663%;}
            .col-md-12 {width: 99.999999996%;}
            .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
            .col-md-auto{min-height: 1px;padding-right: 15px;padding-left: 15px;}
            .text-justify {text-align: justify !important;}
            .ml-0,.mx-0 {margin-left: 0 !important;}
            .ml-auto,.mx-auto {margin-left: auto !important;}
            .pl-0,.px-0 {padding-left: 0 !important;}
            .font-weight-bold{font-weight: 700 !important;}
            .float-left {float: left !important;}
            .float-right {float: right !important;}
            .float-none {float: none !important;}

            .text-left{text-align: left !important;}
            .text-right{text-align: right !important;}
            .text-center {text-align: center !important;}
            .text-top {text-align: top !important;}
            .text-white {color: #fff !important;}
            .text-primary {color: #007bff !important;}
            .text-secondary {color: #6c757d !important;}
            .text-success {color: #28a745 !important;}
            .text-info {color: #17a2b8 !important;}
            .text-warning {color: #ffc107 !important;}
            .text-danger {color: #dc3545 !important;}
            .text-light {color: #f8f9fa !important;}
            .text-dark {color: #343a40 !important;}
            .text-body {color: #212529 !important;}
            .text-muted {color: #6c757d !important;}
            .text-black-50 {color: rgba(0, 0, 0, 0.5) !important;}
            .text-white-50 {color: rgba(255, 255, 255, 0.5) !important;}

            .bg-primary {background-color: #006666 !important;}
            .border {border: 1px solid #dee2e6 !important;}
            .border-primary {border-color: #007bff !important;}
            .border-secondary {border-color: #6c757d !important;}
            .border-success {border-color: #28a745 !important;}
            .border-info {border-color: #17a2b8 !important;}
            .border-warning {border-color: #ffc107 !important;}
            .border-danger {border-color: #dc3545 !important;}
            .border-light {border-color: #f8f9fa !important;}
            .border-dark {border-color: #343a40 !important;}
            .border-white {border-color: #fff !important;}
            .rounded {border-radius: 5px !important;}
            .p-0 {padding: 0 !important;}
            .p-1 {padding: 0.25rem !important;}
            .mt-2,.my-2 {margin-top: 0.5rem !important;}
            .pt-2,.py-2 {padding-top: 0.5rem !important;}
            .pb-4,.py-4 {padding-bottom: 1.5rem !important;}
            
            /* tabela */
            table{border-collapse: collapse;width: 100%;margin-bottom: 1rem;background-color: transparent;}
            td[class^="col-"]{line-height: 5px;padding-top:2px;}
            .table th,
            .table td {padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;}
            .table thead th {vertical-align: bottom;border-bottom: 2px solid #dee2e6;}
            .table tbody + tbody {border-top: 2px solid #dee2e6;}
            .table .table {background-color: #fff;}
            .table-bordered {border: 1px solid #dee2e6;}
            .table-bordered th,.table-bordered td {border: 1px solid #dee2e6;}
            .table-bordered thead th,.table-bordered thead td {border-bottom-width: 2px;}
            .table-striped tbody tr:nth-of-type(odd) {background-color: rgba(0, 0, 0, 0.05);}
            .table-hover tbody tr:hover {background-color: rgba(0, 0, 0, 0.075);}

            /* tamanhos de font */
            .font-8{font-size: 8px;}
            .font-9{font-size: 9px;}
            .font-10{font-size: 10px;}
            .font-12{font-size: 12px;}
            .font-14{font-size: 14px;}
            .font-16{font-size: 16px;}
            .font-18{font-size: 18px;}
            .font-20{font-size: 20px;}
            .font-24{font-size: 24px;}
            .font-28{font-size: 28px;}
            .font-30{font-size: 30px;}

            .jumbotron{padding: 2rem 1rem;margin-bottom: 2rem;background-color: #e9ecef;border-radius: 0.3rem;}

        </style>
	</head>
    <body>
        <!-- cabeçalho -->
        <table>
            <tr class="row bg-primary text-white text-center">
                <td class="col-md-1">
                    <img src="https://sisact.org.br/img/logo.png" height="90"/>
                </td>
                <td class="col-md-12  ">
                    <h2>@yield('titulo')</h2>
                </td>
            </tr>
        </table>

        @yield('conteudo')

        <!-- rodapé -->
        <footer class="row bg-primary text-white">
            <p> SISACT - Sistema Integrado de Acolhidos em Comunidades Terapêuticas</p>
            <p><a href="https://sisact.org.br">www.sisact.org.br</a></p>
        </footer>
        
    </body>
</html>

