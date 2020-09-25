

{{--
<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Ajuda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Licença</a>
                </li>

            </ul>
        </nav>
        <div class="copyright ml-auto">
            Desenvolvido por <a href="#">RViana Tecnologia</a> © 2020
        </div>
    </div>
</footer>
--}}

<footer class="main-footer">
    <img src="/img/fes/logo-governo-ssp-2018.png" height="30" alt="">
    <strong>Secretaria de Segurança Pública do Maranhão &copy; 2020-{{Util::GetData()->format('Y')}}</strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> {{env('APP_VERSION')}}
    </div>
</footer>
