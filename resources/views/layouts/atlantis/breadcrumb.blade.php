<div class="page-header">
    <h4 class="page-title"><i class="{{$icone_titulo}}"></i> {{$titulo}}</h4>
    
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="flaticon-home"></i>
            </a>
        </li>

        @foreach($breadcrumb as $bread)
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a href="#">{{$bread}}</a>
            </li>
        @endforeach

    </ul>

</div>