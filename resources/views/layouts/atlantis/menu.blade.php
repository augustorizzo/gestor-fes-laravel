<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      
      <!-- Usuário -->
      <div class="user">
        <div class="avatar-sm float-left mr-2 avatar avatar-online">
          <img src="{{Util::CaminhoCompleto(!empty(Auth::user()->getFoto()) ? Auth::user()->getFoto() : 'img/default-user.png') }}" alt="..." class="avatar-img rounded-circle">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
            <span>
              {{Auth::user()->getNomeCompleto()}}
              <span class="user-level">{{Auth::user()->Classe->first()->getDescricao()}}</span>
              <span class="caret"></span>
            </span>
          </a>
          <div class="clearfix"></div>

          <!-- Submenu do usuário -->
          <div class="collapse in" id="collapseExample">
            <ul class="nav">

              <li class="text-center">
                <a href="{{route('logout')}}">
                  <span class="link-collapse">Sair</span>
                </a>
              </li>
            <!--
              <li>
                <a href="#profile">
                  <span class="link-collapse">Meu Perfil</span>
                </a>
              </li>
              <li>
                <a href="#edit">
                  <span class="link-collapse">Editar Perfil</span>
                </a>
              </li>
              <li>
                <a href="#settings">
                  <span class="link-collapse">Configurações</span>
                </a>
              </li>
            -->
            </ul>
          </div>
          <!-- /Submenu do usuário -->

        </div>
      </div>
      <!-- /Usuário -->

      <!-- Menu -->
      <ul class="nav nav-primary">
       
        <!-- Item de menu ativo -->
        <!--
        <li class="nav-item">
          <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Incio</p>
            <span class="caret"></span>
          </a>
          
          <div class="collapse" id="dashboard">
            <ul class="nav nav-collapse">
              
          
              <li>
                <a href="../demo1/index.html">
                  <span class="sub-item">Dashboard 1</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        -->
        <!-- /Item de menu ativo -->

        <!-- (Seção/Agrupamento) de menus -->
        <!--
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">SISREG</h4>
        </li>
      -->
        <!-- /(Seção/Agrupamento) de menus -->

        @foreach(session('user.menus') as $rota)

          @if($rota['submenu']->count() > 0)

            <li class="nav-item {{Util::MenuHierarquia(Route::currentRouteName(),$rota['submenu']) ? 'active' : ''}}">
              <a data-toggle="collapse" href="#rota_{{$rota['id']}}">
                <i class="{{$rota['icone']}}"></i>
                <p>{{$rota['nome']}}</p>
                <span class="caret"></span>
              </a>
              <div id="rota_{{$rota['id']}}" class="collapse {{Util::MenuHierarquia(Route::currentRouteName(),$rota['submenu']) ? 'show' : ''}}">
                <ul class="nav nav-collapse">

                  @foreach($rota['submenu'] as $subRota)
                    @if($subRota['is_menu'])
                      
                      <li class="{{$subRota['rota'] == Route::currentRouteName() ? 'active' : ''}}">
                        <a href="{{route($subRota['rota'])}}">
                          <span class="sub-item">{{$subRota['nome']}}</span>
                        </a>
                      </li>

                    @endif
                  @endforeach

                </ul>
              </div>
            </li>

          @elseif($rota['is_pai'])

            <li class="nav-item">
              <a href="{{route($rota['rota'])}}">
                <i class="{{$rota['icone']}}"></i>
                <p>{{$rota['nome']}}</p>
                <!-- span class="badge badge-success">4</span> -->
              </a>
            </li>

          @endif

        @endforeach

        <!-- template menus 
        <li class="nav-item">
          <a data-toggle="collapse" href="#base">
            <i class="fas fa-layer-group"></i>
            <p>Base</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="base">
            <ul class="nav nav-collapse">
              <li>
                <a href="components/avatars.html">
                  <span class="sub-item">Avatars</span>
                </a>
              </li>
              <li>
                <a href="components/buttons.html">
                  <span class="sub-item">Buttons</span>
                </a>
              </li>
              <li>
                <a href="components/gridsystem.html">
                  <span class="sub-item">Grid System</span>
                </a>
              </li>
              <li>
                <a href="components/panels.html">
                  <span class="sub-item">Panels</span>
                </a>
              </li>
              <li>
                <a href="components/notifications.html">
                  <span class="sub-item">Notifications</span>
                </a>
              </li>
              <li>
                <a href="components/sweetalert.html">
                  <span class="sub-item">Sweet Alert</span>
                </a>
              </li>
              <li>
                <a href="components/font-awesome-icons.html">
                  <span class="sub-item">Font Awesome Icons</span>
                </a>
              </li>
              <li>
                <a href="components/simple-line-icons.html">
                  <span class="sub-item">Simple Line Icons</span>
                </a>
              </li>
              <li>
                <a href="components/flaticons.html">
                  <span class="sub-item">Flaticons</span>
                </a>
              </li>
              <li>
                <a href="components/typography.html">
                  <span class="sub-item">Typography</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#sidebarLayouts">
            <i class="fas fa-th-list"></i>
            <p>Sidebar Layouts</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayouts">
            <ul class="nav nav-collapse">
              <li>
                <a href="sidebar-style-1.html">
                  <span class="sub-item">Sidebar Style 1</span>
                </a>
              </li>
              <li>
                <a href="overlay-sidebar.html">
                  <span class="sub-item">Overlay Sidebar</span>
                </a>
              </li>
              <li>
                <a href="compact-sidebar.html">
                  <span class="sub-item">Compact Sidebar</span>
                </a>
              </li>
              <li>
                <a href="static-sidebar.html">
                  <span class="sub-item">Static Sidebar</span>
                </a>
              </li>
              <li>
                <a href="icon-menu.html">
                  <span class="sub-item">Icon Menu</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Forms</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
            <ul class="nav nav-collapse">
              <li>
                <a href="forms/forms.html">
                  <span class="sub-item">Basic Form</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#tables">
            <i class="fas fa-table"></i>
            <p>Tables</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
              <li>
                <a href="tables/tables.html">
                  <span class="sub-item">Basic Table</span>
                </a>
              </li>
              <li>
                <a href="tables/datatables.html">
                  <span class="sub-item">Datatables</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#maps">
            <i class="fas fa-map-marker-alt"></i>
            <p>Maps</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="maps">
            <ul class="nav nav-collapse">
              <li>
                <a href="maps/jqvmap.html">
                  <span class="sub-item">JQVMap</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#charts">
            <i class="far fa-chart-bar"></i>
            <p>Charts</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="charts">
            <ul class="nav nav-collapse">
              <li>
                <a href="charts/charts.html">
                  <span class="sub-item">Chart Js</span>
                </a>
              </li>
              <li>
                <a href="charts/sparkline.html">
                  <span class="sub-item">Sparkline</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="widgets.html">
            <i class="fas fa-desktop"></i>
            <p>Widgets</p>
            <span class="badge badge-success">4</span>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#submenu">
            <i class="fas fa-bars"></i>
            <p>Menu Levels</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="submenu">
            <ul class="nav nav-collapse">
              <li>
                <a data-toggle="collapse" href="#subnav1">
                  <span class="sub-item">Level 1</span>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="subnav1">
                  <ul class="nav nav-collapse subnav">
                    <li>
                      <a href="#">
                        <span class="sub-item">Level 2</span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="sub-item">Level 2</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a data-toggle="collapse" href="#subnav2">
                  <span class="sub-item">Level 1</span>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="subnav2">
                  <ul class="nav nav-collapse subnav">
                    <li>
                      <a href="#">
                        <span class="sub-item">Level 2</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">
                  <span class="sub-item">Level 1</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="mx-4 mt-2">
          <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a> 
        </li>
        -->
      </ul>
      <!-- /Menu -->

    </div>
  </div>
</div>
<!-- End Sidebar -->
