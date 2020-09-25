<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    {{-- Left navbar links --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      {{--
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
      --}}
    </ul>


    {{-- Right navbar links --}}
    <ul class="navbar-nav ml-auto">

        {{-- TEMPO RESTANTE DA SESSÃO --}}
        <li class="mt-2 text-white">
            <span id="spnTempoSessao" class="font-weight-bold" title="Tempo restante da sessão">00:00:00</span>
        </li>

      {{-- Notifications Dropdown Menu --}}
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messagnpm audit fixes
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{Util::UsuarioFoto()}}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{Auth::user()->getNomeCompleto()}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right border border-white">
                {{-- User image --}}
                <li class="user-header bg-primary">
                    <img src="{{Util::UsuarioFoto()}}" class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{Auth::user()->getNomeCompleto()}}
                        <small>{{Auth::user()->getEmail()}}</small>
                    </p>
                </li>

                {{-- Menu Body --}}
                {{--
                <li class="user-body">
                    <div class="row">
                    <div class="col-4 text-center">
                        <a href="#">Followers</a>
                    </div>
                    <div class="col-4 text-center">
                        <a href="#">Sales</a>
                    </div>
                    <div class="col-4 text-center">
                        <a href="#">Friends</a>
                    </div>
                    </div>

                </li>
                --}}

                {{-- Menu Footer--}}
                <li class="user-footer">
                    <a href="{{ route('perfil.index') }}" class="btn btn-default btn-flat">Perfil</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sair</a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
